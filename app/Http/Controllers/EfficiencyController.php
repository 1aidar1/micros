<?php

namespace App\Http\Controllers;

use App\Models\Efficiency;
use Illuminate\Http\Request;

class EfficiencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Efficiency::all();
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
            'code' => 'required|numeric|unique:efficiencies',
            'description' => 'required'
        ]);
        SideEffect::create($validated);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Efficiency  $efficiency
     * @return \Illuminate\Http\Response
     */
    public function show(Efficiency $efficiency)
    {
        return $efficiency;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Efficiency  $efficiency
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Efficiency $efficiency)
    {
        $request->validate([
            'code' => 'numeric',
        ]);
        $code = $request->input('code',$efficiency->code);
        $desc = $request->input('description',$efficiency->description);
        $efficiency->code = $code;
        $efficiency->description = $desc;
        $efficiency->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Efficiency  $efficiency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Efficiency $efficiency)
    {
        //
    }
}
