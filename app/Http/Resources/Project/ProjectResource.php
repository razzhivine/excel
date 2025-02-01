<?php

namespace App\Http\Resources\Project;

use App\Http\Resources\Type\TypeResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => new TypeResource($this->type),
            'title' => $this->title,
            'created_at_time' => $this->created_at_time->format('d-m-Y'),
            'contracted_at' => $this->contracted_at->format('d-m-Y'),
            'is_chain' => $this->is_chain ? 'yes' : 'no',
            'worker_count' => $this->worker_count,
            'has_outsource' => $this->has_outsource ? 'yes' : 'no',
            'has_investors' => $this->has_investors ? 'yes' : 'no',
            'deadline' => $this->deadline ? $this->deadline->format('d-m-Y') : null,
            'is_on_time' => $this->is_on_time ? 'yes' : 'no',
            'service_count' => $this->service_count,
            'comment' => $this->comment,
            'effective_value' => $this->effective_value,
            'payment_first_step' => $this->payment_first_step,
            'payment_second_step' => $this->payment_second_step,
            'payment_third_step' => $this->payment_third_step,
            'payment_fourth_step' => $this->payment_fourth_step,
        ];
    }
}
