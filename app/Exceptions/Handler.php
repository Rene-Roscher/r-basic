<?php

namespace RServices\Exceptions;

use Illuminate\Http\Exceptions\HttpResponseException;
use RServices\Response\ResponseState;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Symfony\Component\HttpFoundation\Response;
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
     * Report or log an exception.
     *
     * @param Throwable $exception
     * @return void
     *
     * @throws \Exception
     * @throws Throwable
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  Request  $request
     * @param Throwable $exception
     * @return Response
     *
     * @throws Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof UnauthorizedException)
            return $request->ajax() ? respond()->addMessage($exception->getMessage(), 'error')->response() : back()->withErrors($exception->getMessage());
		if (env('APP_DEBUG') && $request->ajax() && !$exception instanceof HttpResponseException && !$exception instanceof ValidationException)
            respond()->addMessage($exception->getMessage(), 'error')->response();
		if ($exception instanceof ValidationException && $request->ajax())
		    return $this->invalidJson($request, $exception);
        return parent::render($request, $exception);
    }

    protected function invalidJson($request, ValidationException $exception)
    {
        $response = respond();
        $response->setErrors($exception->errors());
        foreach ($exception->errors() as $error)
            $response->addMessage($error, 'error');
        $response->setStatus(ResponseState::INVALID)->response();
    }

}
