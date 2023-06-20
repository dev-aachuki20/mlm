<div>
    <div class="table-responsive pt-4">
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
            <input type="text" class="form-control col-2" wire:model="search" placeholder="{{ __('global.search')}}">
            <!-- End Search -->
        </div>

        <table class="table table-hover">
        <thead>
            <tr>
                <th>{{ trans('global.sno') }}</th>
                <th>Payment ID</th>
                <th>Method</th>
                <th>Amount</th>
                <th>{{ trans('global.created_at') }}
                    <span wire:click="sortBy('created_at')" class="float-right text-sm" style="cursor: pointer;">
                        <i class="fa fa-arrow-up {{ $sortColumnName === 'created_at' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                        <i class="fa fa-arrow-down {{ $sortColumnName === 'created_at' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                    </span>
                </th>
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
                <td>{{ convertDateTimeFormat($payment->created_at,'datetime') }}</td>

            </tr>
            @endforeach
            @endif
        </tbody>
        </table>
    
        {{ $allPayments->links('vendor.pagination.bootstrap-5') }}
    </div>
</div>
