<?php

namespace App\Http\Controllers\API\V1\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\JsonResponse;
use RuntimeException;
use App\Services\Users\UserService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login(Request $request): jsonResponse
    {

        try {
            
            //code...
            $validator = Validator::make($request->all(), [
                'password' => ['required', 'string'],
                'usermail' => ['required', 'email', 'max:255'],
            ]);


            //if validation fails , retrun error messages
            if ($validator->fails()) {
                if ($request->expectsJson()) {
                    throw ValidationException::withMessages($validator->errors()->toArray());
                }
                return response()->json(["error" => $validator->errors()], 400);
            }

            // Retrieve  of the validated input...
            $password = $validator->safe()->only(['password']);
            $usermail = $validator->safe()->only(['usermail']);


            $user = $this->userService->findUserByUsermail($usermail["usermail"]);

            if (empty($user)) {

                return response()->json(["error" => "No user found,Please Try again with valid a mail "], 404);
            }


            $hashedPassword = $user['password'];


            // Verify the password
            if (Hash::check($password["password"], $hashedPassword)) {

                // Attempt to authenticate the user
                if (!Auth::attempt($request->only('usermail', 'password'))) {
                    return response()->json(['error' => 'Invalid credentials'], 401);
                }

                // Authentication successful, create a token
                $token = $request->user()->createToken('api-token')->plainTextToken;

                // Return the token in the response
                return response()->json(['message' => 'Login successful', 'api-token' => $token], 200);
            } else {
                // Password is incorrect
                return response()->json(['error' => 'Invalid Password ,Please try again'], 401);
            }
        } catch (RuntimeException $e) {

            return response()->json(['error' => $e->getMessage()], 500);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function logout(Request $request): JsonResponse
    {

        try {

    // Check if the user is authenticated
    if (Auth::check()) {
        // Logging for debugging within the authenticated context
        Log::info('User ID: ' . Auth::user()->id);

        // Revoke the token by name
        $request->user()->currentAccessToken()->delete();

        // Optionally, you can also clear the session or perform any other necessary actions

        return response()->json(['message' => 'Logout successful']);
    } else {
        return response()->json(['error' => 'User not authenticated'], 401);
    }
    } catch (RuntimeException $e) {

        return response()->json(['error' => $e->getMessage()], 500);
    }
    }
}
