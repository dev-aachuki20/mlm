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
                <th>Transaction Id</th>
                <th>Amount</th>
                <th>{{ trans('global.status') }}</th>
                <th>{{ trans('global.created_at') }}
                    <span wire:click="sortBy('created_at')" class="float-right text-sm" style="cursor: pointer;">
                        <i class="fa fa-arrow-up {{ $sortColumnName === 'created_at' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                        <i class="fa fa-arrow-down {{ $sortColumnName === 'created_at' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                    </span>
                </th>
                <th>{{ trans('global.action') }}</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>DFEFE45</td>
                <td><i class="fa-sharp fa-solid fa-indian-rupee-sign"></i> 100.00</td>
                <td><label class="badge badge-success">Success</label></td>
                <td>16-06-2023 11:00</td>
                <td>
                    <button type="button"  class="btn btn-primary btn-rounded btn-icon">
                        <i class="ti-eye"></i>
                    </button>
                </td>
            </tr>

           
            {{-- <tr>
                <td colspan="5">{{ __('messages.no_record_found')}}</td>
            </tr>
             --}}
        
        </tbody>
        </table>
    
        {{-- {{ $allFaqs->links('vendor.pagination.bootstrap-5') }} --}}
    </div>
</div>
