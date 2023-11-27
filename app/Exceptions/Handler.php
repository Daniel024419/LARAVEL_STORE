<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;


use App\Exceptions\NotFoundException;
use Illuminate\Auth\AuthenticationException;
use RuntimeException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    public function register(): void
    {


        //not found
        $this->renderable(function (NotFoundHttpException $e, $request) {
            return response()->json(['error' => $e->getMessage()], 404);
        });


        $this->renderable(function (RuntimeException $e, $request) {

            //runtime
            return response()->json(['error' => $e->getMessage()], 500);
        });


        $this->renderable(function (AuthenticationException $e, $request) {
            //unathorize
            return response()->json(['error' => $e->getMessage()], 401);
        });
    }

}