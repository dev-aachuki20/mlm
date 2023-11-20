<div class="content-wrapper">
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                @if($formMode)
    
                    @include('livewire.admin.package.form')

                @elseif($viewMode)

                    @livewire('admin.package.show', ['package_id' => $package_id])

                @else
                    <div wire:loading wire:target="create" class="loader"></div>
                    <div class="card-title d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">{{__('cruds.package.title')}}</h4>
                        <button wire:click="create()" type="button" class="btn btn-sm btn-success btn-icon-text float-right">
                            <i class="fa-solid fa-plus"></i>                                                    
                                {{__('global.add')}}
                        </button>
                        {{-- <a href="{{ route('admin.package.create') }}" type="button" class="btn btn-sm btn-success btn-icon-text float-right">
                            <i class="fa-solid fa-plus"></i>                                                    
                                {{__('global.add')}}
                        </a> --}}
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
                            <th>{{ trans('cruds.package.fields.title') }}</th>
                            <th>{{ trans('cruds.package.fields.amount') }}</th>
                            <th>{{ trans('global.status') }}</th>
                            <th>{{ trans('cruds.package.fields.created_at') }}
                                <span wire:click="sortBy('created_at')" class="float-right text-sm" style="cursor: pointer;">
                                    <i class="fa fa-arrow-up {{ $sortColumnName === 'created_at' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                                    <i class="fa fa-arrow-down {{ $sortColumnName === 'created_at' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                                </span>
                            </th>
                            <th>{{ trans('global.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($allPackages->count() > 0)
                                @foreach($allPackages as $serialNo => $package)
                                    <tr>
                                        <td>{{ $serialNo+1 }}</td>
                                        <td>{{ ucfirst($package->title) }}</td>
                                        <td><i class="fa-solid fa-indian-rupee-sign"></i> {{ number_format($package->amount,2) }}</td>
                                        <td>
                        
                                            <label class="toggle-switch">
                                                <input type="checkbox" class="toggleSwitch"  wire:click.prevent="toggle({{$package->id}})" {{ $package->status == 1 ? 'checked' : '' }}>
                                                <span class="switch-slider"></span>
                                            </label>

                                        </td>
                                        <td>{{ convertDateTimeFormat($package->created_at,'datetime') }}</td>
                                        <td>
                                            <button type="button" wire:click.prevent="show({{$package->id}})" class="btn btn-primary btn-rounded btn-icon">
                                                <i class="ti-eye"></i>
                                            </button>
                                            
                                            <button type="button" wire:click.prevent="edit({{$package->id}})" class="btn btn-info btn-rounded btn-icon">
                                                <i class="ti-pencil-alt"></i>
                                            </button>

                                            <button type="button" wire:click.prevent="delete({{$package->id}})" class="btn btn-danger btn-rounded btn-icon">
                                                <i class="ti-trash"></i>
                                            </button>
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
                    {{ $allPackages->links('vendor.pagination.bootstrap-5') }}

                @endif

            </div>
        </div>
    </div>
</div>
</div>


@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" />
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('admin/assets/select2/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/assets/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/css/vertical-layout-light/style.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="{{ asset('admin/assets/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/resumable.js/1.1.0/resumable.min.js"></script>

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

        if ($(".js-example-basic-single").length) {
            $(".js-example-basic-single").select2({
                placeholder: 'Select Level',
            });
        }

        $('input[id="duration"]').daterangepicker({
            autoApply: true,
            timePicker: true,
            timePicker24Hour: true,
            singleDatePicker: true,
            timePickerIncrement: 15,
            // minDate: moment().startOf('day'),
            // maxDate: moment().startOf('day').add(12, 'hour'),
            locale: {
             format: 'HH:mm'
            }

        },function(start, end, label) {
            // Handle your apply button logic here
            // console.log(start.format('HH:mm'));

            @this.set('duration', start.format('HH:mm'));
            

        }).on('show.daterangepicker', function(ev, picker) {
            picker.container.find(".calendar-table").hide();
        });



        $(document).on('change','.select-level',function(){
            var selectLevel = $(this).val();
            @this.set('level', selectLevel);
        });

       
        $('textarea#summernote-features').summernote({
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
                // ['table', ['table']],
                ['insert', ['link', /*'picture', 'video'*/]],
                ['view', [/*'fullscreen',*/ 'codeview', /*'help'*/]],
            ],
            callbacks: {
                onChange: function(content) {
                    // Update the Livewire property when the Summernote content changes
                    @this.set('features', content);
                }
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
                // ['table', ['table']],
                ['insert', ['link', /*'picture', 'video'*/]],
                ['view', [/*'fullscreen',*/ 'codeview', /*'help'*/]],
            ],
            callbacks: {
                onChange: function(content) {
                    // Update the Livewire property when the Summernote content changes
                    @this.set('description', content);
                }
            }
        });
      
        //Upload Video file
        let browseFile = $('#browseVideoFile');
        let resumable = new Resumable({
            target: "{{ route('upload-file') }}",
            query: {_token: '{{ csrf_token() }}'},
            fileType: ['webm', 'mp4', 'avi', 'wmv','flv','mov'],
            chunkSize: 2 * 1024 * 1024, // default is 1*1024*1024, this should be less than your maximum limit in php.ini
            headers: {
                'Accept': 'application/json'
            },
            testChunks: false,
            throttleProgressCallbacks: 1,
        });

        resumable.assignBrowse(browseFile[0]);

        resumable.on('fileAdded', function (file) { // trigger when file picked
            showProgress();
            resumable.upload() // to actually start uploading.
        });

        resumable.on('fileProgress', function (file) { // trigger when file progress update
            updateProgress(Math.floor(file.progress() * 100));
        });

        resumable.on('fileSuccess', function (file, response) { // trigger when file upload complete
            response = JSON.parse(response)

            if (response.mime_type.includes("image")) {
                $('#imagePreview').attr('src', response.path + '/' + response.name).show();
            }

            if (response.mime_type.includes("video")) {
                $('#videoPreview').attr('src', response.path + '/' + response.name).show();
            }

            $('.card-footer').show();
        });

        resumable.on('fileError', function (file, response) { // trigger when there is any error
            alert('file uploading error.')
        });

        let progress = $('.progress');

        function showProgress() {
            progress.find('.progress-bar').css('width', '0%');
            progress.find('.progress-bar').html('0%');
            progress.find('.progress-bar').removeClass('bg-success');
            progress.show();
        }

        function updateProgress(value) {
            progress.find('.progress-bar').css('width', `${value}%`)
            progress.find('.progress-bar').html(`${value}%`)

            if (value === 100) {
                progress.find('.progress-bar').addClass('bg-success');
            }
        }

        function hideProgress() {
            progress.hide();
        }
        //End file upload
       
    });

   

</script>
@endpush