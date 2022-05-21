<?php

namespace App\Http\Livewire;

use App\Http\Controllers\Service\CompilerAPI;
use App\Models\ProgLanguages;
use Livewire\Component;

class Compiler extends Component
{
    public $script;

    public $selectedLanguage;

    public $submitButton;

    public function button()
    {
        $this->submitButton = 1;
    }

    public function submit()
    {
        if ($this->submitButton == 1) {
            $compiler = new CompilerAPI($this->script, $this->selectedLanguage);
            $response = $compiler->fetchData();
        }

        return $response;
    }

    public function render()
    {
        $progLanguages = ProgLanguages::all();

        if ($this->submitButton == 1) {
            return view('livewire.compiler', [
                'progLanguages' => $progLanguages,
                'selectedLanguage' => $this->selectedLanguage,
                'compilerResponse' => $this->submit()
            ]);
        }
        return view('livewire.compiler', [
            'progLanguages' => $progLanguages,
            'selectedLanguage' => $this->selectedLanguage,
        ]);
    }
}
