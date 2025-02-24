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
                    <div class="card-title d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">{{__('cruds.course.title')}}</h4>

                        @can('course_create')
                        <button wire:click="create()" type="button" class="btn btn-sm btn-success btn-icon-text float-right">
                            <i class="fa-solid fa-plus"></i>
                            {{__('global.add')}}
                        </button>
                        @endcan

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
                                    <th>{{ trans('cruds.course.fields.name') }}</th>
                                    <th>Package name</th>
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
                                    <td>{{ $course->name ? ucwords($course->name) : '' }}</td>
                                    <td>
                                        @foreach($course->packages as $selected_package)
                                            <span class="badge bg-secondary text-white">{{ ucwords($selected_package->title) }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <label class="toggle-switch">
                                            <input type="checkbox" class="toggleSwitch" wire:click.prevent="toggle({{$course->id}})" {{ $course->status == 1 ? 'checked' : '' }}>
                                            <div class="switch-slider round"></div>
                                        </label>

                                    </td>
                                    <td>{{ convertDateTimeFormat($course->created_at,'date') }}</td>
                                    <td>

                                        @can('course_show')
                                        <button title="View" type="button" wire:click.prevent="show({{$course->id}})" class="btn btn-primary btn-rounded btn-icon">
                                            <i class="ti-eye"></i>
                                        </button>
                                        @endcan

                                        @can('course_edit')
                                        <button title="Edit" type="button" wire:click.prevent="edit({{$course->id}})" class="btn btn-info btn-rounded btn-icon">
                                            <i class="ti-pencil-alt"></i>
                                        </button>
                                        @endcan

                                        @can('course_delete')
                                        <button title="Delete" type="button" wire:click.prevent="delete({{$course->id}})" class="btn btn-danger btn-rounded btn-icon">
                                            <i class="ti-trash"></i>
                                        </button>
                                        @endcan

                                        <a title="Lecture List" href="{{route('admin.getAllVideos',$course->id)}}" class="btn btn-warning btn-rounded btn-icon list-all-btn">
                                            <i class="ti-list"></i>
                                        </a>

                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td class="text-center" colspan="6">{{ __('messages.no_record_found')}}</td>
                                </tr>
                                @endif

                            </tbody>
                        </table>

                    </div>

                    {{ $allCourse->links('vendor.pagination.bootstrap-5') }}

                    @endif

                </div>
            </div>
        </div>
    </div>

</div>

@push('styles')
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" /> --}}
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('admin/assets/select2/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/assets/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/css/vertical-layout-light/style.css') }}">
@endpush

@push('scripts')
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="{{ asset('admin/assets/select2/select2.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/resumable.js/1.1.0/resumable.min.js"></script>

<script type="text/javascript">
    document.addEventListener('loadPlugins', function(event) {

        // video js
        $(".box-video").click(function() {
            var videoId = $(this).find('.video-container video').attr('id');
            var video = document.getElementById(videoId);
            video.play();

            $('video source', this)[0].src;
            $(this).addClass('open');
        });

        if ($(".js-example-basic-single").length) {
            $(".js-example-basic-single").select2({
                placeholder: 'Select Package',
            });
        }

        $(document).on('change', '.select-package', function() {
            var selectPackage = $(this).val();
            @this.set('selectedPackages', selectPackage);
        });


        $('textarea#summernote').summernote({
            placeholder: 'Type somthing...',
            tabsize: 2,
            height: 200,
            fontNames: ['Arial', 'Helvetica', 'Times New Roman', 'Courier New', 'sans-serif'],
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['fontname', ['fontname']],
                // ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', [/*'link', 'picture', 'video'*/ ]],
                ['view', ['codeview', /*'help'*/ ]],
            ],
            callbacks: {
                onChange: function(content) {
                    // Update the Livewire property when the Summernote content changes
                    @this.set('description', content);
                }
            }
        });


        //Start Upload Video file
        let browseVideoFile = $("#browseVideoFile");
        let resumableVideo = new Resumable({
            target: "{{ route('upload-file') }}",
            query: {_token: '{{ csrf_token() }}'},
            fileType: ['webm', 'mp4', 'wmv','flv','mov'],
            chunkSize: 2 * 1024 * 1024, // default is 1*1024*1024, this should be less than your maximum limit in php.ini
            headers: {
                'Accept': 'application/json'
            },
            testChunks: false,
            throttleProgressCallbacks: 1,
        });

        if (browseVideoFile && browseVideoFile.length > 0) {
            resumableVideo.assignBrowse(browseVideoFile[0]);
        }

        resumableVideo.on('fileAdded', function (file) { // trigger when file picked
            browseVideoFile.attr('disabled',true);

            $('.submit-btn').attr('disabled',true);

            showProgress('.progress-video','#progress-bar-video');
            resumableVideo.upload() // to actually start uploading.
        });

        resumableVideo.on('fileProgress', function (file) { // trigger when file progress update
            updateProgress('.progress-video','#progress-bar-video',Math.floor(file.progress() * 100));
        });

        resumableVideo.on('fileSuccess', function (file, response) { // trigger when file upload complete
            response = JSON.parse(response)

            browseVideoFile.attr('disabled',false);
            $('.submit-btn').attr('disabled',false);

            if (response.mime_type.includes("video")) {
                var videoPath = response.path + '/' + response.name;

                @this.set('video',response.name);
                @this.set('originalVideo',videoPath);

                $('#videoPreview').attr('src', videoPath).show();
            }

            $('.card-footer').show();
        });

        resumableVideo.on('fileError', function (file, response) { // trigger when there is any error
            alert('file uploading error.')
        });
        //End upload video file

        //Start Upload Image file
        let browseImageFile = $("#browseImageFile");
        let resumableImage = new Resumable({
            target: "{{ route('upload-file') }}",
            query: {_token: '{{ csrf_token() }}'},
            fileType: ['jpg', 'png', 'jpeg','svg'],
            chunkSize: 2 * 1024 * 1024, // default is 1*1024*1024, this should be less than your maximum limit in php.ini
            headers: {
                'Accept': 'application/json'
            },
            testChunks: false,
            throttleProgressCallbacks: 1,
        });

        resumableImage.assignBrowse(browseImageFile[0]);

        resumableImage.on('fileAdded', function (file) { // trigger when file picked
            browseImageFile.attr('disabled',true);
            $('.submit-btn').attr('disabled',true);

            showProgress('.progress-image','#progress-bar-image');
            resumableImage.upload() // to actually start uploading.
        });

        resumableImage.on('fileProgress', function (file) { // trigger when file progress update
            updateProgress('.progress-image','#progress-bar-image',Math.floor(file.progress() * 100));
        });

        resumableImage.on('fileSuccess', function (file, response) { // trigger when file upload complete
            response = JSON.parse(response)

            browseImageFile.attr('disabled',false);
            $('.submit-btn').attr('disabled',false);

            if (response.mime_type.includes("image")) {
                var imagePath = response.path + '/' + response.name;

                @this.set('image',response.name);
                @this.set('originalImage',imagePath);

                $('#imagePreview').attr('src', imagePath).show();
            }

            $('.card-footer').show();
        });

        resumableImage.on('fileError', function (file, response) { // trigger when there is any error
            alert('file uploading error.')
        });
        //End upload video file

    });
</script>

@include('partials.admin.upload_file')

@endpush
