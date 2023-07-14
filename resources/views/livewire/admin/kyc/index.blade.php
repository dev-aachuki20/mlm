<div class="content-wrapper">
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                @if($viewMode)

                    @livewire('admin.kyc.show', ['kyc_id' => $kyc_id])

                @else
                    <div wire:loading wire:target="create" class="loader"></div>
                    <div class="card-title d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Kyc</h4>
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
                                <th>User Name</th>
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
                            @if($allKycUsers->count() > 0)
                                @foreach($allKycUsers as $serialNo => $kyc)
                                    <tr>
                                        <td>{{ $serialNo+1 }}</td>
                                        <td>{{ ucfirst($kyc->user->name) }}</td>
                                        <td>
                                            <select class="form-control select-status" wire:change.prevent="toggle({{$kyc->id}},$event.target.value)">
                                                @foreach(config('constants.kyc_status') as $keyId=>$statusName)
                                                <option value="{{$keyId}}" {{$kyc->status == $keyId ? 'selected' : ''}}>{{ ucfirst($statusName) }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>{{ convertDateTimeFormat($kyc->created_at,'datetime') }}</td>
                                        <td>
                                            <button type="button" wire:click.prevent="show({{$kyc->id}})" class="btn btn-primary btn-rounded btn-icon">
                                                <i class="ti-eye"></i>
                                            </button>
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
                    </div>

                    {{ $allKycUsers->links('vendor.pagination.bootstrap-5') }}

                @endif

            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal show" id="kycCommentModal" tabindex="-1" role="dialog" aria-labelledby="kycCommentModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form wire:submit.prevent="submitStatusComment">
                <div class="modal-header">
                    <h5 class="modal-title" id="kycCommentModalLabel">{{ ucfirst(config('constants.kyc_status')[$status]) }} Comment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  <textarea class="form-control" wire:model.defer="status_comment" style="height:200px;"></textarea>
                  @error('status_comment') <span class="error text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="modal-footer">
                    <button wire:click.prevent="closedKycModal" class="btn btn-secondary">
                        {{ __('global.cancel')}}
                        <span wire:loading wire:target="closedKycModal">
                            <i class="fa fa-solid fa-spinner fa-spin" aria-hidden="true"></i>
                        </span>
                    </button>
                    <button type="submit" wire:loading.attr="disabled" class="btn btn-primary mr-2">
                        Save
                        <span wire:loading wire:target="submitStatusComment">
                            <i class="fa fa-solid fa-spinner fa-spin" aria-hidden="true"></i>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

</div>

@push('styles')
@endpush

@push('scripts')
<script type="text/javascript">
    document.addEventListener('openKycStatusModal',function(event){
        $('#kycCommentModal').modal('show');
    });

    document.addEventListener('closedKycStatusModal',function(event){
        $('#kycCommentModal').modal('hide');
    });

    document.addEventListener('loadPlugins', function (event) {
      
    });
</script>
@endpush