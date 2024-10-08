@extends("layouts.app")
@section("header")

@endsection
@section("content")
<div class="content-wrapper">
    <!-- START PAGE CONTENT-->
    <div class="page-heading">
        <h1 class="page-title">Invoice</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.html"><i class="la la-home font-20"></i></a>
            </li>
            <li class="breadcrumb-item">Invoice</li>
        </ol>
    </div>
    <div class="page-content fade-in-up">
        <div class="ibox invoice">
            <div class="invoice-header">
                <div class="row">
                    <div class="col-6">
                        <div class="invoice-logo">
                            <img src="/assets/img/logos/github-logo.png" height="65px" />
                        </div>
                        <div>
                            <div class="m-b-5 font-bold">Invoice from</div>
                            <div>Github, Inc.</div>
                            <ul class="list-unstyled m-t-10">
                                <li class="m-b-5">
                                    <span class="font-strong">A:</span> San Francisco, CA 94103 Market Street</li>
                                <li class="m-b-5">
                                    <span class="font-strong">W:</span> adminca@exmail.com</li>
                                <li>
                                    <span class="font-strong">P:</span> (123) 456-2112</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-6 text-right">
                        <div class="clf" style="margin-bottom:30px;">
                            <dl class="row pull-right" style="width:250px;"><dt class="col-sm-6">Invoice Date</dt>
                                <dd class="col-sm-6">10 April 2017</dd><dt class="col-sm-6">Issue Date</dt>
                                <dd class="col-sm-6">30 April 2017</dd><dt class="col-sm-6">Account No.</dt>
                                <dd class="col-sm-6">1450012</dd>
                            </dl>
                        </div>
                        <div>
                            <div class="m-b-5 font-bold">Invoice To</div>
                            <div>Emma Johnson</div>
                            <ul class="list-unstyled m-t-10">
                                <li class="m-b-5">San Francisco, 548 Market St.</li>
                                <li class="m-b-5">emma.johnson@exmail.com</li>
                                <li>(123) 279-4058</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-striped no-margin table-invoice">
                <thead>
                    <tr>
                        <th>Item Description</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th class="text-right">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div><strong>Flat Design</strong></div><small>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small></td>
                        <td>2</td>
                        <td>$220.00</td>
                        <td>$440.00</td>
                    </tr>
                    <tr>
                        <td>
                            <div><strong>Bootstrap theme</strong></div><small>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small></td>
                        <td>1</td>
                        <td>$500.00</td>
                        <td>$500.00</td>
                    </tr>
                    <tr>
                        <td>
                            <div><strong>Invoice Design</strong></div><small>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small></td>
                        <td>3</td>
                        <td>$300.00</td>
                        <td>$900.00</td>
                    </tr>
                </tbody>
            </table>
            <table class="table no-border">
                <thead>
                    <tr>
                        <th></th>
                        <th width="15%"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-right">
                        <td>Subtotal:</td>
                        <td>$1840</td>
                    </tr>
                    <tr class="text-right">
                        <td>TAX 5%:</td>
                        <td>$92</td>
                    </tr>
                    <tr class="text-right">
                        <td class="font-bold font-18">TOTAL:</td>
                        <td class="font-bold font-18">$1748</td>
                    </tr>
                </tbody>
            </table>
            <div class="text-right">
                <button class="btn btn-info" type="button" onclick="javascript:window.print();"><i class="fa fa-print"></i> Print</button>
            </div>
        </div>
    </div>
@include("layouts.footer")
</div>
@endsection
@section("js")
 <!-- CORE PLUGINS-->
 <script src="/assets/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
 <script src="/assets/vendors/popper.js/dist/umd/popper.min.js" type="text/javascript"></script>
 <script src="/assets/vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
 <script src="/assets/vendors/metisMenu/dist/metisMenu.min.js" type="text/javascript"></script>
 <script src="/assets/vendors/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
 <script src="/assets/js/app.min.js" type="text/javascript"></script>
 <!-- PAGE LEVEL SCRIPTS-->
@endsection
