<?php

namespace FloPe\T3Monitoring\Middleware;

use FloPe\T3Monitoring\Service\ErrorService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use TYPO3\CMS\Core\Http\JsonResponse;

class ErrorReceiveMiddleware implements MiddlewareInterface
{

    private ErrorService $errorService;

    public function __construct(ErrorService $errorService)
    {
        $this->errorService = $errorService;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if($request->getMethod() === 'POST' && rtrim($request->getUri()->getPath(), '/') === '/api/error') {
            $parameter = @json_decode($request->getBody()->getContents(), true);
            if(!is_array($parameter)) {
                $parameter = [];
            }
            return new JsonResponse(['persisted' => $this->errorService->persistError($parameter)]);
        }

        return $handler->handle($request);
    }

}