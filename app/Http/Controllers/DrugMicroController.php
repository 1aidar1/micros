<?php

namespace App\Http\Controllers;

use App\Http\Resources\DrugMicroResource;
use App\Models\Drug;
use App\Models\DrugMicro;
use Illuminate\Http\Request;

class DrugMicroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DrugMicroResource::collection(DrugMicro::all())->collection;
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
            'drug_id' => 'required|int|exists:drugs,id',
            'micronutrient_id' => 'required|int|exists:micronutrients,id',
            'power_id' => 'required|int|exists:powers,id',
        ]);
        DrugMicro::create([
            'drug_id'=>$request->input('drug_id'),
            'micronutrient_id'=>$request->input('micronutrient_id'),
            'power_id'=>$request->input('power_id'),
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
        return new DrugMicroResource(DrugMicro::where('id',$id)->first());
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
        $dm = DrugMicro::where('id',$id)->first();

        DrugMicro::where('id',$id)->update([
            'drug_id'=>$request->input('drug_id',$dm->drug_id),
            'micronutrient_id'=>$request->input('micronutrient_id',$dm->micronutrient_id),
            'power_id'=>$request->input('power_id',$dm->power_id),
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
        DrugMicro::where('id',$id)->delete();

    }
}
