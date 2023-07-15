<?php

namespace App\Http\Livewire\Admin\Report;

use Gate;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Symfony\Component\HttpFoundation\Response;

class SalesReport extends Component
{
    use WithPagination, LivewireAlert;

    protected $layout = null;

    public $search = '', $formMode = false , $updateMode = false, $viewMode = false ,$originalImage;

    public $sortColumnName = 'created_at', $sortDirection = 'desc', $paginationLength = 10;

    public $salesReportId, $fromDate , $toDate, $userName, $packageName, $referralName, $referralCode;

    public $filterApply = false;

    protected $listeners = [
        'updatePaginationLength','cancel','updatedFromDate','resetFromDate','updatedToDate','resetToDate'
    ];

    public function mount(){
        abort_if(Gate::denies('sales_report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
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


    public function updatedFromDate($date){
        $this->fromDate = Carbon::parse($date)->format('d-m-Y');
        $this->filterApply = false;
    }
    public function resetFromDate(){
        $this->reset(['fromDate']);
    }

    public function updatedToDate($date){
        $this->toDate = Carbon::parse($date)->format('d-m-Y');
        $this->filterApply = false;
    }
    public function resetToDate(){
        $this->reset(['toDate']);
    }

    public function filterRecords(){
       $this->resetPage();
       if($this->toDate){
            if(is_null($this->fromDate)){
                $this->addError('fromDate','From date field is required.');
                $this->reset(['toDate']);
            }else{
                $this->resetErrorBag(['fromDate']);
            }
       }

       if($this->fromDate && $this->toDate){
            $fDate = Carbon::parse($this->fromDate)->format('Y-m-d');
            $tDate = Carbon::parse($this->toDate)->format('Y-m-d');

            if($fDate > $tDate ){
                $this->addError('toDate','To date should be greater than from date');
            }else{
                $this->resetErrorBag(['toDate']);
            }
       }

       $this->filterApply = true;
    }

    public function resetFilters(){
        $this->filterApply = false;
        $this->reset(['fromDate','toDate','userName','packageName','referralName','referralCode']);
    }

    public function render()
    {
        $users = null;
        // Start custom filter
        if($this->filterApply){

            $users = User::query();

            if(($this->fromDate && $this->toDate)){
                $users->whereBetween('created_at',[Carbon::parse($this->fromDate)->startOfDay(),Carbon::parse($this->toDate)->endOfDay()]);
            }
            // if($this->userName){
            //     $users->where('name',$this->userName);
            // }
            if($this->packageName){
                $users->whereRelation('packages', 'title','like', $this->packageName);
            
            }
            if($this->referralName){
                $users->where('referral_name',$this->referralName);
            }
            if($this->referralCode){
                $users->where('referral_code',$this->referralCode);
            }
        }
        // End custom filter

        $this->search = str_replace(',', '', $this->search);
        $searchValue = $this->search;
        if($searchValue){
            $users->where(function ($query) use($searchValue) {
                $query->whereRelation('packages', 'title','like', '%'.$searchValue.'%')
                ->orWhere('name','like', '%'.$searchValue.'%')
                ->orWhere('referral_name','like', '%'.$searchValue.'%')
                ->orWhere('referral_code','like', '%'.$searchValue.'%')
                ->orWhereRaw("date_format(created_at, '".config('constants.search_datetime_format')."') like ?", ['%'.$searchValue.'%']);
            });
        }

        if($users){
            $users = $users->whereRelation('roles','id','=',3)
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationLength);
        }

        return view('livewire.admin.report.sales-report',compact('users'));
    }

    public function show($id){
        $this->resetPage();
        $this->salesReportId = $id;
        $this->formMode = false;
        $this->viewMode = true;
    }

    public function cancel(){
        $this->formMode = false;
        $this->updateMode = false;
        $this->viewMode = false;
    }

    public function initializePlugins(){
        $this->dispatchBrowserEvent('loadPlugins');
    }
}
