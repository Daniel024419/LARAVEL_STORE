<?php
namespace App\Services\Users;
use Illuminate\Http\JsonResponse;
interface UserInterfaceService {

    /**
     *@retrun get all $users
     * @return array< int , strin>
     */
    function getUsers();

    /**
     *@retrun save $users
     * @return array< int , strin>
     */
    function saveNewUser( array $userData);


    /**
     *@retrun $user by usermail
     * @return string< int , strin>
     */

     function findUserByUsermail( string $usermail) ;
}