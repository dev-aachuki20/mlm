<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Auth;
use App\Models\Package;

class ReferralLink extends Component
{
    protected $layout = null;

    public $selectPackage;


    public function render()
    {  
        $package = Package::where('status', '1')->pluck('title', 'uuid');

        $referralUUID =  Auth::user()->uuid;
        
        $referralLink = route('auth.register', [$referralUUID, $this->selectPackage]);

        return view('livewire.user.referral-link', compact('package', 'referralLink'));
        
        // return view('livewire.user.referral-link');
    }

}
