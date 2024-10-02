@extends("layouts.app")
@section("header")
<!-- Select2 -->
<link href="/assets/vendors/select2/dist/css/select2.min.css" rel="stylesheet">

@endsection
@section("content")
@php
    $Secret=\App\Models\SecretName::where('stat','Y')->OrderBy('uuid')->get();
    $Urgent=\App\Models\UrgentName::where('stat','Y')->OrderBy('uuid')->get();

    $SectionIn=\App\Models\Section::where('type','IN')->OrderBy('name')->get();
    $SectionOut=\App\Models\Section::where('type','EX')->OrderBy('name')->get();

    $Uploads=\App\Models\Uploads::where('ref_uuid',$data->uuid)->OrderBy('created_at')->get();

@endphp
<div class="content-wrapper">
    <!-- START PAGE CONTENT-->
    <div class="page-heading">
        <h1 class="page-title">ทะเบียนรับเอกสาร</h1>
    </div>
    <div class="page-content fade-ex-up">
        <div class="row">
            <div class="col-md-12">
                <div class="ibox">
                    <div class="ibox-head" style="background-color: #f75188;color:white;">
                        <div class="ibox-title">บันทึก ทะเบียนรับเอกสาร</div>
                    </div>
                    <div class="ibox-body">
                        <form id="frmadd"  name="frmadd" action="{{ route('docrec.save') }}" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="uuid" id="uuid" value="{{ $data->uuid }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 form-group ">

                            <label style="color: red;ffont-weight: 400;">ความเร่งด่วน</label>
                            @foreach ($Urgent as $key=> $item)
                            <input type="radio" class="flat ml-2" name="lavel_urgent" id="lavel_urgent_{{ $item->uuid }}" value="{{ $item->uuid }}" {{ $item->uuid==$data->lavel_urgent ? 'checked' : '' }}  {{ $key==0 ? '  required' : ''}} /> {{ $item->name }}
                            @endforeach


                            </div>
                            <div class="col-md-6 form-group ">

                               <label   style="color: red;ffont-weight: 800;">สถานะเอกสาร</label>
                                @foreach ($Secret as $key=> $item)
                                <input type="radio" class="flat ml-2" name="lavel_secret" id="lavel_secret_{{ $item->uuid }}" value="{{ $item->uuid }}"  {{ $item->uuid==$data->lavel_secret ? 'checked' : '' }} {{ $key==0 ? ' required' : ''}} /> {{ $item->name }}
                                @endforeach
                                </div>
                        </div>

                            <div class="row">
                                <div class="col-md-2 form-group">
                                    <label >เลขที่หนังสือ</label>
                                    <input type="text"  id="doc_no" name="doc_no" class="form-control" value="{{ $data->doc_no }}"  placeholder="" required>
                                </div>
                                <div class="col-md-2 form-group">
                                    <label >หนังสือลงวันที่</label>
                                    <input type="date"  id="doc_date" name="doc_date" class="form-control" value="{{ $data->doc_date }}"  placeholder="" required>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label >จากหน่วยงาน</label>
                                    <select class="form-control select2_group"  id="doc_from" name="doc_from" required>
                                        <option value="">Choose option</option>
                                        @foreach ($SectionOut as $key=>$item )
                                        <option value="{{ $item->name }}" {{ $data->doc_from==$item->name ? 'selected' : '' }}>{{ $item->name }}</option>
                                        @endforeach

                                    </select>

                                </div>
                                <div class="col-md-4 form-group">
                                    <label >ถึงหน่วยงาน</label>
                                    <select class="form-control select2_group"  id="doc_to" name="doc_to" required>
                                        <option value="">Choose option</option>
                                        @foreach ($SectionIn  as $key=>$item )
                                        <option value="{{ $item->name }}"  {{ $data->doc_to==$item->name ? 'selected' : '' }}>{{ $item->name }}</option>
                                        @endforeach

                                    </select>

                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="doc_subject">เรื่อง</label>
                                    <textarea id="doc_subject" required="required"
                                    rows="5"
                                    class="form-control" name="doc_subject"
                                    data-parsley-trigger="keyup" data-parsley-minlength="5" data-parsley-maxlength="300"
                                    data-parsley-minlength-message="ข้อความยาวไม่เกิน 300 ตัวอักษร"
                                    data-parsley-validation-threshold="3">{!! $data->doc_to !!}</textarea>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label >เอกสารแนบ</label>
                                    <input type="file"  id="file" name="file[]" class="form-control form-control-file"   multiple >
                                </div>
                            </div>

                            <div class="form-group">
                                <a href="{{route('docrec.index')}}"    class="btn  btn-warning btn-sm"><i class="fa fa-arrow-left"></i> กลับ</a>
                                <button  type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> บันทึก</button>
                            </div>
                        </form>

                    </div>
                </div>
                <div class="ibox">
                    <div class="ibox-head bg-info" >
                        <div class="ibox-title">เอกสารแนบ</div>
                    </div>
                    <div class="ibody">
                        <div class="row">
                            <div class="col-md-12">

                                <table class="table table-bordered">
                                    <thead>
                                      <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">File</th>
                                        <th>File Name</th>
                                        <th>Date Time</th>
                                        <th>Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @foreach ($Uploads as $key=> $file )
                                      <tr>
                                        <th class="text-center" scope="row">{{  $key+1 }}</th>
                                        <td class="text-center"><img src="{{'/icon/'.$file->file_ext.'.png'  }}" width="32px"></img></td>
                                        <td>{{ $file->file_name }}</td>
                                        <td>{{ $file->created_at }}</td>
                                        <td>
                                            <a href="javascript:void(0)" data-uuid="{{ $file->uuid }}"
                                                onclick="centeredPopup('{{ "/uploads/".$file->file_name }}')"
                                                class="btn btn-primary btn-sm btn-file-view"><i class="fa fa-eyes"></i> View</a>
                                            <a href="javascript:void(0)" data-uuid="{{ $file->uuid }}" class="btn btn-danger btn-sm btn-file-delete"><i class="fa fa-trash"></i> Delete</a>
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
    $(document).ready(function() {
        init_select2();
    })

    function init_select2() {
        $(".select2_group").select2({
            placeholder: 'Select...',
            allowClear: true,
            tags: true
        });
    }

$(document).on("click", '.btn-file-delete', function(e) {
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
                url: "{{route('upload.deletefile')}}",
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
});
</script>
@endsection
