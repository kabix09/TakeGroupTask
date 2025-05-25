<?php

declare(strict_types=1);

namespace App\Services\Request;

interface RequestInterface
{
    public function get(string $endpoint): array;
}
