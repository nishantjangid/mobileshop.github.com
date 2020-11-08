<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Session;


class UserController extends Controller
{
    //
    function login(Request $req)
    {
        $customer = Customer::where(['email'=>$req->email])->first();
        if(!$customer || !Hash::check($req->password,$customer->password))
        {                 
                  
            $req->session()->flash('alertWrong','Username and Password are Incorrect');
            return redirect('/login');
        }
        else{
            $reqData = $req->input('email');            
            $req->session()->put('user',$customer);
            // $req->session()->flash('alertRight',$reqData);
            alert()->success('You are successfully Logged in')->persistent('Close')->autoClose(3000);
            return redirect('/');
        }
    }
    function registration(Request $req)
    {
        // return $req->input();
        $customer = Customer::where('email',$req->email)->count();
        
        if($customer > 0){
            $reqData = $req->input('email');
            $req->session()->flash('alertWrong',$reqData);            
            return redirect('/registration');
        }
        else{
        $customer = new Customer;
        $customer->username = $req->username;
        $customer->email = $req->email;
        $customer->password = Hash::make($req->password);
        $customer->mobile= $req->mobile;
        $customer->address = $req->address;
        $customer->save();
        alert()->success('You are registered successfully,Please Login!')->persistent('Close')->autoClose(3000);
        return redirect('/login');
        }    
    }

    function myaccount()
    {
        $customer_id = Session::get('user')['id'];
        $customerinfo = Customer::find($customer_id);
        if($customer_id == "")
        {
            return view('/login');
        }else{
            return view('myaccount',['customerinfo'=>$customerinfo]);
        }
    }
    function customerUpdate(Request $req)
    {
        $customer_id = Session::get('user')['id'];
        
        if($req->password == "")
        {
            // $data = "password blank";
            $data = Customer::where('id',$customer_id)
            ->update(['username'=>$req->username,'email'=>$req->email,'address'=>$req->address, 'mobile'=>$req->mobile]);            
        }else{
            $password = Hash::make($req->password);
            // $data = "password not blank";
            $data = Customer::where('id',$customer_id)
            ->update(['username'=>$req->username,'email'=>$req->email,'password'=>$password,'address'=>$req->address, 'mobile'=>$req->mobile]);
        }

        
        return $data;

    }

    function accountDelete(){

        $customer_id = Session::get('user')['id'];
        $data = Customer::find($customer_id);
        $data->delete();            
        return redirect('/logout');
    }
}
