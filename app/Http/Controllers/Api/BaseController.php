<?php


namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BaseController extends Controller
{
    /**
     * return success response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendSuccessResponse($data = null)
    {
    	$response = [
            'success' => true,
        ];

        if ($data) {
            $response['data'] = $data;
        }

        return response()->json($response);
    }

    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error = null, $code = null, $data = null)
    {
    	$response = [
            'success' => false,
            'message' => $error,
        ];

        if ($data) {
            $response['data'] = $data;
        }

        if ($code) {
            return response()->json($response, $code);
        } else {
            return response()->json($response);
        }
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function get($url)
    {
    	$response = Http::withHeaders([
            'x-api-key' => config('constants.api.x_api_key'),
        ])->withOptions(['verify' => false])->get(config('constants.api.base_url').$url);

        return $response;
    }

    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function post($url, $data)
    {
    	$response = Http::withHeaders([
            'x-api-key' => config('constants.api.x_api_key'),
        ])->withOptions(['verify' => false])->post(config('constants.api.base_url').$url, $data);

        return $response;
    }

    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function put($url, $data = null)
    {
    	$response = Http::withHeaders([
            'x-api-key' => config('constants.api.x_api_key'),
        ])->withOptions(['verify' => false])->put(config('constants.api.base_url').$url, $data);

        return $response;
    }

    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete($url)
    {
    	$response = Http::withHeaders([
            'x-api-key' => config('constants.api.x_api_key'),
        ])->withOptions(['verify' => false])->delete(config('constants.api.base_url').$url);

        return $response;
    }

    /**
     * log to file.
     *
     * @return \Illuminate\Http\Response
     */
    public function log($url, $method, $response, $company_id = null, $user_id = null, $data = null)
    {
        $log = '['.$company_id.'-'.$user_id.'] '.$method.' '.config('constants.api.base_url').$url;
        if (isset($data) && ($method === config('constants.post') || $method === config('constants.put'))) {
            $log = $log.PHP_EOL.json_encode($data, JSON_UNESCAPED_UNICODE);
        }
        if ($response->failed()) {
            $log = $log.PHP_EOL.'{ '.$response->body().' }';
        }
    	Log::channel('api_customer')->info($log);
    }

    /**
     * log to file.
     *
     * @return \Illuminate\Http\Response
     */
    public function logCatch($url, $method, $user_id = null, $data = null, $error = null)
    {
        $log = 'ERROR: ';
        $log = $log.$method.' '.$url;
        if (!is_null($user_id)) $log = $log.' user_id:'.$user_id;
        if (!is_null($data)) $log = $log.' {'.PHP_EOL.json_encode($data, JSON_UNESCAPED_UNICODE).'}';
        $log = $log.' message:'.$error;
    	Log::channel('log_catch')->info($log);
    }
}