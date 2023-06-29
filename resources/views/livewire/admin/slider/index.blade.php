<div class="content-wrapper">
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                @if($formMode)
    
                    @include('livewire.admin.slider.form')

                @elseif($viewMode)

                    @livewire('admin.slider.show', ['slider_id' => $slider_id])

                @else
                    <div wire:loading wire:target="create" class="loader"></div>
                    <div class="card-title">
                        <h4 class="float-left">Sliders</h4>

                        @if($allSliders->count() <= (int)config('constants.slider_limit'))
                            <button wire:click="create()" type="button" class="btn btn-sm btn-success btn-icon-text float-right">
                                <i class="fa-solid fa-plus"></i>                                                   
                                    {{__('global.add')}}
                            </button>
                        @endif

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
                            <div class="search-container">
                                <input type="text" class="form-control" id="searchInput" placeholder="{{ __('global.search')}}" wire:model="search"/>
                                <span id="clearSearch" class="clear-icon" wire:click.prevent="clearSearch"><i class="fas fa-times"></i></span>
                            </div>
                            <!-- End Search -->
                        </div>

                        <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>{{ trans('global.sno') }}</th>
                                <th>{{ __('cruds.slider.fields.name')}}</th>
                                <th>{{ __('cruds.slider.fields.type')}}</th>
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
                            @if($allSliders->count() > 0)
                                @foreach($allSliders as $serialNo => $slider)

                                <tr>
                                        <td>{{ $serialNo+1 }}</td>
                                        <td>{{ ucfirst($slider->name) }}</td>
                                        <td>{{ ucfirst($slider->type) }}</td>
                                        <td>
                        
                                            <label class="toggle-switch">
                                                <input type="checkbox" class="toggleSwitch"  wire:click.prevent="toggle({{$slider->id}})" {{ $slider->status == 1 ? 'checked' : '' }}>
                                                <span class="switch-slider"></span>
                                            </label>

                                        </td>
                                        <td>{{ convertDateTimeFormat($slider->created_at,'datetime') }}</td>
                                        <td>
                                            <button type="button" wire:click.prevent="show({{$slider->id}})" class="btn btn-primary btn-rounded btn-icon">
                                                <i class="ti-eye"></i>
                                            </button>
                                            
                                            <button type="button" wire:click.prevent="edit({{$slider->id}})" class="btn btn-info btn-rounded btn-icon">
                                                <i class="ti-pencil-alt"></i>
                                            </button>

                                            <button type="button" wire:click.prevent="delete({{$slider->id}})" class="btn btn-danger btn-rounded btn-icon">
                                                <i class="ti-trash"></i>
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

                @endif

            </div>
        </div>
    </div>
</div>
</div>

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" />
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script type="text/javascript">
    document.addEventListener('loadPlugins', function (event) {
        $('.dropify').dropify();
        $('.dropify-errors-container').remove();
      
    });
</script>
@endpush