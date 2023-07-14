<div class="content-wrapper">
    <div class="row">
    <div class="col-lg-12">
        <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-40">Contact Information</h4>
            <div class="contactus-outer bg-light-orange d-flex flex-wrap mb-5">
            <div class="contactus-img align-self-end">
                <img src="{{ asset('images/contact-us.png') }}">
            </div>
            <div class="contactus-details">
                <div class="d-flex flex-wrap justify-content-between align-items-center mb-5">
                <h3 class="mb-0 border-0">Contact US </h3>
                <div class="bg-white contact-time">
                    Contact us between 9:00AM to 9:00PM
                </div>
                </div>
                <div class="get-in-tuch-list">
                <ul>
                    <li>
                    <div class="contact-iocns">
                        <img src="{{ asset('images/email.svg') }}">
                    </div>
                    <div class="contact-detail">
                        <span class="color-dark-gray">Email Us</span>
                        <a href="mailto:{{ getSetting('support_email') }}" class="color-dark-blue">{{ getSetting('support_email') }}</a> 
                    </div>
                    </li>
                    <li>
                    <div class="contact-iocns">
                        <img src="{{ asset('images/phone.svg') }}">
                    </div>
                    <div class="contact-detail">
                        <span class="color-dark-gray">Connect with us</span>
                        <a href="tel:{{ getSetting('support_phone') }}" class="color-dark-blue">{{ getSetting('support_phone') }}</a> 
                    </div>
                    </li>
                    <li>
                    <div class="contact-iocns">
                        <img src="{{ asset('images/whatsapp.svg') }}">
                    </div>
                    <div class="contact-detail">
                        <span class="color-dark-gray">Connect On Whatsapp</span>
                        <a href="https://api.whatsapp.com/send?phone={{ getSetting('support_whatsapp_number') }}" target="blank" class="color-dark-blue">{{ getSetting('support_whatsapp_number') }}</a> 
                    </div>
                    </li>
                </ul>
                </div>
                <div class="founder-social">
                <ul>
                    <li>
                        <a href="{{ getSetting('youtube') }}">
                            <div class="social-icon">
                            <img src="{{ asset('images/youtube.svg') }}">
                            </div>
                            <div class="social-type">
                            <h6 class="color-dark-blue"><span class="color-dark-gray">My Channel On</span>Youtube</h6>                        
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ getSetting('instagram') }}">
                            <div class="social-icon">
                            <img src="{{ asset('images/instagram.svg') }}">
                            </div>
                            <div class="social-type">
                            <h6 class="color-dark-blue"><span class="color-dark-gray">Follow Me On</span>Instagram</h6>                        
                            </div>
                        </a>
                    </li>
                </ul>
                </div>
            </div>
            </div>
                            
        </div>
        </div>
    </div>
    </div>
</div>