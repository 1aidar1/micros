<?php

namespace App\Http\Controllers;

use App\Http\Resources\SideEffectMicroResource;
use App\Models\Micronutrient;
use App\Models\SideEffect;
use App\Models\SideEffectMicro;
use Illuminate\Http\Request;

class SideEffectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SideEffect::all();
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
            'name' => 'required|string|unique:side_effects',
        ]);

        $name = $request->input('name');
        $name_html = $request->input('name_html','');
        SideEffect::create([
            'name'=> $name,
            'name_html' => $name_html,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SideEffect  $side_effect
     * @return \Illuminate\Http\Response
     */
    public function show(SideEffect $side_effect)
    {
        $side_effect_micro = SideEffectMicro::select('*')->where('side_effect_id',$side_effect->id)->get();
        $side_effect_micro = SideEffectMicroResource::collection($side_effect_micro);
        return compact('side_effect','side_effect_micro');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SideEffect  $side_effect
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SideEffect $side_effect)
    {
        $name = $request->input('name',$side_effect->name);
        $name_html = $request->input('name_html',$side_effect->name_html);
        $side_effect->name = $name;
        $side_effect->name_html = $name_html;
        $side_effect->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SideEffect  $side_effect
     * @return \Illuminate\Http\Response
     */
    public function destroy(SideEffect $side_effect)
    {
        SideEffectMicro::where('side_effect_id',$side_effect->id)->delete();
        $side_effect->delete();
    }
}
