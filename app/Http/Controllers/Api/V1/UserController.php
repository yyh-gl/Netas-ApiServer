<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return array users
     */
    public function index()
    {
        $users = User::all();
        return $this->toJson(compact('users'));
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
     * @return array
     */
    public function store(UserRequest $request)
    {
        $isAuthorized = $this->isAuthorizedClient($request->header('ClientId'), $request->header('ClientSecret'));
        if (! $isAuthorized) {
            $code = config('system.ERROR_CODE.clientUnauthorized');
            return $this->toErrorJson($code, $request->url(), config('const_http.STATUS_CODE.unauthorized'));
        }

        $user = new User;
        $user->user_id      = $request->user_id;
        $user->name         = $request->name;
        $user->email        = $request->email;
        $user->avatar       = $request->avatar;
        $user->introduction = $request->introduction;
        $user->password     = Hash::make($request->password);
        $user->save();
        return $this->toJson(compact('user'), config('const_http.STATUS_CODE.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param $user_id
     * @return array
     */
    public function show($user_id)
    {
        $user = User::where('user_id', $user_id)->first();
        return $this->toJson(compact('user'));
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

}
