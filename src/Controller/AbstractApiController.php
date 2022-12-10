<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

class AbstractApiController extends AbstractController
{
    protected function handleSuccess(array $data = [], array $groups = [], bool $new = false): JsonResponse
    {
        $defaultContext = ["json_encode_options" => JSON_UNESCAPED_UNICODE];
        if ($groups) {
            $defaultContext[AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER] = function ($object, $format, $context) {
                return get_class($object);
            };
            $defaultContext[AbstractNormalizer::GROUPS] = array_merge(["default"], $groups);
        }

        return $this->json(array_merge(["success" => true], $data), ($new)?201:200, [], $defaultContext);
    }
}
