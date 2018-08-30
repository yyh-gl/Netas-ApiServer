<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\TagRequest;
use App\Models\Tag;

class TagController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index()
    {
        $tags = Tag::all();
        return $this->toJson(compact('tags'));
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
     * @param TagRequest $request
     * @return array
     */
    public function store(TagRequest $request)
    {
        $tag = new Tag();
        $tag->name = $request->name;
        $tag->followed_count = 0;
        $tag->save();
        return $this->toJson($tag, config('const_http.STATUS_CODE.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return array
     */
    public function show($id)
    {
        $tag = Tag::getRecordById($id);
        return $this->toJson(compact('tag'));
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
