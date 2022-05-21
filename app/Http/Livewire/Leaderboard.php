<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Leaderboard extends Component
{
    use WithPagination;

    public $place = 1;

    public $term;

    public function render()
    {
        return view('livewire.leaderboard', [
            'users' => User::when($this->term, function ($query, $term) {
                return $query->where('name', 'LIKE', "%$term%")
                    ->orWhere('email', 'LIKE', "%$term%");
            })
                ->orderBy('rating', 'DESC')
                ->get()
        ]);
    }
}
