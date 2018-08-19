<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\TagRequest;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User;
        $user->user_id = $request->user_id;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->avatar = $request->avatar;
        $user->introduction = $request->introduction;
        $user->password = $request->password;
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
        $user = User::where('user_id', $user_id)->firstOrFail();
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
}
