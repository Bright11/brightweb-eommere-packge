<?php

namespace Brightweb\Ecommerce\Http\Livewire\Frontend;

use Brightweb\Ecommerce\Models\Product;
use Livewire\Component;


class Slider extends Component
{

public $sliderproduct;





    public function render()
    {
        return view('brightweb::livewire.frontend.slider');
    }

    public function mount()
    {
          // slider product in random way
          $this->sliderproduct=Product::inRandomOrder()->take(6)->get()->toArray();
    }
}
