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
use App\Models\SecretName;

class DocstatusController extends Controller
{    protected  $paginate =20;

    public function index(){
        $dataset=SecretName::where('uuid','!=','')
        ->Orderby('name')
        ->paginate(10);

        return view('docstatus.index',compact('dataset') );
    }

    function add(Request $request){
        return view('docstatus.add');
    }

    public function save(Request $request){
           // dd($request->all());

        $name =isset($request->name) ? $request->name :'';
        $color=isset($request->color) ? $request->color :'';
        $faicon=isset($request->faicon) ? $request->faicon :'';
        $stat="Y";
        $uuid= str_replace('-', '', Str::uuid());
        $created_at=Carbon::now()->format("Y-m-d H:i:s");
        $created_by =isset(Auth::user()->name) ? Auth::user()->name : '';
        $updated_at =Carbon::now()->format("Y-m-d H:i:s");
        $updated_by=isset(Auth::user()->name) ? Auth::user()->name : '';
      $act=false;
      $act=  SecretName::insert([
            'uuid' =>$uuid
            , 'name'=>$name
            , 'stat'=>$stat
            , 'color'=>$color
            , 'faicon'=>$faicon
            , 'created_at'=>$created_at
            , 'created_by'=>$created_by
            , 'updated_at'=>$updated_at
            , 'updated_by'=>$updated_by
        ]);

        return redirect('/docstatus')->with('msg', $act);

    }

    public function edit(Request $request,$uuid) {

        $uuid = isset($uuid) ? $uuid :   $request->uuid;
        $data=  SecretName::where('uuid','=',$uuid)->first();

        return view('docstatus.edit',compact('data'));
    }

    public function update(Request $request) {
        $uuid =$request->uuid;
        $name =isset($request->name) ? $request->name :'';
        $color =isset($request->color) ? $request->color :'';
        $faicon=isset($request->faicon) ? $request->faicon :'';
        $created_at=Carbon::now()->format("Y-m-d H:i:s");
        $created_by =isset(Auth::user()->name) ? Auth::user()->name : '';
        $updated_at =Carbon::now()->format("Y-m-d H:i:s");
        $updated_by=isset(Auth::user()->name) ? Auth::user()->name : '';


      $act=false;
      $act=  SecretName::where('uuid','=',$uuid)->update([
            'name'=>$name
            , 'color'=>$color
            , 'faicon'=>$faicon
            , 'updated_at'=>$updated_at
            , 'updated_by'=>$updated_by
        ]);

        return redirect('/docstatus')->with('msg', $act);
    }

    public function delete(Request $request) {

        $uuid =   $request->uuid;

        $SecretName=  SecretName::where('uuid','=',$uuid)->first();
        $act=false;
        if($SecretName){
            $act= SecretName::where('uuid','=',$uuid)->delete();
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
