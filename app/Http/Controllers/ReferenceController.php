<?php

namespace App\Http\Controllers;

use App\Models\Reference;
use Illuminate\Http\Request;

class ReferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Reference::select('id','micronutrient_id','reference_code','head')->get();
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
            'micronutrient_id'=>"required|int|exists:micronutrients,id",
            'head'=>"required"
        ]);
        $micro_id = $request->input('micronutrient_id');
        $max = Reference::where('micronutrient_id',$micro_id)->max('reference_code');
        $ref_code = $max + 1;

        Reference::create([
            'micronutrient_id'=>$micro_id,
            'reference_code'=>$ref_code,
            'head'=>$request->input('head'),
            'body'=>$request->input('body',''),
        ]);

    }
    public function referenceByMicro($id){
        $limit = request('per_page',PHP_INT_MAX);
        $page = request('page',1);

        return Reference::where('micronutrient_id',$id)
            ->paginate($limit,['id','micronutrient_id','reference_code','head'],'page');
    }

    public function referenceByCodeAndMicro($code,$id){
        $ref = Reference::where('reference_code',$code)->where('micronutrient_id',$id)->first();
        if ($ref){
            return $ref;
        } else {
            return response()->json([
                'success'=>'false',
                'message'=>"no such reference found"
            ],404);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $ref = Reference::where('id',$id)->first();
        if ($ref){
            return $ref;
        } else {
            return response()->json([
                'success'=>'false',
                'message'=>"no such reference found"
            ],404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'micronutrient_id'=>"int|exists:micronutrients,id",
            'head'=>"string"
        ]);
        $reference = Reference::where('id',$id)->first();
        $micro_id = $request->input('micronutrient_id',null);
        $ref_code = $request->input('reference_code',null);
        if ($ref_code!=null){
            if ($micro_id==null){
                return response()->json([
                    'success'=>false,
                    'message'=>"supply micronutrient_id if you want to change reference code"
                ],400);
            }
            if (Reference::where('micronutrient_id',$micro_id)->where('reference_code',$ref_code)->first()){
                return response()->json([
                   'success'=>false,
                   'message'=>"reference_code for this micronutrient already exists"
                ],400);
            }
            else{
                $reference->reference_code = $ref_code;
            }
        }
        $reference->micronutrient_id = $request->input('micronutrient_id',$reference->micronutrient_id);
        $reference->reference_code = $request->input('reference_code',$reference->reference_code);
        $reference->body = $request->input('body',$reference->body);
        $reference->head = $request->input('head',$reference->head);
        $reference->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Reference::where('id',$id)->delete();
    }
}
