<?php

namespace App\Services\Users;

use App\Repository\Users\UserInterfaceRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserService
{
    protected $userRepository;

    public function __construct(UserInterfaceRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers()
    {

        try {
            return $this->userRepository->getUsers();
        } catch (ModelNotFoundException $e) {

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function saveNewUser($userData)
    {

        try {
            //pass the data to repository
            return $this->userRepository->saveNewUser($userData);
        } catch (ModelNotFoundException $e) {

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }



    /**
     * @param search_param
     */
    function findUserByUsermail(string $UsermailOrUsername)
    {

        try {
            //pass the data for query
            return  $this->userRepository->findUserByUsermail($UsermailOrUsername);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }



    /**
     * @param search_param
     */
    function findUserByParam(string $search_param)
    {
        try {
            //pass the data for query
            return  $this->userRepository->findUserByParam($search_param);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }



    public function updateUser($userData)
    {

        try {
            //pass the data to repository
            return $this->userRepository->updateUser($userData);
        } catch (ModelNotFoundException $e) {

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
