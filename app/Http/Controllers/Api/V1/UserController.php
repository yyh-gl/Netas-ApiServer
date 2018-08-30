<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\ClientRepository;

class UserController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Collection users
     */
    public function index()
    {
        $users = User::all();
        return response()->json([
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $isAuthorized = $this->isAuthorizedClient($request->header('ClientId'), $request->header('ClientSecret'));
        if (! $isAuthorized) {
            // TODO: エラー処理をきれいに書き直す
            return response()->json([
                'error' => 'Not Authorized',
            ], config('const_http.STATUS_CODE.unauthorized'));
        }

        $user = new User;
        $user->user_id      = $request->user_id;
        $user->name         = $request->name;
        $user->email        = $request->email;
        $user->avatar       = $request->avatar;
        $user->introduction = $request->introduction;
        $user->password     = Hash::make($request->password);
        $user->save();
        return response()->json([
            'user' => $user,
        ], config('const_http.STATUS_CODE.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param $user_id
     * @return \Illuminate\Http\Response
     */
    public function show($user_id)
    {
        try {
            $user = User::where('user_id', $user_id)->firstOrFail();
        } catch (\Exception $e) {
            $user = NULL;
        }

        return response()->json([
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * 認証済みのクライアントか判別
     *
     * @param  int $id
     * @param $secretKey
     * @return bool
     */
    private function isAuthorizedClient($id, $secretKey)
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
