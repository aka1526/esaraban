@extends("layouts.app")
@section("header")

@endsection
@section("content")
<div class="content-wrapper">
    <!-- START PAGE CONTENT-->
    <div class="page-heading">
        <h1 class="page-title">เมนูโปรแกรม</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.html"><i class="la la-home font-20"></i></a>
            </li>

        </ol>
    </div>
    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-md-12">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">ข้อมูลเมนูโปรแกรม</div>
                        <div class="ibox-tools">
                            <button type="button" class="btn btn-info"><i class="fa fa-plus"></i> เพิ่มข้อมูล</button>
                        </div>
                    </div>
                    <div class="ibox-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Username</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Larry</td>
                                    <td>the Bird</td>
                                    <td>@twitter</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
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
