<div class="content-wrapper bg-white">
    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="watch-our-introductory">
          <div class="introductory-text">
            <h1>{{ getSetting('introduction_video_title') }}</h1>
            <p>{!! getSetting('introduction_video_description') !!}</p>
          </div>
          <div class="introductory-video">
            @php
              $introVideo = getSettingDetail('introduction_video');
              $introVideoImage = getSetting('introduction_video_image');
            @endphp
            <div class="box-video">
              <div class="bg-video" style="background-image: url({{ $introVideoImage ? $introVideoImage : asset('images/package.png') }});">
                <div class="bt-play">
                  <svg width="55" height="55" viewBox="0 0 55 55" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M41.7108 27.5123L20.4197 13.9199V41.1046L41.7108 27.5123Z" fill="white"></path>
                    <path d="M22.9631 53.1667C22.8666 53.1667 22.77 53.1581 22.6722 53.1398C20.0787 52.6546 17.5817 51.7783 15.2509 50.5365C12.9715 49.3216 10.8863 47.7767 9.05423 45.9458C7.22212 44.1137 5.67723 42.0286 4.46356 39.7491C3.22178 37.4184 2.34667 34.9214 1.86023 32.3278C1.70012 31.4735 2.26356 30.6509 3.11789 30.4908C3.97223 30.3307 4.79478 30.8941 4.9549 31.7485C6.68067 40.9665 14.0323 48.3194 23.2503 50.0439C24.1047 50.204 24.6681 51.0266 24.508 51.8809C24.3675 52.6387 23.7062 53.1667 22.9631 53.1667Z" fill="white"></path>
                    <path d="M32.0369 53.1667C31.2938 53.1667 30.6326 52.6387 30.4908 51.8821C30.3307 51.0278 30.8941 50.2053 31.7484 50.0451C40.9665 48.3194 48.3193 40.9677 50.0439 31.7497C50.204 30.8954 51.0266 30.3319 51.8809 30.492C52.7352 30.6521 53.2987 31.4747 53.1386 32.329C52.6533 34.9226 51.777 37.4196 50.5352 39.7504C49.3203 42.0298 47.7754 44.1149 45.9446 45.947C44.1124 47.7791 42.0273 49.324 39.7479 50.5377C37.4171 51.7795 34.9201 52.6546 32.3266 53.141C32.23 53.1581 32.1322 53.1667 32.0369 53.1667Z" fill="white"></path>
                    <path d="M3.40985 24.5361C3.3133 24.5361 3.21674 24.5275 3.11896 24.5092C2.26463 24.3491 1.70119 23.5265 1.8613 22.6722C2.34652 20.0786 3.22285 17.5816 4.46463 15.2509C5.67952 12.9714 7.22441 10.8863 9.0553 9.0542C10.8874 7.22209 12.9725 5.6772 15.252 4.46353C17.5827 3.22175 20.0797 2.34664 22.6733 1.8602C23.5276 1.70009 24.3502 2.26353 24.5103 3.11786C24.6704 3.9722 24.107 4.79475 23.2526 4.95486C14.0334 6.68064 6.68052 14.0335 4.95596 23.2515C4.81419 24.0081 4.15296 24.5361 3.40985 24.5361Z" fill="white"></path>
                    <path d="M51.59 24.5361C50.8469 24.5361 50.1857 24.0081 50.0439 23.2515C48.3181 14.0335 40.9664 6.68064 31.7484 4.95609C30.8941 4.79597 30.3307 3.97342 30.4908 3.11909C30.6509 2.26475 31.4734 1.70131 32.3278 1.86142C34.9213 2.34664 37.4183 3.22297 39.7491 4.46475C42.0286 5.67964 44.1137 7.22453 45.9458 9.05542C47.7779 10.8875 49.3228 12.9726 50.5364 15.2521C51.7782 17.5829 52.6533 20.0799 53.1398 22.6734C53.2999 23.5278 52.7364 24.3503 51.8821 24.5104C51.7843 24.5275 51.6866 24.5361 51.59 24.5361Z" fill="white"></path>
                    </svg>
                </div>
              </div>
              <div class="video-container">

                @if($introVideo->video)
                  <video controls="" width="450" height="315" preload="none" poster="{{ $introVideoImage ? $introVideoImage : asset('images/package.png') }}" id="introductionVideo"  playsinline>
                    <source class="js-video" src="{{ $introVideo->video_url }}" type="video/{{ $introVideo->video->extension }}">
                  </video>
                @else
                  <iframe width="560" height="315" src="https://www.youtube.com/embed/DGFvSDGUPCY" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen=""></iframe>
                @endif

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- Start package selling overview --}}
    <h3>Package Selling Overview</h3><hr>
    <div class="row row-gap-30 package-statistics">
      <div class="col-lg-3 col-md-4 col-sm-12">
        <div class="old-lace card-box">
          <div class="right-icon">
            <img src="{{ asset('images/icons/right-icon-1.svg') }}" alt="right-icon-1">
          </div>
          <div class="bg-white icon-main">
            <img src="{{ asset('images/icons/today.svg') }}" alt="1">
          </div>
          <div class="price-box">&#8377 {{ number_format($todayEarnings,2) }}</div>
          <div class="box-discrip">

              @if($todayEarningPercent > 0)
                <span class="text-green">
                  <img src="{{ asset('images/icons/up-graph.svg') }}">
                  {{$todayEarningPercent}}%
                </span>
              @else
              <span class="text-red">
                <img src="{{ asset('images/icons/down-graph.svg') }}">
                {{$todayEarningPercent}}%
              </span>
              @endif

             Today's Earning</div>
        </div>
      </div>
      <div class="col-lg-3 col-md-4 col-sm-12">
        <div class="titan-white card-box">
          <div class="right-icon">
            <img src="{{ asset('images/icons/right-icon-2.svg') }}" alt="right-icon-1">
          </div>
          <div class="bg-white icon-main">
            <img src="{{ asset('images/icons/secen-day.svg') }}" alt="1">
          </div>
          <div class="price-box">&#8377 {{ number_format($last7DaysEarnings,2) }}</div>
          <div class="box-discrip">
              @if($last7DaysEarningPercent > 0)
                <span class="text-green">
                  <img src="{{ asset('images/icons/up-graph.svg') }}">
                  {{$last7DaysEarningPercent}}%
                </span>
              @else
              <span class="text-red">
                <img src="{{ asset('images/icons/down-graph.svg') }}">
                {{$last7DaysEarningPercent}}%
              </span>
              @endif
              Last 7 Days Earning</div>
        </div>
      </div>
      <div class="col-lg-3 col-md-4 col-sm-12">
        <div class="pearl card-box">
          <div class="right-icon">
            <img src="{{ asset('images/icons/right-icon-3.svg') }}" alt="right-icon-1">
          </div>
          <div class="bg-white icon-main">
            <img src="{{ asset('images/icons/3.svg') }}" alt="1">
          </div>
          <div class="price-box">&#8377 {{ number_format($last30DaysEarnings,2) }}</div>
          <div class="box-discrip">
            <span class="text-red">
              @if($last30DaysEarningPercent > 0)
                <span class="text-green">
                  <img src="{{ asset('images/icons/up-graph.svg') }}">
                  {{$last30DaysEarningPercent}}%
                </span>
              @else
              <span class="text-red">
                <img src="{{ asset('images/icons/down-graph.svg') }}">
                {{$last30DaysEarningPercent}}%
              </span>
              @endif
            </span>30 Days Earning</div>
        </div>
      </div>
      <div class="col-lg-3 col-md-4 col-sm-12">
        <div class="lily-white card-box">
          <div class="right-icon">
            <img src="{{ asset('images/icons/right-icon-4.svg')}}" alt="right-icon-1">
          </div>
          <div class="bg-white icon-main">
            <img src="{{ asset('images/icons/4.svg') }}" alt="1">
          </div>
          <div class="price-box">&#8377 {{ number_format($allTimeEarning,2) }}</div>
          <div class="box-discrip">
            @if($allTimeEarningPercent > 0)
              <span class="text-green">
                <img src="{{ asset('images/icons/up-graph.svg') }}">
                {{$allTimeEarningPercent}}%
              </span>
            @else
            <span class="text-red">
              <img src="{{ asset('images/icons/down-graph.svg') }}">
              {{$allTimeEarningPercent}}%
            </span>
            @endif
            All Time Earning</div>
        </div>
      </div>
      <div class="col-lg-3 col-md-4 col-sm-12">
        <div class="hint-green card-box">
          <div class="right-icon">
            <img src="{{ asset('images/icons/right-icon-5.svg') }}" alt="right-icon-1">
          </div>
          <div class="bg-white icon-main">
            <img src="{{ asset('images/icons/5.svg') }}" alt="1">
          </div>
          <div class="price-box">&#8377 {{ number_format($levelCommission,2) }}</div>
          <div class="box-discrip">Distribute Level Commission</div>
        </div>
      </div>
      <div class="col-lg-3 col-md-4 col-sm-12">
        <div class="lily-white-off card-box">
          <div class="right-icon">
            <img src="{{ asset('images/icons/right-icon-6.svg') }}" alt="right-icon-1">
          </div>
          <div class="bg-white icon-main">
            <img src="{{ asset('images/icons/6.svg') }}" alt="1">
          </div>
          <div class="price-box">&#8377 {{ number_format($totalWithdrawal,2) }}</div>
          <div class="box-discrip">Total Withdrawal</div>
        </div>
      </div>
      <div class="col-lg-3 col-md-4 col-sm-12">
        <div class="old-lace card-box">
          <div class="label">Remaining balance in your wallet</div>
          <div class="bg-white icon-main">
            <img src="{{ asset('images/icons/7.svg') }}" alt="1">
          </div>
          <div class="price-box">&#8377 {{ number_format($availableBalance,2) }}</div>
          <div class="box-discrip">Available Balance</div>
        </div>
      </div>
      <div class="col-lg-3 col-md-4 col-sm-12">
        <div class="linen card-box">
          <div class="right-icon">
            <img src="{{ asset('images/icons/right-icon-8.svg') }}" alt="right-icon-8">
          </div>
          <div class="bg-white icon-main">
            <img src="{{ asset('images/icons/8.svg') }}" alt="1">
          </div>
          <div class="price-box">&#8377 {{ number_format($netProfit,2) }}</div>
          <div class="box-discrip">Net Profit</div>
        </div>
      </div>
    </div>
    {{-- End package selling overview --}}
    <hr>


    <div class="row">
      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          {{-- Start chart --}}
          <div class="card-body">
           <div class="d-block ">
            <p class="card-title border-0">Income Growth</p>
           </div>
            <canvas id="income-growth-chart"></canvas>
          </div>
        </div>
      </div>
      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
           <div class="d-block">
            <p class="card-title border-0">Today New Joiner</p>
           </div>
           <div class="recent-list">
             <ul class="icon-data-list">
              @if($todayNewJoiners->count() > 0)
               @foreach($todayNewJoiners as $newJoiner)
                <li>
                  <div class="d-flex recent-list-detail">
                    <img src="{{ $newJoiner->profile_image_url ? $newJoiner->profile_image_url : asset(config('constants.default.profile_image')) }}" alt="user">
                    <div class="leaderboard-row">{{ ucwords($newJoiner->name) }}</div>
                  </div>
                  @php
                    $amount = $newJoiner->payments()->sum('amount');
                  @endphp
                  <div class="price-recent">&#8377 {{ number_format($amount,2) }}</div>
                </li>
               @endforeach
               @else
               <li>No Record Found!</li>
              @endif
            </ul>
           </div>
          </div>
        </div>
      </div>
    </div>

  {{-- Start Leaderboad --}}
  <div class="row">
    <div class="col-md-12 col-sm-12">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center pb-3 border-b-1  mb-4">
            <p class="card-title border-0 mb-0 p-0">Leader Board</p>
            <a href="{{ route('admin.leaderboard') }}" class="text-info">View all</a>
          </div>
          <div class="row row-gap-30 leader-board-dashboard">
            <div class="col-lg-3 col-md-4 col-sm-12">
              <p class="small-title">This Week ({{\Carbon\Carbon::now()->startOfWeek()->format('d')}} - {{\Carbon\Carbon::now()->endOfWeek()->format('d')}} {{\Carbon\Carbon::now()->format('M')}})</p>
              <div class="recent-list small-text h-auto">
                <ul class="icon-data-list">
                  @if($weeklyTopRecords->count() > 0)
                    @foreach($weeklyTopRecords as $record)
                    @if($record->user)
                    <li>
                      <div class="d-flex recent-list-detail">
                        <img src="{{ $record->user->profile_image_url ? $record->user->profile_image_url : asset(config('constants.default.profile_image'))  }}" alt="user">
                        <div class="leaderboard-row">
                          {{ ucwords($record->user->name) }}
                          <span>{{ $record->payment->package->title ?? null }} &#8377 {{ number_format( $record->payment->package->amount,2) }}</span>
                        </div>
                      </div>
                      <div class="price-recent">&#8377 {{ number_format($record->total_amount,2) }}</div>
                    </li>
                    @endif
                    @endforeach
                  @else
                    <li>No Record Found!</li>
                  @endif
                </ul>
              </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-12">
              <p class="small-title">This Month ({{\Carbon\Carbon::now()->startOfMonth()->format('d')}} - {{\Carbon\Carbon::now()->endOfMonth()->format('d')}} {{\Carbon\Carbon::now()->format('M')}})</p>
              <div class="recent-list small-text h-auto">
                <ul class="icon-data-list">
                  @if($monthlyTopRecords->count() > 0)
                    @foreach($monthlyTopRecords as $record)
                     @if($record->user)
                      <li>
                        <div class="d-flex recent-list-detail">
                          <img src="{{ $record->user->profile_image_url ? $record->user->profile_image_url : asset(config('constants.default.profile_image'))  }}" alt="user">
                          <div class="leaderboard-row">
                            {{ ucwords($record->user->name) }}
                             <span>{{ $record->payment->package->title ?? null }} &#8377 {{ $record->payment->package ? number_format( $record->payment->package->amount,2) : '' }}</span>
                          </div>
                        </div>
                        <div class="price-recent">&#8377 {{ number_format($record->total_amount,2) }}</div>
                      </li>
                      @endif
                      @endforeach
                    @else
                      <li>No Record Found!</li>
                    @endif
                </ul>
              </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-12">
              <p class="small-title">Yearly ({{getFinancialYearMonths()[0]}} - {{getFinancialYearMonths()[11]}})</p>
              <div class="recent-list small-text h-auto">
                <ul class="icon-data-list">
                  @if($yearlyTopRecords->count() > 0)
                    @foreach($yearlyTopRecords as $record)
                     @if($record->user)
                        <li>
                          <div class="d-flex recent-list-detail">
                            <img src="{{ $record->user->profile_image_url ? $record->user->profile_image_url : asset(config('constants.default.profile_image'))  }}" alt="user">
                            <div class="leaderboard-row">
                              {{ ucwords($record->user->name) }}
                              <span>{{ $record->payment->package->title ?? null }} &#8377 {{ $record->payment->package ? number_format( $record->payment->package->amount,2) : '' }}</span>
                            </div>
                          </div>
                          <div class="price-recent">&#8377 {{ number_format($record->total_amount,2) }}</div>
                        </li>
                     @endif
                    @endforeach
                  @else
                    <li>No Record Found!</li>
                  @endif
                </ul>
              </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-12">
              <p class="small-title">All Time</p>
              <div class="recent-list small-text h-auto">
                <ul class="icon-data-list">

                  @if($allTimeTopRecords->count() > 0)
                    @foreach($allTimeTopRecords as $record)
                     @if($record->user)
                        <li>
                          <div class="d-flex recent-list-detail">
                            <img src="{{ $record->user->profile_image_url ? $record->user->profile_image_url : asset(config('constants.default.profile_image'))  }}" alt="user">
                            <div class="leaderboard-row">
                              {{ ucwords($record->user->name) }}
                              <span>{{ $record->payment->package->title ?? null }} &#8377 {{ $record->payment->package ? number_format( $record->payment->package->amount,2) : '' }}</span>
                            </div>
                          </div>
                          <div class="price-recent">&#8377 {{ number_format($record->total_amount,2) }}</div>
                        </li>
                    @endif
                    @endforeach
                  @else
                    <li>No Record Found!</li>
                  @endif

                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  {{-- End Leaderboad --}}

  </div>
  <!-- End content-wrapper -->

  @push('scripts')
  <!-- Custom js for this page-->
  <script src="{{ asset('admin/assets/chart.js/Chart.min.js') }}"></script>

  <script type="text/javascript">
    $(document).ready(function(){

      // video js
      $(".box-video").click(function(){
        var videoId = $(this).find('.video-container video').attr('id');
        var video = document.getElementById(videoId);
        video.play();

        $('video source',this)[0].src;
        $(this).addClass('open');
      });

      var weekData = [{{implode(',',$incomeGrowthChart['week_data'])}}];
      var ctx = document.getElementById('income-growth-chart').getContext('2d');
      var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: [{!! "'".implode("','",$incomeGrowthChart['labels'])."'" !!}],
          datasets: [{
            label: 'Distribute Level Commision',
            data: weekData,
            backgroundColor: '#f24f00', // Customize the bar color
            borderColor: '#f24f00', // Customize the bar border color
            borderWidth: 1
          }]
        },
        options: {
          legend: {
              display: false
          },
          scales: {
            y: {
              beginAtZero: true // Start the y-axis from zero
            }
          }
        }
      });

    });
  </script>
  @endpush
