<?php

namespace App\Exceptions;

use App\Helpers\JSON;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e, bool $callFromTests = false)
    {
        if(!$callFromTests && $request->acceptsHtml()){
            return parent::render($request, $e);
        }

        $response = null;

        if($e instanceof CustomException){
            $error = [
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
                'description' => $e->getDescription(),
            ];
            $response = JSON::getJson([], [$error]);
        }

        if($e instanceof AuthenticationException){
            $error = [
                'code' => 401,
                'message' => 'AUTHENTICATION_EXCEPTION',
                'description' => __('auth.errors.AUTHENTICATION_EXCEPTION'),
            ];
            $response = JSON::getJson([], [$error]);
        }

        if($e instanceof AuthorizationException){
            $error = [
                'code' => 403,
                'message' => 'AUTHORIZATION_EXCEPTION',
                'description' => __('auth.errors.AUTHORIZATION_EXCEPTION'),
            ];
            $response = JSON::getJson([], [$error]);
        }

        if($e instanceof \TypeError){
            $error = [
                'code' => 500,
                'message' => 'REAL_500',
                'description' => config('app.debug')
                    ? $e->getTrace()
                    : $e->getMessage(),
            ];
            $response = JSON::getJson([], [$error]);
        }

        // Если ошибка связана с валидацией
        if ($e instanceof ValidationException) {
            $errors = [];
            foreach ($e->errors() as $key => $error) {
                $errors[] = [
                    'code' => 422,
                    'field' => $key,
                    'message' => 'VALIDATION_EXCEPTION',
                    'description' => $error[0],
                ];
            }

            $response = JSON::getJson([], $errors);
        }

        // Если ошибка связана с валидацией
        if ($e instanceof NotFoundHttpException) {
            $error = [
                'code' => 404,
                'message' => 'NOT_FOUND',
                'description' => $e->getMessage(),
            ];
            $response = JSON::getJson([], [$error]);
        }

        if(!$response){
            $response = JSON::getJson([], [
                [
                    'code' => $e->getCode(),
                    'message' => $e->getMessage(),
                    'description' => $e->getMessage(),
                ]
            ]);
        }

        if($callFromTests){
            return $response;
        }
        return Response::json($response);
    }
}
