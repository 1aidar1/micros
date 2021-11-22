<?php

namespace App\Http\Resources;

use App\Models\Micronutrient;
use App\Models\Reference;
use App\Models\SideEffect;
use App\Models\SideEffectMicro;
use Illuminate\Http\Resources\Json\JsonResource;

class SideEffectMicroResource extends JsonResource
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
        $names = SideEffect::where('id',$this->side_effect_id)->select('name','name_html')->first();
        $links = explode(',',$this->links);
        $refs = [];
        foreach ($links as $link){
            $refs[] = Reference::where('micronutrient_id',$this->micronutrient_id)
                ->where('reference_code',$link)->select('id','reference_code','head')->first();
        }

        return [
            'id'=>$this->id,
            'side_effect_id'=>$this->side_effect_id,
            'side_effect_name'=>$names->name,
            'side_effect_name_html'=>$names->name_html,
            'micronutrient_id'=>$this->micronutrient_id,
            'micronutrient_name'=>Micronutrient::where('id',$this->micronutrient_id)->pluck('name')[0],
            'comment'=>$this->comment,
            'comment_html'=>$this->comment_html,
            'links'=>$refs
        ];
    }
}
