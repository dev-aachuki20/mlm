<div>
    <section class="other-page-banner bg-light-orange">
        <div class="container">
          <div class="row justify-content-between">
            <div class="col-lg-6 col-sm-12 align-self-center">
              <div class="other-page-text">
                <h1>Contact Us</h1>
                <div class="section-text body-size-normal">
                  <p>The vision of MyFutureBiz is to develop entrepreneurial mindset and create financially independent person's excellent.</p>
                </div>
              </div>
            </div>
            <div class="col-lg-5 col-sm-12 align-self-end">
              <div class="other-page-img">
                <img src="{{ asset('images/contact-img.png') }}">
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="contact-form ptb-120 bg-white">
        <div class="container">
          <div class="row">
            <div class="col-md-12 col-sm-12">
              <div class="contact-form-inner">
                <div class="other-sec-head">
                  <h2>Get in  <span class="color-orange">Touch!</span></h2>
                  <div class="section-text">
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                  </div>
                </div>
                <form class="form" wire:submit.prevent="sendContactMail">            
                  <div class="form-outer">
                    <div class="form-group col-50">
                      <div class="form-group">
                        <div class="input-form">
                          <div class="login-icon"><img src="{{ asset('images/icons/user.svg')}}" alt="User"></div>
                          <label class="form-label">Name</label>
                          <input type="text" wire:model.defer="name" class="form-control" placeholder="Enter Your name" />
                        </div>
                        @error('name') <span class="error text-danger">{{ $message }}</span>@enderror
                      </div>

                    </div>
                    <div class="form-group col-50">
                      <div class="form-group">
                        <div class="input-form">
                          <div class="login-icon"><img src="{{ asset('images/icons/email.svg')}}" alt="User"></div>
                          <label class="form-label">Email ID</label>
                          <input type="email" wire:model.defer="email" class="form-control" placeholder="Enter Your Email" />
                        </div>
                        @error('email') <span class="error text-danger">{{ $message }}</span>@enderror
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="input-form">
                        <label class="form-label">Message</label>
                        <textarea class="form-control" wire:model.defer="message" placeholder="Enter Message" ></textarea>
                        @error('message') <span class="error text-danger">{{ $message }}</span>@enderror
                      </div>
                    </div>
                  </div>
                  <div class="submit-btn">
                    <button type="submit" class="btn fill" wire:loading.attr="disabled">Submit Now
                      <svg width="14" height="12" viewBox="0 0 14 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8 11L13 6L8 1" stroke-width="1.5" stroke-linecap="round"
                          stroke-linejoin="round" />
                        <path d="M1 11L6 6L1 1" stroke-width="1.5" stroke-linecap="round"
                          stroke-linejoin="round" />
                      </svg>

                      <span wire:loading wire:target="sendContactMail">
                          <i class="ml-1 fa fa-solid fa-spinner fa-spin" aria-hidden="true"></i>
                      </span>
                     
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
</div>
