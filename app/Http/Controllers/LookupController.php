<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Repositories\SearchRepository;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

/**
 * Class LookupController
 *
 * @package App\Http\Controllers
 */
class LookupController extends Controller
{

    //this is private because this dependency should only be available within this class
    private $search_repository;

    public function __construct(SearchRepository $searchRepository)
    {
        $this->search_repository = $searchRepository;
    }

    /**
     * @param Request $request
     * @return array
     * main lookup function
     */
    public function lookup(Request $request) {
        if($request->has('type')){
            if ($request->get('type') == 'minecraft') {

                //perform the minecraft lookup
                return $this->lookupMinecraft($request);

            }
            elseif ($request->get('type')=='steam') {

                //perform lookup on steam
                return $this->lookupSteam($request);
            }
            elseif($request->get('type') === 'xbl'){

                //perform lookup on xbl
                return $this->lookupXBL($request);
            }
        }
        else{
            return $this->sendErrorResponse("Type not specified!", 400);
        }

        //We can't handle this - maybe provide feedback?
        //die('request cannot be processed, unidentified parameters!');
    }

    /**
     * @param Request $request
     * @return bool
     * check if request has user id or not
     * return true if request contains id or false otherwise
     */
//    public function checkIfRequestHasId(Request $request)
//    {
//        if(!$request->has('id')){
//            return false;
//        }else{
//            return true;
//        }
//    }

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
                return $this->sendErrorResponse('Unrecognized parameter, Kindly include user id or username', 400);
            }

            $arr =  $this->sendMinecraftResponse($response); //return response
            $this->setSessionAcrossUsers($arr);

            return $arr;

        }catch(\Exception $e){
            return $this->sendErrorResponse($e->getMessage(), 500);
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

                $arr =  $this->sendXBLResponse($response); //return response
                $this->setSessionAcrossUsers($arr);

                return $arr;
            }
            elseif($request->username){
                // request contains username

                //die("Steam only supports IDs");
                return $this->sendErrorResponse('Steam only supportd IDs.', 400);
            }
            else{
                return $this->sendErrorResponse('Unrecognized parameter, id not specified in request', 400);
            }
        }catch(\Exception $e){
            return $this->sendErrorResponse($e->getMessage(), 500);
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
                return $this->sendErrorResponse('Unrecognized parameter, Kindly include user id or username', 400);
            }

            $arr =  $this->sendXBLResponse($response); //return response
            $this->setSessionAcrossUsers($arr);

            return $arr;
        }catch(\Exception $e){
            return $this->sendErrorResponse($e->getMessage(), 500);
        }
    }
}
