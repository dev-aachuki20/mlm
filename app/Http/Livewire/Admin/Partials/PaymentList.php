<?php

namespace App\Http\Livewire\Admin\Partials;

use Gate;
use App\Models\User;
use App\Models\Payment;
use App\Models\Transaction;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Symfony\Component\HttpFoundation\Response;

class PaymentList extends Component
{
    use WithPagination, LivewireAlert;

    protected $layout = null;
    
    public $total_earning = 0, $total_withdrawal = 0, $total_remaning_earning = 0;
    public $payment_type, $type;

    public $search = '', $formMode = false , $updateMode = false, $viewMode = false, $viewInvoice = false;
    public $sortColumnName = 'created_at', $sortDirection = 'desc', $paginationLength = 10;

    public $payments;
    public $user_id = null;

    protected $listeners = [
        'updatePaginationLength'
    ];

    public function mount($user_id=''){
        abort_if(Gate::denies('transactions_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $this->user_id = $user_id;
        $this->userDetail = User::find($user_id);

        $this->total_earning = Transaction::where('user_id', $user_id)->where('payment_type', 'credit')->pluck('amount')->sum();
        
        $this->total_withdrawal = Transaction::where('user_id', $user_id)->where('payment_type', 'debit')->pluck('amount')->sum();

        $this->total_remaning_earning = $this->total_earning -  $this->total_withdrawal;

        $this->payment_type  = Payment::where('user_id', $user_id)->first();
        // $this->type =json_decode($this->payment_type->json_response)->card->type;
         $this->type = isset(json_decode($this->payment_type->json_response)->card->type) ? json_decode($this->payment_type->json_response)->card->type : null;
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
