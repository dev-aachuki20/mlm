<div class="content-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="my-team-head">
            <h4 class="card-title">Statement Information</h4>
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
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>S.no</th>
                      <th>Payment Type</th>
                      <th>Amount</th>
                      <th>Referrer Name</th>
                      <th>Gateway</th>
                      <th>Level</th>
                      <th>Created At
                        <span wire:click="sortBy('date_of_join')" class="float-right text-sm" style="cursor: pointer;">
                          <i class="fa fa-arrow-up {{ $sortColumnName === 'date_of_join' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                          <i class="fa fa-arrow-down {{ $sortColumnName === 'date_of_join' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                        </span>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @if($allTransaction->count() > 0)
                    @foreach($allTransaction as $transaction)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{ucfirst($transaction->payment_type)}}</td>
                      <td>&#8377; {{number_format($transaction->amount,2)}}</td>
                      <td>{{ ucwords($transaction->user->name) }}</td>
                      <td> {{ ucfirst(config('constants.gateway')[$transaction->gateway])}}</td>
                      <td> {{ ucfirst(config('constants.referral_levels')[$transaction->type])}}
                        <!-- <label class="toggle-switch">
                          <input type="checkbox" class="toggleSwitch">
                          <div class="switch-slider round"></div>
                        </label> -->
                      </td>
                      <td>{{ convertDateTimeFormat($transaction->created_at,'date') }}</td>
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

              {{ $allTransaction->links('vendor.pagination.bootstrap-5') }}

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
