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
    function getUsers(): Collection;

    /**
     *@retrun save $users
     * @return array< int , strin>
     */
    function saveNewUser(array $userData);


    /**
     *@retrun user by UsermailOrUsername
     *@param $id , $username , $usermail
     * @return string< int , strin>
     */

    function findUserByUsermail(string $UsermailOrUsername);


    //findUserByParam

    /**
     *@retrun user
     *@param $search_param
     * @return string< int , strin>
     */
    function findUserByParam(string $search_param);

    /**
     *@retrun user
     *@param $userData
     * @return string< int , strin>
     */

    function updateUser(array $userData);
}
