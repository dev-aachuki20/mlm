<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    @if($formMode)

                        @include('livewire.admin.service.form')

                    @elseif($viewMode)

                        @livewire('admin.service.show', ['service_id' => $service_id])

                    @else
                        <div wire:loading wire:target="create" class="loader"></div>
                        <div class="card-title d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">{{__('cruds.service.title')}}</h4>
                            <button wire:click="create()" type="button" class="btn btn-sm btn-success btn-icon-text float-right">
                                <i class="fa-solid fa-plus"></i>
                                    {{__('global.add')}}
                            </button>
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
                                <th>{{ trans('cruds.service.fields.title') }}</th>
                                <th>{{ trans('cruds.service.fields.sub_title') }}</th>
                                <th>{{ trans('global.status') }}</th>
                                <th>{{ trans('cruds.service.fields.created_at') }}
                                    <span wire:click="sortBy('created_at')" class="float-right text-sm" style="cursor: pointer;">
                                        <i class="fa fa-arrow-up {{ $sortColumnName === 'created_at' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                                        <i class="fa fa-arrow-down {{ $sortColumnName === 'created_at' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                                    </span>
                                </th>
                                <th>{{ trans('global.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($allServices->count() > 0)
                                    @foreach($allServices as $serialNo => $service)
                                        <tr>
                                            <td>{{ $serialNo+1 }}</td>
                                            <td>{{ ucfirst($service->title) }}</td>
                                            <td>{!! nl2br(wordwrap($service->sub_title, 20, '<br>', true)) !!}</td>
                                            <td>
                                                <label class="toggle-switch">
                                                    <input type="checkbox" class="toggleSwitch"  wire:click.prevent="toggle({{$service->id}})" {{ $service->status == 1 ? 'checked' : '' }}>
                                                    <span class="switch-slider"></span>
                                                </label>

                                            </td>
                                            <td>{{ convertDateTimeFormat($service->created_at,'date') }}</td>
                                            <td>
                                                <button type="button" wire:click.prevent="show({{$service->id}})" class="btn btn-primary btn-rounded btn-icon">
                                                    <i class="ti-eye"></i>
                                                </button>

                                                <button type="button" wire:click.prevent="edit({{$service->id}})" class="btn btn-info btn-rounded btn-icon">
                                                    <i class="ti-pencil-alt"></i>
                                                </button>

                                                <button type="button" wire:click.prevent="delete({{$service->id}})" class="btn btn-danger btn-rounded btn-icon">
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
                        {{ $allServices->links('vendor.pagination.bootstrap-5') }}

                    @endif

                </div>
            </div>
        </div>
    </div>
    </div>


    @push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('admin/css/vertical-layout-light/style.css') }}">
    @endpush

    @push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>


    <script type="text/javascript">

        document.addEventListener('loadPlugins', function (event) {

            $('.dropify').dropify();
            $('.dropify-errors-container').remove();
            $('.dropify-clear').click(function(e) {
                e.preventDefault();
                var elementName = $(this).siblings('input[type=file]').attr('id');
                if(elementName == 'dropify-image'){
                   @this.set('image',null);
                   @this.set('originalImage',null);
                   @this.set('removeImage',true);
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
