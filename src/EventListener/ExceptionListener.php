<?php

namespace App\EventListener;

use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ExceptionListener
{
    /**
     * @param ExceptionEvent $event
     */
    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();

        $response = $this->createResponse($exception);
        $event->setResponse($response);
    }

    /**
     * Creates the ApiResponse from any Exception
     *
     * @param \Exception $exception
     *
     * @return Response
     */
    private function createResponse(\Throwable $exception): Response
    {
        $statusCode = $exception instanceof GuzzleException ? $exception->getCode() : Response::HTTP_INTERNAL_SERVER_ERROR;

        return new JsonResponse(null, $statusCode);
    }
}