<?php

namespace App\Http\Livewire\User;

use DB;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Payment;
use App\Models\Transaction;
use Livewire\Component;

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
        $this->todayEarnings = Transaction::whereDate('created_at', today())->where('referrer_id',$this->userId)->where('payment_type','credit')->sum('amount');
       
        $yesterday = Carbon::yesterday()->toDateString();
        $yesterdayClosedAmount = Transaction::whereDate('created_at', $yesterday)->where('referrer_id',$this->userId)->where('payment_type','credit')->sum('amount');

        
        
        $diffreceTodayAmount = (float)$this->todayEarnings - (float)$yesterdayClosedAmount;
        
        if($diffreceTodayAmount != 0 && $yesterdayClosedAmount != 0){
            $percentage = $diffreceTodayAmount / (float)$yesterdayClosedAmount * 100;
            $this->todayEarningPercent = number_format(min($percentage, 100),2);
        }

        //Last 7 days
        $previousStartOfWeek = Carbon::now()->subWeek()->startOfWeek();
        $previousEndOfWeek = Carbon::now()->subWeek()->endOfWeek();

        $this->last7DaysEarnings = Transaction::whereBetween('created_at', [$previousStartOfWeek, $previousEndOfWeek])->where('referrer_id',$this->userId)->where('payment_type','credit')->sum('amount');

        $currentStartOfWeek = Carbon::now()->startOfWeek();
        $currentEndOfWeek   = Carbon::now()->endOfWeek();

        $currentWeekEarnings = Transaction::whereBetween('created_at', [$currentStartOfWeek, $currentEndOfWeek])->where('referrer_id',$this->userId)->where('payment_type','credit')->sum('amount');

        $diffreceWeekAmount = (float)$currentWeekEarnings - (float)$this->last7DaysEarnings;
        if($diffreceWeekAmount != 0 && $this->last7DaysEarnings != 0){
            $percentage = $diffreceWeekAmount / (float)$this->last7DaysEarnings * 100;
            $this->last7DaysEarningPercent = number_format(min($percentage, 100),2);
        }

        //30 Days
        $lastMonthStart = Carbon::now()->subMonth()->startOfMonth();
        $lastMonthEnd = Carbon::now()->subMonth()->endOfMonth();

        $this->last30DaysEarnings = Transaction::whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])->where('referrer_id',$this->userId)->where('payment_type','credit')->sum('amount');

        $currentMonthStart = Carbon::now()->startOfMonth();
        $currentMonthEnd = Carbon::now()->endOfMonth();

        $currentMonthEarnings = Transaction::whereBetween('created_at', [$currentMonthStart, $currentMonthEnd])->where('referrer_id',$this->userId)->where('payment_type','credit')->sum('amount');

        $diffreceMonthAmount = (float)$currentMonthEarnings - (float)$this->last30DaysEarnings;
        if($diffreceMonthAmount != 0 && $this->last30DaysEarnings != 0){
            $percentage = $diffreceMonthAmount / (float)$this->last30DaysEarnings * 100;
            $this->last30DaysEarningPercent = number_format(min($percentage, 100),2);
        }

        //All Time
        $this->allTimeEarning = Transaction::where('referrer_id',$this->userId)->sum('amount');
        $currentDateTime = Carbon::now();
        $earningsUpToCurrentTime = Transaction::where('created_at', '<=', $currentDateTime)->where('referrer_id',$this->userId)->where('payment_type','credit')->sum('amount');

        if($this->allTimeEarning != 0){
            $earningPercentage = ((float)$earningsUpToCurrentTime / (float)$this->allTimeEarning) * 100;
            $this->allTimeEarningPercent = number_format(min($earningPercentage,100),2);
        }
        // End Earning

        DB::statement("SET SQL_MODE=''");

        // Recent sales
        $this->recentSales = Transaction::where('referrer_id',$this->userId)->where('payment_type','credit')->whereDate('created_at', today())->get();


        // Start Commission
        $this->levelCommission = Transaction::where('payment_type','credit')->where('referrer_id',$this->userId)->sum('amount');
        $this->totalWithdrawal = Transaction::where('payment_type','debit')->where('referrer_id',$this->userId)->sum('amount');
        $this->availableBalance = (float)$this->levelCommission - (float)$this->totalWithdrawal;
        $this->netProfit = (float)$this->levelCommission - (float)$this->totalWithdrawal;
        // End Commission


        // Start Leaderboard
        // Weekly
        $this->weeklyTopRecords = Transaction::selectRaw('*, SUM(amount) as total_amount')
        ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
        ->where('payment_type','credit')
        // ->where('referrer_id',$this->userId)
        ->groupBy('referrer_id')
        ->orderByDesc('total_amount')
        ->limit(5)
        ->get();

        // Monthly
        $currentMonth = Carbon::now()->format('Y-m');
        $this->monthlyTopRecords = Transaction::selectRaw('*, SUM(amount) as total_amount')
        ->whereRaw("DATE_FORMAT(created_at, '%Y-%m') = ?", [$currentMonth])
        ->where('payment_type','credit')
        // ->where('referrer_id',$this->userId)
        ->groupBy('referrer_id')
        ->orderByDesc('total_amount')
        ->limit(5)
        ->get();

        // Yearly
        $yearStart = date('Y-04-01');
        $yearEnd = date('Y-03-31', strtotime('+1 year'));
        $this->yearlyTopRecords = Transaction::selectRaw('*, SUM(amount) as total_amount')
         ->whereBetween('created_at', [$yearStart, $yearEnd])
         ->where('payment_type','credit')
        //  ->where('referrer_id',$this->userId)
         ->groupBy('referrer_id')
         ->orderByDesc('total_amount')
         ->limit(5)
         ->get();

        // All Time
        $this->allTimeTopRecords = Transaction::selectRaw('*, SUM(amount) as total_amount')
        ->where('payment_type','credit')
        // ->where('referrer_id',$this->userId)
        ->groupBy('referrer_id')
        ->orderByDesc('total_amount')
        ->limit(5)
        ->get();

        // End Leaderboard

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
            ->where('referrer_id',$this->userId)
            ->groupBy('week_number')->pluck('total_amount')->toArray();
        //End income growth chart

    }

    public function render()
    {
        return view('livewire.user.index');
    }
}
