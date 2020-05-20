<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

/**
 * Class JsonExceptionHandler
 * @package App\Exceptions
 */
class JsonExceptionHandler extends ExceptionHandler
{
    
    /**
     * @param Exception $exception
     * @throws Exception
     */
    public function report($exception)
    {
        if (app()->environment() != 'dev') {
            if (app()->bound('sentry') && $this->shouldReport($exception)){
                app('sentry')->captureException($exception);
            }
        }
        parent::report($exception);
    }
    
    /**
     * @param \Illuminate\Http\Request $request
     * @param \Throwable $exception
     * @return SymfonyResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Throwable
     */
    public function render($request, $exception)
    {
        if ($request->wantsJson()) {
            return $this->renderExceptionAsJson($request, $exception);
        }
        return parent::render($request, $exception);
    }
    
    /**
     * Render an exception into a JSON response
     *
     * @param $request
     * @param Exception $exception
     * @return SymfonyResponse
     */
    protected function renderExceptionAsJson($request, Exception $exception)
    {
        
        $exception  = $this->prepareException($exception);
        
        $code       = !empty($exception->getCode()) ? $exception->getCode() : 500;
        $message    = !empty($exception->getMessage()) ? $exception->getMessage() : 'Bad Request';
        
        $response = [
          'code' => $code,
          'message' => $message
        ];
        
        return response()->json($response, $code);
    }
}
