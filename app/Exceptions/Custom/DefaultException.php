<?php

namespace App\Exceptions\Custom;

class DefaultException extends ExceptionAbstract
{
    public function handleStatusCode():void
    {
        $this->statusCode = method_exists($this->exception,'getStatusCode') ? 
                                $this->exception->getStatusCode() : 500;                   
    }

    public function handleMessage():void
    {
        $this->message = ($this->statusCode == 500) ? 
                        "API Server Internal Error" : 
                        $this->exception->getMessage();                          
    }
}

