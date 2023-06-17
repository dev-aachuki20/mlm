<div>
    <h5>Payment Amount: {{ $amount }}</h5>
    <button wire:click.prevent="pay">Pay Now</button>
   
</div>

@push('scripts')
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        Livewire.on('paymentSuccessful', () => {
            // Handle payment successful event
            // Perform any necessary actions after successful payment
        });
    </script>
@endpush