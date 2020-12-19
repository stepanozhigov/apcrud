<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Order extends Component
{
    
    public function render()
    {
        return view('livewire.order')->extends('pages.order-page')->section('content');
    }
}
