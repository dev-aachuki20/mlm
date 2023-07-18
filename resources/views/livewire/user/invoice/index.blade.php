@if($viewMode)
@livewire('user.invoice.view-invoice')
@else
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="my-team-head">
                        <h4 class="card-title">My Invoice</h4>
                    </div>
                    <div class="table-header-plugins mb-3">
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
                    <div class="table-responsive my-team-details">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Invoice#</th>
                                    <th>Package Name</th>
                                    <th>Level</th>
                                    <th>Amount</th>
                                    <th>Order Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($allInvoices->count() > 0 )
                                @foreach($allInvoices as $allInvoiceData)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$allInvoiceData->invoice_number}}</td>
                                    <td>{{ucwords($packageTitle->title)}}</td>
                                    <td>{{ config('constants.levels')[$packageTitle->level] }}</td>
                                    <td>{{$allInvoiceData->amount}}</td>
                                    <td>{{convertDateTimeFormat($allInvoiceData->date_time,'datetime')}}</td>
                                    <td>
                                        <span>
                                            <a href="javascript:void(0);" wire:click.prevent="show({{$allInvoiceData->id}})" type="button" class="btn btn-primary btn-sm">View</a>
                                        </span>
                                    </td>
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
                    {{ $allInvoices->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endif