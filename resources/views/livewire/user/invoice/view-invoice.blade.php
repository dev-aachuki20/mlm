<div class="content-wrapper">
<div class="row">
    <div class="col-lg-12">
    <div class="card">
        <div class="card-body">
        <div class="my-team-head">
            <h4 class="card-title">My Invoice</h4>                  
        </div>
        <div class="invoice-box">
            <div class="row">
            <div class="col-md-12">
                <div class="row">
                <div class="col-md-6">
                    <div class="invoice-logo">
                    <img src="{{ asset('images/logo.png') }}" alt="logo">
                    </div>
                </div>
                <div class="col-md-6 text-right">
                    <div class="invoice-order">
                    <h2>Invoice</h2><h3 class="pull-right">Order # 12345</h3>
                    <address>
                        <strong>Order Date:</strong><br>
                        March 7, 2014<br><br>
                    </address>
                    </div>
                </div>
                </div>
                <hr>
                <div class="row">
                <div class="col-md-6">
                    <address>
                    <strong>Billed To:</strong><br>
                    John Smith<br>
                    1234 Main<br>
                    Apt. 4B<br>
                    Springfield, ST 54321
                    </address>
                </div>
                <div class="col-md-6 text-right">
                    <address>
                    <strong>Shipped To:</strong><br>
                    Jane Smith<br>
                    1234 Main<br>
                    Apt. 4B<br>
                    Springfield, ST 54321
                    </address>
                </div>
                </div>
            </div>
            </div>
            <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default mt-5">
                <div class="panel-body">
                    <div class="table-responsive">
                    <table class="table table-condensed">
                        <thead>
                            <tr>
                            <th><strong>#</strong></th>
                            <th><strong>Description </strong></th>
                            <th class="text-center"><strong>Price</strong></th>
                            <th class="text-center"><strong>Quantity</strong></th>
                            <th class="text-right"><strong>Totals</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                        <!-- foreach ($order->lineItems as $line) or some such thing here -->
                        <tr>
                            <td>1</td>
                            <td>Standard Package
                            <div class="Package-details">
                                <ul>
                                <li><span>Duration :</span>2.5hr</li>
                                <li><span>Level :</span>Beginner</li>
                                <li><span>Enrolled :</span>450 Enrolled</li>
                                </ul>
                            </div></td>
                            <td class="text-center">$10.99</td>
                            <td class="text-center">1</td>
                            <td class="text-right">$10.99</td>
                        </tr>
                        <tr>
                            <td class="thick-line"></td>
                            <td class="thick-line"></td>
                            <td class="thick-line"></td>
                            <td class="thick-line text-center"><strong>Subtotal</strong></td>
                            <td class="thick-line text-right">$670.99</td>
                        </tr>
                        <tr>
                            <td class="no-line"></td>
                            <td class="no-line"></td>
                            <td class="no-line"></td>
                            <td class="no-line text-center"><strong>Total</strong></td>
                            <td class="no-line text-right">$685.99</td>
                        </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
                </div>
            </div>
            </div>
            <hr>
            <div class="row">
            <div class="col-md-12">
                <p><strong>Declaration:- </strong> We declare that this invoice shows the actual price of the goods/ services described and that all particulars are true and correct.</p>
            </div>
            </div>
            <hr>
            <div class="row">
            <div class="col-md-12 text-center">
                <button type="button" id="print" class="btn btn-success ml15"><i class="fa fa-print mr5"></i> Download/Print</button>
            </div>
            </div>
        </div>                
        </div>
    </div>
    </div>
</div>
</div>