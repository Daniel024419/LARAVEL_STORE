<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;


use Illuminate\Auth\AuthenticationException;
use RuntimeException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Validation\ValidationException;

class Handler extends ExceptionHandler
{
    public function register( ): void
    {


        //not found
        $this->renderable(function (NotFoundHttpException $e, $request) {
            return response()->json(['error' => "Page or Source not found",
            'Message' => 'The resource you require may have been moved to different place'], 404);
        });

        $this->renderable(function (RuntimeException $e, $request) {

            //runtime
            return response()->json([
                'error' => "Server may be busy or not responding to request now",
                'message' => 'Please, Try again sometime.'
                ,'error-message'=> $e->getMessage(),
            ], 500);
        });


        $this->renderable(function (AuthenticationException $e, $request) {
            //unathorize
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Only aunthenticated users are allowed',
                'api-token' => ''

            ], 401);
        });

        $this->renderable(function (ValidationException $e, $request) {
            //unathorize
            return response()->json([
                'error' => 'Unauthenticated.',
                'message' => 'Only aunthenticated users are allowed',
                'api-token' => ''
                ,'error-message'=> $e->getMessage(),
            ], 401);
        });
    }
}