<?php

namespace App\Http\Resources;

use App\Models\Disease;
use App\Models\Efficiency;
use App\Models\Micronutrient;
use App\Models\Reference;
use Illuminate\Http\Resources\Json\JsonResource;

class DiseaseMicroResource extends JsonResource
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
        $names = Disease::where('id',$this->disease_id)->select('name','name_html')->first();

        $links = explode(',',$this->links);
        $refs = [];
        foreach ($links as $link){
            $refs[] = Reference::where('micronutrient_id',$this->micronutrient_id)
                ->where('reference_code',$link)->select('id','reference_code','head')->first();
        }

        return [
            'id'=>$this->id,
            'disease_id'=>$this->disease_id,
            'disease_name'=>$names->name,
            'disease_name_html'=>$names->name_html,
            'micronutrient_id'=>$this->micronutrient_id,
            'micronutrient_name'=>Micronutrient::where('id',$this->micronutrient_id)->pluck('name')[0],
            'efficiency' => Efficiency::where('id',$this->efficiency_id)->first(),
            'comment'=>$this->comment,
            'comment_html'=>$this->comment_html,
            'links'=>$refs


        ];
    }
}
