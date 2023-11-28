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
