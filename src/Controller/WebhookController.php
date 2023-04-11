<?php

namespace App\Controller;

use App\Service\Webhook\Handler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WebhookController extends AbstractController
{
    #[Route("/webhook", name: "webhook", methods: "POST")]
    public function getWebhook(Request $request)
    {
        try {
            $message = $request->toArray()['message']; //Обернуть в сервис, не красиво
            (new Handler())->handle($message);
        } catch (\Exception) {
            return new JsonResponse([
                'status' => 'error',
                'message' => 'Bad request'
            ], Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse([
            'status' => 'success',
            'message' => 'Created'
        ], Response::HTTP_CREATED);
    }
}