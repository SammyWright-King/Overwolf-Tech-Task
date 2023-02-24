<?php

namespace App\Repositories;

use App\Interfaces\SearchInterface;
use function App\Helpers\sendRequest;

class SearchRepository implements SearchInterface
{
    /**
     * @param int $id
     * lookup minecraft service by searching with user id
     */
    public function lookupMinecraftById($userId)
    {
        //set url value
        $url = "https://sessionserver.mojang.com/session/minecraft/profile/{$userId}";

        //send request with the sendRequest helper function
        return sendRequest($url);
    }

    /**
     * @param string $username
     *lookup minecraft services by searching through with username
     */
    public function lookupMinecraftByUsername(string $username)
    {
        //set url value separate for looking up minecraft using
        $url = "https://api.mojang.com/users/profiles/minecraft/{$username}";

        // send request with the sendRequest helper function
        return sendRequest($url);
    }

    /**
     * @param int $id
     * @return mixed
     * lookup steam api using user id
     */
    public function lookupSteamById($id)
    {
        //set url value for accessing the steam endpoint with id
        $url = "https://ident.tebex.io/usernameservices/4/username/{$id}";

        // send request with the sendRequest helper function and return response
        return sendRequest($url);
    }

    /**
     * @param string $username
     * @return mixed
     * lookup the xbl api with username
     */
    public function lookupXBLByusername(string $username)
    {
        //set url for accessing the xbl endpoint with username
        //$url = "https://ident.tebex.io/usernameservices/3/username/" . $username . "?type=username";
        $url = "https://ident.tebex.io/usernameservices/3/username/{$username}?type=username";


        // send request with the sendRequest helper function
        return sendRequest($url);
    }

    /**
     * @param int $id
     * @return mixed
     * lookup the xbl api using user id
     */
    public function lookupXBLById($id)
    {
        //set url for accessing the xbl endpoint with username
        $url = "https://ident.tebex.io/usernameservices/3/username/{$id}";

        // send request with the sendRequest helper function
        return sendRequest($url);
    }
}
