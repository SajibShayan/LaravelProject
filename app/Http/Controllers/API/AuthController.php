<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
//se Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function index(){
        $users = User::all();
        return response()->json($users);
    }

    public function register(Request $request){
        //validation

        $validator =  Validator::make($request->all(), [

            'name' => 'required',
            'email' => 'required | email',
            'password' => 'required',
            'c_password' => 'required|same:password',

        ]);


        if($validator->fails()){

            $response = [
                'success' => false,
                'message' => $validator->errors(),
            ];

            return response()->json($response, 400);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        $success['token'] = $user->createToken('MyApp')->plainTextToken;
        $success['name'] = $user->name;

        $response = [

            'success' => true,
            'data' => $success,
            'message' => 'User register successfully', 
        ];
 
        return response()->json($response, 200);
    }

    public function login(Request $request){
        if(Auth::attempt(['email'=>$request->email, 
        'password'=>$request->password])){

            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->plainTextToken;
            $success['user'] = $user;
    
            $response = [
    
                'success' => true,
                'data' => $success,
                'message' => 'User login successfully', 
            ];

            return response()->json($response, 200);
        }
        else{

            $response = [
                'success' => false,
                'message' => 'User Not Found..!'
            ];

            return response()->json($response);
        }
    }


   public function logOut(Request $request){

    
        //dd('hello');
        // $user = Auth::user();
        // $success['token'] = $user->createToken('MyApp')->plainTextToken;
        // $success['name'] = $user->name;

        $request->user()->currentAccessToken()->delete();

        $response = [

            'success' => true,
            'message' => 'User logout successfully', 
        ];

        return response()->json($response);
    

    }

    public function userDelete(Request $request){
        

    $request->user()->currentAccessToken()->delete();
    
   
    $delete = User::find($request->id)->delete();
    return response()->json('User Deleted');

    }


}
