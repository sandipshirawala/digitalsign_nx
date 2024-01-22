<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

use App\Models\Form;
use App\Models\Document;
use App\Models\DocumentReply;
use App\Models\LogHistory;
use App\Models\DocDecline;

use App\Http\Middleware\checkLogin;

//use App\Http\Controllers\CustomerController;

//use Illuminate\Support\Facades\DB;
use DB;
use Session;


class getsignController extends Controller
{

    public function __construct()
    {
        $this->middleware('checkLogin');
    }
    //
    public function get_signature()
    {
        $columns=Schema::getColumnListing('form');
        $data['forms_list']=Form::select($columns)
                    ->where("company_id","=",Session::get("company_id"))
                    ->get();
        return view('get_signature',$data);
    }

    public function sent_doc()
    {
        
        /*
        // Store the file name into variable 
        $file = 'https://royalegroupnyc.com/wp-content/uploads/seating_areas/sample_pdf.pdf'; 
        $filename = 'filename.pdf'; 
        
        // Header content type 
        header('Content-type: application/pdf'); 
        
        header('Content-Disposition: inline; filename="' . $filename . '"'); 
        
        header('Content-Transfer-Encoding: binary'); 
        
        header('Accept-Ranges: bytes'); 
        
        // Read the file 
        @readfile($file); 
        */
        
        
        $data['title']='Sent List';
        $columns=Schema::getColumnListing('document');
        $data['document_list']=Document::select($columns)
                    ->where("company_id","=",Session::get('company_id'))
                    ->get()
                    ->sortByDesc("document_id");
        return view('sent_doc',$data);
        
        //echo $this->get_file_names('1,2');
        
    }

