<?php

namespace NeedleProject\CodeceptOpenAPI\Dto;

class Path
{
    public function __construct(
        private readonly array $responses 
    ) {
    }

    public function getResponses(): array
    {
        return $this->responses;
    }
}
