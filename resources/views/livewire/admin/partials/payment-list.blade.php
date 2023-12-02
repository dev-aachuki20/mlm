@if($viewInvoice)
    @livewire('admin.partials.invoice.view-invoice',['user_id' => $user_id])
@else
<div>

    <!-- Start Payment Overview -->
    <div class="card mb-4">
        <div class="card-header background-purple-color">
            <label class="font-weight-bold">Payment Overview</label>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4">
                    <label class="font-weight-bold">{{ __('cruds.user.payment.total_earning') }}</label> : 
                    <span class="p-2">&#8377; {{number_format($total_earning,2)}}</span>
                </div>
                <div class="col-sm-4">
                    <label class="font-weight-bold">{{ __('cruds.user.payment.total_remaning_earning') }}</label> : 
                    <span class="p-2">&#8377; {{number_format($total_remaning_earning,2)}}</span>
                </div>
                <div class="col-sm-4">
                    <label class="font-weight-bold">{{ __('cruds.user.payment.total_withdrawal') }}</label> : 
                    <span class="p-2">&#8377; {{number_format($total_withdrawal,2)}} </span>
                </div>
            </div>
        </div>
    </div>
    <!-- End Payment Overview -->



    <div class="card mb-4">
        <div class="card-header background-purple-color">
            <label class="font-weight-bold">Payment Transactions</label>
        </div>

        

        <div class="table-responsive p-3 my-team-details table-record">
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
            <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>{{ trans('global.sno') }}</th>
                    <th>Payment ID</th>
                    <th>Method</th>
                    <th>Amount</th>
                    <th>Payment Gateway</th>
                    <th>{{ trans('global.created_at') }}
                        <span wire:click="sortBy('created_at')" class="float-right text-sm" style="cursor: pointer;">
                            <i class="fa fa-arrow-up {{ $sortColumnName === 'created_at' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                            <i class="fa fa-arrow-down {{ $sortColumnName === 'created_at' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                        </span>
                    </th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if($allPayments->count() > 0)
                @foreach($allPayments as $key=>$payment)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $payment->r_payment_id }}</td>
                    <td>{{ $payment->method }}</td>
                    <td><i class="fa-sharp fa-solid fa-indian-rupee-sign"></i> {{ number_format($payment->amount,2) }}</td>
                    <td>{{ strtoupper($payment->payment_gateway) }}</td>
                    <td>{{ convertDateTimeFormat($payment->created_at,'datetime') }}</td>
                    <td>
                        @if($payment->method == 'cod' && $payment->payment_approval != 'approved')
                            <button wire:click.prevent="showReceipt({{$payment->id}})"  type="button" class="btn btn-sm btn-info btn-icon-text">
                                View Reciept
                            </button>
                        @endif

                        <button wire:click.prevent="showInvoice({{$payment->user_id}})"  type="button" class="btn btn-sm btn-primary btn-icon-text">
                            View
                        </button>
                        
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

        {{ $allPayments->links('vendor.pagination.bootstrap-5') }}

    </div>

    <div wire:ignore.self wire:key="cod-payment-modal" class="modal fade" id="codReceiptModal" tabindex="-1" data-bs-backdrop='static' aria-hidden="true">
        <div class="modal-dialog codModal modal-dialog-centered">
          <form wire:submit.prevent="submitPaymentApproval" class="modal-content border-0">
            <div class="modal-header">
              <h5 class="modal-title fs-5" id="exampleModalLabel">COD Payment Reciept</h5>
              <button type="button" wire:click.prvent="hideReceipt" class="btn-close shadow-none border-0" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
            </div>
              @if($paymentDetail)
              <div class="modal-body">
                  <div class="mb-3 text-center">
                        @if($paymentDetail->receipt_image_url)
                        <a href="{{$paymentDetail->receipt_image_url}}" target="_blank">
                            <img src="{{ $paymentDetail->receipt_image_url }}"  width="200px"/>
                        </a>
                        @else
                            No Image
                        @endif
                  </div>
                  <div class="mb-3">
                    <label class="font-weight-bold justify-content-start">Transaction Id:</label>
                    <span>{{ $paymentDetail->r_payment_id ?? null}}</span>
                  </div>
                  <div class="form-group mb-3"  wire:ignore>
                      <select class="js-example-basic-single select-payment-approval w-100" wire:model.="payment_approval">
                        <option value="pending" {{ $payment_approval == 'pending' ? 'selected' : ''}}>Pending</option>
                        <option value="approved" {{ $payment_approval == 'approved' ? 'selected' : ''}}>Approved</option>
                        <option value="rejected" {{ $payment_approval == 'rejected' ? 'selected' : ''}}>Rejected</option>
                      </select>
                      @if($errors->has('payment_approval'))
                        <span class="error text-danger">
                            {{ $errors->first('payment_approval') }}
                        </span>
                      @endif
                  </div>
              
              </div>
              @endif
              <div class="modal-footer">
                  <button type="button" wire:click.prvent="hideReceipt" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                    Submit &nbsp;
                    <span wire:loading wire:target="makeCODPayment">
                        <i class="fa fa-solid fa-spinner fa-spin" aria-hidden="true"></i>
                    </span>
                </button>
              </div>
              </form>
        </div>
      </div>
</div>




@endif
