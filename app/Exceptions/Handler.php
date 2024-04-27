<?php

namespace App\Exceptions;

use Throwable;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Arr;

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
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $exception)
    {
        return parent::render($request, $exception);
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }
        // $guard = array_get($exception->guards(), 0);
        $guard = Arr::get($exception->guards(), 0);
        switch ($guard) {
          case 'internal':
            // $login = 'internal.auth.login'; 
            $login = 'internal'; 
            break;
          case 'pengguna':
            // $login = 'login';
            $login = 'pengguna';
            break;
          default:
            $login = 'login';
            break;
        }
        // return redirect()->guest(route($login));
        return redirect()->guest(url('/error-session?param='.$login));
    }
}
