<div class="content-wrapper">
  
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="card">
              <div class="card-header bg-white">
                <div class="float-left">
                
                </div>
                <div class="d-flex float-right">
                    <button class="btn btn-primary btn-sm" wire:loading.attr="disabled" wire:click.prevent="cancel">
                        <i class="fa-solid fa-arrow-left"></i> Back
                        <span wire:loading="" wire:target="cancel">
                            <i class="fa fa-solid fa-spinner fa-spin" aria-hidden="true"></i>
                        </span>
                    </button>
                </div>
              </div>
              <div class="card-body playlists">
                  <div class="row">
                    <div class="col-md-7 col-12">
                      <div class="my-course-video-main">
                        <div class="tab-content border-0 p-0" id="v-pills-tabContent">
                          <div class="tab-pane fade show active"  role="tabpanel" aria-labelledby="v-pills-home-tab">
                              <video id='displayActiveVideo' controls="controls" preload='none' width="600" poster="{{$imageUrl}}" controlsList="nodownload">
                                  <source  src="{{$videoUrl}}" type='video/{{$videoExtension}}' />
                              </video>
                          </div>

                        </div>
                      </div>

                    </div>
                    <div class="col-md-5 col-12">
                       <div class="nav flex-column nav-pills border-0 playlistvidoTab" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                      
                        @if($lectureList)
                          @foreach($lectureList as $list)
                          <a class="nav-link playlist-item {{ $lastUserWatchedLectureId == $list->id ? 'active' : ''}}" wire:click.prevent="changeVideo('{{$list->id}}')">
                            <div class="playlistVideo">
                              <div class="row">
                                <div class="col-auto">
                                  <div class="videoImg"><img src="{{ $list->course_image_url }}" alt=""><span class="time">{{ $list->duration }}</span></div>
                                </div>
                                <div class="col pl-0 lecture-short-des">
                                  <div class="videoTitle"><strong>{{$loop->iteration}}.</strong> {{ ucwords($list->title) }}</div>
                                  <div class="videoDiscription">
                                    {!! Str::limit(strip_tags($list->description),200) !!}
                                  </div>
                                </div>
                              </div>
                            </div>
                          </a>
                          @endforeach
                        @endif


                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-12">
                      <div class="my-course-video-main">
                        <div class="tab-content border-0 p-0" id="v-pills-tabContent">
                           
                            <div class="videoName">{{ucwords($title)}}</div>
                            <div class="discriptionContent d-md-block d-none">
                              <p>{!! $description !!}</p>
                            </div>
                            <hr/>
                            <div class="discriptionContent d-md-block d-none">
                              <p>{!! $course->description !!}</p>
                            </div>

                        </div>
                      </div>

                    </div>
                   
                  </div>

              </div>


            </div>
        </div>
    </div>

    


</div>

@push('scripts')
<script type="text/javascript">

  document.addEventListener('livewire:load', function () {
      activePlaylistItem();
  });

  document.addEventListener('activePlaylistItemOnTop', function () {
      activePlaylistItem();
  });

  document.addEventListener('loadNewVideo', function(event) {
    changeVideoSource(event.detail)
  });

  function changeVideoSource(newSource) {
      var video = document.getElementById('displayActiveVideo');

      // Find the current source element.
      var source = video.getElementsByTagName('source')[0];

      // Update the source element's "src" attribute.
      source.src = newSource;

      // Load the new video source and start playing it.
      video.load();
      video.play();
  }

  function activePlaylistItem(){
    const playlist = document.querySelector('.playlistvidoTab');
    //Scrolling
    const activeVideo = playlist.querySelector('.playlist-item.active');
    if (activeVideo) {
        const offsetTop = activeVideo.offsetTop;
        playlist.scrollTo({
          top: offsetTop,
          behavior: 'smooth',
        });
    }
  }

</script>
@endpush
