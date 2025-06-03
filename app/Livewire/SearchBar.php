<?php
namespace App\Livewire;

use Livewire\Component;

class SearchBar extends Component
{
public $query = '';

public function render()
{
return view('livewire.search-bar');
}
}