<?php

namespace App\Http\Livewire\User\Leaderboard;

use DB;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Payment;
use App\Models\Transaction;
use Livewire\WithPagination;
use Livewire\Component;
use Symfony\Component\HttpFoundation\Response;

class Index extends Component
{
    protected $layout = null;

    public function mount(){

    }

    public function render()
    {
        return view('livewire.user.leaderboard.index');
    }
}
