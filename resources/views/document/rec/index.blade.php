@extends("layouts.app")
@section("header")

@endsection
@section("content")
@php
use Illuminate\Support\Carbon;
$Secret=\App\Models\SecretName::where('stat','Y')->OrderBy('uuid')->get();
$Urgent=\App\Models\UrgentName::where('stat','Y')->OrderBy('uuid')->get();
$Uploads=\App\Models\Uploads::where('uuid','!=','')->OrderBy('created_at')->get();
$arrSecret=  array();
$arrUrgent=  array();

$colorSecret=  array();
$iconSecret=  array();

$colorUrgent=  array();

foreach ($Secret as $key => $value) {
    $arrSecret[$value->uuid]=$value->name;
    $colorSecret[$value->uuid]=$value->color;
    $iconSecret[$value->uuid]=$value->faicon;

}

foreach ($Urgent as $key => $value) {
    $arrUrgent[$value->uuid]=$value->name;
    $colorUrgent[$value->uuid]=$value->color;
}

@endphp
@if(session()->get('msg'))
<script>
    Swal.fire({
    title: 'บันทึกข้อมูลสำเร็จ',
    timer: 1000,
    icon: 'success',
    confirmButtonText: 'OK'
    }) ;
</script>
@endif
<div class="content-wrapper">
    <!-- START PAGE CONTENT-->
    <div class="page-heading">
        <h1 class="page-title"> ทะเบียนรับเอกสาร</h1>

    </div>
    <div class="page-content fade-ex-up">
        <div class="row">
            <div class="col-md-12">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">ข้อมูลทะเบียนรับเอกสาร</div>
                        <div class="ibox-tools">
                            <button type="button" onclick="location.href='{{ route('docrec.add') }}';"
                             class="btn btn-info" style=" cursor: pointer;">
                             <i class="fa fa-plus"></i> เพิ่มข้อมูล</button>
                        </div>
                    </div>
                    <div class="ibox-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form id="frmsearch" name="frmsearch" action="{{ route('docrec.index') }}" method="post">
                                    @csrf
                                  <div class="row">

                                    <div class="col-md-4 form-group  ">
                                        <label >ค้นหา/search</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="search" name="search" value="{{ $search }}">
                                            <span class="input-group-btn">
                                                <button type="submit" class="btn btn-primary">ค้นหา</button>
                                            </span>
                                        </div>

                                    </div>

                                </div>


                                </form>
                            </div>
                        </div>
                        <div class="row mt-3">


                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="bg-primary">
                                        <th>#</th>
                                        <th>เลขที่รับ</th>
                                        <th>วันที่รับ</th>
                                        <th>ความเร่งด่วน</th>
                                        <th>สถานะเอกสาร</th>

                                        <th>จากหน่วยงาน</th>

                                        <th>เลขที่หนังสือ</th>
                                        <th>หนังสือลงวันที่</th>
                                        <th>ถึงหน่วยงาน</th>
                                        <th>เอกสารแนบ</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataset as $key=>$row )
                                    <tr>
                                        <td> {{$dataset->firstItem() + $key }}</td>
                                        <td>{{ $row->runnumber  }}</td>
                                        <td>{{ Carbon::parse( $row->tra_date)->thaidate();  }}</td>
                                        <td><button type="button" class="btn btn-sm btn-rounded btn-{{$colorUrgent[$row->lavel_urgent ]}}" style="width: 120px"><i class="fa fa-rocket"></i> {{ $arrUrgent[$row->lavel_urgent]}}</button></td>
                                        <td><button type="button" class="btn btn-sm btn-rounded btn-{{$colorSecret[$row->lavel_secret ]}}" style="width: 120px"><i class="fa {{$iconSecret[$row->lavel_secret ]}}"></i> {{$arrSecret[$row->lavel_secret ]}}</button></td>


                                        <td>{{ $row->doc_from  }}</td>

                                        <td>{{ $row->doc_no  }}</td>
                                        <td>{{ Carbon::parse( $row->doc_date)->thaidate();  }}</td>
                                        <td>{{ $row->doc_subject  }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-bars m-r-5"> เอกสารแนบ</i><i class="fa fa-angle-down"></i></button>
                                                <ul class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 33px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                    @foreach ($Uploads->where('ref_uuid',$row->uuid) as $key=>$file )
                                                    <li><a class="dropdown-item" href="javascript:;"  onclick="centeredPopup('{{ "/uploads/".$file->file_name }}')">{{ $file->file_desc }}</a></li>
                                                    @endforeach

                                                </ul>
                                            </div>

                                        </td>
                                        <td>

                                            <a href="{{ route('docrec.edit',$row->uuid) }}" class="btn btn-btn btn-warning btn-sm" > <i class="fa fa-edit"></i> แก้ไข</a>
                                            <a href="{{ route('docrec.delete') }}" data-uuid="{{ $row->uuid }}" class="btn btn-danger btn-delete btn-sm" > <i class="fa fa-trash"></i> ลบ</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@include("layouts.footer")
</div>
@endsection
@section("js")
<script src="/assets/vendors/metisMenu/dist/metisMenu.min.js" type="text/javascript"></script>
<script src="/assets/vendors/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="/assets/js/app.min.js" type="text/javascript"></script>
<!-- Select2 -->
<script src="/assets/vendors/select2/dist/js/select2.full.min.js"></script>


 <script>

$(document).on("click", '.btn-delete', function(e) {
    e.preventDefault();

    var uuid=$(this).data('uuid');

    Swal.fire({
    title: 'ยืนยันการลบ?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
    if (result.isConfirmed) {
    $.ajax({
            type: 'POST',
            url: "{{route('docrec.delete')}}",
            data: {uuid: uuid,"_token": "{{ csrf_token() }}"},
            success: function (data){
                        Swal.fire({
                        title: "ลบข้อมูลสำเร็จ",
                        timer: 1000,
                        icon: "success",
                        confirmButtonText: 'OK'
                        }).then((willDelete) => {
                            deleteRow(rowid);

                        });


                        location.reload();
            },
            error: function(e) {
                console.log(e);
            }});
  }
});


})
 </script>
@endsection
