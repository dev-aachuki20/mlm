<?php

namespace App\Http\Livewire\Admin\UserManage;

use Gate;
use App\Models\User;
use App\Models\Package;
use App\Models\Transaction;
use Carbon\Carbon;
use App\Rules\ValidWithdrawalAmount;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Index extends Component
{
    use WithPagination, LivewireAlert;

    protected $layout = null;

    public $search = '', $formMode = false, $updateMode = false, $viewMode = false, $viewDetails = null;

    public $sortColumnName = 'created_at', $sortDirection = 'desc', $paginationLength = 10;

    public $user_id = null;

    public $allPackages;

    public $salesReportId, $fromDate, $toDate, $userName, $packageName, $referralName, $referralCode, $sponserName, $sponserCode;

    public $filterApply = false, $withdrawUserId,$withdrawUserName,$totalEarning = 0, $availableBalance = 0, $withdraw_amount=0, $payment_gateway, $withdraw_remark;

    protected $listeners = [
        'cancel', 'initializePlugins', 'updatePaginationLength', 'confirmedToggleAction', 'deleteConfirm', 'updatedFromDate', 'resetFromDate', 'updatedToDate', 'resetToDate','openWithdrawPanel','hideWithdrawPanel'
    ];

    public function mount()
    {
        $this->allPackages = Package::all();
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    }


    public function updatePaginationLength($length)
    {
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

    public function resetFilters()
    {
        $this->filterApply = false;
        $this->reset(['fromDate', 'toDate', 'packageName','sponserName', 'sponserCode']);
    }

    public function updatedFromDate($date)
    {
        $this->fromDate = Carbon::parse($date)->format('d-m-Y');
        $this->filterApply = false;
    }
    public function resetFromDate()
    {
        $this->reset(['fromDate']);
    }

    public function updatedToDate($date)
    {
        $this->toDate = Carbon::parse($date)->format('d-m-Y');
        $this->filterApply = false;
    }
    public function resetToDate()
    {
        $this->reset(['toDate']);
    }

    public function filterRecords()
    {
        $this->resetPage();
        if ($this->toDate) {
            if (is_null($this->fromDate)) {
                $this->addError('fromDate', 'From date field is required.');
                $this->reset(['toDate']);
            } else {
                $this->resetErrorBag(['fromDate']);
            }
        }

        if ($this->fromDate && $this->toDate) {
            $fDate = Carbon::parse($this->fromDate)->format('Y-m-d');
            $tDate = Carbon::parse($this->toDate)->format('Y-m-d');

            if ($fDate > $tDate) {
                $this->addError('toDate', 'To date should be greater than from date');
            } else {
                $this->resetErrorBag(['toDate']);
            }
        }

        $this->filterApply = true;
    }

    public function render()
    {

        $allUser = [];

        $allUser = User::query();

        // Start  filter
        if ($this->filterApply) {
            if ((!$this->fromDate && !$this->toDate && !$this->packageName && !$this->sponserName && !$this->sponserCode)) {
                $allUser->get();
            }

            if (($this->fromDate && $this->toDate)) {
                $allUser->whereBetween('date_of_join', [Carbon::parse($this->fromDate)->startOfDay(), Carbon::parse($this->toDate)->endOfDay()]);
            }
            if ($this->packageName) {
                $allUser->whereRelation('packages', 'title', 'like', $this->packageName);
            }
            if ($this->sponserName) {
                $allUser->where('referral_name', $this->sponserName);
            }
            if ($this->sponserCode) {
                $allUser->where('referral_code', $this->sponserCode);
            }
        }
        // End  filter


        $statusSearch = null;
        $searchValue = $this->search;
        if (Str::contains('active', strtolower($searchValue))) {
            $statusSearch = 1;
        } else if (Str::contains('inactive', strtolower($searchValue))) {
            $statusSearch = 0;
        }


        if ($searchValue) {
            $allUser->where(function ($query) use ($searchValue, $statusSearch) {
                $query->where('my_referral_code', 'like', '%' . $searchValue . '%')
                    ->orWhere('referral_code', 'like', '%' . $searchValue . '%')
                    ->orWhere('name', 'like', '%' . $searchValue . '%')
                    ->orWhere('referral_name', 'like', '%' . $searchValue . '%')
                    ->orWhere('is_active', $statusSearch)
                    ->orWhereRelation('packages', 'title', 'like', '%' . $searchValue . '%')
                    ->orWhereRaw("date_format(date_of_join, '" . config('constants.search_date_format') . "') like ?", '%' . $searchValue . '%');
            });
        }

        if ($allUser) {
            $allUser = $allUser->whereHas('roles', function ($query) {
                $query->whereIn('id', [3]);
            })
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationLength);
        }


        // autoload

        if($this->filterApply == false){
            $allUser = User::query()->where(function ($query) use ($searchValue, $statusSearch) {
                $query->where('my_referral_code', 'like', '%' . $searchValue . '%')
                    ->orWhere('referral_code', 'like', '%' . $searchValue . '%')
                    ->orWhere('name', 'like', '%' . $searchValue . '%')
                    ->orWhere('referral_name', 'like', '%' . $searchValue . '%')
                    ->orWhere('is_active', $statusSearch)
                    ->orWhereRelation('packages', 'title', 'like', '%' . $searchValue . '%')
                    ->orWhereRaw("date_format(date_of_join, '" . config('constants.search_date_format') . "') like ?", ['%' . $searchValue . '%']);
            })
                ->whereHas('roles', function ($query) {
                    $query->whereIn('id', [3]);
                })
                ->orderBy($this->sortColumnName, $this->sortDirection)
                ->paginate($this->paginationLength);
        }

        return view('livewire.admin.user-manage.index', compact('allUser'));
    }


    public function delete($id)
    {
        $this->confirm('Are you sure?', [
            'text' => 'You want to delete it.',
            'toast' => false,
            'position' => 'center',
            'confirmButtonText' => 'Yes, delete it!',
            'cancelButtonText' => 'No, cancel!',
            'onConfirmed' => 'deleteConfirm',
            'onCancelled' => function () {
                // Do nothing or perform any desired action
            },
            'inputAttributes' => ['deleteId' => $id],
        ]);
    }

    public function deleteConfirm($event)
    {
        $deleteId = $event['data']['inputAttributes']['deleteId'];
        $model = User::find($deleteId);
        $model->delete();
        $this->alert('success', trans('messages.delete_success_message'));
    }

    public function show($id)
    {
        $this->resetPage('page');
        $this->user_id = $id;
        $this->formMode = false;
        $this->viewMode = true;
    }

    public function cancel()
    {
        $this->formMode = false;
        $this->updateMode = false;
        $this->viewMode = false;
    }

    public function toggle($id)
    {
        $this->confirm('Are you sure?', [
            'text' => 'You want to change the status.',
            'toast' => false,
            'position' => 'center',
            'confirmButtonText' => 'Yes, change it!',
            'cancelButtonText' => 'No, cancel!',
            'onConfirmed' => 'confirmedToggleAction',
            'onCancelled' => function () {
                // Do nothing or perform any desired action
            },
            'inputAttributes' => ['userId' => $id],
        ]);
    }

    public function confirmedToggleAction($event)
    {
        $userId = $event['data']['inputAttributes']['userId'];
        $model = User::find($userId);
        $model->update(['is_active' => !$model->is_active]);
        $this->alert('success', trans('messages.change_status_success_message'));
    }

    public function changeStatus($statusVal)
    {
        $this->status = (!$statusVal) ? 1 : 0;
    }

    public function initializePlugins()
    {
        $this->dispatchBrowserEvent('loadPlugins');
    }

    public function openWithdrawPanel($userId){

        $this->withdrawUserId = $userId;
        $this->withdrawUserName = User::where('id',$userId)->value('name');

        $creditBalance = Transaction::where('referrer_id', $userId)->where('payment_type','credit')->sum('amount');
        $debitBalance = Transaction::where('referrer_id', $userId)->where('payment_type','debit')->sum('amount');

        $this->totalEarning = $creditBalance;

        $this->availableBalance = (float)$creditBalance - (float)$debitBalance;

        $this->dispatchBrowserEvent('openWithdrawModal');
    }

    public function WithdrawAmount(){
        $this->resetValidation();

        $this->validate([
            'withdraw_amount'=> ['required','numeric','not_in:-,0', new ValidWithdrawalAmount($this->availableBalance)],
            'payment_gateway'=> 'required|in:razorpay,cod',
            'withdraw_remark'=> 'required|string',
        ],[],[
            'withdraw_amount'=>'amount',
            'withdraw_remark'=>'remark',
        ]);

        DB::beginTransaction();
        try{

            $gateway = $this->payment_gateway == 'cod' ? 2 : 1;

            $transactionRecord = [
                'user_id' => $this->withdrawUserId,
                'payment_id' => null,
                'payment_type' => 'debit',
                'type' => null,
                'gateway' => $gateway,
                'amount' => $this->withdraw_amount,
                'remark' => $this->withdraw_remark,
                'referrer_id' => null,
            ];

            Transaction::create($transactionRecord);

            DB::commit();

            $this->hideWithdrawPanel();

            $this->alert('success', 'Withdrawal Successfully!');

        }catch (\Exception $e) {
            DB::rollBack();
            // dd($e->getMessage().'->'.$e->getLine());
            $this->alert('error',trans('messages.error_message'));
        }

    }

    public function hideWithdrawPanel(){
        $this->resetValidation();
        $this->reset(['withdrawUserId','withdrawUserName','totalEarning','availableBalance','withdraw_amount','payment_gateway','withdraw_remark']);
        $this->dispatchBrowserEvent('hideWithdrawModal');
    }
}
