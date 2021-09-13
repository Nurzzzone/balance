<?php

namespace App\Exceptions;

use Exception;
use Throwable;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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
     * Report or log an exception.
     *
     * @param  \Throwable $exception
     * @return void
     *
     * @throws \Throwable
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($request->wantsJson()) {
            return $this->handleApiException($request, $exception);
        } else {
            $retval = parent::render($request, $exception);
        }

        if (!config('app.debug') && $exception instanceof Exception) {
            $request->session()->flash('error', __('messages.500.body'));
            return redirect()->back();
        }

        return $retval;
    }

    /**
     * Convert a validation exception into a JSON response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Validation\ValidationException  $exception
     * @return \Illuminate\Http\JsonResponse
     */
    protected function invalidJson($request, ValidationException $exception)
    {
        return response()->json([
            'message' => trans('validation.header'),
            'errors' => $exception->errors(),
        ], $exception->status);
    }

    private function handleApiException($request, Throwable $exception)
    {
        $exception = $this->prepareException($exception);

        if ($exception instanceof \Illuminate\Http\Exceptions\HttpResponseException) {
            $exception = $exception->getResponse();
        }

        if ($exception instanceof \Illuminate\Auth\AuthenticationException) {
            $exception = $this->unauthenticated($request, $exception);
        }

        if ($exception instanceof \Illuminate\Validation\ValidationException) {
            $exception = $this->convertValidationExceptionToResponse($exception, $request);
        }

        return $this->customApiResponse($exception);
    }

    private function customApiResponse($exception)
    {
        if (method_exists($exception, 'getStatusCode')) {
            $statusCode = $exception->getStatusCode();
        } else {
            $statusCode = 500;
        }

        if (method_exists($exception, 'getCode')) {
            $response['code'] = $exception->getCode();
        }

        if (method_exists($exception, 'getFile')) {
            $response['file'] = $exception->getFile();
        }

        if (method_exists($exception, 'getLine')) {
            $response['line'] = $exception->getLine();
        }

        switch ($statusCode) {
            case 401:
                $response['message'] = 'Для доступа к запрашиваемому ресурсу требуется аутентификация!';
                break;
            case 403:
                $response['message'] = 'Отказано в попытке доступа к текущему ресурсу!';
                break;
            case 404:
                $response['message'] = 'Соответствующего ресурса по указанному URL не найдено!';
                break;
            case 405:
                $response['message'] = 'Указанный метод нельзя применить к текущему ресурсу!';
                break;
            case 422:
                $response['message'] = $exception->original['message'];
                $response['errors'] = $exception->original['errors'];
                break;
            default:
                $response['message'] = ($statusCode == 500) && !config('app.debug') ? __('messages.500.body') : $exception->getMessage();
                break;
        }

        $response['status'] = $statusCode;

        return response()
            ->json($response, $statusCode)
            ->setEncodingOptions(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}
