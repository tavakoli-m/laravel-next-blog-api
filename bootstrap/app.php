<?php

use App\Base\ApiResponse\Facades\ApiResponse;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        commands: __DIR__ . '/../routes/console.php',
        using: function () {
            Route::middleware('api')->prefix('api')->group(function () {
                Route::prefix('v1')->group(base_path('routes/api_v1.php'));
            });
        }
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // 422 status code
        $exceptions->render(function (ValidationException $exception, Request $request) {
            return ApiResponse::withStatus(422)
                ->withErrors($exception->errors())
                ->withMessage($exception->getMessage())
                ->send();
        });

        // 401 status code (Sanctum)
        $exceptions->render(function (AuthenticationException $exception, Request $request) {
            return ApiResponse::withStatus(401)
                ->withMessage($exception->getMessage())
                ->send();
        });

        // 403 status code
        $exceptions->render(function (AccessDeniedHttpException $exception, Request $request) {
            if ($exception->getPrevious() instanceof AuthorizationException) {
                return ApiResponse::withStatus(403)
                    ->withMessage("Unauthorized.")
                    ->send();
            }
        });

        // 404 status code
        $exceptions->render(function (NotFoundHttpException $exception, Request $request) {
            return ApiResponse::withStatus(404)
                ->withMessage("not found !!")
                ->send();
        });

        // 405 status code
        $exceptions->render(function (MethodNotAllowedHttpException $exception, Request $request) {
            return ApiResponse::withStatus(405)
                ->withMessage("Method Not Allowed !!")
                ->send();
        });

        $exceptions->shouldRenderJsonWhen(function (Request $request) {
            return true;
        });
    })->create();
