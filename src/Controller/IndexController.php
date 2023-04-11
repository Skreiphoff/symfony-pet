<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends AbstractController
{
    #[Route("/", name: "index")]
    public function index(Request $request): Response
    {
        if ($request->getUser())
            return new Response('Ok');
        else
            return new JsonResponse([
                'code' => Response::HTTP_UNAUTHORIZED,
                'body' => [
                    'link' => "t.me/TestTaskAuthBot"
                ]
            ]);
    }
}