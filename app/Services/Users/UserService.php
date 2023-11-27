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


    function findUserByUsermail( string $usermail)
    {

        try {
            //pass the data for query
        return  $this->userRepository->findUserByUsermail($usermail);

        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
