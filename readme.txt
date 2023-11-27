php artisan make:model Models/core


    // /**
    //  * @var UserService
    //  */
    // protected $userService;

    // /**
    //  * @param UserService $userService;
    //  */

    // //bind service constructor
    // public function __construct(UserService $userService)
    // {
    //     $this->userService = $userService;
    // }

    // /**
    //  *
    //  * @var array <string , int>
    //  * @type json
    //  */

    // public function getUsers(): jsonResponse
    // {

    //     try {


    //         // $users = $this->userService->getUsers();

    //         $users = UsersModel::all();

    //         if ($users) {
    //             //send json res 200 with the data
    //             return response()->json($users, 200);
    //             # code...
    //         } else {
    //             # code... 404
    //             return response()->json(["error" => "No users uploaded yet"], 404);
    //         }

    //         //handle exception
    //     } catch (RuntimeException $e) {
    //     return response()->json(['error' => $e->getMessage()], 500);
    //     } catch (ModelNotFoundException $e) {
    //         return response()->json(['error' => $e->getMessage()], 404);
    //     }
    // }

    // protected $UserService;

    // public function __construct(UserService $UserService)
    // {
    //     $this->UserService = $UserService;
    // }




cmds
php artisan clear-compiled
php artisan optimize
php artisan config:clear
php artisan cache:clear
composer dump-autoload



// Revoke all tokens...
$user->tokens()->delete();

// Revoke the token that was used to authenticate the current request...
$request->user()->currentAccessToken()->delete();

// Revoke a specific token...
$user->tokens()->where('id', $tokenId)->delete();
