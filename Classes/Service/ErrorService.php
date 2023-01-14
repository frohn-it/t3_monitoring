<?php

namespace FloPe\T3Monitoring\Service;

use foroco\BrowserDetection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Localization\LanguageService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\PathUtility;

class ErrorService
{
    const TYPE_FE = 0;
    const TYPE_BE = 1;
    private LanguageService $languageService;
    private string $dateFormat;

    public function __construct(LanguageService $languageService)
    {
        $this->languageService = $languageService;
        $this->dateFormat = $this->languageService->sL('LLL:EXT:t3_monitoring/Resources/Private/Language/locallang.xlf:date.format');
    }

    public function getLastErrorList(int $type, int $start = 0, int $size = 20): array
    {
        $result = $this->getErrorCluster($type, $start, $size);

        return $result;
    }

    private function getErrorCluster(int $type, int $start = 0, int $size = 20): array
    {
        $result = [];
        $connection = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable('tx_t3monitoring_log');
        $qb = $connection->createQueryBuilder();
        $qb->selectLiteral('message', 'GROUP_CONCAT(uid) AS uid_list', 'MIN(crdate) AS first_occurrence', 'MAX(crdate) as last_occurrence', 'count(uid) as error_cnt', 'MAX(reviewed) as reviewed')
            ->from('tx_t3monitoring_log')
            ->where(
                $qb->expr()->and(
                    $qb->expr()->eq('type', $type),
                )
            )
            ->groupBy('message')
            ->orderBy('last_occurrence', 'DESC');
        $result['error_total'] = $qb->execute()->rowCount();
        $rows = $qb->setMaxResults($size)
            ->setFirstResult($start)
            ->execute()
            ->fetchAll();
        foreach($rows as $row) {
            $row['chart_data'] = $this->analyzeErrorCluster($row['uid_list']);
            $row['last_occurrence_compare'] = $this->getTimeDifferenceString($row['last_occurrence']);
            $row['first_occurrence_compare'] = $this->getTimeDifferenceString($row['first_occurrence']);
            $row['first_occurrence'] = date($this->dateFormat, $row['first_occurrence']);
            $row['last_occurrence'] = date($this->dateFormat, $row['last_occurrence']);
            $row['identifier'] = md5($row['uid_list']);
            $result['errors'][] = $row;
        }

        return $result;
    }

    private function getTimeDifferenceString(int $unixTime): string
    {
        $LLL = 'LLL:EXT:t3_monitoring/Resources/Private/Language/locallang.xlf:';
        if(($unixTime + 86400) < time()) {
            $days = ceil((time() - $unixTime) / 86400);
            $result = sprintf($this->languageService->sL($LLL . 'time.diff.days'), $days);
        } else if(($unixTime + 3600) < time()) {
            $hours = ceil((time() - $unixTime) / 3600);
            $result = sprintf($this->languageService->sL($LLL . 'time.diff.hours'), $hours);
        } else if(($unixTime + 60) < time()) {
            $minutes = ceil((time() - $unixTime) / 60);
            $result = sprintf($this->languageService->sL($LLL . 'time.diff.minutes'), $minutes);
        } else {
            $seconds = time() - $unixTime;
            $result = sprintf($this->languageService->sL($LLL . 'time.diff.seconds'), $seconds);
        }

        return $result;
    }

    private function analyzeErrorCluster(string $errorUidList): array
    {
        $connection = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable('tx_t3monitoring_log');
        $qb = $connection->createQueryBuilder();
        $sql = $qb->selectLiteral('concat(3600 * floor(crdate / 3600), \'-\', 3600 * floor(crdate / 3600) + 3599) as `range`', 'count(*) as errors_in_range')
            ->from('tx_t3monitoring_log')
            ->where(
                $qb->expr()->in('uid', GeneralUtility::intExplode(',', $errorUidList))
            )
            ->getSQL();
        $sql .= ' GROUP BY 1 ORDER BY crdate DESC LIMIT 24';
        $rows = $connection->executeQuery($sql)->fetchAll();
        $rows = $this->fillRows($rows);
        foreach($rows as &$row) {
            list($start, $end) = GeneralUtility::intExplode('-', $row['range']);
            $row['range'] = [
                'start' => date($this->dateFormat, $start),
                'end' => date($this->dateFormat, $end),
            ];
        }
        krsort($rows);

        return $this->buildChartJsData($rows);
    }

