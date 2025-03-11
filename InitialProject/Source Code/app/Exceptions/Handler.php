<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
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
        'current_password',
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

    public function report(Throwable $exception)
    {
        if ($this->shouldReport($exception)) {
            \Log::error('Error Occurred', [
                'message' => $exception->getMessage(),
                'url' => request()->fullUrl(),
                'ip' => request()->ip(),
                'user_id' => auth()->id(),
            ]);
        }
        parent::report($exception);
    }

    public function render($request, Throwable $exception)
    {
        if ($request->expectsJson()) {  // Check if request expects JSON (API calls)
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
            ], 500);
        }

        return parent::render($request, $exception);
    }
}
