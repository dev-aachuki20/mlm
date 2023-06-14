<div class="content-wrapper">
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                @if($formMode)
    
                    @include('livewire.admin.course.form')

                @elseif($viewMode)

                    @livewire('admin.course.show', ['course_id' => $course_id])
                  
                @else
                    <div wire:loading wire:target="create" class="loader"></div>
                    <div class="card-title">
                        <h4 class="float-left">{{__('cruds.course.title_singular')}}</h4>

                        @can('course_create')
                        <button wire:click="create()" type="button" class="btn btn-sm btn-success btn-icon-text float-right">
                            <i class="ti-plus btn-icon-prepend"></i>                                                    
                                {{__('global.add')}}
                        </button>
                        @endcan

                    </div>                
                    <div class="table-responsive">
                        <div class="table-additional-plugin">
                            <input type="text" class="form-control col-2" wire:model="search" placeholder="{{ __('global.search')}}">
                        </div>
                        <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>{{ trans('global.sno') }}</th>
                                <th>{{ trans('cruds.course.fields.name') }}</th>
                                <th>{{ trans('global.status') }}</th>
                                <th>{{ ucwords(trans('global.created_at')) }}</th>
                                <th>{{ trans('global.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($allCourse->count() > 0)
                                @foreach($allCourse as $serialNo => $course)
                                    <tr>
                                        <td>{{ $serialNo+1 }}</td>
                                        <td>{{ $course->name }}</td>
                                        <td>
                                            <label class="toggle-switch">
                                                <input type="checkbox" class="toggleSwitch" wire:click="toggle({{$course->id}})" wire:click.prevent="confirmAlert('You want to change the status.','updateStatus',{{$course->id}})" {{ $course->status == 1 ? 'checked' : '' }}>
                                                <div class="switch-slider round"></div>
                                            </label>

                                        </td>
                                        <td>{{ convertDateTimeFormat($course->created_at,'datetime') }}</td>
                                        <td>

                                            @can('course_show')
                                            <button type="button" wire:click="show({{$course->id}})" class="btn btn-primary btn-rounded btn-icon">
                                                <i class="ti-eye"></i>
                                            </button>
                                            @endcan

                                            @can('course_edit')
                                            <button type="button" wire:click="edit({{$course->id}})" class="btn btn-info btn-rounded btn-icon">
                                                <i class="ti-pencil-alt"></i>
                                            </button>
                                            @endcan

                                            @can('course_delete')
                                            <button type="button" wire:click="delete({{$course->id}})" class="btn btn-danger btn-rounded btn-icon">
                                                <i class="ti-trash"></i>
                                            </button>
                                            @endcan
                                           
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
                    
                        {{ $allCourse->links('vendor.pagination.bootstrap-5') }}
                        
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