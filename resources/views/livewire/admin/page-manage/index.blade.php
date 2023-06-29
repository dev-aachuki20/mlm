<div class="content-wrapper" wire:key="{{time()}}2023">
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                @if($formMode)
    
                    @include('livewire.admin.page-manage.form')

                @elseif($viewMode)

                    @livewire('admin.page-manage.show', ['page_id' => $page_id])
                  
                @else
                    <div wire:loading wire:target="create" class="loader"></div>
                    <div class="card-title">
                        <h4 class="float-left">Page Management</h4>
                        <button wire:click="create()" type="button" class="btn btn-sm btn-success btn-icon-text float-right">
                            <i class="fa-solid fa-plus"></i>                                                    
                                {{__('global.add')}}
                        </button>
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
                                <th>Type</th>
                                <th>{{ trans('global.status') }}</th>
                                <th>{{ trans('global.created_at') }}
                                    <span wire:click="sortBy('created_at')" class="float-right text-sm" style="cursor: pointer;">
                                        <i class="fa fa-arrow-up {{ $sortColumnName === 'created_at' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                                        <i class="fa fa-arrow-down {{ $sortColumnName === 'created_at' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                                    </span>
                                </th>
                                <th>{{ trans('global.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($allPage->count() > 0)
                                @foreach($allPage as $serialNo => $page)
                                    <tr>
                                        <td>{{ $serialNo+1 }}</td>
                                        <td>{{ ucwords($page->title) }}</td>
                                        <td>{{ ucwords(config('constants.page_types')[$page->type]) }}</td>
                                        <td>
                        
                                            <label class="toggle-switch">
                                                <input type="checkbox" class="toggleSwitch" wire:click.prevent="toggle({{$page->id}})" {{ $page->status == 1 ? 'checked' : '' }}>
                                                <div class="switch-slider round"></div>
                                            </label>

                                        </td>
                                        <td>{{ convertDateTimeFormat($page->created_at,'datetime') }}</td>
                                        <td>
                                            <button type="button" wire:click.prevent="show({{$page->id}})" class="btn btn-primary btn-rounded btn-icon">
                                                <i class="ti-eye"></i>
                                            </button>

                                            <button type="button" wire:click.prevent="edit({{$page->id}})" class="btn btn-info btn-rounded btn-icon">
                                                <i class="ti-pencil-alt"></i>
                                            </button>

                                            @if($page->type != 3)
                                                <button type="button" wire:click.prevent="delete({{$page->id}})" class="btn btn-danger btn-rounded btn-icon">
                                                    <i class="ti-trash"></i>
                                                </button>
                                            @endif
                                            
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
                    
                        {{ $allPage->links('vendor.pagination.bootstrap-5') }}
                    </div>

                @endif

            </div>
        </div>
    </div>
</div>
</div>

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" />
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>

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
              ['color', ['color']],
              ['para', ['ul', 'ol', 'paragraph']],
              ['table', ['table']],
              ['insert', ['link', 'picture', /*'video'*/]],
              ['view', [/*'fullscreen', */'codeview', /*'help'*/]],
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