<?php

namespace FloPe\T3Monitoring\Controller;

use FloPe\T3Monitoring\Service\ErrorService;
use TYPO3\CMS\Backend\Template\ModuleTemplateFactory;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class ErrorController extends ActionController
{

    private ErrorService $errorService;

    public function __construct(ErrorService $errorService)
    {
        $this->errorService = $errorService;
    }

    public function indexAction()
    {
        $this->view->assign('errors', $this->errorService->getLastErrorList(ErrorService::TYPE_FE));
        return $this->view->render();
    }
}