<?php

namespace App\Exceptions;
use Illuminate\Http\Response;
use App\Exceptions\Custom\DefaultException;
use App\Exceptions\Custom\ServerInternalException;

use Exception;

class APIException extends Exception
{
   public function handleError($exception)
    {
        $exceptions = config("api-error-handler") ?? [];

        $class = array_key_exists(get_class($exception),$exceptions) ? 
                    $exceptions[get_class($exception)] : 
                    (config('app.debug') ? DefaultException::class : ServerInternalException::class);

        $handler = new $class($exception);
        $handler->handleStatusCode();
        $handler->handleMessage();

        $errorMessage = $handler->getStatusCode() == 405 ? 
                            'Method not allowed.' : 
                            $handler->getMessage();               
                             
        return response()->json([
            'code'      => $handler->getStatusCode(),
            'status'    => 'failed',
            'message'   => $errorMessage
        ], $handler->getStatusCode());
    }
}
