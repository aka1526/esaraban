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
use File;
use App\Models\Uploads;
use App\Models\Document;
class UploadFileController  extends Controller{

    public function uploadFile(Request $request){
        // Validate the file input
    $request->validate([
        'file.*' => 'required|file', // Validate each file in the array
    ]);
    $ref_uuid =isset($request->uuid) ? $request->uuid :$request->ref_uuid;
    $act=false;
    // Define the destination path
    $destinationPath = public_path('uploads');

    // Check if the uploads directory exists, if not, create it
    if (!File::exists($destinationPath)) {
        File::makeDirectory($destinationPath, 0755, true); // Create the directory with permissions
    }

    // Array to hold file names for display
    $fileNames = [];

    // Handle the file upload
    if ($request->hasfile('file')) {
        foreach ($request->file('file') as $file) {
            $fileName = time() . '_' . $file->getClientOriginalName(); // Generate a unique file name
            $file_ext =   $file->extension();
            $file->move($destinationPath, $fileName); // Move each file to public/uploads
            $fileNames[] = $fileName; // Store the file name for display

            $uuid= str_replace('-', '', Str::uuid());
            $Document=Document::where('uuid',$ref_uuid)->first();
            $doc_no="";
            if($Document){
                $doc_no  =  $Document->doc_no;
            }

            $created_at=Carbon::now()->format("Y-m-d H:i:s");
            $created_by =isset(Auth::user()->name) ? Auth::user()->name : '';
            $updated_at =Carbon::now()->format("Y-m-d H:i:s");
            $updated_by=isset(Auth::user()->name) ? Auth::user()->name : '';

            $act=Uploads::insert([
                'uuid'=>$uuid
                ,'ref_uuid'=>$ref_uuid
                ,'doc_no'=>$doc_no
              ,  'file_name'=>$fileName
              ,  'file_ext'=>$file_ext
              ,  'created_at'=>$created_at
              ,  'created_by'=>$created_by
              ,  'updated_at'=>$updated_at
              ,  'updated_by'=>$updated_by
            ]);

        }
    }
    return $act;
    }

    public function deletefile( Request $request){

        $uuid =isset($request->uuid) ? $request->uuid : '' ;
        $check=Uploads::where('uuid',$uuid)->count();
        $act=false;
        if($check){
            $act=Uploads::where('uuid',$uuid)->delete();
        }
        return response()->json(['result'=> $act  ],200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);

    }

}
