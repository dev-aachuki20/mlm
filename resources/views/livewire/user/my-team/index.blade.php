<div class="content-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="my-team-head">

            <h4 class="card-title">Level Information</h4>
            <ul class="nav nav-tabs my-team-tab-head" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link {{$activeTab == 'all' ? 'active' : ''}}" id="all-tab" data-toggle="tab" wire:click="switchTab('all')" href="#all" role="tab" aria-controls="all" aria-selected="true">all</a>
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

            <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
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
                    <input type="text" class="form-control" id="searchInput" placeholder="{{ __('global.search')}}" wire:model="search" />
                    <span id="clearSearch" class="clear-icon" wire:click.prevent="clearSearch"><i class="fas fa-times"></i></span>
                  </div>

                  <!-- End Search -->
                </div>
                @if($activeTab == 'all')
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>{{ trans('global.sno') }}</th>
                      <th>My {{ trans('cruds.user.fields.referral_code') }}</th>
                      <th>{{ trans('cruds.user.fields.name') }}</th>
                      <th>{{ trans('cruds.user.fields.sponser_id') }}</th>
                      <th>{{ trans('cruds.user.fields.sponser_name') }}</th>
                      <th>Mobile Number</th>
                      <th>Commission</th>
                      <th>Joining Date
                        <span wire:click="sortBy('date_of_join')" class="float-right text-sm" style="cursor: pointer;">
                          <i class="fa fa-arrow-up {{ $sortColumnName === 'date_of_join' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                          <i class="fa fa-arrow-down {{ $sortColumnName === 'date_of_join' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                        </span>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @if($allTeams->count() > 0)
                    @foreach($allTeams as $team)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$team->my_referral_code}}</td>
                      <td>{{ ucwords($team->name) }}</td>
                      <td>{{$team->referral_code}}</td>
                      <td>{{ ucwords($team->referral_name) }}</td>
                      <td>{{ $team->phone }}</td>
                      <td>&#8377; {{ number_format($team->refferalTransaction()->where('referrer_id',auth()->user()->id)->where('payment_type','credit')->sum('amount'),2) }} </td>
                      <td>{{ convertDateTimeFormat($team->date_of_join,'date')}}</td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                      <td class="text-center" colspan="8">{{ __('messages.no_record_found')}}</td>
                    </tr>
                    @endif
                  </tbody>
                </table>
              </div>

              {{ $allTeams->links('vendor.pagination.bootstrap-5') }}

            </div>
            <div class="tab-pane fade" id="level-01" role="tabpanel" aria-labelledby="level-01-tab">
              <div class="table-responsive my-team-details">
                @elseif($activeTab == 'level_1')
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>S.no</th>
                      <th>My Refferal Code</th>
                      <th>Name</th>
                      <th>{{ trans('cruds.user.fields.sponser_id') }}</th>
                      <th>{{ trans('cruds.user.fields.sponser_name') }}</th>
                      <th>Mobile Number</th>
                      <th>Commission</th>
                      <th>Joining Date
                        <span wire:click="sortBy('date_of_join')" class="float-right text-sm" style="cursor: pointer;">
                          <i class="fa fa-arrow-up {{ $sortColumnName === 'date_of_join' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                          <i class="fa fa-arrow-down {{ $sortColumnName === 'date_of_join' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                        </span>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @if($allTeams->count() > 0)
                    @foreach($allTeams as $levelone)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$levelone->my_referral_code}}</td>
                      <td>{{ ucwords($levelone->name) }}</td>
                      <td>{{$levelone->referral_code}}</td>
                      <td>{{ ucwords($levelone->referral_name) }}</td>
                      <td>{{$levelone->phone}}</td>
                      <td>&#8377; {{ number_format($levelone->refferalTransaction()->where('referrer_id',auth()->user()->id)->where('payment_type','credit')->sum('amount'),2) }} </td>
                      <td>{{ convertDateTimeFormat($levelone->date_of_join,'date')}}</td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                      <td class="text-center" colspan="8">{{ __('messages.no_record_found')}}</td>
                    </tr>
                    @endif
                  </tbody>
                </table>
              </div>
              {{ $allTeams->links('vendor.pagination.bootstrap-5') }}
            </div>
            <div class="tab-pane fade" id="level-02" role="tabpanel" aria-labelledby="level-02-tab">
              <div class="table-responsive my-team-details">
                @elseif($activeTab == 'level_2')
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>S.no</th>
                      <th>My Refferal Code</th>
                      <th>Name</th>
                      <th>{{ trans('cruds.user.fields.sponser_id') }}</th>
                      <th>{{ trans('cruds.user.fields.sponser_name') }}</th>
                      <th>Mobile Number</th>
                      <th>Commission</th>
                      <th>Joining Date
                        <span wire:click="sortBy('date_of_join')" class="float-right text-sm" style="cursor: pointer;">
                          <i class="fa fa-arrow-up {{ $sortColumnName === 'date_of_join' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                          <i class="fa fa-arrow-down {{ $sortColumnName === 'date_of_join' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                        </span>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @if($allTeams->count() > 0)
                    @foreach($allTeams as $leveltwo)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$leveltwo->my_referral_code}}</td>
                      <td>{{ ucwords($leveltwo->name) }}</td>
                      <td>{{$leveltwo->referral_code}}</td>
                      <td>{{ ucwords($leveltwo->referral_name) }}</td>
                      <td>{{$leveltwo->phone}}</td>
                      <td>&#8377; {{ number_format($leveltwo->refferalTransaction()->where('referrer_id',auth()->user()->id)->where('payment_type','credit')->sum('amount'),2) }} </td>
                      <td>{{ convertDateTimeFormat($leveltwo->date_of_join,'date')}}</td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                      <td class="text-center" colspan="8">{{ __('messages.no_record_found')}}</td>
                    </tr>
                    @endif
                  </tbody>
                </table>
              </div>

              {{ $allTeams->links('vendor.pagination.bootstrap-5') }}

            </div>
            <div class="tab-pane fade" id="level-03" role="tabpanel" aria-labelledby="level-03-tab">
              <div class="table-responsive my-team-details">
                @else
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>S.no</th>
                      <th>My Refferal Code</th>
                      <th>Name</th>
                      <th>{{ trans('cruds.user.fields.sponser_id') }}</th>
                      <th>{{ trans('cruds.user.fields.sponser_name') }}</th>
                      <th>Mobile Number</th>
                      <th>Commission</th>
                      <th>Joining Date
                        <span wire:click="sortBy('date_of_join')" class="float-right text-sm" style="cursor: pointer;">
                          <i class="fa fa-arrow-up {{ $sortColumnName === 'date_of_join' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                          <i class="fa fa-arrow-down {{ $sortColumnName === 'date_of_join' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                        </span>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @if($allTeams->count() > 0)
                    @foreach($allTeams as $levelthree)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$levelthree->my_referral_code}}</td>
                      <td>{{ucwords($levelthree->name)}}</td>
                      <td>{{$levelthree->referral_code}}</td>
                      <td>{{ ucwords($levelthree->referral_name) }}</td>
                      <td>{{$levelthree->phone}}</td>
                      <td>&#8377; {{ number_format($levelthree->refferalTransaction()->where('referrer_id',auth()->user()->id)->where('payment_type','credit')->sum('amount'),2) }} </td>
                      <td>{{ convertDateTimeFormat($levelthree->date_of_join,'date')}}</td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                      <td class="text-center" colspan="8">{{ __('messages.no_record_found')}}</td>
                    </tr>
                    @endif
                  </tbody>
                </table>
              </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
