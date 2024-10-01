@extends("layouts.app")
@section("header")

@endsection
@section("content")
<div class="content-wrapper">
    <!-- START PAGE CONTENT-->
    <div class="page-heading">
        <h1 class="page-title">เมนูตั้งค่าเอกสาร</h1>

    </div>
    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-md-12">
                <div class="ibox">
                    <div class="ibox-head bg-primary">
                        <div class="ibox-title">ตั้งค่าทะเบียนรับเอกสาร</div>
                    </div>
                    <div class="ibox-body">
                        <form id="frmrec"  name="frmrec" action="{{ route('setting.save') }}" method="post">
                            <input type="hidden" name="doc_type" value="REC">
                            <input type="hidden" name="uuid"  value="{{ isset($DocRec->uuid) ? $DocRec->uuid : '' }}">
                            @csrf

                            <div class="row">
                                <div class="col-md-1 form-group">
                                    <label >อักษรย่อ</label>
                                    <input type="text"  id="prefix1" name="prefix1" class="form-control" value="{{ isset($DocRec->prefix1) ? $DocRec->prefix1 : '' }}"   required>
                                </div>
                                <div class="col-md-1 form-group">
                                    <label >รูปแบบปี</label>
                                    <select class="form-control" id="doc_year" name="doc_year">
                                        <option value="">เว้นว่าง</option>
                                        <option value="yy" {{ isset($DocRec->doc_year) && $DocRec->doc_year =='yy' ? 'selected' : '' }}>{{ date('y') }}</option>
                                        <option value="yyyy" {{ isset($DocRec->doc_year) && $DocRec->doc_year =='yyyy' ? 'selected' : '' }}>{{ date('Y') }}</option>


                                    </select>
                                </div>

                                <div class="col-md-1 form-group">
                                    <label >อักษรย่อ</label>
                                    <input type="text"  id="prefix2" name="prefix2" class="form-control" value="{{ isset($DocRec->prefix2) ? $DocRec->prefix2 : '' }}"   >
                                </div>
                                <div class="col-md-1 form-group">
                                    <label >รูปแบบเดือน </label>
                                    <select class="form-control" id="doc_month" name="doc_month">
                                        <option value="">เว้นว่าง</option>
                                        <option value="m" {{ isset($DocRec->doc_month) && $DocRec->doc_month =='m' ? 'selected' : '' }}>{{ date('m') }}</option>
                                        <option value="mm" {{ isset($DocRec->doc_month) && $DocRec->doc_month =='mm' ? 'selected' : '' }}>{{ strtolower(date('M')) }}</option>


                                    </select>
                                </div>
                                <div class="col-md-1 form-group">
                                    <label >อักษรย่อ</label>
                                    <input type="text"  id="prefix3" name="prefix3" class="form-control" value="{{ isset($DocRec->prefix3) ? $DocRec->prefix3 : '' }}"    >
                                </div>
                                <div class="col-md-1 form-group">
                                    <label >จำนวนหลัก</label>
                                    <input type="number"  id="doc_digit" name="doc_digit" class="form-control" min="1" max="10" value="{{ isset($DocRec->doc_digit) ? $DocRec->doc_digit : '3' }}"   required>
                                </div>

                                <div class="col-md-3 form-group">
                                    <label >ตัวอย่างเลขที่เอกสาร</label>
                                    <input type="text"  id="previewnumber" name="previewnumber" class="form-control" value="{{ isset($DocRec->previewnumber) ? $DocRec->previewnumber : '' }}"   readonly>
                                </div>

                            </div>

                            <div class="form-group">

                                <button  type="submit" class="btn btn-primary  btn-sm"><i class="fa fa-save"></i> บันทึก</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-md-12">
                <div class="ibox">
                    <div class="ibox-head bg-warning">
                        <div class="ibox-title">ตั้งค่าทะเบียนส่งเอกสาร</div>
                    </div>
                    <div class="ibox-body">
                        <form id="frmsend"  name="frmsend" action="{{ route('setting.save') }}" method="post">
                            <input type="hidden" name="doc_type" value="SEND">
                            <input type="hidden" name="uuid"  value="{{ isset($DocSend->uuid) ? $DocSend->uuid : '' }}">
                            @csrf

                            <div class="row">
                                <div class="col-md-1 form-group">
                                    <label >อักษรย่อ</label>
                                    <input type="text"  id="prefix1" name="prefix1" class="form-control" value="{{ isset($DocSend->prefix1) ? $DocSend->prefix1 : '' }}"   required>
                                </div>
                                <div class="col-md-1 form-group">
                                    <label >รูปแบบปี</label>
                                    <select class="form-control" id="doc_year" name="doc_year">
                                        <option value="">เว้นว่าง</option>
                                        <option value="yy" {{ isset($DocSend->doc_year) && $DocSend->doc_year =='yy' ? 'selected' : '' }}>{{ date('y') }}</option>
                                        <option value="yyyy" {{ isset($DocSend->doc_year) && $DocSend->doc_year =='yyyy' ? 'selected' : '' }}>{{ date('Y') }}</option>


                                    </select>
                                </div>

                                <div class="col-md-1 form-group">
                                    <label >อักษรย่อ</label>
                                    <input type="text"  id="prefix2" name="prefix2" class="form-control" value="{{ isset($DocSend->prefix2) ? $DocSend->prefix2 : '' }}"   >
                                </div>
                                <div class="col-md-1 form-group">
                                    <label >รูปแบบเดือน </label>
                                    <select class="form-control" id="doc_month" name="doc_month">
                                        <option value="">เว้นว่าง</option>
                                        <option value="m" {{ isset($DocSend->doc_month) && $DocSend->doc_month =='m' ? 'selected' : '' }}>{{ date('m') }}</option>
                                        <option value="mm" {{ isset($DocSend->doc_month) && $DocSend->doc_month =='mm' ? 'selected' : '' }}>{{ strtolower(date('M')) }}</option>


                                    </select>
                                </div>
                                <div class="col-md-1 form-group">
                                    <label >อักษรย่อ</label>
                                    <input type="text"  id="prefix3" name="prefix3" class="form-control" value="{{ isset($DocSend->prefix3) ? $DocSend->prefix3 : '' }}"    >
                                </div>
                                <div class="col-md-1 form-group">
                                    <label >จำนวนหลัก</label>
                                    <input type="number"  id="doc_digit" name="doc_digit" class="form-control" min="1" max="10" value="{{ isset($DocSend->doc_digit) ? $DocSend->doc_digit : '3' }}"   required>
                                </div>

                                <div class="col-md-3 form-group">
                                    <label >ตัวอย่างเลขที่เอกสาร</label>
                                    <input type="text"  id="previewnumber" name="previewnumber" class="form-control" value="{{ isset($DocSend->previewnumber) ? $DocSend->previewnumber : '' }}"   readonly>
                                </div>

                            </div>

                            <div class="form-group">

                                <button  type="submit" class="btn btn-primary  btn-sm"><i class="fa fa-save"></i> บันทึก</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-md-12">
                <div class="ibox">
                    <div class="ibox-head bg-info">
                        <div class="ibox-title">ตั้งค่าเอกสารภายใน</div>
                    </div>
                    <div class="ibox-body">
                        <form id="frmsend"  name="frmsend" action="{{ route('setting.save') }}" method="post">
                            <input type="hidden" name="doc_type" value="DOCIN">
                            <input type="hidden" name="uuid"  value="{{ isset($DocIn->uuid) ? $DocIn->uuid : '' }}">
                            @csrf

                            <div class="row">
                                <div class="col-md-1 form-group">
                                    <label >อักษรย่อ</label>
                                    <input type="text"  id="prefix1" name="prefix1" class="form-control" value="{{ isset($DocIn->prefix1) ? $DocIn->prefix1 : '' }}"   required>
                                </div>
                                <div class="col-md-1 form-group">
                                    <label >รูปแบบปี</label>
                                    <select class="form-control" id="doc_year" name="doc_year">
                                        <option value="">เว้นว่าง</option>
                                        <option value="yy" {{ isset($DocIn->doc_year) && $DocIn->doc_year =='yy' ? 'selected' : '' }}>{{ date('y') }}</option>
                                        <option value="yyyy" {{ isset($DocIn->doc_year) && $DocIn->doc_year =='yyyy' ? 'selected' : '' }}>{{ date('Y') }}</option>


                                    </select>
                                </div>

                                <div class="col-md-1 form-group">
                                    <label >อักษรย่อ</label>
                                    <input type="text"  id="prefix2" name="prefix2" class="form-control" value="{{ isset($DocIn->prefix2) ? $DocIn->prefix2 : '' }}"   >
                                </div>
                                <div class="col-md-1 form-group">
                                    <label >รูปแบบเดือน </label>
                                    <select class="form-control" id="doc_month" name="doc_month">
                                        <option value="">เว้นว่าง</option>
                                        <option value="m" {{ isset($DocIn->doc_month) && $DocIn->doc_month =='m' ? 'selected' : '' }}>{{ date('m') }}</option>
                                        <option value="mm" {{ isset($DocIn->doc_month) && $DocIn->doc_month =='mm' ? 'selected' : '' }}>{{ strtolower(date('M')) }}</option>


                                    </select>
                                </div>
                                <div class="col-md-1 form-group">
                                    <label >อักษรย่อ</label>
                                    <input type="text"  id="prefix3" name="prefix3" class="form-control" value="{{ isset($DocIn->prefix3) ? $DocIn->prefix3 : '' }}"    >
                                </div>
                                <div class="col-md-1 form-group">
                                    <label >จำนวนหลัก</label>
                                    <input type="number"  id="doc_digit" name="doc_digit" class="form-control" min="1" max="10" value="{{ isset($DocIn->doc_digit) ? $DocIn->doc_digit : '3' }}"   required>
                                </div>

                                <div class="col-md-3 form-group">
                                    <label >ตัวอย่างเลขที่เอกสาร</label>
                                    <input type="text"  id="previewnumber" name="previewnumber" class="form-control" value="{{ isset($DocIn->previewnumber) ? $DocIn->previewnumber : '' }}"   readonly>
                                </div>

                            </div>

                            <div class="form-group">

                                <button  type="submit" class="btn btn-primary  btn-sm"><i class="fa fa-save"></i> บันทึก</button>
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
