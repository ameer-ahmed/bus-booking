<?php

namespace App\Exceptions;

use App\Http\Traits\Responser;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenBlacklistedException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException;
use Throwable;

class Handler extends ExceptionHandler
{
    use Responser;

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

    public function render($request, Throwable $e)
    {
        if ($e instanceof TokenExpiredException) {
            return $this->responseFail(status: 401, message: 'Token expired');
        }
        if ($e instanceof TokenBlacklistedException) {
            return $this->responseFail(status: 401, message: 'Token blacklisted');
        }
        if ($e instanceof TokenInvalidException) {
            return $this->responseFail(status: 401, message: 'Token invalid');
        }
        if ($e instanceof JWTException) {
            return $this->responseFail(status: 401, message: 'JWT error');
        }
        if ($e instanceof AuthenticationException) {
            if($request->expectsJson()) {
                return $this->responseFail(status: 401, message: 'Unauthenticated');
            } else {
                return redirect()->route('auth.login');
            }
        }

        return parent::render($request, $e);
    }
}
