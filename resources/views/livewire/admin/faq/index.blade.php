<div class="content-wrapper">
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                @if($formMode)
    
                    @include('livewire.admin.faq.form')

                @elseif($viewMode)

                    @livewire('admin.faq.show', ['faq_id' => $faq_id])
                  
                @else
                    <div wire:loading wire:target="create" class="loader"></div>
                    <div class="card-title">
                        <h4 class="float-left">{{__('cruds.faq.title_singular')}}</h4>
                        <button wire:click="create()" type="button" class="btn btn-sm btn-success btn-icon-text float-right">
                            <i class="ti-plus btn-icon-prepend"></i>                                                    
                                {{__('global.add')}}
                        </button>
                    </div>                
                    <div class="table-responsive">
                        <div class="table-additional-plugin">
                            <input type="text" class="form-control col-2" wire:model="search" placeholder="{{ __('global.search')}}">
                        </div>
                        <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>{{ trans('global.sno') }}</th>
                                <th>{{ trans('cruds.faq.fields.question') }}</th>
                                <th>{{ trans('global.status') }}</th>
                                <th>{{ trans('global.created_at') }}</th>
                                <th>{{ trans('global.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($allFaqs->count() > 0)
                                @foreach($allFaqs as $serialNo => $faq)
                                    <tr>
                                        <td>{{ $serialNo+1 }}</td>
                                        <td>{{ $faq->question }}</td>
                                        <td>
                        
                                            <label class="toggle-switch">
                                                <input wire:ignore type="checkbox" class="toggleSwitch"  wire:click="toggle({{$faq->id}})" {{ $faq->status == 1 ? 'checked' : '' }}>
                                                <span class="switch-slider"></span>
                                            </label>

                                        </td>
                                        <td>{{ convertDateTimeFormat($faq->created_at,'datetime') }}</td>
                                        <td>
                                            <button type="button" wire:click="show({{$faq->id}})" class="btn btn-primary btn-rounded btn-icon">
                                                <i class="ti-eye"></i>
                                            </button>

                                            <button type="button" wire:click="edit({{$faq->id}})" class="btn btn-info btn-rounded btn-icon">
                                                <i class="ti-pencil-alt"></i>
                                            </button>

                                            <button type="button" wire:click="delete({{$faq->id}})" class="btn btn-danger btn-rounded btn-icon">
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
                    
                        {{ $allFaqs->links('vendor.pagination.bootstrap-5') }}
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
      
        $('textarea#summernote').summernote({
            placeholder: 'Type somthing...',
            tabsize: 2,
            height: 100,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', /*'picture', 'video'*/]],
                // ['view', ['fullscreen', 'codeview', 'help']],
            ],
            callbacks: {
                onChange: function(content) {
                    // Update the Livewire property when the Summernote content changes
                    @this.set('answer', content);
                }
            }
        });
      
    });

   

</script>
@endpush