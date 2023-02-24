<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param $response
     * @return array
     * return response specific to minecraft structure
     */
    public function sendMinecraftResponse($response)
    {
        return [
            'username' => $response->name,
            'id' => $response->id,
            'avatar' => "https://crafatar.com/avatars" . $response->id
        ];
    }

    /**
     * @param $response
     * @return array
     * return response specific to steam and xbl structure
     */
    public function sendXBLResponse($response)
    {
        return [
            'username' => $response->username,
            'id' => $response->id,
            'avatar' => $response->meta->avatar
        ];
    }

    /**
     * @param array $arr
     * setup session across requests
     */
    public function setSessionAcrossUsers(array $arr)
    {
        session([
            'id' => $arr['id'],
            'username' => $arr['username'],
            'avatar' => $arr['avatar']
        ]);
    }

    /**
     * @param $message
     * @return array
     * send back or display error message
     */
    public function sendErrorResponse($message)
    {
        return [
            'status' => false, 'error' => $message
        ];
    }
}
