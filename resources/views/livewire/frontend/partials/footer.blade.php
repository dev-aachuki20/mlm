<footer class="bg-dark-blue footer-main">
<div class="pb-120 footer-top">
    <div class="container">
    <div class="footer-logo-top">
        <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-12">
            <div class="footer-logo">
                <a href="{{ route('front.home') }}"><img src="{{ asset(config('constants.default.footer-logo'))}}"></a>
            </div>
        </div>
        <div class="col-lg-9 col-md-8 col-sm-12 align-self-center">
            <div class="footer-link-top">
            <ul class="d-flex flex-wrap justify-content-end">
                <li>
                <a href="{{ route('front.home') }}" class="text-white">Home</a>
                </li>
                <li>
                <a href="javascript:void(0);" class="text-white">Pricing plan</a>
                </li>
                <li>
                <a href="{{ route('auth.login') }}" class="text-white">Login</a>
                </li>
                <li>
                <a href="{{ route('auth.register') }}" class="text-white">Registration</a>
                </li>
                <li>
                <a href="{{ route('front.contact-us') }}" class="text-white">Contact Us</a>
                </li>
            </ul>
            </div>
        </div>
        </div>
    </div>
    <div class="footer-details">
        <div class="row">
        <div class="col-lg-5 col-md-4 col-sm-12">
            <div class="footer-about">
            <h4 class="text-white">About Us</h4>
            <div class="section-text">
                <p>
                    {{ getSetting('company_address') ? getSetting('company_address') : 'MyFutureBiz Marketing Private Limited Meena Bhawan, Near Water Tank Tilwar, Tehsil, Rajgarh, Alwar, Rajasthan, India.' }}
                </p>
            </div>
            <ul>
                <li>
                <a href="{{ getSetting('facebook') ? getSetting('facebook') : 'javascript:void(0);' }}">
                    <svg width="8" height="16" viewBox="0 0 8 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6.55245 2.65602H8V0.112024C7.29913 0.0363015 6.59492 -0.00108342 5.89028 2.38913e-05C3.79596 2.38913e-05 2.36381 1.32802 2.36381 3.76002V5.85601H0V8.70401H2.36381V16H5.19731V8.70401H7.55342L7.9076 5.85601H5.19731V4.04002C5.19731 3.20002 5.4129 2.65602 6.55245 2.65602Z"/>
                    </svg>
                </a>
                </li>
                <li>
                <a href="{{ getSetting('linkedin') ? getSetting('linkedin') : 'javascript:void(0);' }}">
                    <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1.80172 3.35586H1.78056C1.55012 3.36976 1.31929 3.336 1.10248 3.25669C0.885669 3.17737 0.687541 3.05421 0.520464 2.8949C0.353387 2.73558 0.220951 2.54353 0.131425 2.33074C0.0418984 2.11794 -0.00279509 1.88898 0.000135317 1.65814C0.00306572 1.42729 0.0535569 1.19954 0.148456 0.989083C0.243355 0.77863 0.380624 0.590003 0.551691 0.434979C0.722758 0.279956 0.923949 0.161865 1.1427 0.0880828C1.36145 0.0143002 1.59307 -0.0135903 1.82308 0.00615302C2.05423 -0.0105879 2.28635 0.0206767 2.50484 0.0979807C2.72333 0.175285 2.92345 0.296956 3.09264 0.455345C3.26183 0.613734 3.39643 0.805414 3.48795 1.01833C3.57948 1.23125 3.62597 1.46081 3.62449 1.69256C3.62301 1.92432 3.5736 2.15326 3.47937 2.36499C3.38513 2.57673 3.24811 2.76668 3.07691 2.92289C2.90571 3.07911 2.70405 3.19822 2.4846 3.27273C2.26514 3.34725 2.03264 3.37555 1.80172 3.35586Z"/>
                    <path d="M3.31571 5.6106H0.309509V14.6292H3.31571V5.6106Z"/>
                    <path d="M11.2066 5.6106C10.7001 5.61198 10.2003 5.72784 9.74485 5.94953C9.28935 6.17122 8.88985 6.493 8.57621 6.89081V5.6106H5.57001V14.6292H8.57621V10.4957C8.57621 10.097 8.73457 9.71471 9.01646 9.43282C9.29835 9.15094 9.68067 8.99257 10.0793 8.99257C10.478 8.99257 10.8603 9.15094 11.1422 9.43282C11.4241 9.71471 11.5824 10.097 11.5824 10.4957V14.6292H14.5886V8.99257C14.5886 8.54845 14.5011 8.10867 14.3312 7.69835C14.1612 7.28803 13.9121 6.9152 13.5981 6.60115C13.284 6.28711 12.9112 6.03799 12.5009 5.86803C12.0905 5.69807 11.6508 5.6106 11.2066 5.6106Z"/>
                    </svg>
                </a>
                </li>
                <li>
                <a href="{{ getSetting('instagram') ? getSetting('instagram') : 'javascript:void(0);' }}">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12.272 2.768C12.0821 2.768 11.8965 2.8243 11.7387 2.92979C11.5808 3.03528 11.4577 3.18521 11.3851 3.36062C11.3124 3.53604 11.2934 3.72906 11.3304 3.91529C11.3675 4.10151 11.4589 4.27256 11.5932 4.40682C11.7274 4.54108 11.8985 4.63251 12.0847 4.66955C12.2709 4.7066 12.464 4.68758 12.6394 4.61492C12.8148 4.54226 12.9647 4.41922 13.0702 4.26135C13.1757 4.10348 13.232 3.91787 13.232 3.728C13.232 3.47339 13.1309 3.22921 12.9508 3.04918C12.7708 2.86914 12.5266 2.768 12.272 2.768ZM15.952 4.704C15.9364 4.04024 15.8121 3.38352 15.584 2.76C15.3806 2.22651 15.064 1.74342 14.656 1.344C14.2599 0.933941 13.7756 0.619341 13.24 0.424C12.6181 0.188929 11.9607 0.061768 11.296 0.048C10.448 -4.47035e-08 10.176 0 8 0C5.824 0 5.552 -4.47035e-08 4.704 0.048C4.03932 0.061768 3.38187 0.188929 2.76 0.424C2.22534 0.621319 1.74155 0.935648 1.344 1.344C0.933941 1.74014 0.619341 2.22435 0.424 2.76C0.188929 3.38187 0.061768 4.03932 0.048 4.704C-4.47035e-08 5.552 0 5.824 0 8C0 10.176 -4.47035e-08 10.448 0.048 11.296C0.061768 11.9607 0.188929 12.6181 0.424 13.24C0.619341 13.7756 0.933941 14.2599 1.344 14.656C1.74155 15.0644 2.22534 15.3787 2.76 15.576C3.38187 15.8111 4.03932 15.9382 4.704 15.952C5.552 16 5.824 16 8 16C10.176 16 10.448 16 11.296 15.952C11.9607 15.9382 12.6181 15.8111 13.24 15.576C13.7756 15.3807 14.2599 15.0661 14.656 14.656C15.0658 14.2581 15.3827 13.7746 15.584 13.24C15.8121 12.6165 15.9364 11.9598 15.952 11.296C15.952 10.448 16 10.176 16 8C16 5.824 16 5.552 15.952 4.704ZM14.512 11.2C14.5062 11.7078 14.4142 12.211 14.24 12.688C14.1123 13.0362 13.9071 13.3507 13.64 13.608C13.3805 13.8724 13.0666 14.0771 12.72 14.208C12.243 14.3822 11.7398 14.4742 11.232 14.48C10.432 14.52 10.136 14.528 8.032 14.528C5.928 14.528 5.632 14.528 4.832 14.48C4.30471 14.4899 3.77968 14.4087 3.28 14.24C2.94863 14.1025 2.64908 13.8982 2.4 13.64C2.13447 13.383 1.93187 13.0682 1.808 12.72C1.61269 12.2361 1.50435 11.7216 1.488 11.2C1.488 10.4 1.44 10.104 1.44 8C1.44 5.896 1.44 5.6 1.488 4.8C1.49159 4.28084 1.58636 3.76636 1.768 3.28C1.90884 2.94233 2.12501 2.64133 2.4 2.4C2.64305 2.12493 2.94343 1.90648 3.28 1.76C3.76764 1.58403 4.2816 1.49206 4.8 1.488C5.6 1.488 5.896 1.44 8 1.44C10.104 1.44 10.4 1.44 11.2 1.488C11.7078 1.49382 12.211 1.5858 12.688 1.76C13.0515 1.89492 13.3778 2.11428 13.64 2.4C13.9022 2.64574 14.107 2.94619 14.24 3.28C14.4178 3.76715 14.5098 4.28142 14.512 4.8C14.552 5.6 14.56 5.896 14.56 8C14.56 10.104 14.552 10.4 14.512 11.2ZM8 3.896C7.18865 3.89758 6.39597 4.13962 5.72212 4.59153C5.04828 5.04345 4.5235 5.68496 4.21411 6.435C3.90471 7.18505 3.82458 8.00997 3.98384 8.80554C4.14309 9.60111 4.53459 10.3316 5.10886 10.9048C5.68313 11.4779 6.41441 11.868 7.21029 12.0257C8.00617 12.1834 8.83093 12.1017 9.58037 11.7908C10.3298 11.48 10.9703 10.954 11.4209 10.2792C11.8715 9.6045 12.112 8.81135 12.112 8C12.1131 7.46008 12.0074 6.92529 11.801 6.42636C11.5946 5.92744 11.2916 5.47425 10.9095 5.09284C10.5273 4.71143 10.0736 4.40934 9.57424 4.20394C9.07492 3.99854 8.53991 3.89389 8 3.896ZM8 10.664C7.47311 10.664 6.95805 10.5078 6.51996 10.215C6.08187 9.92231 5.74042 9.50625 5.53878 9.01947C5.33715 8.53269 5.2844 7.99705 5.38719 7.48028C5.48998 6.96351 5.7437 6.48883 6.11627 6.11627C6.48883 5.7437 6.96351 5.48998 7.48028 5.38719C7.99705 5.2844 8.53269 5.33715 9.01947 5.53878C9.50625 5.74042 9.92231 6.08187 10.215 6.51996C10.5078 6.95805 10.664 7.47311 10.664 8C10.664 8.34984 10.5951 8.69626 10.4612 9.01947C10.3273 9.34268 10.1311 9.63636 9.88373 9.88373C9.63636 10.1311 9.34268 10.3273 9.01947 10.4612C8.69626 10.5951 8.34984 10.664 8 10.664Z"/>
                    </svg>
                </a>
                </li>
                <li>
                <a href="{{ getSetting('youtube') ? getSetting('youtube') : 'javascript:void(0);' }}">
                    <svg width="18" height="13" viewBox="0 0 18 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.9959 4.58161C18.0363 3.3787 17.7803 2.18479 17.2518 1.11075C16.8932 0.670038 16.3955 0.372629 15.8454 0.270343C13.5703 0.058163 11.2857 -0.0288028 9.00153 0.00981866C6.72568 -0.0305557 4.44935 0.0536038 2.1822 0.26194C1.73397 0.345742 1.31917 0.56183 0.988407 0.883837C0.252508 1.58137 0.170742 2.77474 0.088975 3.78323C-0.0296584 5.59645 -0.0296584 7.41581 0.088975 9.22903C0.11263 9.79665 0.194858 10.3601 0.334275 10.9098C0.432865 11.3343 0.632333 11.727 0.914817 12.0528C1.24783 12.3919 1.67229 12.6202 2.13314 12.7083C3.89596 12.9319 5.67217 13.0246 7.44797 12.9856C10.3098 13.0277 12.82 12.9856 15.7882 12.7503C16.2603 12.6677 16.6967 12.439 17.0392 12.0948C17.2681 11.8594 17.4391 11.5713 17.538 11.2544C17.8304 10.3322 17.974 9.36695 17.9631 8.39704C17.9959 7.92641 17.9959 5.08585 17.9959 4.58161ZM7.15361 8.90128V3.69919L11.9942 6.31284C10.6369 7.08601 8.84618 7.96003 7.15361 8.90128Z"/>
                    </svg>
                </a>
                </li>
            </ul>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="footer-link">
            <h4 class="text-white">Support Menu</h4>
            <ul>
                <li><a href="{{ route('front.contact-us') }}">Contact Us</a></li>
                <li><a href="javascript:void(0);">Disclaimer</a></li>
                <li><a href="javascript:void(0);">Privacy Policy</a></li>
                <li><a href="javascript:void(0);">Terms & Condition</a></li>
            </ul>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-12">                
            <div class="footer-link">
            <h4 class="text-white">Useful Links</h4>
            <ul>
                <li><a href="{{ route('front.about-us') }}">About Us</a></li>
                <li><a href="javascript:void(0);">About Courses</a></li>
                <li><a href="javascript:void(0);">Refund Policy</a></li>
                <li><a href="javascript:void(0);">End user license Agreement</a></li>
            </ul>
            </div>
        </div>
        </div>
    </div>
    </div>
</div>
<div class="footer-copyright bg-white text-center">
    <div class="container">
    <div class="row">
        <div class="col-md-12 col-sm-12">
        <p>Copyright © {{ date('Y') }} {{ config('app.name') }} All rights reserved.</p>
        </div>
    </div>
    </div>
</div>
</footer>