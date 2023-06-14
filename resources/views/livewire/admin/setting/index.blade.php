<div class="content-wrapper">
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                @if($formMode)
    
                    @include('livewire.admin.setting.form')

                @elseif($viewMode)

                    @livewire('admin.setting.show', ['setting_id' => $setting_id])
                  
                @else
                    <div wire:loading wire:target="create" class="loader"></div>
                    <div class="card-title">
                        <h4 class="float-left">{{__('cruds.setting.title_singular')}}</h4>
                       {{-- <button wire:click="create()" type="button" class="btn btn-sm btn-success btn-icon-text float-right">
                            <i class="ti-plus btn-icon-prepend"></i>                                                    
                                {{__('global.add')}}
                        </button>
                        --}}
                    </div>                
                    <div class="table-responsive">
                        <div class="table-additional-plugin">
                            <input type="text" class="form-control col-2" wire:model="search" placeholder="{{ __('global.search')}}">
                        </div>
                        <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>{{ trans('global.sno') }}</th>
                                <th>{{ trans('cruds.setting.fields.key') }}</th>
                                <th>{{ trans('cruds.setting.fields.type') }}</th>
                                <th>{{ trans('global.status') }}</th>
                                <th>{{ trans('global.created_at') }}</th>
                                <th>{{ trans('global.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($allSetting->count() > 0)
                                @foreach($allSetting as $serialNo => $setting)
                                    <tr>
                                        <td>{{ $serialNo+1 }}</td>
                                        <td>{{ $setting->key }}</td>
                                        <td>{{ $setting->type }}</td>

                                        <td>
                                            <label class="toggle-switch">
                                                <input type="checkbox" class="toggleSwitch" wire:click="toggle({{$setting->id}})" wire:click.prevent="confirmAlert('You want to change the status.','updateStatus',{{$setting->id}})" {{ $setting->status == 1 ? 'checked' : '' }}>
                                                <div class="switch-slider round"></div>
                                            </label>

                                        </td>
                                        <td>{{ convertDateTimeFormat($setting->created_at,'datetime') }}</td>
                                        <td>
                                            <button type="button" wire:click="show({{$setting->id}})" class="btn btn-primary btn-rounded btn-icon">
                                                <i class="ti-eye"></i>
                                            </button>

                                            <button type="button" wire:click="edit({{$setting->id}})" class="btn btn-info btn-rounded btn-icon">
                                                <i class="ti-pencil-alt"></i>
                                            </button>

                                           {{--  <button type="button" wire:click="delete({{$setting->id}})" class="btn btn-danger btn-rounded btn-icon">
                                                <i class="ti-trash"></i>
                                            </button>
                                            --}}
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                            <tr>
                                <td colspan="6">{{ __('messages.no_record_found')}}</td>
                            </tr>
                            @endif
                        
                        </tbody>
                        </table>
                    
                        {{ $allSetting->links('vendor.pagination.bootstrap-5') }}
                        
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

        // $('textarea#summernote').summernote({
        //     placeholder: 'Type somthing...',
        //     tabsize: 2,
        //     height: 100,
        //     toolbar: [
        //         ['style', ['style']],
        //         ['font', ['bold', 'underline', 'clear']],
        //         ['fontname', ['fontname']],
        //         ['color', ['color']],
        //         ['para', ['ul', 'ol', 'paragraph']],
        //         ['table', ['table']],
        //         ['insert', ['link', /*'picture', 'video'*/]],
        //         // ['view', ['fullscreen', 'codeview', 'help']],
        //     ],
        //     callbacks: {
        //         onChange: function(content) {
        //             // Update the Livewire property when the Summernote content changes
        //             @this.set('value', content);
        //         }
        //     }
        // });
      
    });


    $(document).ready(function(){
        $(document).on('change','.section-type',function(){
            var sectionType = $(this).val();
            Livewire.emit('changeType',sectionType);

        });
    });
</script>
@endpush