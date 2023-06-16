<div>
   
    <h4 class="card-title">
        {{__('global.show')}}
        {{ strtolower(__('cruds.course.title_singular'))}}</h4>
    
    
        <div class="form-group row">
            <label class="col-sm-3 col-form-label font-weight-bold">Title</label>
            <div class="col-sm-9">
                 {{ $detail->title }}
            </div>
        </div>
    
        <div class="form-group row">
            <label class="col-sm-3 col-form-label font-weight-bold">Video</label>
            <div class="col-sm-9">
                <video controls="" width="200" preload="none" poster="{{ $detail->course_image_url }}" id="clip-video" playsinline>
                    <source class="js-video" src="{{ $detail->course_video_url }}" type="video/{{ $detail->courseVideo->extention }}">
                </video>
            </div>
        </div>
    
        <div class="form-group row">
            <label class="col-sm-3 col-form-label font-weight-bold">{{ __('cruds.course.fields.description')}}</label>
            <div class="col-sm-9">
                {!! $detail->description !!}
            </div>
        </div>
    
    
        <div class="form-group row">
            <label class="col-sm-3 col-form-label font-weight-bold">Status</label>
            <div class="col-sm-9">
                 @if($detail->status)
                    <div class="badge badge-success">Active</div>
                 @else
                    <div class="badge badge-danger">Inactive</div>
                 @endif
                 
            </div>
        </div>
    
        <button wire:click.prevent="cancel" class="btn btn-secondary">
            {{ __('global.cancel')}}
            <span wire:loading wire:target="cancel">
                <i class="fa fa-solid fa-spinner fa-spin" aria-hidden="true"></i>
            </span>
        </button>
    
    </div>
    