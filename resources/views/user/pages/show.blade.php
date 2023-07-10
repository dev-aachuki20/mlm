@extends('layouts.admin')
@section('title',ucwords($page->title))

@section('styles')
@stop

@section('content')

<div class="content-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            
            <div class="d-flex flex-wrap panel-setion">
              <div class="panel-img">
                <img src="{{  $page ? $page->image_url : asset(config('constants.no_image_url'))  }}" alt="training-img">
              </div>
              <div class="panel-right">
                <div class="panel-content">
                    {!! $page->description !!}
                </div>
              </div>
              <div class="card w-100 mt-5 rounded-0">
                <div class="card-body d-flex justify-content-between align-items-center w-100 p-3">
                  <div class="d-flex justify-content-between align-items-center w-100">
                    <p>{{ $page->link }}</p>
                    <button class="btn w-auto mt-0" onclick="copyToClipboard('{{$page->link}}')">
                      <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg" class="mr-2">
                        <path d="M18.3333 8.25H10.0833C9.07081 8.25 8.25 9.07081 8.25 10.0833V18.3333C8.25 19.3459 9.07081 20.1667 10.0833 20.1667H18.3333C19.3459 20.1667 20.1667 19.3459 20.1667 18.3333V10.0833C20.1667 9.07081 19.3459 8.25 18.3333 8.25Z" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M4.58398 13.7499H3.66732C3.18109 13.7499 2.71477 13.5568 2.37096 13.2129C2.02714 12.8691 1.83398 12.4028 1.83398 11.9166V3.66659C1.83398 3.18036 2.02714 2.71404 2.37096 2.37022C2.71477 2.02641 3.18109 1.83325 3.66732 1.83325H11.9173C12.4035 1.83325 12.8699 2.02641 13.2137 2.37022C13.5575 2.71404 13.7507 3.18036 13.7507 3.66659V4.58325" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg> Copy Link</button>
                    </div>
                </div>
              </div>
            </div>
                             
          </div>
        </div>
      </div>
    </div>
  </div>
@stop

@push('scripts')
<script type="text/javascript">
    function copyToClipboard(url) {
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
  </script>
@endpush
