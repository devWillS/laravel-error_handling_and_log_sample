<?php

declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Contracts\View\View;
use Illuminate\View\ViewName;
use RuntimeException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class AppException extends RuntimeException implements Responsable
{
    protected $error = 'error';

    private $factviewNameory;

    public function __construct(
        string $viewName,
        string $message = "",
        int $code = 0,
        Throwable $previous = null
    ) {
        $this->viewName = $viewName;
        parent::__construct($message, $code, $previous);
    }

    public function toResponse($request)
    {
        // return $this->factory->with($this->error, $this->message);
        return response()->view($this->viewName, [
            $this->error => $this->message
        ]);
    }
}
