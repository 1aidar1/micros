<?php

namespace App\Http\Controllers;

use App\Http\Resources\HealthStatusMicroResource;
use App\Models\HealthStatusMicro;
use Illuminate\Http\Request;

class HealthStatusMicroControlller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return HealthStatusMicroResource::collection(HealthStatusMicro::all())->collection;

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
            'health_status_id' => 'required|int|exists:health_statuses,id',
            'micronutrient_id' => 'required|int|exists:micronutrients,id',
            'usage_id' => 'required|int|exists:usages,id',
        ]);
        HealthStatusMicro::create([
            'health_status_id'=>$request->input('health_status_id'),
            'micronutrient_id'=>$request->input('micronutrient_id'),
            'usage_id'=>$request->input('usage_id'),
            'comment'=>$request->input('comment',''),
            'comment_html'=>$request->input('comment_html',''),
            'links'=>json_encode("")
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
        return new HealthStatusMicroResource(HealthStatusMicro::where('id',$id)->first());

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
        $hs = HealthStatusMicro::where('id',$id)->first();

        HealthStatusMicro::where('id',$id)->update([
            'health_status_id'=>$request->input('health_status_id',$hs->health_status_id),
            'micronutrient_id'=>$request->input('micronutrient_id',$hs->micronutrient_id),
            'comment'=>$request->input('comment',$hs->comment),
            'comment_html'=>$request->input('comment_html',$hs->comment_html),
            'links'=>$request->input('links',$hs->links)
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
        HealthStatusMicro::where('id',$id)->delete();
    }
}
