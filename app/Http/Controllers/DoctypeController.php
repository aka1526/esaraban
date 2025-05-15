<?php

namespace App\Http\Controllers;


use PDF;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Elibyy\TCPDF\Facades\TCPDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Auth;
use App\Models\Doctype;

class DoctypeController extends Controller
{    protected  $paginate =20;

    public function index(){
        $dataset=Doctype::where('uuid','!=','')
        ->Orderby('name')
        ->paginate(20);

        return view('doctype.index',compact('dataset') );
    }

    function add(Request $request){
        return view('doctype.add');
    }

    public function save(Request $request){
           // dd($request->all());
        $uuid =isset($request->uuid) ? $request->uuid :'';
        $name =isset($request->name) ? $request->name :'';
        $color=isset($request->color) ? $request->color :'';
        $faicon=isset($request->faicon) ? $request->faicon :'';
        $stat="Y";
        //$uuid= str_replace('-', '', Str::uuid());
        $created_at=Carbon::now()->format("Y-m-d H:i:s");
        $created_by =isset(Auth::user()->name) ? Auth::user()->name : '';
        $updated_at =Carbon::now()->format("Y-m-d H:i:s");
        $updated_by=isset(Auth::user()->name) ? Auth::user()->name : '';
      $act=false;
      $act=  Doctype::insert([
            'uuid' =>$uuid
            , 'name'=>$name
            , 'stat'=>$stat

            , 'created_at'=>$created_at
            , 'created_by'=>$created_by
            , 'updated_at'=>$updated_at
            , 'updated_by'=>$updated_by
        ]);

        return redirect('/doctype')->with('msg', $act);

    }

    public function edit(Request $request,$uuid) {

        $uuid = isset($uuid) ? $uuid :   $request->uuid;
        $data=  Doctype::where('uuid','=',$uuid)->first();

        return view('doctype.edit',compact('data'));
    }

    public function update(Request $request) {
        $uuid =$request->uuid;
        $name =isset($request->name) ? $request->name :'';

        $created_at=Carbon::now()->format("Y-m-d H:i:s");
        $created_by =isset(Auth::user()->name) ? Auth::user()->name : '';
        $updated_at =Carbon::now()->format("Y-m-d H:i:s");
        $updated_by=isset(Auth::user()->name) ? Auth::user()->name : '';


      $act=false;
      $act=  Doctype::where('uuid','=',$uuid)->update([
            'name'=>$name

            , 'updated_at'=>$updated_at
            , 'updated_by'=>$updated_by
        ]);

        return redirect('/doctype')->with('msg', $act);
    }

    public function delete(Request $request) {

        $uuid =   $request->uuid;

        $SecretName=  Doctype::where('uuid','=',$uuid)->first();
        $act=false;
        if($SecretName){
            $act= Doctype::where('uuid','=',$uuid)->delete();
        }

        if($act){
            $icon="success";
            $msg="ลบสำเสร็จ";
            $result="success";
        } else {
            $icon="error";
            $msg="เกิดข้อผิดพลาด";
            $result="error";
        }

       return response()->json(['result'=> $result,'icon'=>$icon,'msg'=> $msg],200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);

    }

}
