<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Http\JsonResponse;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
    public function render($request, Throwable $exception)
    {

        $code = 500;
        $message = $exception->getMessage();
        if ($exception instanceof \Illuminate\Validation\ValidationException) {
            $code = 422;
            $message = array_map(fn ($v) => $v[0], $exception->errors());
        } else if ($exception instanceof \Symfony\Component\Routing\Exception\RouteNotFoundException) {
            $code = 404;
            $message = 'Route not found';
        }
        return new JsonResponse([
            'message' => $exception->getMessage(),
            'status' => $exception->getCode(),
            'data' => NULL
        ]);
    }
}