    public function send_signature_form(Request $request)
    {
        $emails = explode(",",$request->input('txt_email'));
        $mode   = $request->input('txt_mode');
        $msg    = $request->input('txt_message');
        $date   = date('Y-m-d H:i:s');
        $status = 'Pending';
        $open   = 'No';
        $company_id = Session::get('company_id');

        $form_files = implode(",",$request->input('cmb_form'));
        echo $form_files;
        
        //added code
        //$first_file_id = $form_files[0];
        //added code
        
        
        $first_form_files_array = $request->input('cmb_form');
        $first_file_id = $first_form_files_array[0];
        
        //echo "<h1>First form id :".$first_file_id."</h1>";
        
        
        //echo "<h1>".config('app.url')."</h1>";
        
        
        
        if($mode=="Email")
        {
        
            for($i=0;$i<count($emails);$i++)
            {
                echo "<br>".$emails[$i];
                $document =  new Document();
                $document->document_mode =  $mode;
                $document->document_form_files = $form_files;
                $document->document_email = $emails[$i];
                $document->document_message = $msg;
                $document->document_sent_date = $date;
                $document->document_status = $status;
                $document->doc_open = $open;
                $document->company_id = $company_id;
                $document->save();
    
                echo "<h1>Inserted id :" .$document->document_id."</h1>";
                $inserted_id = $document->document_id;

                //log
                for($k=0;$k<count($_POST['cmb_form']);$k++)
                {
                    $log_history = new LogHistory();
                    $log_history->document_id = $inserted_id;
                    $log_history->form_id = $_POST['cmb_form'][$k];
                    $log_history->log_history_action = 'document_create';
                    $log_history->log_name = Session::get("company_name");
                    $log_history->log_email =  Session::get("company_email");
                    $log_history->log_date_time = date("Y-m-d H:i:s");
                    $log_history->log_date_time_zone = "GMT";
                    $log_history->log_ip_address = $_SERVER['REMOTE_ADDR'];
                    $log_history->log_message =  "Document created by ".Session::get("company_name")."(".Session::get("company_email").")";
                    $log_history->log_guid = $this->generateRandomString(25);
                    $log_history->save();
                }

                for($k=0;$k<count($_POST['cmb_form']);$k++)
                {
                    $log_history = new LogHistory();
                    $log_history->document_id = $inserted_id;
                    $log_history->form_id = $_POST['cmb_form'][$k];
                    $log_history->log_history_action = 'document_emailed';
                    $log_history->log_name = $emails[$i];
                    $log_history->log_email =  $emails[$i];
                    $log_history->log_date_time = date("Y-m-d H:i:s");
                    $log_history->log_date_time_zone = "GMT";
                    $log_history->log_ip_address = $_SERVER['REMOTE_ADDR'];
                    //$log_history->log_message =  "Document created by ".Session::get("company_name")."(".Session::get("company_email").")";
                    $log_history->log_message = "Document emailed to ".$emails[$i]." for signature";
                    //$log_history->log_guid = $this->generateRandomString(25);
                    $log_history->save();
                }
                //log
    
                /*
                //sending email
                //app('App\Http\Controllers\sendmailController')->sendmail($emails[$i]);
                $subject ="Review Document from Esign";
                $url     = $request->getHttpHost();
                $public_path = public_path();
                //$message = $msg."<br><a href='https://eyehub.xcesslogic.info/customer_sign_2?document_id=".$inserted_id."&form_id=".$first_file_id."'>Review Document</a>";
                $message = $msg."<br><a href='".config('app.url')."/customer_sign_2?document_id=".$inserted_id."&form_id=".$first_file_id."'>Review Document</a>";
                app('App\Http\Controllers\sendmailController')->sendmail($emails[$i],$subject,$message);
                //sending email
                */

                //sending email
                //app('App\Http\Controllers\sendmailController')->sendmail($emails[$i]);
                $subject ="Digital Sign has requested your signatures";
                $url     = $request->getHttpHost();
                $public_path = public_path();
                //$message = $msg."<br><a href='".config('app.url')."/customer_sign_2?document_id=".$inserted_id."&form_id=".$first_file_id."'>Review Document</a>";
                $review_link = $message = $msg."<br><a href='".config('app.url')."/customer_sign_2?document_id=".$inserted_id."&form_id=".$first_file_id."'>Review & Sign Document</a>";
                $message = "Document Review and Signature Request from Digital Sign<br><br>";
                $message = $message."Dear ".$emails[$i].",<br><br>";
                $message = $message."Digital Sign has sent you the following document(s) for your review and signature. Please take a moment to complete this process promptly.<br><br>";
                $message = $message.$review_link."<br><br>";
                $message = $message."If you encounter any issues, please don't hesitate to contact us at (07) 5220 8990 or via email at concierge@Digital Sign.net.au.<br><br>";
                $message = $message."Thank you for your prompt attention to this matter.<br><br>";
                $message = $message."Best regards,<br>";
                $message = $message."Digital Sign Team<br>";
                //$message = $message."<a href='https://www.eyehub.net.au/' target='_blank'>https://www.eyehub.net.au/</a><br>";
                app('App\Http\Controllers\sendmailController')->sendmail($emails[$i],$subject,$message);
                //sending email
                

                
                
                
            }
        }
        else if($mode=="Local")
        {
                $document =  new Document();
                $document->document_mode =  $mode;
                $document->document_form_files = $form_files;
                $document->document_email = $request->input('txt_name');
                $document->document_message = $msg;
                $document->document_sent_date = $date;
                $document->document_status = $status;
                $document->doc_open = $open;
                $document->company_id = $company_id;
                $document->save();

                echo "<h1>Inserted id :" .$document->document_id."</h1>";
                $inserted_id = $document->document_id;

                //log
                for($k=0;$k<count($_POST['cmb_form']);$k++)
                {
                    $log_history = new LogHistory();
                    $log_history->document_id = $inserted_id;
                    $log_history->form_id = $_POST['cmb_form'][$k];
                    $log_history->log_history_action = 'document_create';
                    $log_history->log_name = Session::get("company_name");
                    $log_history->log_email =  Session::get("company_email");
                    $log_history->log_date_time = date("Y-m-d H:i:s");
                    $log_history->log_date_time_zone = "GMT";
                    $log_history->log_ip_address = $_SERVER['REMOTE_ADDR'];
                    $log_history->log_message =  "Document created by ".Session::get("company_name")."(".Session::get("company_email").")";
                    $log_history->log_guid = $this->generateRandomString(25);
                    $log_history->save();
                }
                for($k=0;$k<count($_POST['cmb_form']);$k++)
                {
                    $log_history = new LogHistory();
                    $log_history->document_id = $inserted_id;
                    $log_history->form_id = $_POST['cmb_form'][$k];
                    $log_history->log_history_action = 'document_emailed';
                    $log_history->log_name =  $request->input('txt_name');
                    $log_history->log_email =  $request->input('txt_name');
                    $log_history->log_date_time = date("Y-m-d H:i:s");
                    $log_history->log_date_time_zone = "GMT";
                    $log_history->log_ip_address = $_SERVER['REMOTE_ADDR'];
                    //$log_history->log_message =  "Document created by ".Session::get("company_name")."(".Session::get("company_email").")";
                    $log_history->log_message = "Document emailed to ".$request->input('txt_name')." for signature";
                    //$log_history->log_guid = $this->generateRandomString(25);
                    $log_history->save();
                }
                //log

                return redirect("customer_sign_2?document_id=".$inserted_id."&form_id=".$first_file_id);
        }

        return redirect('sent_doc');
        
    }

