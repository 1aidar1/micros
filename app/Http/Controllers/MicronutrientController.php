<?php

namespace App\Http\Controllers;

use App\Http\Resources\DiseaseMicroResource;
use App\Http\Resources\DrugMicroResource;
use App\Http\Resources\HealthStatusMicroResource;
use App\Http\Resources\SideEffectMicroResource;
use App\Models\Disease;
use App\Models\DiseaseMicro;
use App\Models\DrugMicro;
use App\Models\Efficiency;
use App\Models\HealthStatusMicro;
use App\Models\Micronutrient;
use App\Models\Power;
use App\Models\Reference;
use App\Models\SideEffectMicro;
use App\Models\Usage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MicronutrientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Micronutrient::select('id','name','is_vitamin')->get();
    }

    public function vitamins(){
        return Micronutrient::where('is_vitamin',true)->select('id','name','is_vitamin')->get();
    }

    public function minerals(){
        return Micronutrient::where('is_vitamin',false)->select('id','name','is_vitamin')->get();
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
            'name' => 'required|string|unique:micronutrients',
            'is_vitamin' => 'required|boolean',
        ]);
        Micronutrient::create([
            'name'=>$request->input('name'),
            'name_html'=>$request->input('name_html',null),
            'description_html'=>$request->input('description_html',''),
            'is_vitamin'=>$request->input('is_vitamin'),
        ]);
    }

    /**
     * desc
     *
     * @param  \App\Models\Micronutrient  $micronutrient
     * @param \App\Models\Efficiency  $efficiency
     * @return DiseaseMicroResource
     */
    public function microByEfficiency(Micronutrient $micronutrient,Efficiency $efficiency){
        $diseases = DiseaseMicro::where('efficiency_id',$efficiency->id)->where('micronutrient_id',$micronutrient->id)->get();
        $diseases = DiseaseMicroResource::collection($diseases);
        return compact('diseases');
    }

    public function microByUsage(Micronutrient $micronutrient,Usage $usage){
        $health_statuses = HealthStatusMicro::where('usage_id',$usage->id)->where('micronutrient_id',$micronutrient->id)->get();
        $health_statuses = HealthStatusMicroResource::collection($health_statuses);
        return compact('health_statuses');
    }

    public function microByPower(Micronutrient $micronutrient,Power $power){
        $drugs = DrugMicro::where('power_id',$power->id)->where('micronutrient_id',$micronutrient->id)->get();
        $drugs = DrugMicroResource::collection($drugs);
        return compact('drugs');
    }
    public function microBySideEffect(Micronutrient $micronutrient){
        $side_effects = SideEffectMicro::where('micronutrient_id',$micronutrient->id)->get();
        $side_effects = SideEffectMicroResource::collection($side_effects);
        return compact('side_effects');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Micronutrient  $micronutrient
     * @return \Illuminate\Http\Response
     */
    public function show(Micronutrient $micronutrient)
    {

        $diseases = DiseaseMicro::where('micronutrient_id',$micronutrient->id)->get();
        $diseases = DiseaseMicroResource::collection($diseases);
        foreach ($diseases as $v){
            $names = DB::table('diseases')->where('id',$v->disease_id)
                ->select('name','name_html')->first();
            $v['disease_name'] = $names->name;
            $v['disease_name_html'] = $names->name_html;
        }

        $side_effects = SideEffectMicro::where('micronutrient_id',$micronutrient->id)->get();
        $side_effects = SideEffectMicroResource::collection($side_effects);
        foreach ($side_effects as $v){
            $names = DB::table('side_effects')->where('id',$v->side_effect_id)
                ->select('name','name_html')->first();
            $v['side_effect_name'] = $names->name;
            $v['side_effect_name_html'] = $names->name_html;
        }
        $health_statuses = HealthStatusMicro::where('micronutrient_id',$micronutrient->id)->get();
        $health_statuses = HealthStatusMicroResource::collection($health_statuses);
        foreach ($health_statuses as $v){
            $names = DB::table('health_statuses')->where('id',$v->health_status_id)
                ->select('name','name_html')->first();
            $v['health_status_name'] = $names->name;
            $v['health_status_name_html'] = $names->name_html;
        }
        $drugs = DrugMicro::where('micronutrient_id',$micronutrient->id)->get();
        $drugs = DrugMicroResource::collection($drugs);
        foreach ($drugs as $v){
            $names = DB::table('drugs')->where('id',$v->drug_id)
                ->select('name','name_html')->first();
            $v['drug_name'] = $names->name;
            $v['drug_name_html'] = $names->name_html;
        }

        return compact('micronutrient','diseases','drugs','side_effects','health_statuses');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Micronutrient  $micronutrient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Micronutrient $micronutrient)
    {

        $request->validate([
            'is_vitamin' => 'boolean',
        ]);
        $micronutrient->name = $request->input('name',$micronutrient->name);
        $micronutrient->name_html = $request->input('name_html',$micronutrient->name_html);
        $micronutrient->description_html = $request->input('description_html',$micronutrient->description_html);
        $micronutrient->is_vitamin = $request->input('is_vitamin',$micronutrient->is_vitamin);
        $micronutrient->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Micronutrient  $micronutrient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Micronutrient $micronutrient)
    {
        //
        DrugMicro::where('micronutrient_id',$micronutrient->id)->delete();
        SideEffectMicro::where('micronutrient_id',$micronutrient->id)->delete();
        DiseaseMicro::where('micronutrient_id',$micronutrient->id)->delete();
        HealthStatusMicro::where('micronutrient_id',$micronutrient->id)->delete();
        $micronutrient->delete();

    }
}
