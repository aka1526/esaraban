@extends("layouts.applogin")
@section('title')
E-Saraban
@endsection
@section('body')
<body class=" " style="background-color: #989595;">
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4 d-flex flex-column justify-content-center" style="min-height: 100vh; margin-top: -50px;">
            <form id="login-form" action="{{ route('user.login_check')}}" method="post" enctype="multipart/form-data">
                @csrf

                <h2 class="login-title text-center mb-4">E-Saraban</h2>

                <div class="form-group">
                    <div class="input-group-icon right">
                        <div class="input-icon"><i class="fa fa-envelope"></i></div>
                        <input class="form-control" type="email" name="email" id="email" placeholder="email" autocomplete="off">
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group-icon right">
                        <div class="input-icon"><i class="fa fa-lock font-16"></i></div>
                        <input class="form-control" type="password" name="password" id="password" placeholder="Password" autocomplete="off">
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-info btn-block" type="submit"><i class="fa fa-key"></i> Login</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>

@endsection

@section('jsfooter')
<script src="/assets/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
<script src="/assets/vendors/popper.js/dist/umd/popper.min.js" type="text/javascript"></script>
<script src="/assets/vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
<!-- PAGE LEVEL PLUGINS -->
<script src="/assets/vendors/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
<!-- CORE SCRIPTS-->
<script src="/assets/js/applogin.js" type="text/javascript"></script>
<!-- PAGE LEVEL SCRIPTS-->
<script type="text/javascript">
    $(function() {
        $('#login-form').validate({
            errorClass: "help-block",
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true
                }
            },
            highlight: function(e) {
                $(e).closest(".form-group").addClass("has-error")
            },
            unhighlight: function(e) {
                $(e).closest(".form-group").removeClass("has-error")
            },
        });
    });
</script>
@endsection
