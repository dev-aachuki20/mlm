<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Invoice-{{$invoice_id}}</title>

    <style>
        .tbl .trdata .tddata {
            border: 1px solid #ddd;
            padding-top: 20px;
            padding-bottom: 20px;
        }

        .text-right-td {
            margin-left: 5rem !important;
        }

        .tddata {
            border-bottom: 1px solid #000 !important;
        }

        .tbl {
            width: 100%;
        }

        .tblhead {
            background-color: #f24f00;
            color: white;
            font-weight: 900;
        }
    </style>
</head>

<body>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="invoice-box">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <div class="table-responsive table-striped">
                                                <table class="table table-condensed">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <img src="{{ $logoImage}}">
                                                            </td>
                                                            <td style="text-align: right;">
                                                                <b>Invoice</b><br>
                                                                <b>Order #</b> {{$invoice_id}}<br>
                                                                <b>Order Date:</b>
                                                                {{convertDateTimeFormat($invoice_date,'date')}}<br>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <address>
                                                <b>Billed To:</b><br>
                                                {{ucwords($user_name)}}<br>
                                                {{ucwords($user_address)}}
                                            </address>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="table-responsive table-striped">
                                    <table class="table table-bordered tbl">
                                        <thead class="tblhead">
                                            <tr class="trdata">
                                                <th><b>#</b></th>
                                                <th><b>Description </b></th>
                                                <th class="text-center"><b>Price</b></th>
                                                <th class="text-center"><b>Totals</b></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="trdata">
                                                <td class="tddata">1</td>

                                                <td class="tddata">{{ucwords($package_title)}} <br>
                                                    <b>Duration :</b>{{$package_duration}} <br>
                                                    <b>Level :</b>{{ucfirst(config('constants.levels')[$package_level])}} <br>
                                                    <b>Enrolled :</b>{{$userenrolled}} Enrolled
                                                </td>

                                                <td class="tddata text-center"><span style="font-family: DejaVu Sans; sans-serif;">&#x20B9;</span> {{$invoice_amount}}</td>

                                                <td class="text-center tddata"><span style="font-family: DejaVu Sans; sans-serif;">&#x20B9;</span> {{$invoice_amount}}</td>
                                            </tr>

                                            <tr class="trdata">
                                                <td class="thick-line"></td>
                                                <td class="thick-line"></td>
                                                <td class="thick-line text-center"><strong>Subtotal</strong></td>
                                                <td class="thick-line text-center"><span style="font-family: DejaVu Sans; sans-serif;">&#x20B9;</span> {{$invoice_amount}}</td>
                                            </tr>
                                            <tr class="trdata">
                                                <td class="no-line"></td>
                                                <td class="no-line"></td>
                                                <td class="no-line text-center"><strong>Total</strong></td>
                                                <td class="no-line text-center"><span style="font-family: DejaVu Sans; sans-serif;">&#x20B9;</span> {{$invoice_amount}}</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                            </div>

                            <div class="row mt-5">
                                <div class="col-md-12">
                                    <p><strong>Declaration:- </strong> We declare that this invoice shows the actual price of the goods/ services described and that all particulars are true and correct.</p>
                                </div>
                            </div>
                            <hr>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>