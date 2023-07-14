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
            <select class="form-control select-status" wire:change.prevent="$emit('toggle',{{$details->id}},$event.target.value)">
                @foreach(config('constants.kyc_status') as $keyId=>$statusName)
                <option value="{{$keyId}}" {{$details->status == $keyId ? 'selected' : ''}}>{{ ucfirst($statusName) }}</option>
                @endforeach
            </select>
             
        </div>
    </div>

    @if($details->comment)
    <div class="form-group row">
        <label class="col-sm-3 col-form-label font-weight-bold">Comment</label>
        <div class="col-sm-9 col-form-label">
             {{ $details->comment ?? '' }}
        </div>
    </div>
    @endif

    <button wire:click.prevent="cancel" class="btn btn-secondary">
        {{ __('global.cancel')}}
        <span wire:loading wire:target="cancel">
            <i class="fa fa-solid fa-spinner fa-spin" aria-hidden="true"></i>
        </span>
    </button>

               
</div>
