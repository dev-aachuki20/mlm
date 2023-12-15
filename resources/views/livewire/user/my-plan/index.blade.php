<div class="content-wrapper">

    <!-- Start show active plan details -->
    <div class="row">
        <div class="col-md-12 grid-margin">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-xl-7 col-sm-12 mb-xl-0 mb-4">
                  <div class="my-course-video-main h-100">
                    <video id='video' controls="controls" preload='none' width="600" poster="{{$packageDetail->image_url}}" controlsList="nodownload">
                        <source id='mp4' src="{{$packageDetail->video_url}}" type='video/{{$packageDetail->packageVideo->extension}}' />
                        </track>
                    </video>
                  </div>
                </div>
                <div class="col-xl-5 col-sm-12">
                  <div class="my-course-package packageDetails">
                    <div class="innerbody w-100">
                        <span class="my-course-plan active">Active Plan</span>
                        <div div class="plan-name">{{ucwords($packageDetail->title)}}</div>
                      <div class="row packagerows">
                        <div class="col-sm-4 col-12">
                          <div class="card text-center">
                            <div class="cardbody">
                              <div class="iconImg"><span><img src="{{ asset('images/standard-pack/level.svg') }}"></span></div>
                              <div class="details_course">Level {{ ucfirst(config('constants.levels')[$packageDetail->level]) }}</div>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-4 col-12">
                          <div class="card text-center">
                            <div class="cardbody">
                              <div class="iconImg"><span><img src="{{ asset('images/standard-pack/lacturess.svg') }}"></span></div>
                              <div class="details_course">{{$courseCount}} Courses</div>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-4 col-12">
                          <div class="card text-center">
                            <div class="cardbody">
                              <div class="iconImg"><span><img src="{{ asset('images/standard-pack/enrolled.svg') }}"></span></div>
                              <div class="details_course">{{$userenrolled}} Enrolled</div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="discriptionContent mt-4">
                    
                    <div class="course-detail-list">
                        <ul class="list">
                        {!! $packageDetail->features !!}
                        </ul>
                    </div>

                    <div class="section-text body-size-normal mt-4">
                        {!! $packageDetail->description !!}
                    </div>

                </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <!-- End show active plan details -->

    <!-- Start all plans -->
    <div class="row">
        <div class="col-lg-12 col-sm-12">
          <div class="course-main packagecardmain">
            <div class="card packagecard">
              <div class="card-body">
                <div class="sec-head allplans">
                  <h3 class="head-f-25 color-dark-blue m-0">All Plans</h3>
                </div>
                <div class="row plancardGroup">
                  
                    @if($packages)
                    @if($packages->count() > 0)
                        @foreach($packages as $package)

                            <div class="col-xl-4 plan_card mt-4 col-md-6 col-12">
                                @php
                                    $levelTitle = '';
                                    $levelClass = '';
                                    if($package->level == 1){
                                        
                                        $levelTitle = ucfirst(config('constants.levels')[$package->level]);
                                        $levelClass = 'active_plan';

                                    }elseif($package->level == 2){

                                        $levelTitle = ucfirst(config('constants.levels')[$package->level]);
                                        $levelClass = 'advancedPlan';

                                    }elseif($package->level == 3){

                                        $levelTitle = ucfirst(config('constants.levels')[$package->level]);
                                        $levelClass = 'advancedPlan';

                                    }
                                @endphp
                                <div class="course-item plancard {{ ($activePlanId == $package->id) ? 'active_plan' : $levelClass }} ">
                                
                                @if($activePlanId == $package->id)
                                
                                <div class="currentPlan"><span>Active Plan</span></div>
                                
                                @else
                                
                                <div class="currentPlan"><span>{{ $levelTitle }}</span></div>
                                
                                @endif

                                <div class=" coursesfield row w-100 mx-0">
                                    <div class="course-text-width col-12 px-0">
                                    <h5 class="head-f-25 color-dark-blue text-center"><span>{{ ucwords($package->title) }}</span></h5>
                                    <div class="prich"><span>₹</span>{{number_format($package->amount,2)}}</div>
                                    
                                    <ul class="list">
                                        {!! $package->features !!}
                                        
                                        @if($activePlanId == $package->parent_id)
                                        <div class="activePlan text-center"><span>Free</span></div>
                                        @endif
                                        </div>
                                    </ul>
                                    <div class="col-12 mt-auto">
                                    <div class="bottomFooter">
                                        <div class="row justify-content-between align-items-center">
                                        <div class="col-12">
                                        @if(($activePlanId == $package->id) || ($activePlanId == $package->parent_id))

                                            <a href="{{ route('user.my-courses',$package->uuid) }}" class="btn viewMoreBtn fill unlock">Read More
                                            <svg width="14" height="12" viewBox="0 0 14 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M8 11L13 6L8 1" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M1 11L6 6L1 1" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                            </a>
                                        @else
                                            <a href="javascript:void(0);" class="btn viewMoreBtn fill">Upgrade Now
                                                <svg width="14" height="12" viewBox="0 0 14 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M8 11L13 6L8 1" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M1 11L6 6L1 1" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                            </a>
                                        @endif

                                        </div>
                                        </div>
                                    </div>
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
            </div>
          </div>
        </div>
      </div>
    <!-- End all plans -->

</div>

@push('scripts')

@endpush
