<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Laravel\Passport\ClientRepository;

class ApiBaseController extends Controller {

    /**
     * JSON形式のレスポンスに変換
     *
     * @param $data
     * @param int $status
     * @return array users
     */
    protected function toJson($data, $status = 200)
    {
        return response()->json($data, $status);
    }

    /**
     * JSON形式のエラーレスポンスに変換
     *
     * @param $code
     * @param $url
     * @param int $status
     * @return array users
     */
    protected function toErrorJson($code, $url, $status = 400)
    {
        $message = config("const_http.ERROR_MESSAGE." . $status);
        $error = array_merge(compact('code'), compact('url'), compact('message'));
        return response()->json(compact('error'), $status);
    }

    /**
     * 認証済みのクライアントか判別
     *
     * @param  int $id
     * @param $secretKey
     * @return bool
     */
    protected function isAuthorizedClient($id, $secretKey)
    {
        $clientClass = new ClientRepository();
        $client = $clientClass->find($id);

        if (! $client) {
            return false;
        } else if ($secretKey == $client->secret) {
            return true;
        }
    }
}