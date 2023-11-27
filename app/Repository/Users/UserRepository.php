<?php

namespace App\Repository\Users;

use App\Models\API\V1\Users\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserRepository implements UserInterfaceRepository
{

    /**
     *@return array $users
     * @type  collectiin
     */

    public function getUsers(): Collection
    {

        try {
    return User::all();
    } catch (ModelNotFoundException $e) {

        return response()->json(['error' => $e->getMessage()], 500);
    }
    }



    /**
     *@return array $users
     * @param array < int , string
     */
    // Save a new user with an array of data
    public function saveNewUser(array $userData)
    {

        try {
        // Create a new User instance and save it
        return User::create($userData);
    } catch (ModelNotFoundException $e) {

        return response()->json(['error' => $e->getMessage()], 500);
    }
    }


    /**
     *@return string
     *@param string $usermail
     */
    public function findUserByUsermail( string $usermail)
    {

        try {
        $user = User::where("usermail", $usermail)->select('id','usermail', 'password')->first();

        return $user;

    } catch (ModelNotFoundException $e) {

        return response()->json(['error' => $e->getMessage()], 500);
    }
    }
}
