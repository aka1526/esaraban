@extends("layouts.app")
@section("header")

@endsection
@section("content")
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
        <h1 class="page-title">เมนูตำแหน่ง</h1>

    </div>
    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-md-12">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">ข้อมูลตำแหน่ง</div>
                        <div class="ibox-tools">
                            <button type="button" onclick="location.href='{{ route('position.add') }}';"
                             class="btn btn-info" style=" cursor: pointer;">
                             <i class="fa fa-plus"></i> เพิ่มข้อมูล</button>
                        </div>
                    </div>
                    <div class="ibox-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ตำแหน่ง</th>

                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataset as $key=>$row )
                                <tr>
                                    <td> {{$dataset->firstItem() + $key }}</td>
                                    <td>{{ $row->name }}</td>

                                    <td>
                                        <a href="{{ route('position.edit',$row->uuid) }}" class="btn btn-btn btn-warning btn-sm" > <i class="fa fa-edit"></i> แก้ไข</a>
                                        <a href="{{ route('position.delete') }}" data-uuid="{{ $row->uuid }}" class="btn btn-danger btn-delete btn-sm" > <i class="fa fa-trash"></i> ลบ</a>
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
            url: "{{route('position.delete')}}",
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
