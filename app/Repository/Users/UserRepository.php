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
     * for auth
     * serach array
     *@return string
     *@param string $search_param
     */
    public function findUserByUsermail(string $UsermailOrUsername)
    {

        try {
            $user = User::where("usermail", "=", $UsermailOrUsername)
                ->orWhere("username", "=", $UsermailOrUsername)

                /**
                 *constitute data transfer object to client
                 * @param id ,usermail , password
                 */
                ->select('userId', 'usermail', 'password')->first();

            return $user;
        } catch (ModelNotFoundException $e) {

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * search users by param
     * serach array
     *@return string
     *@param string $search_param
     */
    public function findUserByParam(string $search_param)
    {

        try {
            $user = User::where("usermail", $search_param)
                ->orWhere("username", $search_param)
                ->orWhere("userId", $search_param)

                /**
                 *constitute data transfer object to client
                 * @param id ,usermail , username
                 */
                ->select('userId', 'usermail', 'username','updated_at', 'created_at', 'created_at')->first();

            return $user;
        } catch (ModelNotFoundException $e) {

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    /**
     *@return array $dated user
     * @param array < int , string
     */
    // Save a new user with an array of data
    public function updateUser(array $userData)
    {

        try {

            $userId = $userData['userId'];
            // find User instance and updated it
            return User::where('userId', '=', $userId)->update($userData);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}