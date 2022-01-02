<?php

namespace App\Exceptions;

use App\Models\ErrorCapture;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Session\TokenMismatchException;
use Psy\Exception\ErrorException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Debug\Exception\FatalThrowableError;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {   
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Exception $exception)
    {

        $error = new ErrorCapture();
        $error->code = $exception->getCode();
        $error->body = $exception->getMessage();
        $error->line = $exception->getLine();
        $error->file = get_class($exception);
        if(auth()->check()){
            $error->user_id = auth()->user()->id;
        }

        $error->url = \Request::url();

        if ($exception instanceof NotFoundHttpException or $exception instanceof ModelNotFoundException) {

            $error->type = "NotFoundHttpException,ModelNotFoundException";
            $error->save();
            if ($request->ajax()) {
                return response()->json(['error' => 'Page Not Found'],404);
            }

            return response()->view('vendor.exceptions.pageNotFound',[],404);
        }
        if ($exception instanceof ErrorException ) {
            if ($request->ajax()) {
                return "ErrorException";
            }

            $error->type = "ErrorException";
            $error->save();

            return response()->view('vendor.exceptions.pageNotFound',[],$exception->getCode());
        }

        if (get_class($exception)=="Symfony\Component\Debug\Exception\FatalThrowableError") {
           if ($request->ajax()) {
                return "FatalThrowableError";
            }

            $error->type = "FatalThrowableError";
            $error->save();
            return response()->view('vendor.exceptions.throwableError',[],500);
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            $error->type = "MethodNotAllowedHttpException";
            $error->save();

            return response()->view('vendor.exceptions.throwableError',[],500);
        }
        if ($exception instanceof TokenMismatchException){
            // Redirect to a form. Here is an example of how I handle mine
            if ($request->ajax()) {
                return response()->json(["status"=>false,'motif' => "Alerte! Oops! Il semble que vous ne puissiez pas soumettre de formulaire depuis longtemps. Veuillez réessayer."],404);
            }
            return redirect($request->fullUrl())->with('error',"Oops! Il semble que vous ne puissiez pas soumettre de formulaire depuis longtemps. Veuillez réessayer.");
        }

        return parent::render($request, $exception);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        $error = new ErrorCapture();
        $error->code = $exception->getCode();
        $error->body = $exception->getMessage();
        $error->line = $exception->getLine();
        $error->file = get_class($exception);
        if(auth()->check()){
            $error->user_id = auth()->user()->id;
        }

        $error->type = "AuthenticationException";
        $error->url = \Request::url();
        $error->save();
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest(route('login'));
    }
}
