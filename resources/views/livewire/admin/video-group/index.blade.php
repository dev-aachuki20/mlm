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
                         
                            <div class="mb-0">
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
                                @if($allLectures->count() > 0)
                                    @foreach($allLectures as $serialNo => $lecture)
                                        <tr>
                                            <td>{{ $serialNo+1 }}</td>
                                            <td>{{ ucfirst($lecture->title) }}</td>
                                            <td>
                                                <label class="toggle-switch">
                                                    <input type="checkbox" class="toggleSwitch" wire:click.prevent="toggle({{$lecture->id}})" {{ $lecture->status == 1 ? 'checked' : '' }}>
                                                    <div class="switch-slider round"></div>
                                                </label>

                                            </td>
                                            <td>{{ convertDateTimeFormat($lecture->created_at,'datetime') }}</td>
                                            <td>

                                                @can('course_show')
                                                <button type="button" wire:click.prevent="show({{$lecture->id}})" class="btn btn-primary btn-rounded btn-icon">
                                                    <i class="ti-eye"></i>
                                                </button>
                                                @endcan

                                                @can('course_edit')
                                                <button type="button" wire:click.prevent="edit({{$lecture->id}})" class="btn btn-info btn-rounded btn-icon">
                                                    <i class="ti-pencil-alt"></i>
                                                </button>
                                                @endcan

                                                @can('course_delete')
                                                <button type="button" wire:click.prevent="delete({{$lecture->id}})" class="btn btn-danger btn-rounded btn-icon">
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
                        </div>
                        {{ $allLectures->links('vendor.pagination.bootstrap-5') }}

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
      
        // video js
        $(".box-video").click(function(){
            var videoId = $(this).find('.video-container video').attr('id');
            var video = document.getElementById(videoId);
            video.play();

            $('video source',this)[0].src;
            $(this).addClass('open');
        });
        
        $('.dropify').dropify();
        $('.dropify-errors-container').remove();
        $('.dropify-clear').click(function(e) {
            e.preventDefault();
            var elementName = $(this).siblings('input[type=file]').attr('id');
            if(elementName == 'dropify-image'){
               @this.set('image',null);
               @this.set('originalImage',null);
               @this.set('removeImage',true);

            }else if(elementName == 'dropify-video'){
                @this.set('video',null);
                @this.set('originalVideo',null);
                @this.set('videoExtenstion',null);
                @this.set('removeVideo',true);
            }
        });

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

        //   Start video duration get js
        var videoFileInput = document.getElementById('video-file');
        videoFileInput.addEventListener('change', function(event) {
            var file = event.target.files[0];
            
            var reader = new FileReader();
            
            reader.onload = function(event) {
                var video = document.createElement('video');
                video.addEventListener('loadedmetadata', function() {
                    var duration = video.duration; // Duration in seconds
                    // console.log('Video duration: ' + duration + ' seconds');
                    @this.emit('updateVideoDuration',formatTime(duration));
                    console.log('Upload Video Duration :- '+ formatTime(duration));
                });
                video.src = event.target.result;
            };
            
            reader.readAsDataURL(file);
        });

         // Function to format time in HH:MM:SS format
        function formatTime(timeInSeconds) {
            var hours = Math.floor(timeInSeconds / 3600);
            var minutes = Math.floor((timeInSeconds % 3600) / 60);
            var seconds = Math.floor(timeInSeconds % 60);
            
            return (
                (hours > 0 ? hours + ':' : '0'+ hours) + ':'+
                (minutes < 10 ? '0' + minutes : minutes) +
                ':' +
                (seconds < 10 ? '0' + seconds : seconds)
            );
        }
        //   End video duration get js

       

    });

</script>
@endpush