<?php

namespace App\Http\Controllers;

use App\Http\Resources\HealthStatusMicroResource;
use App\Models\HealthStatus;
use App\Models\HealthStatusMicro;
use App\Models\Micronutrient;
use App\Models\Usage;
use Illuminate\Http\Request;

class HealthStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return HealthStatus::all();
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
            'name' => 'required|string|unique:health_statuses',
        ]);

        $name = $request->input('name');
        $name_html = $request->input('name_html','');
        HealthStatus::create([
            'name'=> $name,
            'name_html' => $name_html,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HealthStatus  $health_status
     * @return \Illuminate\Http\Response
     */
    public function show(HealthStatus $health_status)
    {
        $health_status_micro = HealthStatusMicro::select('*')->where('health_status_id',$health_status->id)->get();
        $health_status_micro = HealthStatusMicroResource::collection($health_status_micro);
        return compact('health_status','health_status_micro');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HealthStatus  $health_status
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HealthStatus $health_status)
    {
        $name = $request->input('name',$health_status->name);
        $name_html = $request->input('name_html',$health_status->name_html);
        $health_status->name = $name;
        $health_status->name_html = $name_html;
        $health_status->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HealthStatus  $health_status
     * @return \Illuminate\Http\Response
     */
    public function destroy(HealthStatus $health_status){
        HealthStatusMicro::where('health_status_id',$health_status->id)->delete();
        $health_status->delete();
    }
}
