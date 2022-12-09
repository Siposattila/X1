<?php

namespace App\ParamResolver;

use App\Exception\ValidationException;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;

class ParamValueResolver implements ArgumentValueResolverInterface
{
    public function __construct(
        private readonly SerializerInterface $serializer,
        private readonly ManagerRegistry $doctrine,
        private readonly ValidatorInterface $validation
    ) {
    }

    public function resolve(Request $request, ArgumentMetadata $argument): \Generator
    {
        $type = $argument->getType();
        $method = $request->getMethod();
        $params = $argument->getAttributes(Param::class)[0];
        $contentType = $request->getContentType() ?? "json";
        $format = "json";
        $isGET = $method == "GET";

        $data = $isGET?$request->query->all():$request->getContent();

        if (!$type || $type == "array") {
            if (!$isGET) {
                $data = $this->transformJsonBody($data);
                $request->request->replace($data);
            }
        } else {
            if ($contentType == "form") {
                $content = $request->get("data");
            } else {
                $content = $isGET ? json_encode($data) : $data;
            }

            $context = [];
            if (!empty($params->groups)) {
                $context[AbstractNormalizer::GROUPS] = $params->groups;
            }

            $attribute = $request->attributes->get($params->attribute);

            if ($this->validAttributeValue($attribute, $params->attributeType) && $params->getEntity) {
                $entity = $this->doctrine->getRepository($type)->findOneBy([$params->attribute => $attribute]);
                if (!empty($content) && $params->merge) {
                    $data = $this->serializer->deserialize(
                        $content,
                        $type,
                        $format,
                        array_merge([
                            AbstractNormalizer::OBJECT_TO_POPULATE => $entity,
                            "deep_object_to_populate" => true
                        ],
                        $context
                    ));
                } else {
                    $data = $entity;
                }
            } else {
                if (empty($content)) {
                    $data = null;
                } else {
                    $data = $this->serializer->deserialize($content, $type, $format, $context);
                }
            }
        }

        if ($params->validate) {
            $errors = $this->validation->validate($data, null, $params->groups);
            if ($errors && $errors->count() > 0) {
                throw new ValidationException($errors);
            }
        }

        yield $data;
    }

    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        $attrs = $argument->getAttributes(Param::class);

        return $argument->getType() && count($attrs) > 0;
    }

    private function validAttributeValue(mixed $value, string $valueType): bool
    {
        if ($value == null) {
            return false;
        }

        if ($valueType == "int" && $value > 0) {
            return true;
        }

        if ($valueType == "string" && $value != "") {
            return true;
        }

        return false;
    }

    private function transformJsonBody($data): array
    {
        $data = json_decode($data, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return null;
        }

        if ($data === null) {
            return null;
        }

        return $data;
    }
}
