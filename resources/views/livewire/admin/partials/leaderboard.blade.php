<div class="content-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="my-team-head">
              <h4 class="card-title">Leader Board</h4>
              <ul class="nav nav-tabs my-team-tab-head" id="myTab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link {{$activeTab == 'all' ? 'active' : ''}}" id="all-tab" data-toggle="tab" wire:click="switchTab('all')" href="#all" role="tab" aria-controls="all"
                    aria-selected="true">All Time</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{$activeTab == 'weekly' ? 'active' : ''}} " id="level-01-tab" data-toggle="tab" wire:click="switchTab('weekly')" href="#level-01" role="tab" aria-controls="level-01"
                    aria-selected="false">This week</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{$activeTab == 'monthly' ? 'active' : ''}}" id="level-02-tab" data-toggle="tab" wire:click="switchTab('monthly')" href="#level-02" role="tab" aria-controls="level-02"
                    aria-selected="false">This month</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{$activeTab == 'yearly' ? 'active' : ''}}" id="level-03-tab" data-toggle="tab" wire:click="switchTab('yearly')" href="#level-03" role="tab" aria-controls="level-03"
                    aria-selected="false">Yearly</a>
                </li>
              </ul>                    
            </div>
            <div class="tab-content border-0 p-0" id="myTabContent">
              {{-- Start all time records --}}
              <div class="tab-pane fade {{$activeTab == 'all' ? 'show active' : ''}} " id="all" role="tabpanel" aria-labelledby="all-tab">
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
                          <input type="text" class="form-control" id="searchInput" placeholder="{{ __('global.search')}}" wire:model="search"/>
                          <span id="clearSearch" class="clear-icon" wire:click.prevent="clearSearch"><i class="fas fa-times"></i></span>
                      </div>
                      <!-- End Search -->
                  </div>
                  <table class="table table-striped">
                    <tbody>
                      @if($allTimeTopRecords)
                        @if($allTimeTopRecords->count() > 0)
                          @foreach($allTimeTopRecords as $serialNo => $record)
                            <tr>
                              <td class="pr-0"  width="50px">
                                <img src="{{ $record->user->profile_image_url ? $record->user->profile_image_url : asset(config('constants.default.profile_image'))  }}" alt="image">
                              </td>
                              <td>
                                <div class="profile-name-re">
                                  {{ ucwords($record->user->name) }}
                                  <span>{{ $record->payment->package->title ?? null }} &#8377 {{ number_format( $record->payment->package->amount,2) }}</span>
                                </div>
                              </td>
                              <td class="text-right"><strong>&#8377 {{ number_format($record->total_amount,2) }}</strong></td>
                            </tr>
                          @endforeach
                        @else
                          <tr><td colspan="2">No Record Found!</td></tr>
                        @endif
                      @endif
                    </tbody>
                  </table>

                  @if($allTimeTopRecords)
                    {{ $allTimeTopRecords->links('vendor.pagination.bootstrap-5') }}
                  @endif

                </div>
              </div>
              {{-- End all time records --}}

              {{-- Start weekly records --}}
              <div class="tab-pane fade {{$activeTab == 'weekly' ? 'show active' : ''}}" id="level-01" role="tabpanel" aria-labelledby="level-01-tab">
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
                        <input type="text" class="form-control" id="searchInput" placeholder="{{ __('global.search')}}" wire:model="search"/>
                        <span id="clearSearch" class="clear-icon" wire:click.prevent="clearSearch"><i class="fas fa-times"></i></span>
                    </div>
                    <!-- End Search -->
                </div>
                  <table class="table table-striped">
                    <tbody>
                      @if($weeklyTopRecords)
                        @if($weeklyTopRecords->count() > 0)
                          @foreach($weeklyTopRecords as $serialNo => $record)
                            <tr>
                              <td class="pr-0"  width="50px">
                                <img src="{{ $record->user->profile_image_url ? $record->user->profile_image_url : asset(config('constants.default.profile_image'))  }}" alt="image">
                              </td>
                              <td>
                                <div class="profile-name-re">
                                  {{ ucwords($record->user->name) }}
                                  <span>{{ $record->payment->package->title ?? null }} &#8377 {{ number_format( $record->payment->package->amount,2) }}</span>
                                </div>
                              </td>
                              <td class="text-right"><strong>&#8377 {{ number_format($record->total_amount,2) }}</strong></td>
                            </tr>
                          @endforeach
                        @else
                          <tr><td colspan="2">No Record Found!</td></tr>
                        @endif
                      @endif
                    </tbody>
                  </table>
                  @if($weeklyTopRecords)
                    {{ $weeklyTopRecords->links('vendor.pagination.bootstrap-5') }}
                  @endif
                </div>
              </div>
              {{-- End weekly records --}}

              {{-- Start monthly records --}}
              <div class="tab-pane fade {{$activeTab == 'monthly' ? 'show active' : ''}}" id="level-02" role="tabpanel" aria-labelledby="level-02-tab">
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
                        <input type="text" class="form-control" id="searchInput" placeholder="{{ __('global.search')}}" wire:model="search"/>
                        <span id="clearSearch" class="clear-icon" wire:click.prevent="clearSearch"><i class="fas fa-times"></i></span>
                    </div>
                    <!-- End Search -->
                  </div>
                  <table class="table table-striped">
                    <tbody>
                      @if($monthlyTopRecords)
                        @if($monthlyTopRecords->count() > 0)
                          @foreach($monthlyTopRecords as $serialNo => $record)
                            <tr>
                              <td class="pr-0"  width="50px">
                                <img src="{{ $record->user->profile_image_url ? $record->user->profile_image_url : asset(config('constants.default.profile_image'))  }}" alt="image">
                              </td>
                              <td>
                                <div class="profile-name-re">
                                  {{ ucwords($record->user->name) }}
                                  <span>{{ $record->payment->package->title ?? null }} &#8377 {{ number_format( $record->payment->package->amount,2) }}</span>
                                </div>
                              </td>
                              <td class="text-right"><strong>&#8377 {{ number_format($record->total_amount,2) }}</strong></td>
                            </tr>
                          @endforeach
                        @else
                          <tr><td colspan="2">No Record Found!</td></tr>
                        @endif
                      @endif
                    </tbody>
                  </table>
                  @if($monthlyTopRecords)
                    {{ $monthlyTopRecords->links('vendor.pagination.bootstrap-5') }}
                  @endif
                </div>
              </div>
              {{-- End monthly records --}}

              {{-- Start yearly records --}}
              <div class="tab-pane fade {{$activeTab == 'yearly' ? 'show active' : ''}}" id="level-03" role="tabpanel" aria-labelledby="level-03-tab">
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
                          <input type="text" class="form-control" id="searchInput" placeholder="{{ __('global.search')}}" wire:model="search"/>
                          <span id="clearSearch" class="clear-icon" wire:click.prevent="clearSearch"><i class="fas fa-times"></i></span>
                      </div>
                      <!-- End Search -->
                  </div>
                  <table class="table table-striped">
                    <tbody>
                      @if($yearlyTopRecords)
                        @if($yearlyTopRecords->count() > 0)
                          @foreach($yearlyTopRecords as $serialNo => $record)
                            <tr>
                              <td class="pr-0"  width="50px">
                                <img src="{{ $record->user->profile_image_url ? $record->user->profile_image_url : asset(config('constants.default.profile_image'))  }}" alt="image">
                              </td>
                              <td>
                                <div class="profile-name-re">
                                  {{ ucwords($record->user->name) }}
                                  <span>{{ $record->payment->package->title ?? null }} &#8377 {{ number_format( $record->payment->package->amount,2) }}</span>
                                </div>
                              </td>
                              <td class="text-right"><strong>&#8377 {{ number_format($record->total_amount,2) }}</strong></td>
                            </tr>
                          @endforeach
                        @else
                          <tr><td colspan="2">No Record Found!</td></tr>
                        @endif
                      @endif
                    </tbody>
                  </table>
                  @if($yearlyTopRecords)
                    {{ $yearlyTopRecords->links('vendor.pagination.bootstrap-5') }}
                  @endif
                </div>
              </div>
              {{-- End yearly records --}}

            </div>                  
          </div>
        </div>
      </div>
    </div>
</div>