<?php

namespace App\Http\Livewire\Admin\Partials;

use Mail;
use Gate;
use App\Models\User;
use App\Models\Payment;
use App\Models\Transaction;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Symfony\Component\HttpFoundation\Response;
use App\Mail\SendRefferalLevelOneCommissionMail;
use App\Mail\SendRefferalLevelTwoCommissionMail;

class PaymentList extends Component
{
    use WithPagination, LivewireAlert;

    protected $layout = null;

    public $total_earning = 0, $total_withdrawal = 0, $total_remaning_earning = 0;

    public $search = '', $formMode = false , $updateMode = false, $viewMode = false, $viewInvoice = false;
    public $sortColumnName = 'created_at', $sortDirection = 'desc', $paginationLength = 10;

    public $payments;
    public $user_id = null, $payment_id =null, $paymentDetail=null, $payment_approval = 'pending';

    protected $listeners = [
        'updatePaginationLength','setPaymentApproval'
    ];

    public function mount($user_id=''){
        abort_if(Gate::denies('transactions_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $this->user_id = $user_id;
        $this->userDetail = User::find($user_id);

        $this->total_earning = Transaction::where('referrer_id', $user_id)->where('payment_type', 'credit')->pluck('amount')->sum();

        $this->total_withdrawal = Transaction::where('user_id', $user_id)->where('payment_type', 'debit')->pluck('amount')->sum();

        $this->total_remaning_earning = (float)$this->total_earning -  (float)$this->total_withdrawal;
    }

    public function updatePaginationLength($length){
        $this->paginationLength = $length;
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function clearSearch()
    {
        $this->search = '';
    }

    public function sortBy($columnName)
    {
        $this->resetPage();

        if ($this->sortColumnName === $columnName) {
            $this->sortDirection = $this->swapSortDirection();
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortColumnName = $columnName;
    }

    public function swapSortDirection()
    {
        return $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }

    public function cancel(){
        $this->emitUp('cancel');
    }

    public function setPaymentApproval($status){
        $this->payment_approval = $status;
    }

    public function submitPaymentApproval(){
        $validatedData = $this->validate([
            'payment_approval'=>'required|in:pending,approved,rejected',
        ]);

        DB::beginTransaction();
        try {
            $isUpdated = Payment::where('id',$this->payment_id)->update($validatedData);
            if($isUpdated){
                $findUser = User::find($this->user_id);

                if($this->payment_approval == 'approved'){

                    $refferalByUser = User::find($findUser->referral_user_id);

                    $packagePurchased = $findUser->packages()->first();

                    foreach (config('constants.referral_levels') as $levelKey => $level) {
                        $transactionRecords = [];
                        $commissionAmount = null;
                        $referralUserId = null;

                        if ($levelKey == 1 && $refferalByUser) {

                            $commissionAmount   = $packagePurchased->level_one_commission;
                            $referralUserId     = $refferalByUser->is_user ? $refferalByUser->id : null;

                        } elseif ($levelKey == 2 && $refferalByUser->referrer) {

                            $commissionAmount   = $packagePurchased->level_two_commission;
                            $referralUserId     = $refferalByUser->referrer->is_user ? $refferalByUser->referrer->id : null;

                        } elseif ($levelKey == 3 && $refferalByUser->referrer) {

                            if($refferalByUser->referrer->referrer){
                                $commissionAmount   = $packagePurchased->level_three_commission;
                                $referralUserId     = $refferalByUser->referrer->referrer->is_user ? $refferalByUser->referrer->referrer->id : null;
                            }

                        }

                        if ($commissionAmount && $referralUserId) {
                            $transactionRecords['user_id']         = $findUser->id;
                            $transactionRecords['payment_id']      = $this->payment_id;
                            $transactionRecords['payment_type']    = 'credit';
                            $transactionRecords['type']            = $levelKey;
                            $transactionRecords['gateway']         = 2;
                            $transactionRecords['amount']          = $commissionAmount;
                            $transactionRecords['referrer_id']     = $referralUserId;

                            $transactionCreated = Transaction::create($transactionRecords);
                        }
                    }

                     // Send mail to reffrals
                     $LevelOnereffraluser= $findUser->referrer->id ?? null;
                     if($LevelOnereffraluser){
                        $planName = $packagePurchased->title;

                         $LOnecommissionAmount   = $packagePurchased->level_one_commission;
                         $levelOneuser = User::where('id',$LevelOnereffraluser)->first();
                         $subject = "Passive Income";
                         Mail::to($levelOneuser->email)->queue(new SendRefferalLevelOneCommissionMail($subject,$levelOneuser->name,$findUser->name,$findUser->email,$findUser->phone,$planName,$LOnecommissionAmount));

                         $LevelTworeffraluser= $findUser->referrer->referrer->id ?? null;
                         if($LevelTworeffraluser){
                             $LTwocommissionAmount   = $packagePurchased->level_two_commission;
                             $levelTwouser = User::where('id',$LevelTworeffraluser)->first();
                             $subject = "Active Income";
                             Mail::to($levelTwouser->email)->queue(new SendRefferalLevelTwoCommissionMail($subject,$levelTwouser->name,$findUser->name,$findUser->email,$findUser->phone,$planName,$LTwocommissionAmount));
                         }
                     }

                }elseif($this->payment_approval == 'rejected'){
                    $findUser->delete();
                }
            }

            DB::commit();
            $this->hideReceipt();
            $this->alert('success', trans('messages.change_status_success_message'));
        }catch (\Exception $e) {
            DB::rollBack();

            dd($e->getMessage() . '->' . $e->getLine());

            $this->alert('error', trans('messages.error_message'));
        }
    }

    public function showReceipt($paymentId){
        $this->payment_id = $paymentId;
        $this->paymentDetail = Payment::find($this->payment_id);
        $this->dispatchBrowserEvent('paymentRecieptOpenModal');
    }

    public function hideReceipt(){
        $this->payment_id = null;
        $this->paymentDetail =null;
        $this->dispatchBrowserEvent('paymentRecieptClosedModal');
    }

    public function render()
    {
        $this->search = str_replace(',', '', $this->search);

        // $statusSearch = null;
        // $searchValue = $this->search;
        // if(Str::contains('active', strtolower($searchValue))){
        //     $statusSearch = 1;
        // }else if(Str::contains('inactive', strtolower($searchValue))){
        //     $statusSearch = 0;
        // }

        $searchValue = $this->search;

        $allPayments = $this->userDetail->payments()->where(function ($query) use($searchValue) {
            $query->where('r_payment_id', 'like', $searchValue.'%')
            ->orWhere('amount', 'like', '%'.$searchValue.'%')
            ->orWhere('method', 'like', '%'.$searchValue.'%')
            ->orWhereRaw("date_format(created_at, '".config('constants.search_datetime_format')."') like ?", ['%'.$searchValue.'%']);
        })->orderBy($this->sortColumnName, $this->sortDirection)
        ->paginate($this->paginationLength);

        return view('livewire.admin.partials.payment-list',compact('allPayments'));
    }

    public function cancelbutton(){
        $this->viewMode = true;
        $this->viewInvoice = false;
        $this->emitSelf('cancel');
    }

    public function showInvoice($id)
    {
        $this->viewMode = false;
        $this->user_id = $id;
        $this->viewInvoice = true;
    }
}
