<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

use App\Models\Document;
use App\Models\Form;
use App\Models\DocumentReply;

use App\Http\Middleware\checkLogin;

use Session;
class dashboardController extends Controller
{
    public function __construct()
    {
        //$this->middleware('checkLogin');
    }
    //
    public function dashboard(Request $request)
    {

        $request->session()->put('company_id','8');
        $request->session()->put('company_name','Eyehub');
        $request->session()->put('company_email','eyehub@gmail.com');
        Session::put('otp_verified', 'Yes');
        
        $data=array();
        
        $columns=Schema::getColumnListing('document');
        $data['document_count']=Document::select($columns)
                    ->where("company_id","=",Session::get('company_id'))
                    ->get()->count();

        $columns=Schema::getColumnListing('document_reply');
        $data['reply_count']=DocumentReply::select($columns)
                    ->where("company_id","=",Session::get('company_id'))
                    ->get()->count();
        
        return view('dashboard',$data);
        

        /*
        $url = config('app.url');
        print_r($url); 
        */
    }
}
