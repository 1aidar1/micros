<?php

namespace App\Http\Resources;

use App\Models\Drug;
use App\Models\Micronutrient;
use App\Models\Power;
use App\Models\Reference;
use Illuminate\Http\Resources\Json\JsonResource;

class DrugMicroResource extends JsonResource
{
    public static $wrap = null;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $names = Drug::where('id',$this->drug_id)->select('name','name_html')->first();

        $links = explode('[',$this->links);
        $refs = [];
        foreach ($links as $link){
            if ($link==''){
                continue;
            }
            $link = str_replace(']','',$link);
            $refs[] = Reference::where('micronutrient_id',$this->micronutrient_id)
                ->where('reference_code',$link)->select('id','reference_code','head')->first();
        }
        return [
            'id'=>$this->id,
            'drug_id'=>$this->drug_id,
            'drug_name'=>$names->name,
            'drug_name_html'=>$names->name_html,
            'micronutrient_id'=>$this->micronutrient_id,
            'micronutrient_name'=>Micronutrient::where('id',$this->micronutrient_id)->pluck('name')[0],
            'power' => Power::where('id',$this->power_id)->first(),
            'comment'=>$this->comment,
            'comment_html'=>$this->comment_html,
            'links'=>$refs
        ];
    }
}
