<?php

namespace App\Livewire;

use Livewire\Component;

class HeaderComponent extends Component
{
    public $nombre = "";
    public $url = "";
    public function render()
    {
        return view('livewire.header-component');
    }

}
