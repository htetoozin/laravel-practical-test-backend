<?php

return [  
  "Symfony\Component\HttpKernel\Exception\NotFoundHttpException" => "\App\Exceptions\Custom\NotFoundException",
  "ErrorException" => "\App\Exceptions\Custom\ServerInternalException",  
  "Illuminate\Auth\AuthenticationException" => "\App\Exceptions\Custom\UnauthorizedException", 
  "Illuminate\Database\QueryException" => "\App\Exceptions\Custom\ServerInternalException",   
];
