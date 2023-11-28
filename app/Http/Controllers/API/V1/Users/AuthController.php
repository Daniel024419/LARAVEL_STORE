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
                    return response()->json(['error' => 'Invalid credentials', 'message' => 'Can not generate api token'], 401);
                }

                // Authentication successful, create a token
                $token = $request->user()->createToken($user['usermail'])->plainTextToken;

                /**
                 * save user session
                 * @var request session
                 * @type array<int ,string >
                 *
                 */

                return response()->json([
                    'message' => 'Login successful ',
                    'api-token' => $token, 'User' => ['id' => $user["id"], 'usermail' => $user["usermail"]]
                ], 200);
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

    /**
     * logout users
     * @param Request $request
     */
    public function logout(Request $request): JsonResponse
    {

        try {
            // Check if the user is authenticated
            if (Auth::check()) {

                // Revoke the token
                $request->user()->currentAccessToken()->delete();

                return response()->json(['message' => 'Logout successful']);
            } else {
                return response()->json(['error' => 'User not authenticated'], 401);
            }
        } catch (RuntimeException $e) {

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}