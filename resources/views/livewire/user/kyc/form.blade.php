<div>
    <form  wire:submit.prevent="updateKycDetails">
        <div class="form-group row">
            <label class="col-sm-4 col-form-label justify-content-start">Full name <i class="fas fa-asterisk"></i></label>
            <div class="col-sm-8">
                <input type="text" class="form-control" placeholder="Enter your full name" wire:model.defer="account_holder_name">
                @error('account_holder_name') <span class="error text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label justify-content-start">Bank Name <i class="fas fa-asterisk"></i></label>
            <div class="col-sm-8">
                <input type="text" class="form-control" placeholder="Enter your bank name" wire:model.defer="bank_name">
                @error('bank_name') <span class="error text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label justify-content-start">Bank Account Number  <i class="fas fa-asterisk"></i></label>
            <div class="col-sm-8">
                <input type="text" class="form-control" placeholder="Enter your bank account number" wire:model.defer="account_number">
                @error('account_number') <span class="error text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="form-group row mb-40">
            <label class="col-sm-4 col-form-label justify-content-start">IFSC Code  <i class="fas fa-asterisk"></i></label>
            <div class="col-sm-8">
                <input type="text" class="form-control" placeholder="Enter your ifsc code" wire:model.defer="ifsc_code">
                @error('ifsc_code') <span class="error text-danger">{{ $message }}</span>@enderror
            </div>
        </div>

        <p class="card-title mb-4">Identity  Details</p>
        <div class="row">
          {{--Start PanCard Details  --}}
          <div class="col-md-6 col-sm-12">
            <div class="card h-100">
              <div class="card-body">
                <p class="card-title mb-2">
                    Pan Card Details
                </p>
                <div class="form-group">
                  <label class="col-form-label pb-1 pr-0 justify-content-start">Name<i class="fas fa-asterisk"></i></label>
                  <input type="text" class="form-control" placeholder="Enter your pan card name" wire:model.defer="pan_card_name" autocomplete="off">
                  @error('pan_card_name') <span class="error text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                  <label class="col-form-label pb-1 pr-0 justify-content-start">Number<i class="fas fa-asterisk"></i></label>
                  <input type="text" class="form-control" placeholder="Enter your pan card number" wire:model.defer="pan_card_number" onkeydown="javascript: return ['Backspace','Delete','ArrowLeft','ArrowRight','Tab'].includes(event.code) ? true :event.code!=='Space' && this.value.length < 10 " autocomplete="off">
                    @error('pan_card_number') <span class="error text-danger">{{ $message }}</span>@enderror
                </div>                              
                <div class="form-group">
                  <label class="col-form-label pb-1 pr-0 justify-content-start">Upload Image<i class="fas fa-asterisk"></i></label>
                  <p>Min:- {{ config('constants.pancard_image.size.min') }}KB, Max:- {{ config('constants.pancard_image.size.max') }}KB</p>
                  <div class="fixed-image" wire:ignore>
                    <input type="file" id="pan-image"  wire:model.defer="pan_card_image" class="dropify" data-default-file="{{ $panOriginal }}"  data-show-loader="true" data-errors-position="outside" data-allowed-file-extensions="jpeg png jpg svg" data-min-file-size-preview="1M" data-max-file-size-preview="3M"  accept="image/jpeg, image/png, image/jpg,image/svg">
                  </div>
                  <span wire:loading wire:target="pan_card_image">
                    <i class="fa fa-solid fa-spinner fa-spin" aria-hidden="true"></i> Loading
                   </span>
                   <div>@error('pan_card_image') <span class="error text-danger">{{ $message }}</span>@enderror</div>
                </div>
              </div>
            </div>
          </div>
          {{--End PanCard Details  --}}

          {{--Start Aadhar Card Details  --}}
          <div class="col-md-6 col-sm-12">
            <div class="card">
              <div class="card-body">
                <p class="card-title mb-2">
                    Aadhar Card Details 
                </p>
                
                <div class="form-group">
                    <label class="col-form-label pb-1 pr-0 justify-content-start">Name <i class="fas fa-asterisk"></i></label>
                    <input type="text" class="form-control" placeholder="Enter your aadhar card name" wire:model.defer="aadhar_card_name" autocomplete="off">
                    @error('aadhar_card_name') <span class="error text-danger">{{ $message }}</span>@enderror
                </div>
                
                <div class="form-group">
                    <label class="col-form-label pb-1 pr-0 justify-content-start">Number <i class="fas fa-asterisk"></i></label>
                    <input type="text" class="form-control" placeholder="Enter your aadhar card number" wire:model.defer="aadhar_card_number" onkeydown="javascript: return ['Backspace','Delete','ArrowLeft','ArrowRight','Tab'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!=='Space' && this.value.length < 12 "  autocomplete="off">
                    @error('aadhar_card_number') <span class="error text-danger">{{ $message }}</span>@enderror
                </div>

                <div class="row">
                  {{-- Aadhar front image --}}
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                      <label class="col-form-label pb-1 pr-0 justify-content-start">Upload Front Image <i class="fas fa-asterisk"></i></label>
                      <p>Min:- {{ config('constants.aadharcard_image.size.min') }}KB, Max:- {{ config('constants.aadharcard_image.size.max') }}KB</p>
                      <div class="fixed-image" wire:ignore>
                        <input type="file" id="aadhar-front-image"  wire:model.defer="aadharCardImageFront" class="dropify" data-default-file="{{ $aadharFrontOriginal }}"  data-show-loader="true" data-errors-position="outside" data-allowed-file-extensions="jpeg png jpg svg" data-min-file-size-preview="1M" data-max-file-size-preview="3M"  accept="image/jpeg, image/png, image/jpg,image/svg">
                      </div>
                        <span wire:loading wire:target="aadharCardImageFront">
                            <i class="fa fa-solid fa-spinner fa-spin" aria-hidden="true"></i> Loading
                        </span>
                        <div>@error('aadharCardImageFront') <span class="error text-danger">{{ $message }}</span>@enderror</div>
                    </div>
                  </div>

                  {{-- Aadhar back image --}}
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                      <label class="col-form-label pb-1 pr-0 justify-content-start">Upload Back Image <i class="fas fa-asterisk"></i></label>
                      <p>Min:- {{ config('constants.aadharcard_image.size.min') }}KB, Max:- {{ config('constants.aadharcard_image.size.max') }}KB</p>
                      <div class="fixed-image" wire:ignore>
                        <input type="file" id="aadhar-back-image"  wire:model.defer="aadharCardImageBack" class="dropify" data-default-file="{{ $aadharBackOriginal }}"  data-show-loader="true" data-errors-position="outside" data-allowed-file-extensions="jpeg png jpg svg" data-min-file-size-preview="1M" data-max-file-size-preview="3M"  accept="image/jpeg, image/png, image/jpg,image/svg">
                      </div>
                        <span wire:loading wire:target="aadharCardImageBack">
                            <i class="fa fa-solid fa-spinner fa-spin" aria-hidden="true"></i> Loading
                        </span>
                        <div>@error('aadharCardImageBack') <span class="error text-danger">{{ $message }}</span>@enderror</div>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
          {{--End Aadhar Card Details  --}}
        </div>
       
       
        <button type="submit" wire:loading.attr="disabled" class="btn custom-btn btn-default btn-save js-save">
            Save Detail
            <span wire:loading wire:target="updateKycDetails">
                <i class="fa fa-solid fa-spinner fa-spin" aria-hidden="true"></i>
            </span>
        </button>
        <button type="button" wire:loading.attr="disabled" wire:click.prevent="cancel" class="btn custom-btn btn-default btn-edit">
            Cancel
             <span wire:loading wire:target="cancel">
                 <i class="fa fa-solid fa-spinner fa-spin" aria-hidden="true"></i>
             </span>
         </button>
    </form>
</div>