<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait HasJsonResponse
{
    /**
     * Send success message
     * @param string $message
     * @param int|null $status
     * @return JsonResponse
     */
    public function sendSuccessMessage(string $message = 'Операция прошла успешно!', ?int $status = Response::HTTP_OK): JsonResponse
    {
        return response()
            ->json(compact('message'))
            ->setStatusCode($status);
    }

    /**
     * Send error message
     * @param string|null $message
     * @param int|null $status
     * @return JsonResponse
     */
    public function sendErrorMessage(string $message = 'Произошла ошибка! Пожалуйста, попробуйте еще раз', int $status = Response::HTTP_INTERNAL_SERVER_ERROR): JsonResponse
    {
        return response()
            ->json(compact('message'))
            ->setStatusCode($status);
    }

    /**
     * Send unauthorized message
     * @param string $message
     * @return JsonResponse
     */
    public function sendUnauthorizedMessage(string $message = 'Для доступа к запрашиваемому ресурсу требуется авторизация!'): JsonResponse
    {
        return response()
            ->json(compact('message'))
            ->setStatusCode(Response::HTTP_UNAUTHORIZED);
    }

    public function sendSuccessMessageWithData(array $data, string $message = 'Операция прошла успешно!')
    {
        return response()
            ->json(array_merge(compact( 'message'), $data))
            ->setStatusCode(Response::HTTP_OK);
    }
}
