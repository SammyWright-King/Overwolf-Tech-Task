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
class LookupController extends Lookup
{

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
            return $this->sendErrorResponse("Type not specified!");
        }
    }


}
