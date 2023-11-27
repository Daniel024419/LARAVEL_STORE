<?php

namespace App\Repository\Users;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

interface UserInterfaceRepository
{

    /**
     *@retrun get all $users
     * @return array< int , strin>
     */
    function getUsers() : Collection;

    /**
     *@retrun save $users
     * @return array< int , strin>
     */
    function saveNewUser(  array $userData);


    /**
     *@retrun $user by usermail
     * @return string< int , strin>
     */

    function findUserByUsermail(string $usermail) ;
}