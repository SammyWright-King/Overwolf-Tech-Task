<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Repositories\SearchRepository;
use Illuminate\Http\Request;

class Lookup extends Controller
{
    protected $result;
    protected $search_repository;

    public function __construct(SearchRepository $searchRepository)
    {
        $this->search_repository = $searchRepository;
    }

    /**
     * @param Request $request
     * @return array
     * perform the minecraft lookup
     */
    public function lookupMinecraft(Request $request)
    {
        try{
            if($request->id)
            {
                //lookup minecraft with user id
                $response = $this->search_repository->lookupMinecraftById($request->id);
            }
            elseif ($request->username)
            { //then request contains username otherwise

                //lookup minecraft with username
                $response = $this->search_repository->lookupMinecraftByUsername($request->username);

            }else{
                return $this->sendErrorResponse('Unrecognized parameter, Kindly include user id or username');
            }

            $this->result =  $this->sendMinecraftResponse($response); //return response
            $this->setSessionAcrossUsers($this->result);

            return $this->result;

        }catch(\Exception $e){
            return $this->sendErrorResponse($e->getMessage());
        }

    }

    /**
     * @param Request $request
     * @return array
     * perform lookup on steam
     */
    public function lookupSteam(Request $request)
    {
        try{
            if($request->id)
            {
                //lookup steam with id
                $response = $this->search_repository->lookupSteamById($request->id);

                $this->result =  $this->sendXBLResponse($response); //return response
                $this->setSessionAcrossUsers($this->result);

                return $this->result;
            }
            elseif($request->username){
                // request contains username

                //die("Steam only supports IDs");
                return $this->sendErrorResponse('Steam only supportd IDs.');
            }
            else{
                return $this->sendErrorResponse('Unrecognized parameter, id not specified in request');
            }
        }catch(\Exception $e){
            return $this->sendErrorResponse($e->getMessage());
        }

    }

    /**
     * @param Request $request
     * @return array
     * perform lookup on xbl
     */
    public function lookupXBL(Request $request)
    {
        try{
            if($request->id)
            {
                //look up xbl with user id
                $response = $this->search_repository->lookupXBLById($request->id);

            }
            elseif($request->username)
            { //request contains username otherwise

                //look up xbl with username
                $response = $this->search_repository->lookupXBLByusername($request->username);

            }else{
                return $this->sendErrorResponse('Unrecognized parameter, Kindly include user id or username');
            }

            $this->result =  $this->sendXBLResponse($response); //return response
            $this->setSessionAcrossUsers($this->result);

            return $this->result;
        }catch(\Exception $e){
            return $this->sendErrorResponse($e->getMessage());
        }
    }
}
