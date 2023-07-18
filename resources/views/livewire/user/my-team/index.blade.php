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
                      <th>S.no</th>
                      <th>My Refferal Code</th>
                      <th>Name</th>
                      <th>Referral ID</th>
                      <th>Mobile Number</th>
                      <th>Status</th>
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
                      <td>{{$team->first_name}} {{$team->last_name}}</td>
                      <td>{{$team->referral_code}}</td>
                      <td>{{$team->phone}}</td>
                      <td>
                        <label class="toggle-switch">
                          <input type="checkbox" class="toggleSwitch" wire:click.prevent="toggle({{$team->id}})" {{ $team->is_active == 1 ? 'checked' : '' }}>
                          <div class="switch-slider round"></div>
                        </label>
                      </td>
                      <td>{{$team->date_of_join}}</td>
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
            <div class="tab-pane fade" id="level-01" role="tabpanel" aria-labelledby="level-01-tab">
              <div class="table-responsive my-team-details">
                @elseif($activeTab == 'level_1')
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>S.no</th>
                      <th>My Refferal Code</th>
                      <th>Name</th>
                      <th>Referral ID</th>
                      <th>Mobile Number</th>
                      <th>Status</th>
                      <th>Joining Date
                        <span wire:click="sortBy('date_of_join')" class="float-right text-sm" style="cursor: pointer;">
                          <i class="fa fa-arrow-up {{ $sortColumnName === 'date_of_join' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                          <i class="fa fa-arrow-down {{ $sortColumnName === 'date_of_join' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                        </span>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @if($levelOneRecords->count() > 0)
                    @foreach($levelOneRecords as $levelone)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$levelone->my_referral_code}}</td>
                      <td>{{$levelone->first_name}} {{$levelone->last_name}}</td>
                      <td>{{$levelone->referral_code}}</td>
                      <td>{{$levelone->phone}}</td>
                      <td>
                        <label class="toggle-switch">
                          <input type="checkbox" class="toggleSwitch" wire:click.prevent="toggle({{$levelone->id}})" {{ $levelone->is_active == 1 ? 'checked' : '' }}>
                          <div class="switch-slider round"></div>
                        </label>
                      </td>
                      <td>{{$levelone->date_of_join}}</td>
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
              {{ $levelOneRecords->links('vendor.pagination.bootstrap-5') }}
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
                      <th>Referral ID</th>
                      <th>Mobile Number</th>
                      <th>Status</th>
                      <th>Joining Date
                        <span wire:click="sortBy('date_of_join')" class="float-right text-sm" style="cursor: pointer;">
                          <i class="fa fa-arrow-up {{ $sortColumnName === 'date_of_join' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                          <i class="fa fa-arrow-down {{ $sortColumnName === 'date_of_join' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                        </span>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @if($levelTwoRecords->count() > 0)
                    @foreach($levelTwoRecords as $leveltwo)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$leveltwo->my_referral_code}}</td>
                      <td>{{$leveltwo->first_name}} {{$leveltwo->last_name}}</td>
                      <td>{{$leveltwo->referral_code}}</td>
                      <td>{{$leveltwo->phone}}</td>
                      <td>
                        <label class="toggle-switch">
                          <input type="checkbox" class="toggleSwitch" wire:click.prevent="toggle({{$leveltwo->id}})" {{ $leveltwo->is_active == 1 ? 'checked' : '' }}>
                          <div class="switch-slider round"></div>
                        </label>
                      </td>
                      <td>{{$leveltwo->date_of_join}}</td>
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
              {{ $levelTwoRecords->links('vendor.pagination.bootstrap-5') }}
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
                      <th>Referral ID</th>
                      <th>Mobile Number</th>
                      <th>Status</th>
                      <th>Joining Date
                        <span wire:click="sortBy('date_of_join')" class="float-right text-sm" style="cursor: pointer;">
                          <i class="fa fa-arrow-up {{ $sortColumnName === 'date_of_join' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                          <i class="fa fa-arrow-down {{ $sortColumnName === 'date_of_join' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                        </span>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @if($levelThreeRecords->count() > 0)
                    @foreach($levelThreeRecords as $levelthree)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$levelthree->my_referral_code}}</td>
                      <td>{{$levelthree->first_name}} {{$levelthree->last_name}}</td>
                      <td>{{$levelthree->referral_code}}</td>
                      <td>{{$levelthree->phone}}</td>
                      <td>
                        <label class="toggle-switch">
                          <input type="checkbox" class="toggleSwitch" wire:click.prevent="toggle({{$levelthree->id}})" {{ $levelthree->is_active == 1 ? 'checked' : '' }}>
                          <div class="switch-slider round"></div>
                        </label>
                      </td>
                      <td>{{$levelthree->date_of_join}}</td>
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
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>