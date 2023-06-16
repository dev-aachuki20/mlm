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
                <th>{{ trans('cruds.user.fields.name')}}</th>
                <th>{{ trans('cruds.user.fields.email')}}</th>
                <th>{{ trans('cruds.user.fields.phone')}}</th>
                <th>{{ trans('cruds.user.fields.date_of_join')}}
                    <span wire:click="sortBy('date_of_join')" class="float-right text-sm" style="cursor: pointer;">
                        <i class="fa fa-arrow-up {{ $sortColumnName === 'date_of_join' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                        <i class="fa fa-arrow-down {{ $sortColumnName === 'date_of_join' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                    </span>
                </th>
                {{-- <th>{{ trans('global.status') }}</th> --}}
                {{-- <th>{{ trans('global.action') }}</th> --}}
            </tr>
        </thead>
        <tbody>
            @if($allTeam->count() > 0)
            @foreach($allTeam as $serialNo => $team)
                <tr>
                    <td>{{ $serialNo+1 }}</td>
                    <td>{{ ucfirst($team->name) }}</td>
                    <td>{{ $team->email }}</td>
                    <td>{{ $team->phone }}</td>
                    <td>{{ convertDateTimeFormat($team->date_of_join,'date') }}</td>
                    {{-- <td>
                        <button type="button"  class="btn btn-primary btn-rounded btn-icon">
                            <i class="ti-eye"></i>
                        </button>
                    </td> --}}
                </tr>
            @endforeach
            @else
                <tr>
                    <td colspan="5">{{ __('messages.no_record_found')}}</td>
                </tr>
            @endif
        
        </tbody>
        </table>
    
        {{-- {{ $allFaqs->links('vendor.pagination.bootstrap-5') }} --}}
    </div>
</div>
