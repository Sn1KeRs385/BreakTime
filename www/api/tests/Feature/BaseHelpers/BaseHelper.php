<?php

namespace Tests\Feature\BaseHelpers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

trait BaseHelper
{
    use WithFaker;

    protected function getBaseSuccessJson(): array {
        return [
            'status' => true,
            'data' => [],
        ];
    }

    protected function getBaseSuccessStructure(array $data = []): array {
        return [
            'status',
            'data' => $data,
        ];
    }
}
