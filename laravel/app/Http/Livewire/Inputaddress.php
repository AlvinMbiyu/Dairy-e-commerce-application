<?php

namespace App\Http\Livewire;

use App\Models\County;
use App\Models\Subcounty;
use App\Models\Town;
use Livewire\Component;

class Inputaddress extends Component
{
    public $selectedCounty = null;
    public $selectedSubCounty = null;
    public $subcounty = null;
    public $selectedTown = null;
    public $town = null;

    public function render()
    {
        $counties = County::all();
        return view('livewire.inputaddress', compact('counties'));
    }

    public function updatedSelectedCounty($county_id)
    {
        $this->subcounty = Subcounty::where('county_id', $county_id)->get();
    }

    public function updatedSelectedSubcounty($subcounty_id)
    {

        $this->town = Town::where('sc_id', $subcounty_id)->get();
    }
}
