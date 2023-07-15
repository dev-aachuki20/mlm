<div>
    
    <h4 class="card-title">
        View Kyc
    </h4>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label font-weight-bold">User Name</label>
        <div class="col-sm-9 col-form-label">
             {{ ucfirst($details->user->name) }}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label font-weight-bold">Account Holder Name</label>
        <div class="col-sm-9 col-form-label">
             {{ ucfirst($details->account_holder_name) ?? '' }}
        </div>
    </div>
    
    <div class="form-group row">
        <label class="col-sm-2 col-form-label font-weight-bold">Account Number</label>
        <div class="col-sm-9 col-form-label">
             {{ $details->account_number ?? '' }}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label font-weight-bold">Bank Name</label>
        <div class="col-sm-9 col-form-label">
             {{ $details->bank_name ?? '' }}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label font-weight-bold">Branch Name</label>
        <div class="col-sm-9 col-form-label">
             {{ $details->branch_name ?? '' }}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label font-weight-bold">Aadhar Card Name</label>
        <div class="col-sm-9 col-form-label">
             {{ $details->aadhar_card_name ?? '' }}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label font-weight-bold">Aadhar Card Number</label>
        <div class="col-sm-9 col-form-label">
             {{ $details->aadhar_card_number ?? '' }}
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label font-weight-bold">Upload Aadhar Card Image</label>
        <div class="col-sm-5">
            <div class="fixed-image">
                @if($details->user->aadhar_front_image_url)
                <img src="{{ $details->user->aadhar_front_image_url }}"/>
                @else
                <img src="{{ asset(config('constants.no_image_url')) }}"/>
                @endif
            </div>
       </div>
       <div class="col-sm-5">
            <div class="fixed-image">
                @if($details->user->aadhar_back_image_url)
                <img src="{{ $details->user->aadhar_back_image_url }}"/>
                @else
                <img src="{{ asset(config('constants.no_image_url')) }}"/>
                @endif
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label font-weight-bold">Pan Card Name</label>
        <div class="col-sm-10 col-form-label">
             {{ $details->pan_card_name ?? '' }}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label font-weight-bold">Pan Card Number</label>
        <div class="col-sm-10 col-form-label">
             {{ $details->pan_card_number ?? '' }}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label font-weight-bold">Upload Pan Card Image</label>
        <div class="col-sm-10">
            <div class="fixed-image">
                @if($details->user->pancard_image_url)
                    <img src="{{ $details->user->pancard_image_url }}"/>
                @else
                    <img src="{{ asset(config('constants.no_image_url')) }}"/>
                @endif
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label font-weight-bold">Status</label>
        <div class="col-sm-4 col-form-label">
            {{-- <select class="form-control select-status" wire:change.prevent="$emit('toggle',{{$details->id}},$event.target.value)"> --}}
                <select class="form-control select-status" data-kyc="{{$details->id}}">
                @foreach($selectStatus as $keyId=>$statusName)
                <option value="{{$keyId}}" {{$details->status == $keyId ? 'selected' : ''}}>{{ ucfirst($statusName) }}</option>
                @endforeach
            </select>
             
        </div>
    </div>

    @if($details->comment)
    <div class="form-group row">
        <label class="col-sm-2 col-form-label font-weight-bold">Comment</label>
        <div class="col-sm-10 col-form-label">
             {{ ucfirst($details->comment) ?? '' }}
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
