<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

use App\Models\Company;

use Session;

class registerController extends Controller
{
    public function otp()
    {
        //echo Session::get('otp');
        return view('otp');
    }

    public function regenerate_otp()
    {
        /*
        Session::put('otp', rand(100000,999999));
        return redirect()->back();
        */
        $otp = rand(100000,999999);
        Session::put('otp', $otp);

        /*
        $subject = "OTP - Esignpro";
        $message = "Your OTP is  : ".$otp;
        app('App\Http\Controllers\sendmailController')->sendmail(Session::get('company_email'),$subject,$message);
        */
        $this->global_otp_generate(Session::get('company_email'));
        
        Session::flash('message', 'OTP sent successfully'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect()->back();
        
    }

/*
    public function otp_check(Request $request)
    {
        if(Session::get('otp')==$request->input('txt_otp'))
        {
            Session::put('otp_verified', 'Yes');
            return redirect('dashboard');
        }
        else
        {
            Session::flash('message', 'Invalid OTP'); 
            Session::flash('alert-class', 'alert-danger'); 
            return redirect()->back();
        }
        
    }
*/
    public function otp_check(Request $request)
    {
        if(Session::get('otp')==$request->input('txt_otp'))
        {
            //Expiry check
            $current_time = date('Y-m-d H:i:s');
            $expiry_time = Session::get('expiry_time');
            if($current_time<$expiry_time)
            {
                Session::put('expiry_time',$expiry_time);
                Session::put('otp_verified', 'Yes');
                return redirect('dashboard');
            }
            else 
            {
                Session::flash('message', 'You OTP is Expired, Regenerate OTP'); 
                Session::flash('alert-class', 'alert-danger'); 
                return redirect()->back();
            }
            //Expiry check
                
        }
        else
        {
            Session::flash('message', 'Invalid OTP'); 
            Session::flash('alert-class', 'alert-danger'); 
            return redirect()->back();
        }
        
    }
    //
    public function register()
    {
        return view('register');
    }

    public function save_company(Request $request)
    {
        $columns=Schema::getColumnListing('company');    
        $company_count=Company::select($columns)
                    ->where('company_email', '=', $request->input('txt_email'))
                    ->get()->count();

        if($company_count == 0)
        {
            $company = new Company();

            $company->company_name = $request->input('txt_name');
            $company->company_email = $request->input('txt_email');
            //$company->company_password = $request->input('txt_password');
            $password  = md5($request->input('txt_password'));
            $company->company_password = $password;
            $company->company_doj = date('Y-m-d');
            $company->company_status = 'Active';

            $company->save();

            Session::flash('message', 'You are successfully registered, Now you can Login'); 
            Session::flash('alert-class', 'alert-success'); 
        }
        else
        {
            Session::flash('message', 'Email ID already registered'); 
            Session::flash('alert-class', 'alert-danger'); 
        }

        return redirect()->back();
        
        
    }

    public function login()
    {
        //return view('login');
        return redirect('dashboard');
    }

    public function login_check(Request $request)
    {
        $password = md5($request->input('txt_password'));
        
        $columns=Schema::getColumnListing('company');    
        $company_list=Company::select($columns)
                    ->where('company_email', '=', $request->input('txt_email'))
                    ->where('company_password', '=', $password)
                    ->get();
        $company_count  = $company_list->count();
        if($company_count==0)
        {
            Session::flash('message', 'Invalid Email or Password'); 
            Session::flash('alert-class', 'alert-danger'); 
            return redirect()->back();
        }
        else
        {
            foreach ($company_list as $company) {
                $request->session()->put('company_id',$company->company_id);
                $request->session()->put('company_name',$company->company_name);
                $request->session()->put('company_email',$company->company_email);
                
            }
            
            /*
            //extra code
            $otp = rand(100000,999999);
            Session::put('otp', $otp);

            $subject = "OTP - Esignpro";
            $message = "Your OTP is  : ".$otp;
            app('App\Http\Controllers\sendmailController')->sendmail($company->company_email,$subject,$message);
            */
            $this->global_otp_generate($company->company_email);
            
            return redirect('otp');
            //extra code
            
            //return redirect('dashboard');
        }
    }

    public function logout(Request $request)
    {
        $request->session()->forget('company_id');
        $request->session()->forget('otp_verified');
        return redirect('login');
    }
    
    public function global_otp_generate($email)
    {
        $otp = rand(100000,999999);
        Session::put('otp', $otp);

        //add 10 minutes expiration
        $expiry_time = date("Y-m-d H:i:s", strtotime("+10 minutes"));
        Session::put('expiry_time',$expiry_time);
        //add 10 minutes expiration
        

        $subject = "OTP - Esignpro";
        $message = "Your OTP is  : ".$otp;
        app('App\Http\Controllers\sendmailController')->sendmail($email,$subject,$message);
            
                    
    }
    
}
