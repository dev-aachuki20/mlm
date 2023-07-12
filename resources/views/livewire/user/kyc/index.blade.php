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
                      <img id="imgOut" src="{{ !empty($authUser->profile_image_url) ? $authUser->profile_image_url : asset(config('constants.default.profile_image')) }}" />
                    </figure>
                    <label class="file-label">
                      <input class="file-input" type="file" accept="image/*" id="imgInp">
                      <span class="file-cta">
                        <span class="file-label">
                          Browse Now!
                        </span>
                      </span>
                    </label>
                  </div>
                  <p class="card-title mt-4 text-center border-0">Edit the Picture</p>
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
                              <p class="card-title mb-2">Pan Card Details <span>
                                <img src="{{ asset('images/verified.png') }}"></span></p>
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
                                  <img src="{{ asset(config('constants.no_image_url')) }}"/>
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
                              <p class="card-title mb-2">Aadhar Card Details <span>
                                <img src="{{ asset('images/verified.png') }}"></span></p>
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
                                      <img src="{{ asset(config('constants.no_image_url')) }}"/>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                  <div class="form-group">
                                    <label class="col-form-label pb-1 pr-0">Back Image</label>
                                    <div class="fixed-image">
                                      <img src="{{ asset(config('constants.no_image_url')) }}"/>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        {{--End Aadhar Card Details  --}}

                      </div>
                     
                       <button type="button" wire:loading.attr="disabled" class="btn custom-btn btn-default btn-edit js-edit" wire:click.prevent="openEdit">
                        Edit Detail
                        <span wire:loading wire:target="openEdit">
                          <i class="fa fa-solid fa-spinner fa-spin" aria-hidden="true"></i>
                        </span>
                       </button>
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
  });

</script>
<script>
// jQuery(document).ready(function($){
//     jQuery('.js-edit, .js-save').on('click', function(){
//     var $form = jQuery(this).closest('form');
//     $form.toggleClass('is-readonly is-editing');
//     var isReadonly  = $form.hasClass('is-readonly');
//     $form.find('input,textarea').prop('disabled', isReadonly);
//     });
// });
const fileIn = document.getElementById('imgInp'),
    fileOut = document.getElementById('imgOut');

    const readUrl = event => {
    if(event.files && event.files[0]) {
        let reader = new FileReader();
        reader.onload = event => fileOut.src = event.target.result;
        reader.readAsDataURL(event.files[0])
    }
    }

    fileIn.onchange = function() {
    readUrl(this);
    };
</script>
@endpush