    public static function get_file_names($document_form_files)
    {
        $form_name=array();
        $form_list = DB::select('select * from form where form_id in ('.$document_form_files.')');
        foreach($form_list as $form)
        {
            //echo "<br>".$form->form_title;
            $form_name[] = $form->form_title;
        }
        return implode(", ",$form_name);
    }
    
    public function signed_doc(Request $request)
    {
        echo "<br>Signed Doc<br>";
        
        /*
        $columns=Schema::getColumnListing('document_reply');
        $data['document_reply_list']=DocumentReply::select($columns)
                    ->get()
                    ->sortByDesc("document_reply_id");
        return view("signed_doc",$data);
        */

        /*
        $users = DB::table('users')
            ->join('contacts', 'users.id', '=', 'contacts.user_id')
            ->join('orders', 'users.id', '=', 'orders.user_id')
            ->select('users.*', 'contacts.phone', 'orders.price')
            ->get();
            */

            $data['document_reply_list'] = DB::table('document_reply')
            ->join('document', 'document_reply.document_id', '=', 'document.document_id')
            ->join('form', 'document_reply.form_id', '=', 'form.form_id')
            ->select('document_reply.*', 'document.document_email', 'form.form_title')
            ->where("document_reply.company_id","=",Session::get('company_id'))
            ->get()
            ->sortByDesc("document_reply_id");
            
            return view("signed_doc",$data);
            
    }
    
    public static function get_status($document_id,$form_id)
    {
        $columns=Schema::getColumnListing('document_reply');    
        $reply_count=DocumentReply::select($columns)
                    ->where('document_id', '=', $document_id)
                    ->where('form_id','=',$form_id)
                    ->get()->count();
        return $reply_count;
    }
    
    public function download_signedfile_by_id($document_reply_id) 
    {
        /*
        $columns=Schema::getColumnListing('document_reply');
        $single_docreply_list=DocumentReply::select($columns)
                    ->where('document_reply_id', '=', $document_reply_id)
                    ->get();
                    */
        $single_docreply_list = DB::table('document_reply')
        ->join('document', 'document_reply.document_id', '=', 'document.document_id')
        ->join('form', 'document_reply.form_id', '=', 'form.form_id')
        ->select('document_reply.*', 'document.document_email', 'form.form_title')
        ->where('document_reply_id', '=', $document_reply_id)
        ->get();

        $file_name = "";
        $show_file_name = "";
        foreach($single_docreply_list as $single_docreply)
        {
            $file_name=$single_docreply->document_reply_file;
            $show_file_name = $single_docreply->document_email."_".$single_docreply->form_title;
        }

        
        $file_path = public_path('signed_pdf_files/'.$file_name);
        //return response()->download($file_path);
        $headers = array(
            'Content-Type: application/pdf',
          );

          return response()->download($file_path, $show_file_name, $headers);

        //return Response::download($file, 'filename.pdf', $headers);
    }

