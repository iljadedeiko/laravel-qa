<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Questions extends Component
{
    public $str = "\Illuminate\Support\Str";

    public $selectedCategory;

    public function questionsQuery($category)
    {
        if ($this->selectedCategory == '') {
            $query = Question::with('user')
                ->latest()->paginate(8);
        } elseif ($this->selectedCategory == 'my_questions') {
            $query = Question::with('user')
                ->where('user_id', Auth::id())
                ->latest()->paginate(8);
        } else {
            $query = Question::with('user')
                ->where('category_id', $category)
                ->latest()->paginate(8);
        }

        return $query;
    }

    public function render()
    {
        return view('livewire.questions', [
            'questions' => $this->questionsQuery($this->selectedCategory),
            'categories' => Category::all()
        ]);
    }
}
