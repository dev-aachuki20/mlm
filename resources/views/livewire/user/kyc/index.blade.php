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
                      <img id="imgOut" src="https://source.unsplash.com/random" />
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
                    <form class="is-readonly">
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Full name <span>:</span></label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" placeholder="Enter Full Name" value="Rahul Kumar Meena" disabled>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Bank Name <span>:</span></label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" placeholder="Enter Bank Name" value="ICICI Bank" disabled>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Bank Account Number  <span>:</span></label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" placeholder="Enter Bank Account Number" value="12345678910253" disabled>
                        </div>
                      </div>
                      <div class="form-group row mb-40">
                        <label class="col-sm-4 col-form-label">IFSC Code  <span>:</span></label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" placeholder="Enter IFSC Code" value="IFSC0012" disabled>
                        </div>
                      </div>
                      <p class="card-title mb-2">Identity  Details</p>
                      <div class="row">
                        <div class="col-md-6 col-sm-12">
                          <div class="form-group">
                            <label class="col-form-label pb-1 pr-0">Pan Card <span>
                                <img src="{{ asset('images/verified.png') }}"></span>
                            </label>
                            <input type="text" class="form-control" placeholder="Enter Pan Card no." value="12345678900" disabled>
                          </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                          <div class="form-group">
                            <label class="col-form-label pb-1 pr-0">Aadhar Card <span>
                                <img src="{{ asset('images/verified.png') }}"></span>
                            </label>
                            <input type="text" class="form-control" placeholder="Enter Aadhar Card no." value="12345678900" disabled>
                          </div>
                        </div>
                      </div>
                       <button type="button" class="btn custom-btn btn-default btn-edit js-edit">Edit Detail</button>
                       <button type="button" class="btn custom-btn btn-default btn-save js-save">Save Detail</button>
                    </form>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

@push('scripts')
<script>
jQuery(document).ready(function($){
    jQuery('.js-edit, .js-save').on('click', function(){
    var $form = jQuery(this).closest('form');
    $form.toggleClass('is-readonly is-editing');
    var isReadonly  = $form.hasClass('is-readonly');
    $form.find('input,textarea').prop('disabled', isReadonly);
    });
});
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