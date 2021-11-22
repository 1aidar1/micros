<?php

namespace App\Http\Controllers;

use App\Models\Power;
use Illuminate\Http\Request;

class PowerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Power::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|numeric|unique:powers',
            'description' => 'required'
        ]);
        Power::create($validated);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Power  $power
     * @return \Illuminate\Http\Response
     */
    public function show(Power $power)
    {

        return $power;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Power  $power
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Power $power)
    {
        $request->validate([
            'code' => 'numeric',
        ]);
        $code = $request->input('code',$power->code);
        $desc = $request->input('description',$power->description);
        $power->code = $code;
        $power->description = $desc;
        $power->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Power  $power
     * @return \Illuminate\Http\Response
     */
    public function destroy(Power $power)
    {
        //
    }
}
