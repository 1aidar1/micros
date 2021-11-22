<?php

namespace App\Http\Controllers;

use App\Http\Resources\SideEffectMicroResource;
use App\Models\SideEffectMicro;
use Illuminate\Http\Request;

class SideEffectMicroControlller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SideEffectMicroResource::collection(SideEffectMicro::all())->collection;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'side_effect_id' => 'required|int|exists:side_effects,id',
            'micronutrient_id' => 'required|int|exists:micronutrients,id',
        ]);
        SideEffectMicro::create([
            'side_effect_id'=>$request->input('side_effect_id'),
            'micronutrient_id'=>$request->input('micronutrient_id'),
            'comment'=>$request->input('comment',''),
            'comment_html'=>$request->input('comment_html',''),
            'links'=>$request->input('links',json_encode('')),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new SideEffectMicroResource(SideEffectMicro::where('id',$id)->first());

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
        $se = SideEffectMicro::where('id',$id)->first();

        SideEffectMicro::where('id',$id)->update([
            'side_effect_id'=>$request->input('side_effect_id',$se->side_effect_id),
            'micronutrient_id'=>$request->input('micronutrient_id',$se->micronutrient_id),
            'comment'=>$request->input('comment',$se->comment),
            'comment_html'=>$request->input('comment_html',$se->comment_html),
            'links'=>$request->input('links',$se->links)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SideEffectMicro::where('id',$id)->delete();
    }
}
