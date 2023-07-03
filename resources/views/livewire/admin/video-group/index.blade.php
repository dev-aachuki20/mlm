<div class="content-wrapper">

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    @if($formMode)
        
                        @include('livewire.admin.video-group.form')

                    @elseif($viewMode)

                        @livewire('admin.video-group.show', ['group_video_id' => $group_video_id])
                    
                    @else
                        <div wire:loading wire:target="create" class="loader"></div>
                        <div class="card-title d-flex justify-content-between align-items-center">
                            <div class="mb-0">
                                <h4>{{__('cruds.course.title_singular')}} Name :- {{ ucfirst($courseName) }}</h4>
                                <h6>Lecture List</h6>
                            </div>
                         
                            @can('course_create')
                            <button wire:click="create()" type="button" class="btn btn-sm btn-success btn-icon-text float-right">
                                <i class="fa-solid fa-plus"></i>                                                   
                                    {{__('global.add')}}
                            </button>
                            @endcan

                            <a  href="{{ route('admin.course') }}" class="btn btn-sm btn-primary btn-icon-text mr-1 float-right">
                                <i class="fa-solid fa-arrow-left "></i> Back
                            </a>

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
                                    <th>Title</th>
                                    <th>{{ trans('global.status') }}</th>
                                    <th>{{ ucwords(trans('global.created_at')) }}
                                        <span wire:click="sortBy('created_at')" class="float-right text-sm" style="cursor: pointer;">
                                            <i class="fa fa-arrow-up {{ $sortColumnName === 'created_at' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                                            <i class="fa fa-arrow-down {{ $sortColumnName === 'created_at' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                                        </span>
                                    </th>
                                    <th>{{ trans('global.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($allCourse->count() > 0)
                                    @foreach($allCourse as $serialNo => $course)
                                        <tr>
                                            <td>{{ $serialNo+1 }}</td>
                                            <td>{{ ucfirst($course->title) }}</td>
                                            <td>
                                                <label class="toggle-switch">
                                                    <input type="checkbox" class="toggleSwitch" wire:click.prevent="toggle({{$course->id}})" {{ $course->status == 1 ? 'checked' : '' }}>
                                                    <div class="switch-slider round"></div>
                                                </label>

                                            </td>
                                            <td>{{ convertDateTimeFormat($course->created_at,'datetime') }}</td>
                                            <td>

                                                @can('course_show')
                                                <button type="button" wire:click.prevent="show({{$course->id}})" class="btn btn-primary btn-rounded btn-icon">
                                                    <i class="ti-eye"></i>
                                                </button>
                                                @endcan

                                                @can('course_edit')
                                                <button type="button" wire:click.prevent="edit({{$course->id}})" class="btn btn-info btn-rounded btn-icon">
                                                    <i class="ti-pencil-alt"></i>
                                                </button>
                                                @endcan

                                                @can('course_delete')
                                                <button type="button" wire:click.prevent="delete({{$course->id}})" class="btn btn-danger btn-rounded btn-icon">
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
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script type="text/javascript">

    document.addEventListener('loadPlugins', function (event) {
      
        $('.dropify').dropify();
        $('.dropify-errors-container').remove();

        $('textarea#summernote').summernote({
            placeholder: 'Type somthing...',
            tabsize: 2,
            height: 200,
            fontNames: ['Arial', 'Helvetica', 'Times New Roman', 'Courier New','sans-serif'],
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['fontname', ['fontname']],
                // ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', /*'picture', 'video'*/]],
                ['view', ['codeview', /*'help'*/]],
            ],
            callbacks: {
                onChange: function(content) {
                    // Update the Livewire property when the Summernote content changes
                    @this.set('description', content);
                }
            }
        });
    });

</script>
@endpush