<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="card">
                <div class="card-header bg-white">
                    <div class="d-flex float-left">
                    <h4 class="font-weight-bold">View Courses</h4>
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

                <div class="card-body">
                    {{-- Start to show course list --}}
                    <div class="row">
                        <div class="col-lg-12 col-sm-12">
                          <div class="course-main">
                            @if($courses)
                            @if($courses->count() > 0)
                                @foreach($courses as $course)

                                <div class="course-item">
                                    <div class="course-video">
                                        <div class="course-count">
                                        <span>{{$loop->iteration}}</span>
                                        </div>
                                        <div class="box-video">
                                        <div class="video-container course-video-section">
                                            <video id='course-video-{{$loop->iteration}}' controls="controls" preload='none' width="600" poster="{{$course->course_image_url}}" controlsList="nodownload">
                                                <source id='mp4' src="{{$course->course_video_url}}" type='video/{{$course->courseVideo->extension}}' />
                                                </track>
                                            </video>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="course-text coursesfield row">
                                        <div class="course-text-width col">
                                        <a href="{{ route('user.my-course-lectures',[$packageDetail->uuid,$course->slug]) }}" >
                                            <h5 class="head-f-25 color-dark-blue">{{ ucwords($course->name) }}</h5>
                                        </a>
                                        <div class="packages-detais-outer durationTab">
                                            <div class="packages-detais bg-light-orange">
                                            <label>Duration</label>
                                            <div class="icon-time">
                                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0_236_647)">
                                                <path d="M12.2068 10.5894L9.69712 8.70714V4.87293C9.69712 4.48741 9.38549 4.17578 8.99997 4.17578C8.61444 4.17578 8.30282 4.48741 8.30282 4.87293V9.05575C8.30282 9.27534 8.406 9.48241 8.58168 9.61347L11.3702 11.7049C11.4957 11.799 11.6421 11.8443 11.7878 11.8443C12.0004 11.8443 12.2096 11.7488 12.3462 11.5647C12.5777 11.2573 12.515 10.8202 12.2068 10.5894Z" fill="black"></path>
                                                <path d="M9 0C4.0371 0 0 4.0371 0 9C0 13.9629 4.0371 18 9 18C13.9629 18 18 13.9629 18 9C18 4.0371 13.9629 0 9 0ZM9 16.6057C4.80674 16.6057 1.39426 13.1933 1.39426 9C1.39426 4.80674 4.80674 1.39426 9 1.39426C13.194 1.39426 16.6057 4.80674 16.6057 9C16.6057 13.1933 13.1933 16.6057 9 16.6057Z" fill="black"></path>
                                                </g>
                                                <defs>
                                                <clipPath id="clip0_236_647">
                                                <rect width="18" height="18" fill="white"></rect>
                                                </clipPath>
                                                </defs>
                                                </svg>
                                                {{ $course->total_duration ?? '00:00:00' }}
                                            </div>
                                            </div>

                                            <div class="packages-detais bg-light-orange">
                                                <label>Lectures</label>
                                                <div class="icon-time">
                                                    <span class="mr-1"><img src="{{ asset('images/icons/my-course.svg') }}"></span>
                                                  {{ $course->videoGroup()->where('status',1)->count() }}
                                                </div>
                                            </div>

                                        </div>
                                        <div class="content">
                                            <p>{!! Str::limit(strip_tags($course->description),200) !!}</p>
                                        </div>
                                        </div>

                                    </div>
                                </div>

                                @endforeach
                            @else
                            <h6>{{ __('messages.no_record_found')}}</h6>

                            @endif
                                {{-- Start pagination --}}
                                    {{$courses->links('vendor.pagination.bootstrap-5')}}
                                {{-- End Pagination --}}
                            @endif

                          </div>
                        </div>
                    </div>

                    {{-- End to show course list --}}


                </div>
            </div>
        </div>
    </div>


</div>

@push('scripts')
<script type="text/javascript">

    document.addEventListener('livewire:load', function () {
        // Get all video elements
        const videos = document.querySelectorAll('.course-video-section video');

        // Add event listeners to pause other videos when one is played
        videos.forEach(video => {
            video.addEventListener('play', function () {
                pauseOtherVideos(video);
            });
        });

        function pauseOtherVideos(currentVideo) {
            // Pause all other videos except the one that is currently playing
            videos.forEach(video => {
                if (video !== currentVideo) {
                    video.pause();
                }
            });
        }
        
    });

   

</script>
@endpush
