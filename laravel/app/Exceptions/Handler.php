<?php

namespace App\Exceptions;

use App\Http\Traits\ApiResponseTrait;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Illuminate\Contracts\Container\BindingResolutionException;
use Throwable;
class Handler extends ExceptionHandler
{
    use ApiResponseTrait;

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
     * Report the exception handling callbacks for the application.
     *
     * @return void
     */
    public function report(Throwable $exception)
    {
        if ($this->shouldReport($exception) && app()->bound('sentry')) {
            app('sentry')->captureException($exception);
        }
        parent::report($exception);
    }

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

        if (request()->wantsJson()) {
            $this->renderable(function (AccessDeniedHttpException $e) {
                return $this->trJsonError(403, $e->getMessage());
            });

            $this->renderable(function (AuthenticationException $e) {
                return $this->trJsonError(401, $e->getMessage());
            });

            $this->renderable(function (BindingResolutionException $e) {
                return $this->trJsonError(500, $e->getMessage());
            });

            $this->renderable(function (ErrorException $e) {
                return $this->trJsonError(500, $e->getMessage());
            });

            $this->renderable(function (MethodNotAllowedHttpException $e) {
                return $this->trJsonError(405, $e->getMessage());
            });

            $this->renderable(function (ModelNotFoundException $e) {
                return $this->trJsonError(404, 'Entry for '.str_replace('App\\', '', $e->getModel()).' not found');
            });

            $this->renderable(function (NotFoundHttpException $e) {
                return $this->trJsonError(404, 'Http not found '.$e->getMessage());
            });

            $this->renderable(function (RouteNotFoundException $e) {
                return $this->trJsonError(404, 'Route not found '.$e->getMessage());
            });
        }
    }
}
