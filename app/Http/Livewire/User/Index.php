<?php

namespace App\Http\Livewire\User;

use DB;
use Carbon\Carbon;
use Livewire\Component;
use App\Models\User;
use App\Models\Payment;
use App\Models\Transaction;

class Index extends Component
{
    protected $layout = null;
    
    public $todayEarnings, $last7DaysEarnings, $last30DaysEarnings, $allTimeEarning;

    public $todayEarningPercent = 0, $last7DaysEarningPercent=0, $last30DaysEarningPercent=0, $allTimeEarningPercent = 0;

    public $recentSales = null, $weeklyTopRecords,$monthlyTopRecords,$yearlyTopRecords,$allTimeTopRecords;

    public $levelCommission, $totalWithdrawal, $availableBalance, $netProfit;

    public $incomeGrowthChart, $userId;

    public function mount(){
        $this->userId = auth()->user()->id;
        // Start Earning

        //Today
        $this->todayEarnings = Transaction::whereDate('created_at', today())->where('user_id',$this->userId)->sum('amount');

        //Last 7 days
        $this->last7DaysEarnings = Transaction::whereDate('created_at', '>=', DB::raw('DATE_SUB(CURDATE(), INTERVAL 7 DAY)'))->where('user_id',$this->userId)->sum('amount');

        $weekStartAmount = Transaction::whereDate('created_at','=',Carbon::now()->subWeek()->startOfWeek())->where('user_id',$this->userId)->sum('amount');
        $weekEndAmount   = Transaction::whereDate('created_at','=',Carbon::now()->subWeek()->endOfWeek())->where('user_id',$this->userId)->sum('amount');

        $diffreceWeekAmount = (float)$weekEndAmount - (float)$weekStartAmount;
        if($diffreceWeekAmount != 0){
            $this->last7DaysEarningPercent = $diffreceWeekAmount / (float)$weekStartAmount * 100;
        }

        //30 Days
        $this->last30DaysEarnings = Transaction::whereDate('created_at', '>=', DB::raw('DATE_SUB(CURDATE(), INTERVAL 30 DAY)'))->where('user_id',$this->userId)->sum('amount');

        $monthStartAmount = Transaction::whereDate('created_at','=',Carbon::now()->startOfMonth())->where('user_id',$this->userId)->sum('amount');
        $monthEndAmount   = Transaction::whereDate('created_at','=',Carbon::now()->endOfMonth())->where('user_id',$this->userId)->sum('amount');

        $diffreceMonthAmount = (float)$monthEndAmount - (float)$monthStartAmount;
        if($diffreceMonthAmount != 0){
            $this->last30DaysEarnings = $diffreceMonthAmount / (float)$monthStartAmount * 100;
        }

        //All Time
        $this->allTimeEarning = Transaction::sum('amount');

        // New Joiners
        $this->recentSales = User::with([
            'roles'=>function($query){
                $query->where('id',3);
            }
        ])->where('referral_user_id',$this->userId)->whereDate('created_at', today())->get();
        // End Earning

        // Start Commission
        $this->levelCommission = Transaction::where('payment_type','credit')->where('user_id',$this->userId)->sum('amount');
        $this->totalWithdrawal = Transaction::where('payment_type','debit')->where('user_id',$this->userId)->sum('amount');
        $this->availableBalance = (float)$this->levelCommission - (float)$this->totalWithdrawal;
        $this->netProfit = (float)$this->levelCommission - (float)$this->totalWithdrawal;
        // End Commission


        // Leaderboard 

        DB::statement("SET SQL_MODE=''");

        // Weekly
        $this->weeklyTopRecords = Transaction::selectRaw('*, SUM(amount) as total_amount')
        ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
        ->where('payment_type','credit')
        ->groupBy('user_id')
        ->orderByDesc('total_amount')
        ->limit(5)
        ->get();

        // Monthly
        $currentMonth = Carbon::now()->format('Y-m');
        $this->monthlyTopRecords = Transaction::selectRaw('*, SUM(amount) as total_amount')
        ->whereRaw("DATE_FORMAT(created_at, '%Y-%m') = ?", [$currentMonth])
        ->where('payment_type','credit')
        ->groupBy('user_id')
        ->orderByDesc('total_amount')
        ->limit(5)
        ->get();

        // Yearly
        $yearStart = date('Y-04-01'); 
        $yearEnd = date('Y-03-31', strtotime('+1 year'));
        $this->yearlyTopRecords = Transaction::selectRaw('*, SUM(amount) as total_amount')
         ->whereBetween('created_at', [$yearStart, $yearEnd])
         ->where('payment_type','credit')
         ->groupBy('user_id')
         ->orderByDesc('total_amount')
         ->limit(5)
         ->get();

        // All Time
        $this->allTimeTopRecords = Transaction::selectRaw('*, SUM(amount) as total_amount')
        ->where('payment_type','credit')
        ->groupBy('user_id')
        ->orderByDesc('total_amount')
        ->limit(5)
        ->get();

        //Start income growth chart
        $firstDayOfMonth = Carbon::now()->firstOfMonth();
        $lastDayOfMonth  = Carbon::now()->lastOfMonth();
        $totalWeeks = $lastDayOfMonth->diffInWeeks($firstDayOfMonth) + 1;
        for($i=1; $i <= $totalWeeks; $i++){
            $this->incomeGrowthChart['labels'][$i-1] = 'Week '.$i;
        }
      
        // Retrieve records based on current month and week
        $this->incomeGrowthChart['week_data'] = Transaction::selectRaw('YEAR(created_at) as year, WEEK(created_at) as week_number, SUM(amount) as total_amount')->whereRaw('MONTH(created_at) = ?', [Carbon::now()->month]) 
            ->whereRaw('WEEK(created_at) = ?', [Carbon::now()->weekOfYear])
            ->where('payment_type','credit')
            ->groupBy('week_number')->pluck('total_amount')->toArray();
        //End income growth chart

    }

    public function render()
    {
        return view('livewire.user.index');
    }
}
