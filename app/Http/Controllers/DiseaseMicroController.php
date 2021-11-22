<?php

namespace App\Http\Controllers;

use App\Http\Resources\DiseaseMicroResource;
use App\Models\DiseaseMicro;
use Illuminate\Http\Request;

class DiseaseMicroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DiseaseMicroResource::collection(DiseaseMicro::all())->collection;
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
            'disease_id' => 'required|int|exists:diseases,id',
            'micronutrient_id' => 'required|int|exists:micronutrients,id',
            'efficiency_id' => 'required|int|exists:efficiencies,id',
        ]);
        DiseaseMicro::create([
            'disease_id'=>$request->input('disease_id'),
            'micronutrient_id'=>$request->input('micronutrient_id'),
            'efficiency_id'=>$request->input('efficiency_id'),
            'comment'=>$request->input('comment',''),
            'comment_html'=>$request->input('comment_html',''),
            'links'=>$request->input('links',json_encode(''))

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
        $dm = DiseaseMicro::where('id',$id)->first();
        return new DiseaseMicroResource($dm);
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
        $dm = DiseaseMicro::where('id',$id)->first();

        DiseaseMicro::where('id',$id)->update([
            'disease_id'=>$request->input('disease_id',$dm->disease_id),
            'micronutrient_id'=>$request->input('micronutrient_id',$dm->micronutrient_id),
            'efficiency_id'=>$request->input('efficiency_id',$dm->efficiency_id),
            'comment'=>$request->input('comment',$dm->comment),
            'comment_html'=>$request->input('comment_html',$dm->comment_html),
            'links'=>$request->input('links',$dm->links)
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
        DiseaseMicro::where('id',$id)->delete();
    }
}
