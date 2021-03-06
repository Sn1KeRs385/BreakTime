<?php

namespace Tests\Feature\BaseHelpers;

use App\Exceptions\Handler;
use Illuminate\Foundation\Testing\WithFaker;

trait BaseHelper
{
    use WithFaker;

    protected function getBaseSuccessJson(): array {
        return [
            'status' => true,
            'data' => [],
        ];
    }

    protected function getBaseErrorJson(array $errors = [], array $exceptions = []): array {
        $handler = app(Handler::class);
        foreach($exceptions as $exception){
            $errors = array_merge($errors, $handler->render(null, app($exception), true)['errors']);
        }

        return [
            'status' => false,
            'data' => [],
            'errors' => $errors
        ];
    }

    protected function getBaseSuccessStructure(array $data = []): array {
        return [
            'status',
            'data' => $data,
        ];
    }

    protected function getIndexMetaStructure(): array {
        return [
            'meta' => [
                'current_page',
                'last_page',
                'per_page',
                'total',
            ]
        ];
    }
}
