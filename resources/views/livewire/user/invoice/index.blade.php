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
                    <input type="text" class="form-control" id="searchInput" placeholder="{{ __('global.search')}}" wire:model="search"/>
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
                    <th>Name</th>
                    <th>Plan Name</th>
                    <th>Plan Cost</th>
                    <th>Order Date</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>01</td>
                    <td>JAYESH MALHOTRA</td>
                    <td>Sachin09978</td>
                    <td>Standard Package</td>
                    <td>2499</td>
                    <td>20-05-203</td>
                    <td>
                    <span>
                        <a href="javascript:void(0);" wire:click.prevent="show(1)" type="button" class="btn btn-primary btn-sm">View</a>
                    </span>
                    </td>
                </tr>
                <tr>
                    <td>01</td>
                    <td>JAYESH MALHOTRA</td>
                    <td>Sachin09978</td>
                    <td>Standard Package</td>
                    <td>2499</td>
                    <td>20-05-203</td>
                    <td>
                    <span>
                        <a href="javascript:void(0);" wire:click.prevent="show(2)" type="button" class="btn btn-primary btn-sm">View</a>
                    </span>
                    </td>
                </tr>
                <tr>
                    <td>01</td>
                    <td>JAYESH MALHOTRA</td>
                    <td>Sachin09978</td>
                    <td>Standard Package</td>
                    <td>2499</td>
                    <td>20-05-203</td>
                    <td>
                    <span>
                        <a href="javascript:void(0);" wire:click.prevent="show(3)" type="button" class="btn btn-primary btn-sm">View</a>
                    </span>
                    </td>
                </tr>
                <tr>
                    <td>01</td>
                    <td>JAYESH MALHOTRA</td>
                    <td>Sachin09978</td>
                    <td>Standard Package</td>
                    <td>2499</td>
                    <td>20-05-203</td>
                    <td>
                    <span>
                        <a href="javascript:void(0);" wire:click.prevent="show(4)" type="button" class="btn btn-primary btn-sm">View</a>
                    </span>
                    </td>
                </tr>
                <tr>
                    <td>01</td>
                    <td>JAYESH MALHOTRA</td>
                    <td>Sachin09978</td>
                    <td>Standard Package</td>
                    <td>2499</td>
                    <td>20-05-203</td>
                    <td>
                    <span>
                        <a href="javascript:void(0);" wire:click.prevent="show(5)" type="button" class="btn btn-primary btn-sm">View</a>
                    </span>
                    </td>
                </tr>
                </tbody>
            </table>
            </div>    
            {{--{{ $allInvoices->links('vendor.pagination.bootstrap-5') }}--}}

        </div>
        </div>
    </div>
    </div>
</div>
@endif