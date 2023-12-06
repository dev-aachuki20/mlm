<div>
  <!-- Start Level overview earning -->
<div class="card mb-4">
    <div class="card-header background-purple-color">
        <label class="font-weight-bold">Level Overview Earning</label>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-4">
                <label class="font-weight-bold">{{ __('cruds.user.level.level_01_earning') }}</label> :
                <span class="p-2">&#8377; {{number_format($level1Comm,2)}}</span>
            </div>
            <div class="col-sm-4">
                <label class="font-weight-bold">{{ __('cruds.user.level.level_02_earning') }}</label> :
                <span class="p-2">&#8377; {{number_format($level2Comm,2)}}</span>
            </div>
            <div class="col-sm-4">
                <label class="font-weight-bold">{{ __('cruds.user.level.level_03_earning') }}</label> :
                <span class="p-2">&#8377; {{number_format($level3Comm,2)}} </span>
            </div>
        </div>
    </div>
</div>
<!-- End Level overview earning  -->



<div class="content-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="my-team-head">
            <h4 class="card-title">Level Information</h4>
            <ul class="nav nav-tabs my-team-tab-head" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link {{$activeTab == 'all' ? 'active' : ''}}" id="all-tab" data-toggle="tab" data-label="all" wire:click="switchTab('all')" href="#all" role="tab" aria-controls="all" aria-selected="true">all</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{$activeTab == 'level_1' ? 'active' : ''}}" id="level-01-tab" data-toggle="tab" wire:click="switchTab('level_1')" href="#level-01" role="tab" aria-controls="level-01" aria-selected="false">level 01</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{$activeTab == 'level_2' ? 'active' : ''}}" id="level-02-tab" data-toggle="tab" wire:click="switchTab('level_2')" href="#level-02" role="tab" aria-controls="level-02" aria-selected="false">level 02</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{$activeTab == 'level_3' ? 'active' : ''}}" id="level-03-tab" data-toggle="tab" wire:click="switchTab('level_3')" href="#level-03" role="tab" aria-controls="level-03" aria-selected="false">level 03</a>
              </li>
            </ul>
          </div>
          <div class="tab-content border-0 p-0" id="myTabContent">

            <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab" >
              <div class="table-responsive my-team-details leaderboard-data">
                <div class="table-header-plugins">
                  <!-- Start show length -->
                  <div class="dataTables_length">
                        <label>Show
                            <select wire:change="$emit('updatePaginationLength', $event.target.value)">
                                @foreach(config('constants.datatable_paginations') as $length)
                                <option value="{{ $length }}">{{ $length }}</option>
                                @endforeach
                            </select>
                        entries</label>
                 </div>
                  <!-- End show length -->
                  <!--Start search  -->
                  <div class="search-container">
                    <input type="text" class="form-control" id="all_searchInput" placeholder="{{ __('global.search')}}" wire:model="search" />
                    <span id="clearSearch" class="clear-icon" wire:click.prevent="clearSearch"><i class="fas fa-times"></i></span>
                  </div>

                  <!-- End Search -->
                </div>
               <!-- table 1 -->
               @if($activeTab == 'all')
                <table class="table table-striped">
                  <thead>
                    <tr>
                        <th>{{ trans('global.sno') }}</th>
                        <th>{{ trans('cruds.user.fields.name')}}</th>
                        <th>{{ trans('cruds.user.fields.email')}}</th>
                        <th>{{ trans('cruds.user.fields.phone')}}</th>
                        <th>Commission</th>
                        <th>{{ trans('cruds.user.fields.date_of_join')}}</th>
                    </tr>
                  </thead>
                  <tbody>
                @if($allTeams->count() > 0)
                @foreach($allTeams as $team)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{ucwords($team->name)}}</td>
                    <td>{{$team->email}}</td>
                    <td>{{$team->phone}}</td>

                    <td>&#8377; {{ number_format($team->refferalTransaction()->where('referrer_id',$user_id)->where('payment_type','credit')->sum('amount'),2) }} </td>

                    <td>{{ convertDateTimeFormat($team->date_of_join,'date')}}</td>
                  </tr>
                @endforeach
                @else
                <tr>
                    <td class="text-center" colspan="6">{{ __('messages.no_record_found')}}</td>
                </tr>
                @endif
                  </tbody>
                </table>
                <!-- table 1 end -->
              </div>
               {{$allTeams->links('vendor.pagination.bootstrap-5') }}
            </div>

            <div class="tab-pane fade" id="level-01" role="tabpanel" aria-labelledby="level-01-tab" >
              <div class="table-responsive my-team-details leaderboard-data">
              <div class="table-header-plugins">
                  <!-- Start show length -->
                  <div class="dataTables_length">
                        <label>Show
                            <select wire:change="$emit('updatePaginationLength', $event.target.value)">
                                @foreach(config('constants.datatable_paginations') as $length)
                                <option value="{{ $length }}">{{ $length }}</option>
                                @endforeach
                            </select>
                        entries</label>
                 </div>
                  <!-- End show length -->
                  <!--Start search  -->
                  <div class="search-container">
                    <input type="text" class="form-control" id="level_one_searchInput" placeholder="{{ __('global.search')}}" wire:model="search" />
                    <span id="clearSearch" class="clear-icon" wire:click.prevent="clearSearch"><i class="fas fa-times"></i></span>
                  </div>

                  <!-- End Search -->
                </div>
                @elseif($activeTab == 'level_1')
                <table class="table table-striped">
                  <thead>
                  <tr>
                        <th>{{ trans('global.sno') }}</th>
                        <th>{{ trans('cruds.user.fields.name')}}</th>
                        <th>{{ trans('cruds.user.fields.email')}}</th>
                        <th>{{ trans('cruds.user.fields.phone')}}</th>
                        <th>Commission</th>
                        <th>{{ trans('cruds.user.fields.date_of_join')}}</th>
                    </tr>
                  </thead>
                  <tbody>
                  @if($allTeams->count() > 0)
                  @foreach($allTeams as $team)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{ucwords($team->name)}}</td>
                    <td>{{$team->email}}</td>
                    <td>{{$team->phone}}</td>
                    <td>&#8377; {{ number_format($team->refferalTransaction()->where('referrer_id',$user_id)->where('payment_type','credit')->sum('amount'),2) }} </td>
                    <td>{{ convertDateTimeFormat($team->date_of_join,'date')}}</td>
                  </tr>
                  @endforeach
                @else
                <tr>
                    <td class="text-center" colspan="6">{{ __('messages.no_record_found')}}</td>
                </tr>
                @endif
                  </tbody>
                </table>
              </div>
             {{ $allTeams->links('vendor.pagination.bootstrap-5') }}
            </div>

            <div class="tab-pane fade" id="level-02" role="tabpanel" aria-labelledby="level-02-tab" >
              <div class="table-responsive my-team-details leaderboard-data">
              <div class="table-header-plugins">
                  <!-- Start show length -->
                  <div class="dataTables_length">
                        <label>Show
                            <select wire:change="$emit('updatePaginationLength', $event.target.value)">
                                @foreach(config('constants.datatable_paginations') as $length)
                                <option value="{{ $length }}">{{ $length }}</option>
                                @endforeach
                            </select>
                        entries</label>
                 </div>
                  <!-- End show length -->
                  <!--Start search  -->
                  <div class="search-container">
                    <input type="text" class="form-control" id="level_two_searchInput" placeholder="{{ __('global.search')}}" wire:model="search" />
                    <span id="clearSearch" class="clear-icon" wire:click.prevent="clearSearch"><i class="fas fa-times"></i></span>
                  </div>

                  <!-- End Search -->
                </div>
                @elseif($activeTab == 'level_2')
                <table class="table table-striped">
                  <thead>
                    <tr>
                        <th>{{ trans('global.sno') }}</th>
                        <th>{{ trans('cruds.user.fields.name')}}</th>
                        <th>{{ trans('cruds.user.fields.email')}}</th>
                        <th>{{ trans('cruds.user.fields.phone')}}</th>
                        <th>Commission</th>
                        <th>{{ trans('cruds.user.fields.date_of_join')}}</th>
                    </tr>
                  </thead>
                  <tbody>
                  @if($allTeams->count() > 0)
                  @foreach($allTeams as $team)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ucwords($team->name)}}</td>
                        <td>{{$team->email}}</td>
                        <td>{{$team->phone}}</td>
                        <td>&#8377; {{ number_format($team->refferalTransaction()->where('referrer_id',$user_id)->where('payment_type','credit')->sum('amount'),2) }} </td>
                        <td>{{ convertDateTimeFormat($team->date_of_join,'date')}}</td>
                      </tr>
                  @endforeach
                @else
                <tr>
                    <td class="text-center" colspan="6">{{ __('messages.no_record_found')}}</td>
                </tr>
                @endif
                  </tbody>
                </table>
              </div>
               {{$allTeams->links('vendor.pagination.bootstrap-5') }}
            </div>

            <div class="tab-pane fade" id="level-03" role="tabpanel" aria-labelledby="level-03-tab" >
              <div class="table-responsive my-team-details leaderboard-data">
              <div class="table-header-plugins">
                  <!-- Start show length -->
                  <div class="dataTables_length">
                        <label>Show
                            <select wire:change="$emit('updatePaginationLength', $event.target.value)">
                                @foreach(config('constants.datatable_paginations') as $length)
                                <option value="{{ $length }}">{{ $length }}</option>
                                @endforeach
                            </select>
                        entries</label>
                 </div>
                  <!-- End show length -->
                  <!--Start search  -->
                  <div class="search-container">
                    <input type="text" class="form-control" id="level_three_searchInput" placeholder="{{ __('global.search')}}" wire:model="search" />
                    <span id="clearSearch" class="clear-icon" wire:click.prevent="clearSearch"><i class="fas fa-times"></i></span>
                  </div>

                  <!-- End Search -->
                </div>
                @else
                <table class="table table-striped">
                  <thead>
                    <tr>
                        <th>{{ trans('global.sno') }}</th>
                        <th>{{ trans('cruds.user.fields.name')}}</th>
                        <th>{{ trans('cruds.user.fields.email')}}</th>
                        <th>{{ trans('cruds.user.fields.phone')}}</th>
                        <th>Commission</th>
                        <th>{{ trans('cruds.user.fields.date_of_join')}}</th>
                    </tr>
                  </thead>
                  <tbody>
                  @if($allTeams->count() > 0)
                  @foreach($allTeams as $team)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ucwords($team->name)}}</td>
                        <td>{{$team->email}}</td>
                        <td>{{$team->phone}}</td>
                        <td>&#8377; {{ number_format($team->refferalTransaction()->where('referrer_id',$user_id)->where('payment_type','credit')->sum('amount'),2) }} </td>
                        <td>{{ convertDateTimeFormat($team->date_of_join,'date')}}</td>
                      </tr>
                  @endforeach
                @else
                <tr>
                    <td class="text-center" colspan="6">{{ __('messages.no_record_found')}}</td>
                </tr>
                @endif
                  </tbody>
                </table>
              </div>
              {{$allTeams->links('vendor.pagination.bootstrap-5') }}
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
<!-- <script>
  $(document).on('click','.data-label',function(){
     console.log('hello');
  });

  $('.data-label').click(function(){
     var data =  $this.data('label');
    Livewire.emit('switchLebel', data);
  })
</script> -->
@endpush