    public function documentreply_delete($document_reply_id)
    {
        $documentreply=DocumentReply::find($document_reply_id);
        $documentreply->delete(); 

        return redirect()->back();
    }
    
    public function document_delete($document_id,$form_id)
    {
        
        $columns=Schema::getColumnListing('document');    
        $document_res=Document::select($columns)
                    ->where('document_id', '=', $document_id)
                    ->get();
        $form_array = array();
        foreach($document_res as $document)
        {
            $form_array = explode(",",$document->document_form_files);
        }
        
        $remove_value[]=$form_id;
        $updated_array  = array_diff($form_array,$remove_value);

        
        $final_form_files =  implode(",",$updated_array);
        
        if($final_form_files=="")
        {
            $document=Document::find($document_id);
            $document->delete(); 
        }
        else
        {
            $document = Document::find($document_id);
            $document->document_form_files = $final_form_files;
            $document->save();
        }

        return redirect()->back();
    }
    
    public static function get_file_original_name($form_id)
    {
        $form_list = DB::select('select * from form where form_id='.$form_id);
        $form_original_name = "";
        foreach($form_list as $form)
        {
            $form_original_name = $form->form_file;
        }
        return $form_original_name;
    }
    
    public static function resend_email($document_id,$form_id)
    {
        
        $columns=Schema::getColumnListing('document');
        $document_list=Document::select($columns)
                    ->where('document_id','=',$document_id)
                    ->get();

        $email = "";
        $msg = "";
        foreach($document_list as $document)
        {
            $email = $document->document_email;
            $msg = $document->document_message;
        }
        echo "<br>".$email;
        
        /*
        //sending email
        $subject ="Review Document from Esign";
        $app_url = config('app.url');
        $message = $msg."<br><a href='".$app_url."/customer_sign_2?document_id=".$document_id."&form_id=".$form_id."'>Review Document</a>";
        app('App\Http\Controllers\sendmailController')->sendmail($email,$subject,$message);
        //sending email
        */
        //sending email
                //app('App\Http\Controllers\sendmailController')->sendmail($emails[$i]);
                $subject ="Digital Sign has requested your signatures";
                //$url     = $request->getHttpHost();
                $public_path = public_path();
                //$message = $msg."<br><a href='".config('app.url')."/customer_sign_2?document_id=".$inserted_id."&form_id=".$first_file_id."'>Review Document</a>";
                $review_link = $message = $msg."<br><a href='".config('app.url')."/customer_sign_2?document_id=".$document_id."&form_id=".$form_id."'>Review & Sign Document</a>";
                $message = "Document Review and Signature Request from Digital Sign<br><br>";
                $message = $message."Dear ".$email.",<br><br>";
                $message = $message."Digital Sign has sent you the following document(s) for your review and signature. Please take a moment to complete this process promptly.<br><br>";
                $message = $message.$review_link."<br><br>";
                $message = $message."If you encounter any issues, please don't hesitate to contact us at (07) 5220 8990 or via email at concierge@Digital Sign.net.au.<br><br>";
                $message = $message."Thank you for your prompt attention to this matter.<br><br>";
                $message = $message."Best regards,<br>";
                $message = $message."Digital Sign Team<br>";
                //$message = $message."<a href='https://www.eyehub.net.au/' target='_blank'>https://www.eyehub.net.au/</a><br>";
                app('App\Http\Controllers\sendmailController')->sendmail($email,$subject,$message);
                //sending email
        
        Session::flash('message', 'Reminder mail sent successfully'); 
        Session::flash('alert-class', 'alert-success'); 
        
        return redirect('sent_doc');
        
    }
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    
    public static function doc_decline_status($document_id,$form_id)
    {
        $columns=Schema::getColumnListing('doc_decline');  
        $declined_list=DocDecline::select($columns)
                    ->where('document_id', '=', $document_id)
                    ->where('form_id', '=', $form_id)
                    ->get();
        if($declined_list->count()>0)
        {
            return '<button type="button" class="btn btn-sm" style="background:black;color:white">Declined</button>';
        }
        else
        {
            return '<button type="button" class="btn btn-success btn-sm" >Signed</button>';
        }
    }
}
