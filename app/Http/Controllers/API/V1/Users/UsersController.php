<?php

namespace App\Http\Controllers\API\V1\Users;

use App\Http\Controllers\Controller;

use App\Services\Users\UserService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse as HttpJsonResponse;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\JsonResponse;
use RuntimeException;




class UsersController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    //

     /**
     * fetch all new users users.
     *
     * @var array < string ,int>
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllUsers(): HttpJsonResponse
    {
        try {

            $users = $this->userService->getAllUsers();

            if ($users) {
                //send json res 200 with the data
                return response()->json($users, 200);
                # code...
            } else {
                # code... 404
                return response()->json(["error" => "No users uploaded yet"], 404);
            }

            //         //handle exception
        } catch (RuntimeException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }


    /**
     * Save a new user.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request): jsonResponse
    {
        try {
            // Validate the request data
            $validator = Validator::make($request->all(), [
                'username' => ['required', 'string', 'unique:users,username', 'max:255'],
                'password' => ['required', 'string', 'max:255', Password::min(8)->mixedCase()],
                'usermail' => ['required', 'email', 'unique:users,usermail', 'max:255'],
            ]);

            // If validation fails, return error messages
            if ($validator->fails()) {
                if ($request->expectsJson()) {
                    throw ValidationException::withMessages($validator->errors()->toArray());
                }
                return response()->json(["error" => $validator->errors()], 400);
            }

            // Retrieve validated input
            $username = $validator->safe()->only(['username']);
            $password = $validator->safe()->only(['password']);
            $usermail = $validator->safe()->only(['usermail']);

            // Hash the password
            //$hashedPassword = Hash::make($password['password']);

            // Construct $userData as an associative array
            $userData = [
                'username' => $username['username'],
                //password hashed at model
                'password' => $password['password'],
                'usermail' => $usermail['usermail'],
            ];

            // Save the new user using the service
            $this->userService->saveNewUser($userData);


            // customize the response
            return response()->json(['message' => 'User created successfully'], 201);
        } catch (RuntimeException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }
}
