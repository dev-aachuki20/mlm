<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    @if($formMode)

                        @include('livewire.admin.section.form')

                    @elseif($viewMode)

                        @livewire('admin.section.show', ['section_id' => $section_id])

                    @else
                        <div wire:loading wire:target="create" class="loader"></div>
                        <div class="card-title d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">{{__('cruds.section.title')}}</h4>
                            {{--<button wire:click="create()" type="button" class="btn btn-sm btn-success btn-icon-text float-right">
                                <i class="fa-solid fa-plus"></i>
                                    {{__('global.add')}}
                            </button>--}}
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
                                <th>{{ trans('cruds.section.fields.name') }}</th>
                                <th>{{ trans('global.status') }}</th>
                                <th>{{ trans('cruds.section.fields.created_at') }}
                                    <span wire:click="sortBy('created_at')" class="float-right text-sm" style="cursor: pointer;">
                                        <i class="fa fa-arrow-up {{ $sortColumnName === 'created_at' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                                        <i class="fa fa-arrow-down {{ $sortColumnName === 'created_at' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                                    </span>
                                </th>
                                <th>{{ trans('global.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($allSections->count() > 0)
                                    @foreach($allSections as $serialNo => $section)
                                        <tr>
                                            <td>{{ $serialNo+1 }}</td>
                                            <td>{!! ucwords($section->name) !!}</td>
                                            <td>
                                                <label class="toggle-switch">
                                                    <input type="checkbox" class="toggleSwitch"  wire:click.prevent="toggle({{$section->id}})" {{ $section->status == 1 ? 'checked' : '' }}>
                                                    <span class="switch-slider"></span>
                                                </label>
                                            </td>
                                            <td>{{ convertDateTimeFormat($section->created_at,'date') }}</td>
                                            <td>
                                                <button type="button" wire:click.prevent="show({{$section->id}})" class="btn btn-primary btn-rounded btn-icon">
                                                    <i class="ti-eye"></i>
                                                </button>

                                                <button type="button" wire:click.prevent="edit({{$section->id}})" class="btn btn-info btn-rounded btn-icon">
                                                    <i class="ti-pencil-alt"></i>
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
                        {{ $allSections->links('vendor.pagination.bootstrap-5') }}

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
                    ['insert', [/*'link', 'picture', 'video'*/]],
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
                    ['insert', [/*'link', 'picture', 'video'*/]],
                    ['view', [/*'fullscreen',*/ 'codeview', /*'help'*/]],
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
