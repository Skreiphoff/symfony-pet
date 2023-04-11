<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Service\User\ResponseBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class UserController extends AbstractController
{
    #[Route('/users', name: 'app_get_users')]
    public function getUsers(Request $request)
    {
        $limit = $request->query->get('limit', 20);
        $offset = $request->query->get('offset', 0);
        $users = (new UserRepository())->getUsers($limit, $offset);

        return new JsonResponse([
            'status' => 'success',
            'data' => (new ResponseBuilder())->build($users)
        ]);
    }
    #[Route("/user_by_hash")]
    public function getUserByHash(Request $request)
    {
        $user = (new UserRepository())->getUserByHashLink($request->query->get('hash'));
    }
}