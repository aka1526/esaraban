<?php

namespace App\Http\Controllers;


use PDF;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Elibyy\TCPDF\Facades\TCPDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Carbon\Carbon;
use Auth;

use App\Models\SecretName;
use App\Models\User;

class UsersController extends Controller
{    protected  $paginate =20;

    public function index(){
        $dataset=User::where('id','!=','')
        ->Orderby('name')
        ->paginate(10);

        return view('users.index',compact('dataset') );
    }

    function add(Request $request){
        return view('users.add');
    }

    public function save(Request $request){
     // dd($request->all());
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
           // 'password' => ['required', 'confirmed', Rules\Password::defaults()],
             'password' => ['required' ],
        ]);
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return redirect('/users')->with('msg', $user);
        } catch (\Exception $e) {

            return redirect('/users')->with('error', $e->getMessage());
        }


    }

    public function editpassword(Request $request,$id) {

        $id = isset($id) ? $id :   $request->id;
        $user=  User::where('id','=',$id)->first();
        return view('users.editpassword',compact('user'));
    }

    public function edit(Request $request,$id) {

        $id = isset($id) ? $id :   $request->id;
        $user=  User::where('id','=',$id)->first();
        return view('users.edit',compact('user'));
    }

    public function update(Request $request) {
        $password =isset($request->password) ? $request->password :'';
        $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255' ],
            ]);
             $act=false;
        $user = User::where('id','=',$request->id)->first();
        if($user){
            $act= User::where('id','=',$request->id)->update([
                'name' => $request->name,
                'email' => $request->email,

            ]);

            if($password){
               $act= User::where('id','=',$user->id)->update(['password'=>Hash::make($password)]);
            }
        }
        return redirect('/users')->with('msg', $act);
    }


    public function updatepassword(Request $request) {
         $id =isset($request->id) ? $request->id :'';
         $password =isset($request->password) ? $request->password :'';
        $request->validate([
                'id' => ['required' ],
                'password' => ['required' ]
            ]);
        $act=false;
        $user = User::where('id','=',$id)->first();
        if($user){
             $act= User::where('id','=',$id)->update(['password'=>Hash::make($password)]);

        }
        return redirect('/users')->with('msg', $act);
    }

    public function delete(Request $request) {

        $id =   isset($request->id) ? $request->id :'';

        $User=  User::where('id','=',$id)->first();
        $act=false;
        if($User){
            $act= User::where('id','=',$id)->delete();
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
