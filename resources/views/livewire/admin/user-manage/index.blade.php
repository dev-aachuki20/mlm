<div class="content-wrapper">
    @if($viewMode)
         @livewire('admin.user-manage.show', ['user_id' => $user_id])
    @else
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                
                    <div wire:loading wire:target="create" class="loader"></div>
                    <div class="card-title">
                        <h4 class="float-left">{{__('cruds.user.title_singular')}} Management</h4>
                    </div>                
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
                                <th>{{ trans('cruds.user.fields.name') }}</th>
                                {{--<th>{{ trans('global.status') }}</th>--}}
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
                            @if($allUser->count() > 0)
                                @foreach($allUser as $serialNo => $user)
                                    <tr>
                                        <td>{{ $serialNo+1 }}</td>
                                        <td>{{ ucfirst($user->name) }}</td>
                                        {{-- <td>
                        
                                            <label class="toggle-switch">
                                                <input type="checkbox" class="toggleSwitch" wire:click.prevent="toggle({{$user->id}})" {{ $user->is_active == 1 ? 'checked' : '' }}>
                                                <div class="switch-slider round"></div>
                                            </label>

                                        </td> --}}
                                        <td>{{ convertDateTimeFormat($user->created_at,'datetime') }}</td>
                                        <td>
                                            <button type="button" wire:click.prevent="show({{$user->id}})" class="btn btn-primary btn-rounded btn-icon">
                                                <i class="ti-eye"></i>
                                            </button>

                                            {{-- <button type="button" wire:click.prevent="edit({{$user->id}})" class="btn btn-info btn-rounded btn-icon">
                                                <i class="ti-pencil-alt"></i>
                                            </button> 

                                            <button type="button" wire:click.prevent="delete({{$user->id}})" class="btn btn-danger btn-rounded btn-icon">
                                                <i class="ti-trash"></i>
                                            </button>
                                            --}}
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                            <tr>
                                <td colspan="5">{{ __('messages.no_record_found')}}</td>
                            </tr>
                            @endif
                        
                        </tbody>
                        </table>
                    
                        {{ $allUser->links('vendor.pagination.bootstrap-5') }}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endif
</div>

@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endpush

@push('scripts')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script type="text/javascript">

 document.addEventListener('loadPlugins', function (event) {
    
    $('input[id="dob"],input[id="nominee_dob"]').daterangepicker({
        // autoApply: true,
        autoUpdateInput: false,
        singleDatePicker: true,
        showDropdowns: true,
        minYear: 1901,
      
        locale: {
            format: 'DD-MM-YYYY'
        },
    });
    $('input[id="dob"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD-MM-YYYY'));
        Livewire.emit('updateDob',picker.startDate.format('DD-MM-YYYY'));
    });

    $('input[id="nominee_dob"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD-MM-YYYY'));
        Livewire.emit('updateNomineeDob',picker.startDate.format('DD-MM-YYYY'));
    });

    var today = moment().format('DD-MM-YYYY');
    $('input[id="date_of_join"]').daterangepicker({
        // autoApply: true,
        autoUpdateInput: false,
        singleDatePicker: true,
        showDropdowns: true,
        minDate: today,
        locale: {
            format: 'DD-MM-YYYY'
        },
    });

    $('input[id="date_of_join"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD-MM-YYYY'));
        Livewire.emit('updateDateOfJoin',picker.startDate.format('DD-MM-YYYY'));
    });

});

</script>
@endpush