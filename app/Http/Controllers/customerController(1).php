<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

use App\Models\Document;
use App\Models\Form;
use App\Models\DocumentReply;

use DB;
use Session;
class customerController extends Controller
{
    //
    public function customer_sign_option(Request $request)
    {
        
        //echo $_GET['document_id'];
        $data['base_url']       = $request->getHttpHost();
        $data['document_id']    = $_GET['document_id'];

        return view('customer_sign_option',$data);

        /*
        $document_listing = Document::find($_GET['document_id']);
        $data['document_list']=$document_listing;

        foreach($document_listing as $document)
        {
            print_r($document);
            //echo "<h1>".$document->document_form_files."</h1>";
        }
        
        //return view('customer_sign_option',$data);
        */
        
        
    }

    public function customer_sign(Request $request)
    {
        $document_id = $_GET['document_id'];
        $columns=Schema::getColumnListing('document');    
        $document_list=Document::select($columns)
                    ->where('document_id', '=', $document_id)
                    ->get();
        foreach($document_list as $document)
        {
            $form_array = explode(",",$document->document_form_files);
            $data['forms_list'] = Form::whereIn('form_id', $form_array)->get();
        }
        $data['page'] = 'customer_sign';
        $data['document_id']    = $_GET['document_id'];
        return view('customer_sign',$data);
    }

    public function customer_sign_2(Request $request)
    {
        
        $data=array();
        
        $document_id = $_GET['document_id'];
        $columns=Schema::getColumnListing('document');    
        $document_list=Document::select($columns)
                    ->where('document_id', '=', $document_id)
                    ->get();
        foreach($document_list as $document)
        {
            $form_array = explode(",",$document->document_form_files);
            $data['document_email_name']=$document->document_email;
            $data['forms_list'] = Form::whereIn('form_id', $form_array)->get();
        }
        
        //document reply list
        $columns=Schema::getColumnListing('document_reply');    
        $document_reply_list=DocumentReply::select($columns)
                    ->where('document_id', '=', $document_id)
                    ->get();

        $replied_form_id_array=array();
        foreach($document_reply_list as $document_reply)
        {
            $replied_form_id_array[]=$document_reply->form_id;
        }
        $data['replied_form_id_array']=$replied_form_id_array;
        //document reply list

        if(isset($_GET['form_id']))
        {
            //$data['single_form_list'] = Form::find($_GET['form_id']);
            $columns=Schema::getColumnListing('form');    
            $data['single_form_list']=Form::select($columns)
                    ->where('form_id', '=', $_GET['form_id'])
                    ->get();
        
        }
        $data['page'] = 'customer_sign_2';
        $data['document_id']    = $_GET['document_id'];
        
        return view('customer_sign_2',$data);
        
        //return view('customer_sign_2_pdf_working');
    }

/*
    public function save_file(Request $request)
    {
        $documentreply = new DocumentReply();
        $documentreply->document_id = $_GET['document_id'];
        $documentreply->form_id = $_GET['form_id'];
        $file_name  = rand(100000,9999999).".pdf";
        $documentreply->document_reply_file_original_name = $file_name;
        $documentreply->document_reply_file = $file_name;
        $documentreply->document_reply_date = date('Y-m-d H:i:s');
        
        //ip
        $documentreply->document_reply_ip = $_SERVER['REMOTE_ADDR'];
        //ip
        
        $documentreply->save();


        $data = file_get_contents('php://input');
        // write the data out to the file
        $fp = fopen("signed_pdf_files/".$file_name, "wb");
        fwrite($fp, $data);
        fclose($fp);
    }
*/


    public function download($file_name) 
    {
        $file_path = public_path('pdf_files/'.$file_name);
        return response()->download($file_path);
    }

    public function upload_reply(Request $request)
    {
        /*
        print("<pre>");
        print_r($_FILES['replyFile']);
        print("</pre>");
        */
        $form_id =  $request->input('txt_form_id');
        $email =$request->input('txt_email');

        //upload files
        $destinationPath = 'signed_pdf_files/';
        $tmp_name = $_FILES['replyFile']['tmp_name'];
        $name = rand(11111,99999)."_".$_FILES['replyFile']['name'];
        move_uploaded_file($tmp_name, $destinationPath."/".$name);
        //upload files
        
        //get document email
        $columns=Schema::getColumnListing('document');
        $document_res=Document::select($columns)
                        ->where('document_id', '=', $request->input('txt_document_id'))
                        ->get();
        $document_email = "";
        foreach($document_res as $document)
        {
            $document_email =  $document->document_email;
        }
        //get document email

        $documentreply = new DocumentReply();
        $documentreply->document_id = $request->input('txt_document_id');
        $documentreply->form_id = $request->input('txt_form_id');
        $documentreply->document_reply_file_original_name = $_FILES['replyFile']['name'];
        $documentreply->document_reply_file = $name;
        $documentreply->document_reply_date = date('Y-m-d H:i:s');
        //$documentreply->document_reply_email = 'sandipshirawala@gmail.com';
        $documentreply->document_reply_email = $document_email;

        //company id
        $documentreply->company_id = Session::get("company_id");
        //company id
        $documentreply->save();

        

        return redirect()->back();
    }
    
    
    public function save_flatten_file()
    {
        
        $data = file_get_contents('php://input');
        // write the data out to the file
        //$file_name =rand(100000,999999)."_xyz.pdf";
        $file_name = $_GET['document_id']."_".$_GET['form_id'].".pdf";
        //$fp = fopen("signed_pdf_files/".$file_name, "wb");
        //$fp = fopen("flatten_pdf/".$file_name, "wb");
        $fp = fopen("signed_pdf_files/".$file_name, "wb");
        fwrite($fp, $data);
        fclose($fp);

    }

    public function save_file(Request $request)
    {
        $documentreply = new DocumentReply();
        $documentreply->document_id = $_GET['document_id'];
        $documentreply->form_id = $_GET['form_id'];
        //$file_name  = rand(100000,9999999).".pdf";
        $file_name = $_GET['document_id']."_".$_GET['form_id'].".pdf";
        $documentreply->document_reply_file_original_name = $file_name;
        $documentreply->document_reply_file = $file_name;
        $documentreply->document_reply_date = date('Y-m-d H:i:s');
        
        //ip
        $documentreply->document_reply_ip = $_SERVER['REMOTE_ADDR'];
        //ip

        //company id
        $documentreply->company_id = Session::get("company_id");
        //company id
        
        $documentreply->save();


        $data = file_get_contents('php://input');
        // write the data out to the file
        $fp = fopen("signed_pdf_files/".$file_name, "wb");
        fwrite($fp, $data);
        fclose($fp);

        return $file_name;
    }
}
