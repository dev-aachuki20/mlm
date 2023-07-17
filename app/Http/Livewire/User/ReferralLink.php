<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Auth;
use App\Models\Package;
use Jantinnerezo\LivewireAlert\LivewireAlert;


class ReferralLink extends Component
{
    use LivewireAlert;
    protected $layout = null;

    public $selectPackage;
    protected $listeners = ['copyLinkSuccessAlert'];

    public function render()
    {
        $package = Package::where('status', '1')->pluck('title', 'uuid');
        $referralUUID =  Auth::user()->uuid;
        $referralLink = route('auth.register', [$referralUUID, $this->selectPackage]);
        return view('livewire.user.referral-link', compact('package', 'referralLink'));
    }

    public function copyLinkSuccessAlert()
    {
        $this->alert('success', 'Link copied successfully!');
    }
}
