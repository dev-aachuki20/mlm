<div class="content-wrapper">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <p class="card-title mb-40">KYC Detail</p>
            <div class="row">
              <div class="col-lg-3 col-sm-12">
                <form>
                  <div class="input-file-img">
                    <figure class="image is-5by3">

                       <div wire:loading wire:target="profile_image" class="loader" role="status" aria-hidden="true"></div>
                        <div wire:loading wire:target="cancelUpdateProfileImage" class="loader" role="status" aria-hidden="true"></div> 

                        @if ($profile_image)  
                        <img src="{{ $profile_image->temporaryUrl() }}" alt="picture" id="imgOut">
                        @else
                        <img src="{{ ($authUser->profile_image_url) ? $authUser->profile_image_url : asset(config('constants.default.profile_image')) }}" alt="picture" id="imgOut">
                        @endif 
            
                    </figure>
                    
                      @if($showConfirmCancel)
                      <label class="file-label text-center">
                       
                          <button class="btn btn-outline-success ms-1 mr-1" wire:click.prevent="confirmUpdateProfileImage"><i class="fa fa-check"></i></button>

                          <button class="btn btn-outline-danger ms-1"  wire:click.prevent="cancelUpdateProfileImage"><i class="fa fa-close"></i></button>
                      
                      </label>
                      @else
                          <label class="file-label">
                            <input class="file-input" type="file" accept="image/*" wire:model="profile_image" wire:change="validateProfileImage" id="imgInp">
                            <span class="file-cta">
                              <span class="file-label">
                                Browse Now!
                              </span>
                            </span>
                            @error('profile_image') <span class="error text-danger">{{ $message }}</span>@enderror
                          </label>
                      @endif
                  </div>
                  @if($authUser->kycDetail->status != 2)
                  <p class="card-title mt-4 text-center border-0">Edit the Picture</p>
                  @endif
                </form>
              </div>
            

              <div class="col-lg-9 col-sm-12">
                <div class="card">
                  <div class="card-body">
                    <p class="card-title mb-40">Bank Account Details</p>
                    @if($formMode)
                    
                      @include('livewire.user.kyc.form')

                    @else
                    <form class="is-readonly">
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Full name <span>:</span></label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" placeholder="{{$authUser->kycDetail->account_holder_name ?? ''}}"  disabled>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Bank Name <span>:</span></label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" placeholder="{{$authUser->kycDetail->bank_name ?? ''}}" disabled>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Bank Account Number  <span>:</span></label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" placeholder="{{$authUser->kycDetail->account_number ?? ''}}" disabled>
                        </div>
                      </div>
                      <div class="form-group row mb-40">
                        <label class="col-sm-4 col-form-label">IFSC Code  <span>:</span></label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" placeholder="{{$authUser->kycDetail->ifsc_code ?? ''}}" disabled>
                        </div>
                      </div>
                      
                      <p class="card-title mb-4">Identity  Details</p>
                     
                      <div class="row">

                        {{--Start PanCard Details  --}}
                        <div class="col-md-6 col-sm-12">
                          <div class="card h-100">
                            <div class="card-body">
                              <p class="card-title mb-2">Pan Card Details 
                                @if($authUser->kycDetail->status == 2)
                                <span><img src="{{ asset('images/verified.png') }}"></span>
                                @endif
                              </p>
                              <div class="form-group">
                                <label class="col-form-label pb-1 pr-0">Name</label>
                                <input type="text" class="form-control" placeholder="{{$authUser->kycDetail->pan_card_name ?? ''}}"  disabled>
                              </div>
                              <div class="form-group">
                                <label class="col-form-label pb-1 pr-0">Number</label>
                                <input type="text" class="form-control" placeholder="{{$authUser->kycDetail->pan_card_number ?? ''}}"  disabled>
                              </div>                              
                              <div class="form-group">
                                <label class="col-form-label pb-1 pr-0">Image</label>
                                <div class="fixed-image">
                                  @if($authUser->pancard_image_url)
                                  <img src="{{ $authUser->pancard_image_url }}"/>
                                  @else
                                  <img src="{{ asset(config('constants.no_image_url')) }}"/>
                                  @endif
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        {{--End PanCard Details  --}}

                        {{--Start Aadhar Card Details  --}}
                        <div class="col-md-6 col-sm-12">
                          <div class="card">
                            <div class="card-body">
                              <p class="card-title mb-2">Aadhar Card Details 
                                @if($authUser->kycDetail->status == 2)
                                <span><img src="{{ asset('images/verified.png') }}"></span>
                                @endif
                              </p>
                              <div class="form-group">
                                <label class="col-form-label pb-1 pr-0">Name
                                </label>
                                <input type="text" class="form-control" placeholder="{{$authUser->kycDetail->aadhar_card_name ?? ''}}" disabled>
                              </div>
                              
                              <div class="form-group">
                                <label class="col-form-label pb-1 pr-0">Number</label>
                                <input type="text" class="form-control" placeholder="{{$authUser->kycDetail->aadhar_card_number ?? ''}}" disabled>
                              </div>

                              <div class="row">
                                <div class="col-md-6 col-sm-12">
                                  <div class="form-group">
                                    <label class="col-form-label pb-1 pr-0">Front Image</label>
                                    <div class="fixed-image">
                                      @if($authUser->aadhar_front_image_url)
                                      <img src="{{ $authUser->aadhar_front_image_url }}"/>
                                      @else
                                       <img src="{{ asset(config('constants.no_image_url')) }}"/>
                                      @endif
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                  <div class="form-group">
                                    <label class="col-form-label pb-1 pr-0">Back Image</label>
                                    <div class="fixed-image">
                                      @if($authUser->aadhar_back_image_url)
                                      <img src="{{ $authUser->aadhar_back_image_url }}"/>
                                      @else
                                      <img src="{{ asset(config('constants.no_image_url')) }}"/>
                                      @endif
                                    </div>
                                  </div>
                                </div>
                              </div>

                            </div>
                          </div>
                        </div>
                        {{--End Aadhar Card Details  --}}

                      </div>
                      
                      @if($authUser->kycDetail->status ==3 && $authUser->kycDetail->comment)
                      <div class="alert alert-danger mb-0 mt-3" role="alert">
                        {{ ucfirst($authUser->kycDetail->comment) }}
                      </div>
                      @endif

                      @if($authUser->kycDetail->status != 2)
                       <button type="button" wire:loading.attr="disabled" class="btn custom-btn btn-default btn-edit js-edit" wire:click.prevent="openEdit">
                        Edit Detail
                        <span wire:loading wire:target="openEdit">
                          <i class="fa fa-solid fa-spinner fa-spin" aria-hidden="true"></i>
                        </span>
                       </button>
                       @endif

                    </form>
                    @endif

                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" />
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script type="text/javascript">

  document.addEventListener('loadPlugins', function (event) {
      $('.dropify').dropify();
      $('.dropify-errors-container').remove();
      $('.dropify-clear').click(function(e) {
          e.preventDefault();
          var elementName = $(this).siblings('input[type=file]').attr('id');
          if(elementName == 'pan-image'){
              @this.set('pan_card_image',null);
              @this.set('panOriginal',null);
              @this.set('isRemovePanCardImage',true);
          }else if(elementName == 'aadhar-front-image'){
              @this.set('aadharCardImageFront',null);
              @this.set('aadharFrontOriginal',null);
              @this.set('isRemoveAadharCardFrontImg',true);
          }else if(elementName == 'aadhar-back-image'){
              @this.set('aadharCardImageBack',null);
              @this.set('aadharBackOriginal',null);
              @this.set('isRemoveAadharCardBackImg',true);
          }
      });
  });

</script>
@endpush