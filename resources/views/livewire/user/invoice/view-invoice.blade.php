<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                @if($detail)
                    <div class="my-team-head">
                        <h4 class="card-title">My Invoice</h4>
                    </div>
                    <div class="invoice-box">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="invoice-logo">
                                            <img width="227" height="76" src="{{ asset('images/logo.png') }}" alt="logo">
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <div class="invoice-order">
                                            <h2>Invoice</h2>
                                            <h3 class="pull-right">Order # {{$detail->invoice_number}}</h3>
                                            <address>
                                                <!-- <strong>Order Date:</strong><br> -->
                                                {{convertDateTimeFormat($detail->date_time,'monthformat')}}<br><br>
                                            </address>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <address>
                                            <strong>Billed To:</strong><br>
                                            {{ucwords($user_data['name'])}}<br>
                                            {{ucwords($user_data['address'])}}
                                        </address>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <address>
                                            <strong>Shipped To:</strong><br>
                                            {{strip_tags(getSetting('shipped_to'))}}
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
                                                        <th class="text-center"><strong>Total</strong></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                                    <tr>
                                                        <td>1</td>
                                                        <td><strong>{{ucwords($pkg_data['title'])}}</strong>
                                                            <div class="Package-details">
                                                                <ul>
                                                                    <li><span>Duration :</span>{{$pkg_data['duration']}}</li>
                                                                    <li><span>Level :</span>{{ucfirst(config('constants.levels')[$pkg_data['level']])}}</li>
                                                                    <li><span>Enrolled :</span>{{$userenrolled}} Enrolled</li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">&#x20B9; {{number_format($detail->amount,2)}}</td>
                                                        <td class="text-center">1</td>
                                                        <td class="text-center">&#x20B9; {{number_format($detail->amount,2)}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="thick-line"></td>
                                                        <td class="thick-line"></td>
                                                        <td class="thick-line"></td>
                                                        <td class="thick-line text-center"><strong>Subtotal</strong></td>
                                                        <td class="thick-line text-center">&#x20B9; {{number_format($detail->amount,2)}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="no-line"></td>
                                                        <td class="no-line"></td>
                                                        <td class="no-line"></td>
                                                        <td class="no-line text-center"><strong>Total</strong></td>
                                                        <td class="no-line text-center">&#x20B9; {{number_format($detail->amount,2)}}</td>
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
                                <!-- <a href="{{route('pdf.create',encrypt($detail->id))}}" class="btn btn-success ml15"><i class="fa fa-print mr5"></i> Preview</a> -->
                                <a href="{{route('pdf.preview',encrypt($detail->id))}}" target="_blank" class="btn btn-success ml15"><i class="fa fa-print mr5"></i> Download/Print </a>
                            </div>
                        </div>
                    </div>
                @else
                    <p>Invoice Not Available</p>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>