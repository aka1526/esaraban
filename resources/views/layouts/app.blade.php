<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width initial-scale=1.0">
<title>@yield("title","ระบบสารบรรณอิเล็กทรอนิกส์")</title>
<link href="/assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
<link href="/assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
<link href="/assets/vendors/themify-icons/css/themify-icons.css" rel="stylesheet" />
<link href="/assets/css/main.min.css" rel="stylesheet" />

<link href="/assets/css/themes/pink.css" rel="stylesheet" id="theme-style">
<script src="/assets/vendors/sweetalert2/dist/sweetalert2.all.min.js"></script>
<link  href="/assets/vendors/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
<script src="/assets/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
<script src="/assets/vendors/popper.js/dist/umd/popper.min.js" type="text/javascript"></script>
<script src="/assets/vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
<!-- Select2 -->
<link href="/assets/vendors/select2/dist/css/select2.min.css" rel="stylesheet">

@yield("header")
</head>
<body class="fixed-navbar has-animation sidebar-mini">
    <div class="page-wrapper">
        <header class="header">
            <div class="page-brand">
                <a class="link" href="/">
                    <span class="brand">E-
                        <span class="brand-tip">Saraban</span>
                    </span>
                    <span class="brand-mini">Doc</span>
                </a>
            </div>
        @include("layouts.navbar")
        </header>
        @extends("layouts.sidebar")
        @yield("content")
    </div>
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>
 <!-- CORE PLUGINS-->


@yield("js")
</body>
</html>
