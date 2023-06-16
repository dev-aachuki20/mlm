<!-- Modal -->
<div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="videoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Preview</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{-- <!-- 16:9 aspect ratio -->
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="{{$originalVideo}}"></iframe>
                </div> --}}

                    <video controls="" width="450" preload="none" poster="{{ $originalImage }}" id="clip-video" playsinline>
                    <source class="js-video" src="{{ $originalVideo }}" type="video/{{ $videoExtenstion }}">
                    </video>

            </div>
        </div>
    </div>
</div>