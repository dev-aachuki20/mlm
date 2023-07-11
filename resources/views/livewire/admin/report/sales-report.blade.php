
<div class="content-wrapper">
    {{-- <div wire:loading wire:target="filterRecords" class="loader"></div> ---}}
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <p class="card-title mb-40">Sales Report</p>
                    
                    {{-- Start Filter --}}
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 mb-40">
                            <div class="card">
                            <div class="card-body pt-4 pb-4">
                                <p class="card-title mb-4">Filter</p>

                                <form class="form" wire:submit.prevent="filterRecords">            
                                <div class="form-outer">
                                    <div class="form-group row">                  
                                        <div class="col-md-4 col-sm-12">
                                            <div class="input-form">
                                                <div class="login-icon"><img src="{{ asset('images/icons/date.svg') }}"></div>
                                                <label for="from-date" class="form-label">From Date</label>
                                                <input id="from-date" type="text" class="form-control" placeholder="From Date" wire:model.defer="fromDate" autocomplete="off">
                                            </div>
                                            @error('fromDate') <span class="error text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <div class="input-form">
                                                <div class="login-icon"><img src="{{ asset('images/icons/date.svg') }}"></div>
                                                <label for="to-date" class="form-label">To Date</label>
                                                <input id="to-date" type="text" class="form-control" wire:model.defer="toDate" placeholder="To Date" autocomplete="off">
                                            </div>
                                            @error('toDate') <span class="error text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        {{-- <div class="col-md-4 col-sm-12">
                                            <div class="input-form">
                                                <label for="user-name" class="form-label">User Name</label>
                                                <input id="user-name" type="text" class="form-control p-24" wire:model.defer="userName" placeholder="User Name" autocomplete="off">
                                            </div>
                                            @error('userName') <span class="error text-danger">{{ $message }}</span> @enderror
                                        </div> --}}
                                        <div class="col-md-4 col-sm-12">
                                            <div class="input-form">
                                                <label for="package-name" class="form-label">Package Name</label>
                                                <input id="package-name" type="text" class="form-control p-24" wire:model.defer="packageName" placeholder="Package Name" autocomplete="off">
                                            </div>
                                            @error('packageName') <span class="error text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">  
                                        <div class="col-md-4 col-sm-12">
                                            <div class="input-form">
                                                <label for="referral-name" class="form-label">Referral Name</label>
                                                <input id="referral-name" type="text" class="form-control p-24" wire:model.defer="referralName" placeholder="Referral Name" autocomplete="off">
                                            </div>
                                            @error('referralName') <span class="error text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <div class="input-form">
                                                <label for="referral-code" class="form-label">Referral Code</label>
                                                <input id="referral-code" type="text" class="form-control p-24" wire:model.defer="referralCode" placeholder="Referral Code" autocomplete="off">
                                            </div>
                                            @error('referralCode') <span class="error text-danger">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="col-md-2 col-sm-12">
                                            <button type="submit" wire:loading.attr="disabled" wire:click.prevent="resetFilters" class="btn custom-btn btn-secondary mt-0">
                                                Reset
                                                <span wire:loading wire:target="resetFilters">
                                                    <i class="fa fa-solid fa-spinner fa-spin" aria-hidden="true"></i>
                                                </span>
                                            </button>
                                        </div>

                                        <div class="col-md-2 col-sm-12">
                                            <button type="submit" wire:loading.attr="disabled" class="btn custom-btn btn-primary mt-0">
                                            Submit
                                            <span wire:loading wire:target="filterRecords">
                                                <i class="fa fa-solid fa-spinner fa-spin" aria-hidden="true"></i>
                                            </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                </form>         
                                                 
                            </div>
                            </div>
                        </div>
                    </div>
                    {{-- End Filter --}}

                    {{-- Start Table --}}
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
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
                                    <input type="text" class="form-control" id="searchInput" placeholder="{{ __('global.search')}}" wire:model="search"/>
                                    <span id="clearSearch" class="clear-icon" wire:click.prevent="clearSearch"><i class="fas fa-times"></i></span>
                                </div>
                                <!-- End Search -->
                            </div>               
                            <div class="table-responsive mt-3 my-team-details table-record">
                                <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>{{ trans('global.sno') }}</th>
                                        {{-- <th>User Name</th> --}}
                                        <th>Package Name</th>
                                        <th>Referral Name</th>
                                        <th>Referral Code</th>
                                        <th>{{ trans('global.created_at') }}
                                            <span wire:click="sortBy('created_at')" class="float-right text-sm" style="cursor: pointer;">
                                                <i class="fa fa-arrow-up {{ $sortColumnName === 'created_at' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                                                <i class="fa fa-arrow-down {{ $sortColumnName === 'created_at' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                                            </span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($users->count() > 0)
                                        @foreach($users as $serialNo => $user)
                                        <tr>
                                            <td>{{ $serialNo+1 }}</td>
                                            {{-- <td>{{ ucwords($user->name) }}</td> --}}
                                            <td>{{ ucwords($user->packages()->first()->title) }}</td>
                                            <td>{{ ucwords($user->referral_name) }}</td>
                                            <td>{{ $user->referral_code }}</td>
                                            <td>{{ convertDateTimeFormat($user->created_at,'datetime') }}</td>
                                        </tr>
                                        @endforeach
                                    @else
                                    <tr>
                                        <td colspan="5">{{ __('messages.no_record_found')}}</td>
                                    </tr>
                                    @endif
                                
                                </tbody>
                                </table>
                            </div>
    
                            {{ $users->links('vendor.pagination.bootstrap-5') }}
                            
                        </div>
                    </div>
                    {{-- End Table --}}

                </div>
            </div>

        

        </div>
    </div>

</div>

@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endpush

@push('scripts')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script type="text/javascript">

$(document).ready(function(){
    var today = new Date();
    // Start From Date
    $('input[id="from-date"]').daterangepicker({
        // autoApply: true,
        autoUpdateInput: false,
        singleDatePicker: true,
        showDropdowns: true,
        locale: {
            format: 'DD-MM-YYYY',
            cancelLabel: 'Clear'
        },
        maxDate: today,
    });

    $('input[id="from-date"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD-MM-YYYY'));
        Livewire.emit('updatedFromDate', picker.startDate.format('YYYY-MM-DD'));
    });

    $('input[id="from-date"]').on('cancel.daterangepicker', function(ev, picker) {
        Livewire.emit('resetFromDate');
    });
    // End From Date

    // Start To Date
    
    $('input[id="to-date"]').daterangepicker({
        // autoApply: true,
        autoUpdateInput: false,
        singleDatePicker: true,
        showDropdowns: true,
        locale: {
            format: 'DD-MM-YYYY',
            cancelLabel: 'Clear'
        },
        maxDate: today,
    });

    $('input[id="to-date"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD-MM-YYYY'));
        Livewire.emit('updatedToDate', picker.startDate.format('YYYY-MM-DD'));
    });
    
    $('input[id="to-date"]').on('cancel.daterangepicker', function(ev, picker) {
        Livewire.emit('resetToDate');
    });
    // End To Date
    
});
  document.addEventListener('loadPlugins', function (event) {
 
    
  });
</script>

@endpush
