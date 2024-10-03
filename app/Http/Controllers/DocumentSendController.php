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
use App\Models\Document;
use App\Models\SettingDoc;
use App\Models\Section;
use App\Models\Doctype;

use App\Http\Controllers\SettingDocController;
use App\Http\Controllers\UploadFileController as UploadFile;

class DocumentSendController extends Controller
{    protected  $paginate =20;
     protected  $doc_type ="SEND";
    public function index(Request $request){

        $tra_year =isset($request->tra_year) ? $request->tra_year :'';
        $tra_month =isset($request->tra_month) ? $request->tra_month :'';
        $search =isset($request->search) ? $request->search :'';
        $doc_group =isset($request->doc_group) ? $request->doc_group :'';
        $doc_project =isset($request->doc_project) ? $request->doc_project :'';
        $type =isset($request->type) ? $request->type :'';

        $dataset=Document::where('doc_type','=',$this->doc_type)
        ->where(function($query) use ($search) {
            if ($search !="") {
                $query->Where('runnumber','like', '%'.$search.'%')
                        ->orWhere('prefix_doc', 'like','%'.$search.'%')
                        ->orWhere('doc_from', 'like','%'.$search.'%')
                        ->orWhere('doc_no', 'like','%'.$search.'%')
                        ->orWhere('doc_group', 'like','%'.$search.'%')
                        ->orWhere('type', 'like','%'.$search.'%')
                        ->orWhere('doc_project', 'like','%'.$search.'%')
                        ->orWhere('doc_to', 'like','%'.$search.'%')
                        ->orWhere('doc_subject', 'like','%'.$search.'%');

                return $query ;
            }
        })

        ->where(function($query) use ($tra_year) {
            if ($tra_year !="") {
                $query->where('tra_year','=', $tra_year);
                return $query ;
            }
        })
        ->where(function($query) use ($tra_month) {
            if ($tra_month !="") {
                $query->where('tra_month','=', $tra_month);
                return $query ;
            }
        })
        ->where(function($query) use ($doc_project) {
            if ($doc_project !="") {
                $query->where('doc_project','=', $doc_project);
                return $query ;
            }
        })
        ->where(function($query) use ($doc_group) {
            if ($doc_group !="") {
                $query->where('doc_group','=', $doc_group);
                return $query ;
            }

        })
        ->where(function($query) use ($type) {
            if ($type !="") {
                $query->where('type','=', $type);
                return $query ;
            }

        })
         ->Orderby('runnumber','desc')
        ->paginate($this->paginate);

        return view('document.send.index',compact('dataset','search','doc_project','doc_group','type','tra_year','tra_month') );
    }

    function add(Request $request){
        return view('document.send.add');
    }

