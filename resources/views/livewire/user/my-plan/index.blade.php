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
                                <span class="my-course-plan active">Active Plan</span>
                                <div class="plan-name">{{$packageDetail->title}}</div>
                                <div class="course-price-list">
                                    <ul>
                                        {{-- <li>
                                            <div class="name-list">
                                                <span><img src="{{ asset('images/standard-pack/clock.svg') }}"></span>Duration
                                            </div>
                                            <div class="details-course">{{$packageDetail->duration}}</div>
                                        </li> --}}
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
                            <div class="sec-head mb-5">
                                <h3 class="head-f-25 color-dark-blue">All Package</h3>
                            </div>
                          <div class="course-main">
                            @if($packages)
                            @if($packages->count() > 0)
                                @foreach($packages as $package)

                                <div class="course-item plancard">
                                    <div class=" coursesfield row w-100">
                                      <div class="course-text-width col-md">
                                        <h5 class="head-f-25 color-dark-blue">{{ ucwords($package->title) }}</h5>
                                        {!! $package->features !!}
                                      </div>
                                      <div class="col-auto">
                                        <div class="prich">₹{{number_format($package->amount,2)}}</div>
                                      </div>
                                      <div class="col-auto">
                                        @if(($activePlanId == $package->id) || ($activePlanId == $package->parent_id))

                                        <a href="{{ route('user.my-courses',$package->uuid) }}" class="btn viewMoreBtn fill unlock">Unlock
                                          <svg width="14" height="12" viewBox="0 0 14 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M8 11L13 6L8 1" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M1 11L6 6L1 1" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                          </svg>
                                        </a>

                                        @else

                                        <a href="javascript:;" class="btn viewMoreBtn fill" aria-disabled="">Lock
                                            <svg width="14" height="12" viewBox="0 0 14 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                              <path d="M8 11L13 6L8 1" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                              <path d="M1 11L6 6L1 1" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </a>
                                        @endif

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
                      </div>

                    {{-- End to show course list --}}


                </div>
            </div>
        </div>
    </div>


</div>

@push('scripts')

@endpush
