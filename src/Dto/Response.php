<?php

namespace NeedleProject\CodeceptOpenAPI\Dto;

class Response
{
    public function __construct(
        private readonly int $statusCode,
        private readonly string $contentBody
    ) {
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getContent()
    {
        return $contentBody;
    }
}
