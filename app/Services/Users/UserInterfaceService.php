<?php

namespace App\Services\Users;

use Illuminate\Http\JsonResponse;

interface UserInterfaceService
{

    /**
     *@retrun get all $users
     * @return array< int , strin>
     */
    function getUsers();

    /**
     *@retrun save $users
     * @return array< int , strin>
     */
    function saveNewUser(array $userData);


    /**
     *@retrun $user by UsermailOrUsername
     * @return string< int , strin>
     */

    function findUserByUsermail(string $UsermailOrUsername);

     /**
     *@data $userData
     * @param array< int , strin>
     */
    function updateUser(array $userData);



}