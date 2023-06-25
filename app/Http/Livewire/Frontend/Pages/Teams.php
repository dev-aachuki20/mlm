<?php

namespace App\Http\Livewire\Frontend\Pages;

use Livewire\Component;
use App\Models\User;

class Teams extends Component
{
    // public $layouts = null;

    
    public $ceoUserDetail,$managementTeams;

    public function mount(){
        $this->ceoUserDetail = User::whereHas('roles',function($query){
            $query->whereIn('id',[4]);
        })->where('is_active',1)->first();

        $this->managementTeams = User::whereHas('roles',function($query){
            $query->whereIn('id',[5]);
        })->where('is_active',1)->get();
    }
    

    public function render()
    {
        return view('livewire.frontend.pages.teams');
    }
}
