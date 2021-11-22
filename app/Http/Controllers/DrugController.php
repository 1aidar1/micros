<?php

namespace App\Http\Controllers;

use App\Http\Resources\DrugMicroResource;
use App\Http\Resources\DrugResource;
use App\Models\Drug;
use App\Models\DrugMicro;
use App\Models\Micronutrient;
use App\Models\Power;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DrugController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Drug::all();
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
            'name' => 'required|string|unique:drugs',
        ]);

        $name = $request->input('name');
        $name_html = $request->input('name_html','');
        $details = $request->input('details','');
        Drug::create([
            'name'=> $name,
            'name_html' => $name_html,
            'details' => $details
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Drug  $drug
     * @return \Illuminate\Http\Response
     */
    public function show(Drug $drug)
    {
        $drug_micro = DrugMicro::select('*')->where('drug_id',$drug->id)->get();
        $drug_micro = DrugMicroResource::collection($drug_micro);
        return compact('drug','drug_micro');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Drug  $drug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Drug $drug)
    {

        $name = $request->input('name',$drug->name);
        $name_html = $request->input('name_html',$drug->name_html);
        $details = $request->input('details',$drug->details);
        $drug->name = $name;
        $drug->name_html = $name_html;
        $drug->details = $details;
        $drug->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Drug  $drug
     * @return \Illuminate\Http\Response
     */
    public function destroy(Drug $drug)
    {
        DrugMicro::where('drug_id',$drug->id)->delete();
        $drug->delete();
    }
}
