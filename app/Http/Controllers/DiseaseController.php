<?php

namespace App\Http\Controllers;

use App\Http\Resources\DiseaseMicroResource;
use App\Http\Resources\DrugMicroResource;
use App\Models\Disease;
use App\Models\DiseaseMicro;
use App\Models\Efficiency;
use App\Models\Micronutrient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DiseaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Disease::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:diseases',
        ]);

        $name = $request->input('name');
        $name_html = $request->input('name_html','');
        Disease::create([
            'name'=> $name,
            'name_html' => $name_html,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Disease  $disease
     * @return \Illuminate\Http\Response
     */
    public function show(Disease $disease)
    {

        $disease_micro = DiseaseMicro::select('*')->where('disease_id',$disease->id)->get();
        $disease_micro = DiseaseMicroResource::collection($disease_micro);
        return compact('disease','disease_micro');
    }

    public function update(Request $request, Disease $disease)
    {
        $name = $request->input('name',$disease->name);
        $name_html = $request->input('name_html',$disease->name_html);
        $disease->name = $name;
        $disease->name_html = $name_html;
        $disease->save();
    }

    public function destroy(Disease $disease)
    {
        DiseaseMicro::where('disease_id',$disease->id)->delete();
        $disease->delete();
    }

}
