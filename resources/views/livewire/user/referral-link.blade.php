<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <p class="card-title mb-40">Referral link</p>
                    <div class="row">
                        <div class="col-lg-12 col-sm-12">
                            <form class="form referral-link-form">
                                <div class="form-outer">
                                    <div class="form-group row mb-5">
                                        <div class="col-lg-9 col-md-8 col-sm-12">
                                            @php
                                            $refCode = Auth::user()->my_referral_code;
                                            $link = $referralLink;
                                            @endphp

                                            <div class="input-form w-90">
                                                <label class="form-label">My Referral Code</label>
                                                <input type="text" class="form-control p-24" value="{{$refCode}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-12">
                                            <div class="copy-button">
                                                <a href="javascript:void(0)" id="copy_ref_link" onclick="copyRefCode('{{$refCode}}')">
                                                    <input type="button" value="Copy Ref. Code" class="btn">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-0">
                                        <div class="col-lg-3 col-md-6 col-sm-12">
                                            <div class="input-form w-90">
                                                <label class="form-label">Package List:</label>

                                                <select class="form-control p-24" wire:model="selectPackage">
                                                    @foreach($package as $key => $pkname)
                                                    <option value="{{$key}}">{{ucwords($pkname)}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="input-form w-90">
                                                <label class="form-label">My Referral Code</label>
                                                <input type="text" class="form-control p-24" value="{{$referralLink}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-12">
                                            <div class="copy-button">
                                                <a href="javascript:void(0)" id="copy_ref_link" onclick="copyPackageLink('{{$link}}')">
                                                    <input type="button" value="Copy link" class="btn">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script type="text/javascript">
    function copyRefCode(url) {
        // Create a temporary input element
        var tempInput = document.createElement('input');
        tempInput.setAttribute('value', url);
        document.body.appendChild(tempInput);

        // Select the input element's content
        tempInput.select();
        tempInput.setSelectionRange(0, 99999); // For mobile devices

        // Copy the selected text
        document.execCommand('copy');

        // Remove the temporary input element
        document.body.removeChild(tempInput);

        // alert('Link copied to clipboard: ' + url);

        Livewire.emit('copyLinkSuccessAlert');
    }

    function copyPackageLink(link) {
        // Create a temporary input element
        var tempInput = document.createElement('input');
        tempInput.setAttribute('value', link);
        document.body.appendChild(tempInput);

        // Select the input element's content
        tempInput.select();
        tempInput.setSelectionRange(0, 99999); // For mobile devices

        // Copy the selected text
        document.execCommand('copy');

        // Remove the temporary input element
        document.body.removeChild(tempInput);

        // alert('Link copied to clipboard: ' + url);

        Livewire.emit('copyLinkSuccessAlert');
    }
</script>
@endpush