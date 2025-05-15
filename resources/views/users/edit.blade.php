@extends("layouts.app")
@section("header")

@endsection
@section("content")
<div class="content-wrapper">
    <!-- START PAGE CONTENT-->
    <div class="page-heading">
        <h1 class="page-title">เมนูสถานะผู้ใช้งาน</h1>

    </div>
    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-md-12">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">ข้อมูลผู้ใช้งาน</div>
                    </div>
                    <div class="ibox-body">
                        <form id="frmadd"  name="frmadd" action="{{ route('users.update') }}" method="post">
                            <input type="hidden" name="id" value="{{ $user->id }}">
                        @csrf
                             @if ($errors->any())
                                    <div id="flash-message" class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            <div class="row">
                                <div class="col-sm-2 form-group">
                                    <label >ชื่อ / Name </label>
                                    <input type="text"  id="name" name="name" class="form-control" value="{{ $user->name }}"  placeholder="" required   autocomplete="off">
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label >E-mail/ Login</label>
                                    <input type="email"  id="email" name="email" class="form-control" value="{{ $user->email }}"  placeholder="" required autocomplete="off">
                                </div>

                                <div class="col-sm-2 form-group">
                                    <label >Password </label>
                                    <input type="password"  id="password" name="password" class="form-control" value=""  placeholder=""     autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group">
                                <a href="{{route('users.index')}}"    class="btn  btn-warning "><i class="fa fa-arrow-left"></i> กลับ</a>
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
 <script>
    setTimeout(function () {
        let msg = document.getElementById('flash-message');
        if (msg) {
            msg.style.transition = 'opacity 0.5s ease-out';
            msg.style.opacity = '0';
            setTimeout(() => msg.remove(), 500); // fully remove from DOM
        }
    }, 3000); // 5000 milliseconds = 5 seconds
</script>
@endsection
