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
                                    <p>{{strip_tags($packageDetail->description)}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-sm-12">
                            <div class="my-course-package">
                                <span class="my-course-plan active">Active Plan</span>
                                <div class="plan-name">{{$packageDetail->title}}</div>
                                <div class="course-price-list">
                                    <ul>
                                        <li>
                                            <div class="name-list">
                                                <span><img src="{{ asset('images/standard-pack/clock.svg') }}"></span>Duration
                                            </div>
                                            <div class="details-course">{{$packageDetail->duration}}</div>
                                        </li>
                                        <li>
                                            <div class="name-list">
                                                <span><img src="{{ asset('images/standard-pack/level.svg') }}"></span>Level
                                            </div>
                                            <div class="details-course">{{ ucfirst(config('constants.levels')[$packageDetail->level]) }}</div>
                                        </li>
                                        <li>
                                            <div class="name-list">
                                                <span><img src="{{ asset('images/icons/my-course.svg') }}"></span>Lectures
                                            </div>
                                            <div class="details-course">{{$lectureCount}} Enrolled</div>
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
                    <div class="row">
                        <div class="col-lg-12 col-sm-12">
                            <hr>
                            <div class="course-main">
                                @if($lectureList)
                                    @if($lectureList->count() > 0)
                                    @foreach($lectureList as $lecture)
                                    <div class="course-item">
                                        <div class="course-video">
                                            <div class="course-count">
                                                <span>{{$loop->iteration}}</span>
                                            </div>
                                            <div class="box-video">
                                                <div class="video-container">
                                                    <video id="lecture-video-{{$loop->iteration}}" controls="controls" preload='none' width="560" height="315" poster="{{$lecture->course_image_url}}">
                                                        <source src="{{$lecture->course_video_url}}" type='video/{{$lecture->courseVideo->extension}}' />
                                                        </track>
                                                    </video>
                                                </div>
    
                                            </div>
                                        </div>
                                        <div class="course-text">
                                            <div class="course-text-width">
                                                <h5 class="head-f-25 color-dark-blue">{{ ucwords($lecture->title) }}</h5>
                                                <div class="content">
                                                    <p> {!! $lecture->description !!}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @else
                                    <h6>{{ __('messages.no_record_found')}}</h6>
                                    @endif
                                @endif
                            </div>
                        </div>
                        
                        @if($lectureList)
                        {{$lectureList->links('vendor.pagination.bootstrap-5')}}
                        @endif
                    </div>

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