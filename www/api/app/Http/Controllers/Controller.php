<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     *  @OA\Info(version="api", title="CafeTime API", description="Документация по приложению")
     *
     *  @OA\Server(url=L5_SWAGGER_CONST_HOST, description="API")
     *
     *  @OA\Tag(name="Default", description="Общее описание ответов")
     *  @OA\Tag(name="Auth", description="Авторизация")
     *  @OA\Tag(name="Dadata", description="Поиск субъектов (страна, город и тд")
     */

    /**
     *  @OA\PATCH(
     *      path="/example_response/success",
     *      operationId="exampleResponseSuccess",
     *      summary="Успешный ответы",
     *      tags={"Default"},
     *
     *      @OA\Response(
     *          response=200,
     *          description="Ответ приходит в данном формате. Код всегда 200. Данные из других эндпоинтов подставляются в data.",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="bool", example=true),
     *              @OA\Property(
     *                  property="data",
     *                  type="object",
     *                  @OA\Property(property="field1", type="string", example="value1"),
     *                  @OA\Property(property="field2", type="integer", example=2),
     *                  @OA\Property(property="etc", type="string", example="etc"),
     *              ),
     *          )
     *      ),
     *  ),
     */

    /**
     *  @OA\PATCH(
     *      path="/example_response/fail",
     *      operationId="exampleResponseFail",
     *      summary="Ответы с ошибками",
     *      tags={"Default"},
     *
     *      @OA\Response(
     *          response=200,
     *          description="Ответ приходит в данном формате. Код всегда 200. data - пустая. Ошибки выводятся массивом в errors.",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="bool", example=false),
     *              @OA\Property(property="data", type="object", @OA\Items()),
     *              @OA\Property(property="errors", type="array", @OA\Items(ref="#/components/schemas/CustomException")),
     *          )
     *      ),
     *  ),
     */

    /**
     *  @OA\PATCH(
     *      path="/example_response/validation_error",
     *      operationId="exampleResponseValidationError",
     *      summary="Пример ошибки валидации",
     *      tags={"Default"},
     *
     *      @OA\Response(
     *          response=200,
     *          description="В массиве будет новое поле field - поле, которое не прошло валидацию",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="bool", example=false),
     *              @OA\Property(property="data", type="object", @OA\Items()),
     *              @OA\Property(
     *                  property="errors",
     *                  type="array",
     *                  example={{
     *                      "code": 422,
     *                      "field": "first_name",
     *                      "message": "VALIDATION_EXCEPTION",
     *                      "description": "Поле first_name обязательно для заполнения.",
     *                  }, {
     *                      "code": 422,
     *                      "field": "email",
     *                      "message": "VALIDATION_EXCEPTION",
     *                      "description": "Поле email должно быть действительным электронным адресом.",
     *                  }, {
     *                      "code": 422,
     *                      "field": "password",
     *                      "message": "VALIDATION_EXCEPTION",
     *                      "description": "Поле password не совпадает с подтверждением.",
     *                  }},
     *                  @OA\Items(
     *                      @OA\Property(property="code", type="integer", example=422),
     *                      @OA\Property(property="field", type="string", example="first_name"),
     *                      @OA\Property(property="message", type="string", example="VALIDATION_EXCEPTION"),
     *                      @OA\Property(property="description", type="string", example="Поле first_name обязательно для заполнения."),
     *                  ),
     *              ),
     *          )
     *      ),
     *  ),
     */

    /**
     *  @OA\PATCH(
     *      path="/example_response/authorization_error",
     *      operationId="exampleResponseAuthorizationError",
     *      summary="Пример ошибки прав доступа",
     *      tags={"Default"},
     *
     *      @OA\Response(
     *          response=200,
     *          description="Пользователь не авторизован, у пользователя нет прав на выполнение и тд",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="bool", example=false),
     *              @OA\Property(property="data", type="object", @OA\Items()),
     *              @OA\Property(
     *                  property="errors",
     *                  type="array",
     *                  @OA\Items(
     *                      @OA\Property(property="code", type="integer", example=403),
     *                      @OA\Property(property="message", type="string", example="AUTHORIZATION_EXCEPTION"),
     *                      @OA\Property(property="description", type="string", example="Вы не авторизованы."),
     *                  ),
     *              ),
     *          )
     *      ),
     *  ),
     */
}
