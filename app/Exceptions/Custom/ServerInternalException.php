<?php

namespace App\Exceptions\Custom;

class ServerInternalException extends ExceptionAbstract
{
	public function handleStatusCode():void
    {
        $this->statusCode = 500;
    }

    public function handleMessage():void
    {
        $this->message = "API Server Internal Error";
    }
}
