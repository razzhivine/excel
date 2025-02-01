<?php

namespace App\Http\Resources\FailedRow;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FailedRowResource extends JsonResource
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
            'message' => $this->message,
            'key' => $this->key,
            'task_id' => $this->task_id,
            'row' => $this->row,
            'created_at' => $this->created_at->format('d-m-Y'),
        ];
    }
}
