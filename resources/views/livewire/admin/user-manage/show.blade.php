 
<div>
<!-- Start headsection -->
<div class="row">
    <div class="col-lg-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="d-flex float-left">
                <h4 class="font-weight-bold">View User</h5>
                </div>
                <div class="d-flex float-right">
                    <button class="btn btn-primary btn-sm" wire:loading.attr="disabled" wire:click.prevent="cancel">
                        <i class="fa-solid fa-arrow-left"></i> Back
                        <span wire:loading wire:target="cancel">
                            <i class="fa fa-solid fa-spinner fa-spin" aria-hidden="true"></i>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End headsection -->

<div class="row">
    <div class="col-lg-12">
        <!-- Step form tab menu -->
        <ul class="nav nav-pills border-0">
            <li class="nav-item">
                <a class="nav-link active"  data-toggle="pill" href="#personalInfo">Personal Information</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#paymentInfo">Payment Information</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#teamInfo">Team Information</a>
            </li>
        </ul>
        
        
            <!-- Step form content -->
            <div class="tab-content p-0 border-0">
                <div class="tab-pane fade show active" id="personalInfo">
                    @include('livewire.admin.user-manage.show-detail')
                </div>
                <div class="tab-pane fade" id="paymentInfo">
                    <div class="card mb-4">
                        <div class="card-header background-purple-color">
                            <label class="font-weight-bold">Payment Transactions</label>
                        </div>
                        <div class="card-body">
                            @livewire('admin.partials.payment-list',['user_id'=>$user_id])
                        </div>
                    </div> 
                    <!-- Step 2 form content -->
                </div>
                <div class="tab-pane fade" id="teamInfo">
                    <div class="card mb-4">
                        <div class="card-header background-purple-color">
                            <label class="font-weight-bold">Team List</label>
                        </div>
                        <div class="card-body">
                            @livewire('admin.partials.team-list',['user_id'=>$user_id])
                        </div>
                    </div> 
                    <!-- Step 3 form content -->
                </div>
            </div>
            <!-- End Step form content -->
      
        </div>
    </div>

</div>
   
</div>


   