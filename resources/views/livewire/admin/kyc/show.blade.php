<div>
    
    <h4 class="card-title">
        View Kyc
    </h4>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">User Name</label>
        <div class="col-sm-9 col-form-label">
             {{ ucfirst($details->user->name) }}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">Account Holder Name</label>
        <div class="col-sm-9 col-form-label">
             {{ ucfirst($details->account_holder_name) ?? '' }}
        </div>
    </div>
    
    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">Account Number</label>
        <div class="col-sm-9 col-form-label">
             {{ $details->account_number ?? '' }}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">Bank Name</label>
        <div class="col-sm-9 col-form-label">
             {{ $details->bank_name ?? '' }}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">Branch Name</label>
        <div class="col-sm-9 col-form-label">
             {{ $details->branch_name ?? '' }}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">Aadhar Card Name</label>
        <div class="col-sm-9 col-form-label">
             {{ $details->aadhar_card_name ?? '' }}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">Aadhar Card Number</label>
        <div class="col-sm-9 col-form-label">
             {{ $details->aadhar_card_number ?? '' }}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">Pan Card Name</label>
        <div class="col-sm-9 col-form-label">
             {{ $details->pan_card_name ?? '' }}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">Pan Card Number</label>
        <div class="col-sm-9 col-form-label">
             {{ $details->pan_card_number ?? '' }}
        </div>
    </div>





    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">Status</label>
        <div class="col-sm-4 col-form-label">
            <select class="form-control select-status" data-kyc="{{$details->id}}">
                <option value="1" {{$details->status == 1 ? 'selected' : ''}}>Pending</option>
                <option value="2" {{$details->status == 2 ? 'selected' : ''}}>Approve</option>
                <option value="3" {{$details->status == 3 ? 'selected' : ''}}>Reject</option>
            </select>
             
        </div>
    </div>

    <button wire:click.prevent="cancel" class="btn btn-secondary">
        {{ __('global.cancel')}}
        <span wire:loading wire:target="cancel">
            <i class="fa fa-solid fa-spinner fa-spin" aria-hidden="true"></i>
        </span>
    </button>

               
</div>
