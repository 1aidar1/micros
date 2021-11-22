<?php

namespace App\Http\Resources;

use App\Models\HealthStatus;
use App\Models\Micronutrient;
use App\Models\Usage;
use Illuminate\Http\Resources\Json\JsonResource;

class HealthStatusMicroResource extends JsonResource
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
        $names = HealthStatus::where('id',$this->health_status_id)->select('name','name_html')->first();

        return [
            'id'=>$this->id,
            'health_status_id'=>$this->health_status_id,
            'health_status_name'=>$names->name,
            'health_status_name_html'=>$names->name_html,
            'micronutrient_id'=>$this->micronutrient_id,
            'micronutrient_name'=>Micronutrient::where('id',$this->micronutrient_id)->pluck('name')[0],
            'usage'=>Usage::where('id',$this->usage_id)->first(),
            'comment'=>$this->comment,
            'comment_html'=>$this->comment_html,
            'links'=>$this->links
        ];
    }
}
