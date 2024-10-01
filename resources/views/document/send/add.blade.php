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


@endphp
<div class="content-wrapper">
    <!-- START PAGE CONTENT-->
    <div class="page-heading">
        <h1 class="page-title">ทะเบียนส่งเอกสาร</h1>

    </div>
    <div class="page-content fade-ex-up">
        <div class="row">
            <div class="col-md-12">
                <div class="ibox">
                    <div class="ibox-head" style="background-color: #f75188;color:white;">
                        <div class="ibox-title">บันทึก ทะเบียนส่งเอกสาร</div>
                    </div>
                    <div class="ibox-body">
                        <form id="frmadd"  name="frmadd" action="{{ route('docsend.save') }}" method="post" enctype="multipart/form-data">

                        @csrf
                        <div class="row">
                            <div class="col-md-6 form-group ">

                            <label style="color: red;ffont-weight: 400;">ความเร่งด่วน</label>
                            @foreach ($Urgent as $key=> $item)
                            <input type="radio" class="flat ml-2" name="lavel_urgent" id="lavel_urgent_{{ $item->uuid }}" value="{{ $item->uuid }}"   {{ $key==0 ? ' checked required' : ''}} /> {{ $item->name }}
                            @endforeach


                            </div>
                            <div class="col-md-6 form-group ">

                               <label   style="color: red;ffont-weight: 800;">ชั้นความลับ</label>
                                @foreach ($Secret as $key=> $item)
                                <input type="radio" class="flat ml-2" name="lavel_secret" id="lavel_secret_{{ $item->uuid }}" value="{{ $item->uuid }}"   {{ $key==0 ? ' checked required' : ''}} /> {{ $item->name }}
                                @endforeach
                                </div>
                        </div>

                            <div class="row">
                                <div class="col-md-2 form-group">
                                    <label >เลขที่หนังสือ</label>
                                    <input type="text"  id="doc_no" name="doc_no" class="form-control" value=""  placeholder="" required>
                                </div>
                                <div class="col-md-2 form-group">
                                    <label >หนังสือลงวันที่</label>
                                    <input type="date"  id="doc_date" name="doc_date" class="form-control" value=""  placeholder="" required>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label >จากหน่วยงาน</label>
                                    <select class="form-control select2_group"  id="doc_from" name="doc_from" required>
                                        <option value="">Choose option</option>
                                        @foreach ($SectionIn as $key=>$item )
                                        <option value="{{ $item->name }}" >{{ $item->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label >ถึงหน่วยงาน</label>
                                    <select class="form-control select2_group"  id="doc_to" name="doc_to" required>
                                        <option value="">Choose option</option>
                                        @foreach ($SectionOut as $key=>$item )
                                        <option value="{{ $item->name }}" >{{ $item->name }}</option>
                                        @endforeach

                                    </select>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="doc_subject">เรื่อง</label>
                                    <textarea id="doc_subject"
                                    rows="5" required="required" class="form-control" name="doc_subject" data-parsley-trigger="keyup" data-parsley-minlength="5" data-parsley-maxlength="300"
                                    data-parsley-minlength-message="ข้อความยาวไม่เกิน 300 ตัวอักษร"
                                    data-parsley-validation-threshold="3"></textarea>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label >เอกสารแนบ</label>
                                    <input type="file"   id="file" name="file[]" class="form-control form-control-file"   multiple >
                                </div>
                            </div>

                            <div class="form-group">
                                <a href="{{route('docsend.index')}}"    class="btn  btn-warning btn-sm"><i class="fa fa-arrow-left"></i> กลับ</a>
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
</script>
@endsection
