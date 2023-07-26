@if($viewInvoice)
    @livewire('admin.partials.invoice.view-invoice',['user_id' => $user_id])
@else
<div>
    <!-- Start Payment Overview -->
    <div class="card mb-4">
        <div class="card-header background-purple-color">
            <label class="font-weight-bold">Payment Overview</label>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4">
                    <label class="font-weight-bold">{{ __('cruds.user.payment.total_earning') }}</label> : 
                    <span class="p-2">&#8377; {{number_format($total_earning,2)}}</span>
                </div>
                <div class="col-sm-4">
                    <label class="font-weight-bold">{{ __('cruds.user.payment.total_remaning_earning') }}</label> : 
                    <span class="p-2">&#8377; {{number_format($total_remaning_earning,2)}}</span>
                </div>
                <div class="col-sm-4">
                    <label class="font-weight-bold">{{ __('cruds.user.payment.total_withdrawal') }}</label> : 
                    <span class="p-2">&#8377; {{number_format($total_withdrawal,2)}} </span>
                </div>
            </div>
        </div>
    </div>
    <!-- End Payment Overview -->



    <div class="card mb-4">
        <div class="card-header background-purple-color">
            <label class="font-weight-bold">Payment Transactions</label>
        </div>

        

        <div class="table-responsive p-3 my-team-details table-record">
        <div class="table-header-plugins">
                    <!-- Start show length -->
                    <div class="dataTables_length">
                            <label>Show 
                                <select wire:change="$emit('updatePaginationLength', $event.target.value)"> 
                                    @foreach(config('constants.datatable_paginations') as $length)
                                    <option value="{{ $length }}">{{ $length }}</option>
                                    @endforeach
                                </select> 
                            entries</label>
                    </div>
                    <!-- End show length -->
                    <!--Start search  -->
                    <div class="search-container">
                        <input type="text" class="form-control" id="searchInput" placeholder="{{ __('global.search')}}" wire:model="search" />
                        <span id="clearSearch" class="clear-icon" wire:click.prevent="clearSearch"><i class="fas fa-times"></i></span>
                    </div>

                    <!-- End Search -->
                    </div>
            <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>{{ trans('global.sno') }}</th>
                    <th>Payment ID</th>
                    <th>Method</th>
                    <th>Amount</th>
                    <th>Payment Type</th>
                    <th>{{ trans('global.created_at') }}
                        <span wire:click="sortBy('created_at')" class="float-right text-sm" style="cursor: pointer;">
                            <i class="fa fa-arrow-up {{ $sortColumnName === 'created_at' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                            <i class="fa fa-arrow-down {{ $sortColumnName === 'created_at' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                        </span>
                    </th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if($allPayments->count() > 0)
                @foreach($allPayments as $key=>$payment)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $payment->r_payment_id }}</td>
                    <td>{{ $payment->method }}</td>
                    <td><i class="fa-sharp fa-solid fa-indian-rupee-sign"></i> {{ number_format($payment->amount,2) }}</td>
                    <td>{{ $type }}</td>
                    <td>{{ convertDateTimeFormat($payment->created_at,'datetime') }}</td>
                    <td>
                        <button wire:click.prevent="showInvoice({{$payment->user_id}})"  type="button" class="btn btn-sm btn-primary btn-icon-text float-right">
                            View
                        </button>
                    </td>

                </tr>
                @endforeach
                @else
                    <tr>
                        <td class="text-center" colspan="6">{{ __('messages.no_record_found')}}</td>
                    </tr>
                @endif
            </tbody>
            </table>
        </div>

        {{ $allPayments->links('vendor.pagination.bootstrap-5') }}

    </div>
</div>

@endif
