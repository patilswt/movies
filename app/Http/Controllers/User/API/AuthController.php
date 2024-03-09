<?php

namespace App\Http\Controllers\User\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);
   
        if($validator->fails()){ 
            $response = ['success' => false, 'message' => 'Validation Error.'];       
            $response['data'] = $validator->errors();
       
            return response()->json($response);     
        }
   
        $input = $request->all();
        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'role_id' => 2,
            'password' => Hash::make($input['password']),            
        ]);
        $success['token'] =  $user->createToken('MyApp')->plainTextToken;
        $success['name'] =  $user->name;
   
        $response = ['success' => true,'data' => $success, 'message' => 'User register successfully.'];
        return response()->json($response, 200);
    }


    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')->plainTextToken; 
            $success['name'] =  $user->name;
   
            $response = ['success' => true,'data' => $success, 'message' => 'User login successfully.'];
            return response()->json($response, 200);
        } 
        else{ 
           
            $response = ['success' => false, 'message' => 'Unauthorised.'];       
            $response['data'] = ['error'=>'Unauthorised'];
       
            return response()->json($response, 401);
        } 
    }
    
}
