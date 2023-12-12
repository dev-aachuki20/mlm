<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-7 col-sm-12">
                            <div class="my-course-video-main">
                                <video id='video' controls="controls" preload='none' width="600" poster="{{$packageDetail->image_url}}">
                                    <source id='mp4' src="{{$packageDetail->video_url}}" type='video/{{$packageDetail->packageVideo->extension}}' />
                                    </track>
                                </video>
                            </div>
                            <div class="sec-head">
                                <h3 class="head-f-25 color-dark-blue">{{ucwords($packageDetail->title)}}</h3>
                                <div class="content">
                                    <p>{!! $packageDetail->description !!}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-sm-12">
                            <div class="my-course-package">
                                <div class="plan-name">{{$packageDetail->title}}</div>
                                <div class="course-price-list">
                                    <ul>
                                        <li>
                                            <div class="name-list">
                                                <span><img src="{{ asset('images/standard-pack/level.svg') }}"></span>Level
                                            </div>
                                            <div class="details-course">{{ ucfirst(config('constants.levels')[$packageDetail->level]) }}</div>
                                        </li>
                                        <li>
                                            <div class="name-list">
                                                <span><img src="{{ asset('images/icons/my-course.svg') }}"></span>Courses
                                            </div>
                                            <div class="details-course">{{$courseCount}} Enrolled</div>
                                        </li>
                                        <li>
                                            <div class="name-list">
                                                <span><img src="{{ asset('images/standard-pack/enrolled.svg') }}"></span>Enrolled
                                            </div>
                                            <div class="details-course">{{$userenrolled}} Enrolled</div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

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
                                        <div class="video-container">
                                            <video id="lecture-video-{{$course->iteration}}" controls="controls" preload='none' width="560" height="315" poster="{{$course->course_image_url}}">
                                                <source src="{{$course->course_video_url}}" type='video/{{$course->courseVideo->extension}}' />
                                                </track>
                                            </video>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="course-text coursesfield row">
                                        <div class="course-text-width col">
                                        <a href="{{ route('user.my-course-lectures',$course->slug) }}" >
                                            <h5 class="head-f-25 color-dark-blue">{{ ucwords($course->name) }}</h5>
                                        </a>
                                        <div class="packages-detais-outer durationTab">
                                            <div class="packages-detais bg-light-orange ">
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
                                                {{ $course->total_duration }}
                                            </div>
                                            </div>

                                        </div>
                                        <div class="content">
                                            <p>{{ Str::limit(strip_tags($course->description),100) }}</p>
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
<script>
    var charLimit = 210;

    function truncate(el) {
        var clone = el.children().first(),
            originalContent = el.html(),
            text = clone.text();

        if (clone[0].innerHTML.trim().length > charLimit) {
            el.attr("data-originalContent", originalContent);
            el.addClass("hasHidden");
            clone.text(text.substring(0, charLimit) + "...");
            el.empty().append(clone);
            el.append(
                $("<span class='read-more'><a href='#' class='more'>Read More</a>")
            );
        }
    }

    $("body").on("click", "a.more", function(e) {
        e.preventDefault();
        var truncateElement = $(this).parent().parent();
        if (truncateElement.hasClass("hasHidden")) {
            $(truncateElement).html(truncateElement.attr("data-originalContent"));
            $(truncateElement).append(
                $("<span class='read-more'><a href='#' class='more'>Read Less</a>")
            );
            truncateElement.removeClass("hasHidden").slow;
        } else {
            $(".read-more", truncateElement).remove();
            truncate(truncateElement);
        }
    });

    $(".course-text-width .content").each(function() {
        truncate($(this));
    });

    function myCallback() {
        setTimeout(function() {
            $(".course-text-width .content").removeClass("hasHidden");
        }, 3000);
    }
</script>
@endpush
