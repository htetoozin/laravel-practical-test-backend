<?php

namespace App\Exceptions\Custom;

class NotFoundException extends ExceptionAbstract
{
	public function handleStatusCode():void
    {
        $this->statusCode = 404;
    }

    public function handleMessage():void
    {
        $this->message = "Route Not Found";
    }
}
