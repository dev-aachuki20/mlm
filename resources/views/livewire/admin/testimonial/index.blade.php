<div class="content-wrapper">
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                @if($formMode)
    
                    @include('livewire.admin.testimonial.form')

                @else
                    <div wire:loading wire:target="create" class="loader"></div>
                    <div class="card-title">
                        <h4 class="float-left">{{__('cruds.testimonial.title_singular')}}</h4>
                        <button wire:click="create()" type="button" class="btn btn-sm btn-success btn-icon-text float-right">
                            <i class="ti-plus btn-icon-prepend"></i>                                                    
                                {{__('global.add')}}
                        </button>
                    </div>                
                    <div class="table-responsive">
                    
                        <table class="table table-hover">
                        <thead>
                            <tr>
                            <th>{{ trans('global.sno') }}</th>
                            <th>{{ trans('cruds.testimonial.fields.name') }}</th>
                            <th>{{ trans('global.status') }}</th>
                            <th>{{ trans('global.created_at') }}</th>
                            <th>{{ trans('global.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($allTestimonials->count() > 0)
                                @foreach($allTestimonials as $serialNo => $testimonial)
                                    <tr>
                                        <td>{{ $serialNo+1 }}</td>
                                        <td>{{ ucfirst($testimonial->name) }}</td>
                                        <td>
                        
                                            <label class="toggle-switch">
                                                <input type="checkbox" class="toggleSwitch"  wire:click="toggle({{$testimonial->id}})" {{ $testimonial->status == 1 ? 'checked' : '' }}>
                                                <span class="switch-slider"></span>
                                            </label>

                                        </td>
                                        <td>{{ convertDateTimeFormat($testimonial->created_at,'datetime') }}</td>
                                        <td>
                                            <button type="button" wire:click="edit({{$testimonial->id}})" class="btn btn-info btn-rounded btn-icon">
                                                <i class="ti-pencil-alt"></i>
                                            </button>

                                            <button type="button" wire:click="delete({{$testimonial->id}})" class="btn btn-danger btn-rounded btn-icon">
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