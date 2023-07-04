<?php

namespace App\Http\Livewire\Admin;

use DB;
use Carbon\Carbon;
use Livewire\Component;
use App\Models\User;
use App\Models\Payment;


class Index extends Component
{
    protected $layout = null;
    
    public $todayEarnings, $last7DaysEarnings, $last30DaysEarnings, $allTimeEarning;

    public $currentDate;

    public $todayNewJoiners = null, $leaderboards;

    public function mount(){
        $this->todayEarnings = Payment::whereDate('created_at', today())->sum('amount');

        $this->last7DaysEarnings = Payment::whereDate('created_at', '>=', DB::raw('DATE_SUB(CURDATE(), INTERVAL 7 DAY)'))->sum('amount');

        $this->last30DaysEarnings = Payment::whereDate('created_at', '>=', DB::raw('DATE_SUB(CURDATE(), INTERVAL 30 DAY)'))->sum('amount');

        $this->allTimeEarning = Payment::sum('amount');

        $this->todayNewJoiners = User::with([
            'roles'=>function($query){
                $query->where('id',3);
            }
        ])->whereDate('created_at', today())->get();

        // $this->leaderboards = 

        // Leaderboard 
        $this->currentDate = Carbon::now();


    }

    public function render()
    {
        return view('livewire.admin.index');
    }
}