    public function persistError(array $errorData, int $type = self::TYPE_FE): bool
    {
        $browserDetection = GeneralUtility::makeInstance(BrowserDetection::class);
        $userAgent = GeneralUtility::getIndpEnv('HTTP_USER_AGENT');
        $clientInformation = $browserDetection->getAll($userAgent);

        $insertData = [
            'type' => $type,
            'crdate' => time(),
            'tstamp' => time(),
            'browser' => $clientInformation['browser_name'] ?? '',
            'browser_version' => $clientInformation['browser_version'] ?? '',
            'level' => $errorData['errorNr'] ?? 0,
            'os' => $clientInformation['os_name'] ?? 'unknown',
            'os_version' => $clientInformation['os_version'] ?? 0,
            'device_type' => $clientInformation['os_type'] ?? 'unknown',
            'ip_address' => GeneralUtility::getIndpEnv('REMOTE_ADDR'),
            'message' => $errorData['message'] ?? 'No message',
            'error_data' => json_encode($this->buildErrorData($errorData)),
            'url' => $errorData['js_source_file'] ?? ''
        ];
        $connection = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable('tx_t3monitoring_log');
        $affectedRows = $connection->insert('tx_t3monitoring_log', $insertData);

        return $affectedRows > 0;
    }

    private function buildErrorData(array $errorData): array
    {
        $result = [];
        $stackArray = GeneralUtility::trimExplode(PHP_EOL, $errorData['stack'] ?? '');
        $result['stack'] = $this->analyzeStackTrace($stackArray);

        return $result;
    }

    private function analyzeStackTrace(array $stacktrace): array
    {
        $result = [];
        foreach ($stacktrace as $key => $row) {
            if ($key === 0) {
                continue;
            }
            $tmp = GeneralUtility::trimExplode(':', $row);
            if (count($tmp) > 3) {
                $position = (int)array_pop($tmp);
                $line = (int)array_pop($tmp);
                preg_match("/(?<url>http(?:s|):\/\/.*.js)/", $row, $matches);
                if (!empty($matches['url']) && $position > 0 && $line > 0) {
                    $fileContent = GeneralUtility::getUrl($matches['url']);
                    $lines = explode(PHP_EOL, $fileContent);
                    $start = $line - 5;
                    for ($i = 0; $i < 10; $i++) {
                        $lineCheck = $start + $i;
                        if (array_key_exists($lineCheck, $lines)) {
                            $result[$key][] = [
                                'code' => $lines[$lineCheck],
                                'active' => ($lineCheck === ($line - 1)),
                                'url' => $matches['url'],
                                'label' => $row,
                                'line' => ($lineCheck + 1)
                            ];
                        }
                    }
                }
            }
        }

        return $result;
    }

    /**
     * @param array $rows
     * @return array
     */
    private function fillRows(array $rows): array
    {
        $rowCount = count($rows);
        if ($rowCount < 24) {
            $emptyArray = array_fill($rowCount, 24 - $rowCount, ['range' => '', 'errors_in_range' => 0]);
            $lastRange = $rows[array_key_last($rows)]['range'];
            foreach ($emptyArray as &$row) {
                if (empty($row['range']) && !empty($lastRange)) {
                    list($start, $end) = GeneralUtility::intExplode('-', $lastRange, false, 2);
                    $lastRange = $row['range'] = ($start - 3600) . '-' . ($start - 1);
                } else {
                    $lastRange = $row['range'];
                }
            }
            $rows += $emptyArray;
        }
        return $rows;
    }

    /**
     * @param array $rows
     * @return array
     */
    private function buildChartJsData(array $rows): array
    {
        $result = [];
        foreach ($rows as $row) {
            $result['labels'][] = implode(' - ', $row['range']);
            $result['values'][] = $row['errors_in_range'];
        }
        $result['labels'] = json_encode($result['labels']);
        $result['values'] = json_encode($result['values']);

        return $result;
    }

}