<?php

namespace App\Exceptions;

use BadMethodCallException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use PDOException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;
use Illuminate\Support\Str;

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
            Log::info($e->getMessage());
        });
    }

    public function render($request, Throwable $e)
    {
        DB::rollBack();
        if ($e instanceof MethodNotAllowedHttpException) {
            return response()->json([
                'error' => 'This Method is not allowed',
                'data' => null,
                'message' => $e->getMessage()
            ], 405);
        }
        if ($e instanceof NotFoundHttpException) {
            return response()->json([
                'error' => 'This Route is not found',
                'data' => null,
                'message' => $e->getMessage(),
            ], 404);
        }
        if ($e instanceof BadMethodCallException) {
            return response()->json([
                'error' => 'Bad Method Called',
                'data' => null,
                'message' => $e->getMessage(),
            ], 404);
        }
        if ($e instanceof ValidationException) {
            return response()->json([
                'error' => 'Validation failed',
                'message' => $e->errors(),
            ], 422);
        }

        if ($e instanceof ModelNotFoundException) {
            return response()->json([
                'error' => 'Resource not found',
                'message' => $e->getModel()
            ], 404);
        }

        if ($e instanceof PDOException) {
            return response()->json([
                'error' => 'Something Went Wrong',
                'error' => Str::before($e->getMessage(), '(Connection:'),
            ], 404);
        }

        // return parent::render($request, $e);
    }
}
