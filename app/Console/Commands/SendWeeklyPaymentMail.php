<?php

namespace App\Console\Commands;

use Mail;
use App\Models\User;
use Carbon\Carbon;
use App\Mail\WeeklyPaymentMail;
use Illuminate\Console\Command;

class SendWeeklyPaymentMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendmail:weeklypayment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send mail of weekly payment of total earning for all users';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //Delete upload tmp folder of previous week
        removeUploadTmpFolderAndFile();

        $subject = 'Celebrate Your Success: Weekly Earnings Now Available!';

        $users = User::whereHas('roles', function ($query) {
            $query->whereIn('id', [3]);
        })->get();

        foreach ($users as $user) {
            $userName = ucwords(strtolower($user->name));

            //Start to get weekly earning
            $previousStartOfWeek = Carbon::now()->subWeek()->startOfWeek();
            $previousEndOfWeek = Carbon::now()->subWeek()->endOfWeek();

            $weeklyEarning = $user->transaction()->whereBetween('created_at', [$previousStartOfWeek, $previousEndOfWeek])->where('payment_type','credit')->sum('amount');
            //End to get weekly earning

            //Start to get total earning
            $totalEarning =  $user->transaction()->where('payment_type','credit')->sum('amount');
            //End to get total earning

            Mail::to($user->email)->queue(new WeeklyPaymentMail($subject, $userName, $weeklyEarning, $totalEarning));
        }

        return Command::SUCCESS;
    }
}
