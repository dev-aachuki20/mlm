<div class="content-wrapper">
    @if($viewMode)
    @livewire('admin.user-manage.show', ['user_id' => $user_id])
    @else
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <div wire:loading wire:target="create" class="loader"></div>
                    <div class="card-title d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">{{__('cruds.user.title_singular')}} Management</h4>
                    </div>
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
                    <div class="table-responsive mt-3 my-team-details table-record">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>{{ trans('global.sno') }}</th>
                                    <th>{{ trans('cruds.user.fields.name') }}</th>
                                    <th>{{ trans('cruds.user.fields.referral_code') }}</th>
                                    <th>Package</th>
                                    <th>{{ trans('cruds.user.fields.sponser_id') }}</th>
                                    <th>{{ trans('cruds.user.fields.sponser_name') }}</th>
                                    <th>{{ trans('global.status') }}</th>
                                    <th>{{ trans('cruds.user.fields.joining_date') }}
                                        <span wire:click="sortBy('date_of_join')" class="float-right text-sm" style="cursor: pointer;">
                                            <i class="fa fa-arrow-up {{ $sortColumnName === 'date_of_join' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                                            <i class="fa fa-arrow-down {{ $sortColumnName === 'date_of_join' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
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
                                    <td>{{ ucwords($user->name) }}</td>
                                    <td>{{ $user->my_referral_code }}</td>
                                    <td>{{ucwords( $user->packages()->first()->title) }}</td>
                                    <td>{{ $user->referral_code }}</td>
                                    <td>{{ ucwords($user->referral_name) }}</td>
                                    <td>
                                    <label class="toggle-switch">
                                            <input type="checkbox" class="toggleSwitch" wire:click.prevent="toggle({{$user->id}})" {{ $user->is_active == 1 ? 'checked' : '' }}>
                                            <div class="switch-slider round"></div>
                                        </label>
                                    </td>
                                    <td>{{ convertDateTimeFormat($user->created_at,'date') }}</td>
                                    <td>
                                        <button type="button" wire:click.prevent="show({{$user->id}})" class="btn btn-primary btn-rounded btn-icon">
                                            <i class="ti-eye"></i>
                                        </button>

                                        {{-- @if($user->is_ceo || $user->is_management)
                                            <button type="button" wire:click.prevent="edit({{$user->id}})" class="btn btn-info btn-rounded btn-icon">
                                        <i class="ti-pencil-alt"></i>
                                        </button>
                                        @endif --}}

                                        <button type="button" wire:click.prevent="delete({{$user->id}})" class="btn btn-danger btn-rounded btn-icon">
                                            <i class="ti-trash"></i>
                                        </button>

                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td class="text-center" colspan="5">{{ __('messages.no_record_found')}}</td>
                                </tr>
                                @endif

                            </tbody>
                        </table>
                    </div>
                    {{ $allUser->links('vendor.pagination.bootstrap-5') }}

                </div>
            </div>
        </div>
    </div>
    @endif
</div>

@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link rel="stylesheet" href="{{ asset('admin/assets/select2/select2.min.css')}}">
<link rel="stylesheet" href="{{ asset('admin/assets/select2-bootstrap-theme/select2-bootstrap.min.css')}}">
{{-- <script type="text/javascript" src="{{ asset('admin/cities.js') }}"></script> --}}

@endpush

@push('scripts')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="{{ asset('admin/assets/select2/select2.min.js') }}"></script>

<script type="text/javascript">
    document.addEventListener('loadPlugins', function(event) {
        // print_state("state_id");

        if ($(".js-example-basic-single").length) {
            $(".js-example-basic-single").select2();
        }

        $(document).on('change', '#state_id', function() {
            var stateId = $(this).find('option:selected').attr('data-key');
            print_city('city_id', stateId);
        });

        var today = new Date();
        var minDate = new Date(today.getFullYear() - 18, today.getMonth(), today.getDate());

        var dateToSet = '{{ $dob ?? null}}';

        $('input[id="dob"]').daterangepicker({
                autoApply: true,
                singleDatePicker: true,
                showDropdowns: true,
                locale: {
                    format: 'DD-MM-YYYY'
                },
                maxDate: today,
            },
            function(start, end, label) {
                Livewire.emit('updatedDob', start.format('YYYY-MM-DD'));
            });


        $('input[id="nominee_dob"]').daterangepicker({
                autoApply: true,
                singleDatePicker: true,
                showDropdowns: true,
                locale: {
                    format: 'DD-MM-YYYY'
                },
                maxDate: today,
            },
            function(start, end, label) {
                Livewire.emit('updateNomineeDob', start.format('DD-MM-YYYY'));
            }
        );


    });
</script>
@endpush