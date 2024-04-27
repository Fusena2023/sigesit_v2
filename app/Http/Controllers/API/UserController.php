<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\User; 
use Illuminate\Support\Facades\Auth; 
use Validator;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller 
{
    public $successStatus = 200;
    /** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function login(){ 
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')-> accessToken; 

            $meta = [
                'code' => 200,
                'message' => 'Success',
                'status' => 'OK'
            ];

            $data = $success;
            $res['meta'] = $meta;
            $res['data'] = $data;

            return $res;

            //return response()->json(['success' => $success], $this-> successStatus); 
        } 
        else{ 
            $success['token'] ="";
            $meta = [
                    'code' => 100,
                    'message' => 'Unauthorised',
                    'status' => 'error'
            ];
            $data = $success;
            $res['meta'] = $meta;
            $res['data'] = $data;

            return $res;

            //return response()->json(['error'=>'Unauthorised'], 401); 
        } 
    }
    /** 
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */ 

    public function register2(Request $request) 
    { 
        $validator = Validator::make($request->all(), [ 
            'nama' => 'required', 
            'email' => 'required|email|unique:users_pengguna', 
            'password' => 'required',
        ]);
        if ($validator->fails()) { 

            $meta = [
            'code' => 100,
            'message' => 'Failed',
            'status' => 'error'
            ];

            $res['meta'] = $meta;
            $res['data'] = '';

            return $res;
            //return response()->json(['error'=>$validator->errors()], 401);            
        }

        $input = $request->all(); 
        $input['password'] = bcrypt($input['password']); 
        $input['jenis_pengguna'] = 2;
        $input['aktifasi'] = 't'; 
        $user = User::create($input); 

        $success['token'] =  $user->createToken('MyApp')-> accessToken; 
        //$success['name'] =  $user->name;
        $meta = [
            'code' => 200,
            'message' => 'Success',
            'status' => 'OK'
        ];

        
        $data = $success;
        $res['meta'] = $meta;
        $res['data'] = $data;

        return $res;
        //return response()->json(['success'=>$success], $this-> successStatus); 
    }

    public function register1(Request $request) 
    { 
        $validator = Validator::make($request->all(), [ 
            'nama' => 'required', 
            'email' => 'required|email|unique:users_pengguna', 
            'password' => 'required',
        ]);
        if ($validator->fails()) { 

            $meta = [
            'code' => 100,
            'message' => 'Failed',
            'status' => 'error'
            ];

            $res['meta'] = $meta;
            $res['data'] = '';

            return $res;
            //return response()->json(['error'=>$validator->errors()], 401);            
        }

        $input = $request->all(); 
        $input['password'] = bcrypt($input['password']); 
        $input['jenis_pengguna'] = 1;
        $input['aktifasi'] = 't'; 
        $user = User::create($input); 

        $success['token'] =  $user->createToken('MyApp')-> accessToken; 
        //$success['nama'] =  $user->nama;

        $meta = [
            'code' => 200,
            'message' => 'Success',
            'status' => 'OK'
        ];

        
        $data = $success;
        $res['meta'] = $meta;
        $res['data'] = $data;

        return $res;

        //return response()->json(['success'=>$success], $this-> successStatus); 
    }

    /** 
     * details api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function details() 
    { 
        $meta = [
            'code' => 200,
            'message' => 'Success',
            'status' => 'OK'
        ];

        
        $user = Auth::user(); 

        $data = $user;
        $res['meta'] = $meta;
        $res['data'] = $data;

        return $res;
        
        //return response()->json(['success' => $user], $this-> successStatus); 
    } 


    public function logoutApi()
    { 
        if (Auth::check()) {

            Auth::user()->AauthAcessToken()->delete();
            return response()->json([
                'code'    => 200,
                'message' => 'Sukses Logout'
            ]);
        }else{

            return response()->json([
                'code'    => 200,
                'message' => 'User Tidak Melakukan Login'
            ]);

        }
    }


}
