<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        \Carbon\Exceptions\InvalidArgumentException::class,
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof QueryException) {
            return new Response('', Response::HTTP_INTERNAL_SERVER_ERROR, [
                'X-App-Message' => 'An error occured.'
            ]);
        }

        if ($exception instanceof Responsable) {
            return $exception->toResponse($request);
        }

        return parent::render($request, $exception);
    }
}