    public function save(Request $request){
        // dd($request->all());
        $uuid =isset($request->uuid) ? $request->uuid:'';
        $lavel_urgent =isset($request->lavel_urgent) ? $request->lavel_urgent:'A';
        $lavel_secret =isset($request->lavel_secret) ? $request->lavel_secret :'A';
        $doc_no =isset($request->doc_no) ? $request->doc_no :'';
        $doc_date =isset($request->doc_date) ? $request->doc_date :'';

        $doc_from =isset($request->doc_from) ? $request->doc_from :'';
        $doc_to =isset($request->doc_to) ? $request->doc_to :'';

        $doc_project =isset($request->doc_project) ? $request->doc_project :'';
        $doc_group =isset($request->doc_group) ? $request->doc_group :'';
        $type =isset($request->type) ? $request->type :'';

        $this->addASection ($doc_from,"EX");
        $this->addASection ($doc_to,"IN");

        $doc_subject =isset($request->doc_subject) ? $request->doc_subject :'';

        $doc_date  = Carbon::parse($doc_date)->format('Y-m-d');

        $tra_date   = Carbon::now()->format("Y-m-d");
        $tra_month  = Carbon::now()->format("m");
        $tra_year   = Carbon::now()->format("Y");
        $SettingDoc=new SettingDocController();

        $data= $SettingDoc->genDocumber($this->doc_type, $doc_date );

       $runnumber= $data['docno'] ;
       $max_doc = $data['max_doc'] ;
       $prefix_doc=$data['prefix'] ;


        $doc_status="PENDING";


        $created_at=Carbon::now()->format("Y-m-d H:i:s");
        $created_by =isset(Auth::user()->name) ? Auth::user()->name : '';
        $updated_at =Carbon::now()->format("Y-m-d H:i:s");
        $updated_by=isset(Auth::user()->name) ? Auth::user()->name : '';
      $act=false;
      if($uuid ==''){
        $uuid= str_replace('-', '', Str::uuid());
        $request->uuid =$uuid;
        $act=  Document::insert([
            'uuid' =>$uuid
            ,'runnumber'=>$runnumber
            ,'max_doc'=>$max_doc
            ,'prefix_doc'=>$prefix_doc
            ,'tra_year'=>$tra_year
            ,'tra_month'=>$tra_month
            ,'tra_date'=>$tra_date

            , 'lavel_urgent'=>$lavel_urgent
            , 'lavel_secret'=>$lavel_secret

            ,'doc_project'=>$doc_project
            ,'doc_group'=>$doc_group
            ,'type'=>$type

            , 'doc_type'=>$this->doc_type
            , 'doc_status'=>$doc_status
            , 'doc_no'=>$doc_no
            , 'doc_date'=>$doc_date
            , 'doc_from'=>$doc_from
            , 'doc_to'=>$doc_to
            , 'doc_subject'=>$doc_subject


            , 'created_at'=>$created_at
            , 'created_by'=>$created_by
            , 'updated_at'=>$updated_at
            , 'updated_by'=>$updated_by
        ]);

      }else{
        $act=  Document::where('uuid','=',$uuid)->update([

            'prefix_doc'=>$prefix_doc
            ,'tra_year'=>$tra_year
            ,'tra_month'=>$tra_month
            ,'tra_date'=>$tra_date

            , 'lavel_urgent'=>$lavel_urgent
            , 'lavel_secret'=>$lavel_secret

            ,'doc_project'=>$doc_project
            ,'doc_group'=>$doc_group
            ,'type'=>$type

            , 'doc_type'=>$this->doc_type
            , 'doc_status'=>$doc_status
            , 'doc_no'=>$doc_no
            , 'doc_date'=>$doc_date
            , 'doc_from'=>$doc_from
            , 'doc_to'=>$doc_to
            , 'doc_subject'=>$doc_subject

            , 'updated_at'=>$updated_at
            , 'updated_by'=>$updated_by
        ]);

      }
      $Upload=false;

      if ($request->hasfile('file')) {
          $UploadFile= new UploadFile();
          $Upload=  $UploadFile->uploadFile($request);
      }

        return redirect('/document-send')->with('msg', $act);

    }

       public function addASection ($name,$type){

        $created_at=Carbon::now()->format("Y-m-d H:i:s");
        $created_by =isset(Auth::user()->name) ? Auth::user()->name : '';
        $updated_at =Carbon::now()->format("Y-m-d H:i:s");
        $updated_by=isset(Auth::user()->name) ? Auth::user()->name : '';
        $checkName= Section::where('name','=',$name)->where('type',$type)->count();
        if($checkName==0){
            $uuid= str_replace('-', '', Str::uuid());
            $act=  Section::insert([
                'uuid'=>$uuid
               , 'name'=>$name
               , 'type'=>$type
                , 'created_at'=>$created_at
                , 'created_by'=>$created_by
                , 'updated_at'=>$updated_at
                , 'updated_by'=>$updated_by
            ]);
        }

    }

    public function edit(Request $request,$uuid) {

        $uuid = isset($uuid) ? $uuid :   $request->uuid;
        $data=  Document::where('uuid','=',$uuid)->first();

        return view('document.send.edit',compact('data'));
    }

    public function update(Request $request) {
        $uuid =$request->uuid;
        $name =isset($request->name) ? $request->name :'';

        $created_at=Carbon::now()->format("Y-m-d H:i:s");
        $created_by =isset(Auth::user()->name) ? Auth::user()->name : '';
        $updated_at =Carbon::now()->format("Y-m-d H:i:s");
        $updated_by=isset(Auth::user()->name) ? Auth::user()->name : '';


      $act=false;
      $act=  Section::where('uuid','=',$uuid)->update([
            'name'=>$name
            , 'updated_at'=>$updated_at
            , 'updated_by'=>$updated_by
        ]);

        return redirect('/section-internal')->with('msg', $act);
    }

    public function delete(Request $request) {

        $uuid =   $request->uuid;

        $Document=  Document::where('uuid','=',$uuid)->first();
        $act=false;
        if($Document){
            $act= Document::where('uuid','=',$uuid)->delete();
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
