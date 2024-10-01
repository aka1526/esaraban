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
use App\Models\Mainmenu;

class MainMenuController extends Controller
{    protected  $paging =30;

    public function index(){


        return view('mainmenu.index' );
    }

    function add(Request $request){

        return view('base.bank.add');
    }

    public function save(Request $request){

        $bank_id =$request->bank_id;
        $bank_name =isset($request->bank_name) ? $request->bank_name :'';

        $uuid= str_replace('-', '', Str::uuid());
        $created_at=Carbon::now()->format("Y-m-d H:i:s");
        $created_by =Auth::user()->name;
        $updated_at =Carbon::now()->format("Y-m-d H:i:s");
        $updated_by=Auth::user()->name;


      $act=false;
      $act=  Bank::insert([
            'uuid' =>$uuid
            , 'bank_id'=>$bank_id
            , 'bank_name'=>$bank_name


            , 'created_at'=>$created_at
            , 'created_by'=>$created_by
            , 'updated_at'=>$updated_at
            , 'updated_by'=>$updated_by
        ]);

        return redirect('/base/bank')->with('msg', $act);

    }

    public function edit(Request $request,$uuid) {

        $uuid = isset($uuid) ? $uuid :   $request->uuid;
        $Bank=  Bank::where('uuid','=',$uuid)->first();

        return view('base.bank.edit',compact('Bank'));
    }

    public function update(Request $request) {

        $uuid =$request->uuid;
        $bank_id =$request->bank_id;
        $bank_name =isset($request->bank_name) ? $request->bank_name :'';


        $created_at=Carbon::now()->format("Y-m-d H:i:s");
        $created_by =Auth::user()->name;
        $updated_at =Carbon::now()->format("Y-m-d H:i:s");
        $updated_by=Auth::user()->name;


      $act=false;
      $act=  Bank::where('uuid','=',$uuid)->update([

            'bank_id'=>$bank_id
            , 'bank_name'=>$bank_name

            , 'updated_at'=>$updated_at
            , 'updated_by'=>$updated_by
        ]);

        return redirect('/base/bank')->with('msg', $act);
    }

    public function delete(Request $request) {

        $uuid =   $request->uuid;
        $Bank=  Bank::where('uuid','=',$uuid)->first();
        $act=false;
        if($Bank){
            $act= Bank::where('uuid','=',$uuid)->delete();
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
