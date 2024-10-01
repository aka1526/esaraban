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
use App\Models\SettingDoc;
use App\Models\Document;

class SettingDocController extends Controller
{    protected  $paginate =20;

    public function index(){

        $DocRec=SettingDoc::where('doc_type','=','REC')->first();
        $DocSend=SettingDoc::where('doc_type','=','SEND')->first();
        $DocIn=SettingDoc::where('doc_type','=','DOCIN')->first();

        return view('settingdoc.add',compact('DocRec','DocSend','DocIn') );
    }

    public function save(Request $request){
           // dd($request->all());

        $uuid =isset($request->uuid) ? $request->uuid :'';
        $doc_type =isset($request->doc_type) ? $request->doc_type :'';
        $prefix1 =isset($request->prefix1) ? $request->prefix1 :'';
        $doc_year =isset($request->doc_year) ? $request->doc_year :'';
        $prefix2 =isset($request->prefix2) ? $request->prefix2 :'';
        $doc_month =isset($request->doc_month) ? $request->doc_month :'';

        $prefix3 =isset($request->prefix3) ? $request->prefix3 :'';
        $doc_digit =isset($request->doc_digit) ? $request->doc_digit : 3;
        $previewnumber = "";

        if($prefix1!=''){
            $previewnumber .= $prefix1;
        }

        if($doc_year!=''){
            if($doc_year=='yy'){
                $previewnumber .=  date('y');
            }else if($doc_year=='yyyy'){
                $previewnumber .=  date('Y');
            }

        }

        if($prefix2!=''){
            $previewnumber .= $prefix2;
        }
        if($doc_month!=''){
            if($doc_month=='m'){
                $previewnumber .=  date('m');
            }else if($doc_month=='mm'){
                $previewnumber .=  strtolower(date('M'));
            }

        }
        if($prefix3!=''){
            $previewnumber .= $prefix3;
        }


         $previewnumber .=  str_pad(1, ($doc_digit>3 ? $doc_digit : 3), '0', STR_PAD_LEFT);




        $created_at=Carbon::now()->format("Y-m-d H:i:s");
        $created_by =isset(Auth::user()->name) ? Auth::user()->name : '';
        $updated_at =Carbon::now()->format("Y-m-d H:i:s");
        $updated_by=isset(Auth::user()->name) ? Auth::user()->name : '';
        $act=false;
        if($uuid==''){

            $uuid= str_replace('-', '', Str::uuid());
            $act=  SettingDoc::insert([
                'uuid' =>$uuid
                , 'doc_type'=>$doc_type
                , 'prefix1'=>$prefix1
                , 'doc_year'=>$doc_year
                , 'prefix2'=>$prefix2
                , 'doc_month'=>$doc_month
                , 'prefix3'=>$prefix3
                , 'doc_digit'=>$doc_digit
                , 'previewnumber'=>$previewnumber

                , 'created_at'=>$created_at
                , 'created_by'=>$created_by
                , 'updated_at'=>$updated_at
                , 'updated_by'=>$updated_by
            ]);
        } else {
            $act=  SettingDoc::where('uuid',$uuid)->update([
                 'prefix1'=>$prefix1
                , 'doc_year'=>$doc_year
                , 'prefix2'=>$prefix2
                , 'doc_month'=>$doc_month
                , 'prefix3'=>$prefix3
                , 'doc_digit'=>$doc_digit
                , 'previewnumber'=>$previewnumber


                , 'updated_at'=>$updated_at
                , 'updated_by'=>$updated_by
            ]);
        }



        return redirect('/setting')->with('msg', $act);

    }


    public function genDocumber($doc_type, $docdate=""){
        $docno="";
        $docdate=$docdate==""? Carbon::now()->format("Y-m-d") : $docdate;

        $tra_year   = Carbon::parse($docdate)->format('Y');
        $tra_month  = Carbon::parse($docdate)->format('m');

        $SettingDoc= SettingDoc::where('doc_type',$doc_type)->first();
        $prefix1=isset($SettingDoc->prefix1) ? $SettingDoc->prefix1 : '';
        $doc_year=isset($SettingDoc->doc_year) ? $SettingDoc->doc_year : '';
        $prefix2=isset($SettingDoc->prefix2) ? $SettingDoc->prefix2 : '';
        $doc_month=isset($SettingDoc->doc_month) ? $SettingDoc->doc_month : '';
        $prefix3=isset($SettingDoc->prefix3) ? $SettingDoc->prefix3 : '';
        $doc_digit=isset($SettingDoc->doc_digit) ? $SettingDoc->doc_digit : 3;


        if($prefix1!=''){
            $docno .= $prefix1;
        }

        if($doc_year!=''){
            if($doc_year=='yy'){
                $docno .=  date('y');
            }else if($doc_year=='yyyy'){
                $docno .=  date('Y');
            }

        }

        if($prefix2!=''){
            $docno .= $prefix2;
        }
        if($doc_month!=''){
            if($doc_month=='m'){
                $docno .=  date('m');
            }else if($doc_month=='mm'){
                $docno .=  strtolower(date('M'));
            }

        }
        if($prefix3!=''){
            $docno .= $prefix3;
        }

        $number=Document::where('doc_type',$doc_type)
        ->where(function($query) use ($doc_year, $tra_year) {
            if ($doc_year !="") {
                $query->where('tra_year','=', $tra_year);
                return $query ;
            }
        })
        ->where(function($query) use ($doc_month,$tra_month) {
            if ($doc_month !="") {
                $query->where('tra_month','=',$tra_month);
                return $query ;
            }
        })
        ->max('max_doc');
        $number=$number>0? $number+1 : 1;

         $docno .=  str_pad($number, $doc_digit, '0', STR_PAD_LEFT);
        $data=array();
        $data['docno']=$docno;
        $data['max_doc']=$number;
        $data['prefix']=$prefix1;
        return $data;
    }


}
