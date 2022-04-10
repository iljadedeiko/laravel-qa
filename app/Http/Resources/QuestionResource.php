<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'category_id' => $this->category_id,
            'title' => $this->title,
            'slug' => $this->slug,
            'body' => $this->body,
            'answers_count' => $this->answers_count,
            'votes' => $this->votes,
            'views' => $this->views,
            'user_id' => $this->user_id,
            'best_answer_id' => $this->best_answer_id,
            'status' => $this->status,
            'url' => $this->url,
            'user_url' => $this->user->url,
            'created_date'=> $this->created_date,
        ];
        return parent::toArray($request);
    }
}
