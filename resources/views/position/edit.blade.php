@extends("layouts.app")
@section("header")

@endsection
@section("content")
<div class="content-wrapper">
    <!-- START PAGE CONTENT-->
    <div class="page-heading">
        <h1 class="page-title">เมนูตำแหน่ง</h1>

    </div>
    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-md-12">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">แบบฟอร์ม บันทึก</div>
                    </div>
                    <div class="ibox-body">
                        <form id="frmadd"  name="frmadd" action="{{ route('position.update') }}" method="post">
                            <input type="hidden"  id="uuid" name="uuid"  value="{{ $data->uuid }}"  >
                        @csrf

                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <label >ชื่อตำแหน่ง</label>
                                    <input type="text"  id="name" name="name" class="form-control" value="{{ $data->name }}"  placeholder="" required>
                                </div>

                            </div>

                            <div class="form-group">
                                <a href="{{route('position.index')}}"    class="btn  btn-warning btn-sm"><i class="fa fa-arrow-left"></i> กลับ</a>
                                <button  type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> บันทึก</button>
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
