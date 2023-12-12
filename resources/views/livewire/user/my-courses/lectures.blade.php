<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="card">
                <div class="card-body playlists">
                    <div class="row">
                      <div class="col-md-7 col-12">
                        <div class="my-course-video-main">
                          <div class="tab-content border-0 p-0" id="v-pills-tabContent">
                            <div class="tab-pane fade show active"  role="tabpanel" aria-labelledby="v-pills-home-tab">
                                <video id='video' controls="controls" preload='none' width="600" poster="{{$imageUrl}}">
                                    <source id='mp4' src="{{$videoUrl}}" type='video/{{$videoExtension}}' />
                                </video>
                              <div class="videoName">{{ucwords($title)}}</div>
                              <div class="discriptionContent d-md-block d-none">
                                <p>{!! $description !!}</p>
                              </div>
                            </div>

                          </div>
                        </div>

                      </div>
                      <div class="col-md-5 col-12">
                        <div class="nav flex-column nav-pills border-0 playlistvidoTab" id="v-pills-tab" role="tablist" aria-orientation="vertical">

                          @if($lectureList)
                            @foreach($lectureList as $list)
                            <a class="nav-link {{ $active_id == $list->id ? 'active' : ''}}" wire:click.prevent="activeVideo('{{$list->id}}')">
                              <div class="playlistVideo">
                                <div class="row">
                                  <div class="col-auto">
                                    <div class="videoImg"><img src="{{ $list->course_image_url }}" alt=""><span class="time">{{ $list->duration }}</span></div>
                                  </div>
                                  <div class="col pl-0">
                                    <div class="videoTitle"><strong>{{$loop->iteration}}.</strong> {{ ucwords($list->title) }}</div>
                                    <div class="videoDiscription">
                                      {{ Str::limit(strip_tags($list->description),100) }}
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
