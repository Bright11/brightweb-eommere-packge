<?php

namespace Brightweb\Ecommerce\Http\Livewire\Backend;

use Brightweb\Ecommerce\Models\Category;
use Livewire\Component;

class Addcategory extends Component
{
    public $name;
    public $itemId;

    public $fetchcategory;
    public function render()
    {
        return view('brightweb::livewire.backend.addcategory');
    }
    public function savecategory()
    {
        $validated = $this->validate([
            'name' => 'required|string|unique:categories',
            
        ]);
       
        $attributes = ['name' => $this->name]; // The attributes to update or create

        $newOrEdit = Category::updateOrCreate(['id' => $this->itemId], $attributes);
        $this->name='';
        $this->itemId='';
        $this->mount();
        //session()->flash('message', 'Post successfully updated.');
        
    }

    public function mount()
    {
        $this->fetchcategory=Category::all();
    }

    public function updatecat($id)
    {
        $this->itemId=$id;
        $category=Category::find($id);
        $this->name=$category->name;
       // session()->flash('message', 'Post successfully updated.');
       
    }

    public function deletecat($id)
    {
        $category=Category::find($id);
        $category->delete();
        $this->mount();
        //session()->flash('message', 'Post successfully updated.');

    }
}
