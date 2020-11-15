<?php

namespace App\EventListener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();

        $event->setResponse(
            new JsonResponse(
                [
                    'success' => false,
                    'data' => null,
                    'errors' => [
                        'message' => $exception->getMessage(),
                        'code' => $exception->getCode()
                    ]
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            )
        );
    }
}