@extends("layouts.app")
@section("header")

@endsection
@section("content")
<div class="content-wrapper">
    <!-- START PAGE CONTENT-->
    <div class="page-heading">
        <h1 class="page-title">เมนูประเภทเอกสาร</h1>

    </div>
    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-md-12">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">แบบฟอร์ม บันทึก</div>
                    </div>
                    <div class="ibox-body">
                        <form id="frmadd"  name="frmadd" action="{{ route('doctype.save') }}" method="post">
                        @csrf

                            <div class="row">
                                <div class="col-sm-2 form-group">
                                    <label >CODE (A-Z)</label>
                                    <input type="text"  id="uuid" name="uuid" class="form-control" value=""  placeholder="" required>
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label >ประเภทเอกสาร</label>
                                    <input type="text"  id="name" name="name" class="form-control" value=""  placeholder="" required>
                                </div>

                            </div>

                            <div class="form-group">
                                <a href="{{route('doctype.index')}}"    class="btn  btn-warning "><i class="fa fa-arrow-left"></i> กลับ</a>
                                <button  type="submit" class="btn btn-primary "><i class="fa fa-save"></i> บันทึก</button>
                            </div>
                        </form>
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
