<?php

namespace App\Exceptions;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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
        if (\App::environment() != 'local' &&  !($exception instanceof GuzzleException)) {
            $severity = 4; // WARNING

            if ($exception instanceof \ErrorException) {
                $severity = 5;
            }

            try {
                $client = new Client();
                $params = [
                    'form_params' => [
                        'project_id' => env('PROJECT_ID', '58247127f1290140786270f1'),
                        'creation_date' => date('Y-m-d H:i:s'),
                        'severity' => $severity,
                        'file' => basename($exception->getFile()),
                        'method' => $exception->getLine(),
                        'message' => $exception->getMessage() . "\n" . $exception->getTraceAsString()
                    ]
                ];
                // die(dump(url('api/queue/add')));
                $res = $client->request('POST', url('api/queue/add'), $params);
                // $res = $client->request('POST', 'http://nosql.waplet.id.lv/api/queue/add', $params);
                // $res = $client->request('POST', 'http://localhost:8000/api/queue/add', $params);

                // die(dump($res->getBody()->getContents()));
            } catch (\Exception $ex) {
                // dump($ex->getMessage());
                // die("Could not send exception");
            }
        }

        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
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
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest('login');
    }
}
