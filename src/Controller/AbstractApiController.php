<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class AbstractApiController extends AbstractController
{
    protected function handleSuccess(array $data = [], bool $new = false): JsonResponse
    {
        return $this->json(array_merge(["success" => true], $data), ($new)?201:200);
    }
}
