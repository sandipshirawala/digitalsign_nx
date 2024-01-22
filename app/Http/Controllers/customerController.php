<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

use App\Models\Document;
use App\Models\Form;
use App\Models\DocumentReply;
use App\Models\LogHistory;
use App\Models\DocDecline;

use DB;
use Session;
use DateTime;

require_once ('PDFMerger/PDFMerger.php'); 
use PDFMerger\PDFMerger;

require 'vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;
use Dompdf\Adapter\CPDF;

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
        
         //check for declined
        $columns=Schema::getColumnListing('doc_decline');    
        $declined_list=DocDecline::select($columns)
                    ->where('document_id', '=', $_GET['document_id'])
                    ->where('form_id', '=', $_GET['form_id'])
                    ->get();
        $data['declined_count']=$declined_list->count();
        
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
            //added by sandip
            $data['mode']=$document->document_mode;
            //added by sandip
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

        //log
            $columns=Schema::getColumnListing('log_history');
            $loghistory_res=LogHistory::select($columns)
                        ->where('document_id', '=',$data['document_id'])
                        ->where('form_id','=',$_GET['form_id'])
                        ->where('log_history_action','email_viewed')
                        ->get();

            if($loghistory_res->count()==0)
            {
                $log_history = new LogHistory();
                $log_history->document_id = $data['document_id'];
                $log_history->form_id = $_GET['form_id'];
                $log_history->log_history_action = 'email_viewed';
                $log_history->log_name = $data['document_email_name'];
                $log_history->log_email =  $data['document_email_name'];
                $log_history->log_date_time = date("Y-m-d H:i:s");
                $log_history->log_date_time_zone = "GMT";
                $log_history->log_ip_address = $_SERVER['REMOTE_ADDR'];
                $log_history->log_message =  "Email Viewed by ".$data['document_email_name'];
                //$log_history->log_guid = $this->generateRandomString(25);
                $log_history->save();
            }
        //log
        
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
        /*
        $data = file_get_contents('php://input');
        // write the data out to the file
        //$file_name =rand(100000,999999)."_xyz.pdf";
        $file_name = $_GET['document_id']."_".$_GET['form_id'].".pdf";
        //$fp = fopen("signed_pdf_files/".$file_name, "wb");
        //$fp = fopen("flatten_pdf/".$file_name, "wb");
        $fp = fopen("signed_pdf_files/".$file_name, "wb");
        fwrite($fp, $data);
        fclose($fp);
        */
        header('Access-Control-Allow-Origin:*');
        // pdf saving
        //$filename = $_GET['id'];
        //$filename = "compressed.tracemonkey-pldi-09";
        //$filename = $_GET['document_id']."_".$_GET['form_id'].".pdf";
        $filename = $_GET['document_id']."_".$_GET['form_id'];
        $tmpFilePath = $_FILES['pdfFile']['tmp_name'];

        /*
        if (move_uploaded_file($tmpFilePath, "screenshots/" . $filename . ".pdf")) {
        header('Content-Disposition: attachment; filename="' . $filename . '.pdf"');
            readfile("screenshots/" . $filename . ".pdf");	
            echo "Done";
        } else {
            echo "Error moving uploaded file";
        }
        */
        if (move_uploaded_file($tmpFilePath, "signed_pdf_files/" . $filename . ".pdf")) {
            header('Content-Disposition: attachment; filename="' . $filename . '.pdf"');
                readfile("signed_pdf_files/" . $filename . ".pdf");	
                echo "Done";
        } else {
                echo "Error moving uploaded file";
        }

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
        //$documentreply->company_id = Session::get("company_id");
        //company id
        
        //company id
        $columns=Schema::getColumnListing('document');
        $document_res=Document::select($columns)
                        ->where('document_id', '=', $_GET['document_id'])
                        ->get();
        foreach($document_res as $document)
        {
            $documentreply->company_id =  $document->company_id;
        }
        //company id
        
        
        $documentreply->save();

        //log
            $log_history = new LogHistory();
            $log_history->document_id =  $_GET['document_id'];
            $log_history->form_id = $_GET['form_id'];
            $log_history->log_history_action = 'document_esigned';
            $log_history->log_name = "";
            $log_history->log_email =  "";
            $log_history->log_date_time = date("Y-m-d H:i:s");
            $log_history->log_date_time_zone = "GMT";
            //$log_history->log_ip_address = $_SERVER['REMOTE_ADDR'];
            $log_history->log_ip_address = $this->getUserIP();
            $log_history->log_message = "Document Esigned ";
            $log_history->save();

            
        
            $log_history = new LogHistory();
            $log_history->document_id = $_GET['document_id'];
            $log_history->form_id = $_GET['form_id'];
            $log_history->log_history_action = 'completed';
            $log_history->log_name = "";
            $log_history->log_email =  "";
            $log_history->log_date_time = date("Y-m-d H:i:s");
            $log_history->log_date_time_zone = "GMT";
            //$log_history->log_ip_address = $_SERVER['REMOTE_ADDR'];
            $log_history->log_ip_address = $this->getUserIP();
            $log_history->log_message = "Agreement Completed.";
            $log_history->save();
        //log

        header('Access-Control-Allow-Origin:*');
        // pdf saving
        //$filename = $_GET['id'];
        //$filename = "compressed.tracemonkey-pldi-09";
        //$filename = $_GET['document_id']."_".$_GET['form_id'].".pdf";
        $filename = $_GET['document_id']."_".$_GET['form_id'];
        $tmpFilePath = $_FILES['pdfFile']['tmp_name'];

        /*
        if (move_uploaded_file($tmpFilePath, "screenshots/" . $filename . ".pdf")) {
        header('Content-Disposition: attachment; filename="' . $filename . '.pdf"');
            readfile("screenshots/" . $filename . ".pdf");	
            echo "Done";
        } else {
            echo "Error moving uploaded file";
        }
        */
        if (move_uploaded_file($tmpFilePath, "signed_pdf_files/" . $filename . ".pdf")) {
            header('Content-Disposition: attachment; filename="' . $filename . '.pdf"');
                readfile("signed_pdf_files/" . $filename . ".pdf");	
                echo "Done";
        } else {
                echo "Error moving uploaded file";
        }

        //generate certificate
        $this->generate_certificate($_GET['document_id'],$_GET['form_id']);
        //generate certificate
            

    }

    public function getUserIP() {
        $ipaddress="";
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress="UNKNOWN";
        return $ipaddress;
    }
/*
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
        //$documentreply->company_id = Session::get("company_id");
        //company id
        
        //company id
        $columns=Schema::getColumnListing('document');
        $document_res=Document::select($columns)
                        ->where('document_id', '=', $_GET['document_id'])
                        ->get();
        foreach($document_res as $document)
        {
            $documentreply->company_id =  $document->company_id;
        }
        //company id
        
        
        $documentreply->save();

        //log
            $log_history = new LogHistory();
            $log_history->document_id =  $_GET['document_id'];
            $log_history->form_id = $_GET['form_id'];
            $log_history->log_history_action = 'document_esigned';
            $log_history->log_name = "";
            $log_history->log_email =  "";
            $log_history->log_date_time = date("Y-m-d H:i:s");
            $log_history->log_date_time_zone = "GMT";
            $log_history->log_ip_address = $_SERVER['REMOTE_ADDR'];
            //$log_history->log_message =  "Email Viewed by ".$data['document_email_name'];
            //$log_history->log_message = "Document Esigned by ".$email;
            $log_history->log_message = "Document Esigned ";
            //$log_history->log_guid = $this->generateRandomString(25);
            $log_history->save();

            
        
            $log_history = new LogHistory();
            $log_history->document_id = $_GET['document_id'];
            $log_history->form_id = $_GET['form_id'];
            $log_history->log_history_action = 'completed';
            $log_history->log_name = "";
            $log_history->log_email =  "";
            $log_history->log_date_time = date("Y-m-d H:i:s");
            $log_history->log_date_time_zone = "GMT";
            $log_history->log_ip_address = $_SERVER['REMOTE_ADDR'];
            //$log_history->log_message =  "Email Viewed by ".$data['document_email_name'];
            $log_history->log_message = "Agreement Completed.";
            //$log_history->log_guid = $this->generateRandomString(25);
            $log_history->save();
        //log


        $data = file_get_contents('php://input');
        // write the data out to the file
        $fp = fopen("signed_pdf_files/".$file_name, "wb");
        fwrite($fp, $data);
        fclose($fp);

        //generate certificate
        $this->generate_certificate($_GET['document_id'],$_GET['form_id']);
        //generate certificate

        return $file_name;
    }
    */
    
    public function generate_certificate($document_id,$form_id)
    {
        $page_data['document_id']=$document_id;
        $page_data['form_id']=$form_id;

        $columns=Schema::getColumnListing('log_history');    
        $loghistory_list=LogHistory::select($columns)
                    ->where('document_id', '=', $document_id)
                    ->where('form_id','=',$form_id)
                    ->get();

        $page_data['loghistory_list']=$loghistory_list;
        $email = "";
        foreach($loghistory_list as $loghistory)
        {
            if($loghistory->log_history_action=="document_create")
            {
                $page_data['guid']=$loghistory->log_guid;
                $page_data['created_at']=$loghistory->log_date_time." ".$loghistory->log_date_time_zone;
                $page_data['created_by']=$loghistory->log_name."(".$loghistory->log_email.")";
                $page_data['status']="Signed";

                $page_data['step1'] = $loghistory->log_message;
                $page_data['step1_date_time'] = $loghistory->log_date_time." ".$loghistory->log_date_time_zone;
                $page_data['step1_ip_address'] = $loghistory->log_ip_address;
            }
            if($loghistory->log_history_action=="document_emailed")
            {
                $page_data['step2'] = $loghistory->log_message;
                $page_data['step2_date_time'] = $loghistory->log_date_time." ".$loghistory->log_date_time_zone;
                $page_data['step2_ip_address'] = $loghistory->log_ip_address;
            }
            if($loghistory->log_history_action=="email_viewed")
            {
                $page_data['step3'] = $loghistory->log_message;
                $page_data['step3_date_time'] = $loghistory->log_date_time." ".$loghistory->log_date_time_zone;
                $page_data['step3_ip_address'] = $loghistory->log_ip_address;
                $email = $loghistory->log_email;
            }
            //added by sandip
            //if($loghistory->log_history_action=="document_esigned")
            
            if($loghistory->log_history_action=="document_esigned" || $loghistory->log_history_action=="declined")
            {
                $page_data['step4_action']=$loghistory->log_history_action;
                $page_data['step4'] = $loghistory->log_message." by ".$email;
                $page_data['step4_date_time'] = $loghistory->log_date_time." ".$loghistory->log_date_time_zone;
                $page_data['step4_ip_address'] = $loghistory->log_ip_address;
            }
            if($loghistory->log_history_action=="completed")
            {
                $page_data['step5'] = $loghistory->log_message;
                $page_data['step5_date_time'] = $loghistory->log_date_time." ".$loghistory->log_date_time_zone;
                $page_data['step5_ip_address'] = $loghistory->log_ip_address;

                $dt = new DateTime($loghistory->log_date_time);
                $date = $dt->format('Y-m-d');
                $page_data['final_audit_date']=$date;
            }
            
        }

        
        $output = view('certificate',$page_data)->render();
        
        $dompdf = new Dompdf();
        $dompdf->load_html($output);//body -> html content which needs to be converted as pdf..
        $options = new Options();
        $options->setChroot('');
        $options->isHtml5ParserEnabled(true);
        $options->setIsRemoteEnabled(true);
        $dompdf->setOptions($options);
        $dompdf->render();
        $file_name = $page_data['document_id']."_".$page_data['form_id'].".pdf";
        //$dompdf->stream($page_data['document_id']."_".$page_data['form_id'].".pdf"); //To popup pdf as download
        $output = $dompdf->output();
        file_put_contents('certificate/'.$file_name, $output);
        
    }

    public function generate_certificate_old_working_19_1_2024($document_id,$form_id)
    {
        $page_data['document_id']=$document_id;
        $page_data['form_id']=$form_id;

        $columns=Schema::getColumnListing('log_history');    
        $loghistory_list=LogHistory::select($columns)
                    ->where('document_id', '=', $document_id)
                    ->where('form_id','=',$form_id)
                    ->get();

        $page_data['loghistory_list']=$loghistory_list;
        $email = "";
        foreach($loghistory_list as $loghistory)
        {
            if($loghistory->log_history_action=="document_create")
            {
                $page_data['guid']=$loghistory->log_guid;
                $page_data['created_at']=$loghistory->log_date_time." ".$loghistory->log_date_time_zone;
                $page_data['created_by']=$loghistory->log_name."(".$loghistory->log_email.")";
                $page_data['status']="Signed";

                $page_data['step1'] = $loghistory->log_message;
                $page_data['step1_date_time'] = $loghistory->log_date_time." ".$loghistory->log_date_time_zone;
                $page_data['step1_ip_address'] = $loghistory->log_ip_address;
            }
            if($loghistory->log_history_action=="document_emailed")
            {
                $page_data['step2'] = $loghistory->log_message;
                $page_data['step2_date_time'] = $loghistory->log_date_time." ".$loghistory->log_date_time_zone;
                $page_data['step2_ip_address'] = $loghistory->log_ip_address;
            }
            if($loghistory->log_history_action=="email_viewed")
            {
                $page_data['step3'] = $loghistory->log_message;
                $page_data['step3_date_time'] = $loghistory->log_date_time." ".$loghistory->log_date_time_zone;
                $page_data['step3_ip_address'] = $loghistory->log_ip_address;
                $email = $loghistory->log_email;
            }
            if($loghistory->log_history_action=="document_esigned")
            {
                $page_data['step4'] = $loghistory->log_message." by ".$email;
                $page_data['step4_date_time'] = $loghistory->log_date_time." ".$loghistory->log_date_time_zone;
                $page_data['step4_ip_address'] = $loghistory->log_ip_address;
            }
            if($loghistory->log_history_action=="completed")
            {
                $page_data['step5'] = $loghistory->log_message;
                $page_data['step5_date_time'] = $loghistory->log_date_time." ".$loghistory->log_date_time_zone;
                $page_data['step5_ip_address'] = $loghistory->log_ip_address;

                $dt = new DateTime($loghistory->log_date_time);
                $date = $dt->format('Y-m-d');
                $page_data['final_audit_date']=$date;
            }
            
        }

        
        $output = view('certificate',$page_data)->render();
        
        $dompdf = new Dompdf();
        $dompdf->load_html($output);//body -> html content which needs to be converted as pdf..
        $options = new Options();
        $options->setChroot('');
        $options->isHtml5ParserEnabled(true);
        $options->setIsRemoteEnabled(true);
        $dompdf->setOptions($options);
        $dompdf->render();
        $file_name = $page_data['document_id']."_".$page_data['form_id'].".pdf";
        //$dompdf->stream($page_data['document_id']."_".$page_data['form_id'].".pdf"); //To popup pdf as download
        $output = $dompdf->output();
        file_put_contents('certificate/'.$file_name, $output);
        
    }

    public function certificate()
    {
        return view('certificate');
    }

    public function merge_pdf()
    {
        
        $pdf = new PDFMerger; // initiate the class

        $pdf->addPDF('signed_pdf_files/40_4.pdf'); // add a sample pdf 
        $pdf->addPDF('samplepdf/certificate.pdf'); // add a sample pdf

        //$pdf->merge('file',__DIR__.'/merged.pdf');
        //$pdf->merge('file',public_path().'/merged.pdf');
        $pdf->merge('file',public_path().'/signed_pdf_files/40_4.pdf'); 
        

        echo public_path().'/merged.pdf';
    }

    public function merge_flatten_file()
    {
        /*
        header('Access-Control-Allow-Origin:*');
        
        $data = file_get_contents('php://input');
        $file_name = $_GET['filename'];
        //$fp = fopen("signed_pdf_files/signed_".$file_name, "wb");
        $fp = fopen("signed_pdf_files/".$file_name, "wb");
        fwrite($fp, $data);
        fclose($fp);
        */
        

        
        header('Access-Control-Allow-Origin:*');
        $filename= $_GET['filename'];
        $tmpFilePath = $_FILES['pdfFile']['tmp_name'];

        /*
        if (move_uploaded_file($tmpFilePath, "signed_pdf_files/" . $filename . ".pdf")) {
            header('Content-Disposition: attachment; filename="' . $filename . '.pdf"');
                readfile("signed_pdf_files/" . $filename . ".pdf");	
                echo "Done";
        } else {
                echo "Error moving uploaded file";
        }
        */
        
        
        if (move_uploaded_file($tmpFilePath, "signed_pdf_files/" . $filename)) {
            header('Content-Disposition: attachment; filename="' . $filename . '"');
                readfile("signed_pdf_files/" . $filename);	
                echo "Done";
        } else {
                echo "Error moving uploaded file";
        }
        
        

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
    
    public function cancel_review()
    {
        //echo $_GET['document_id'];
        //echo "<br>".$_GET['form_id'];
        $doc_decline = new DocDecline();
        $doc_decline->document_id = $_GET['document_id'];
        $doc_decline->form_id = $_GET['form_id'];
        $doc_decline->doc_decline_date = date('Y-m-d H:i:s');
        $doc_decline->doc_reply_ip = $this->getUserIP();
        $doc_decline->company_id =  Session::get("company_id");
        $doc_decline->save();


        //check for declined

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
            //$documentreply->company_id = Session::get("company_id");
            //company id
            
            //company id
            $columns=Schema::getColumnListing('document');
            $document_res=Document::select($columns)
                            ->where('document_id', '=', $_GET['document_id'])
                            ->get();
            foreach($document_res as $document)
            {
                $documentreply->company_id =  $document->company_id;
            }
            //company id
            
            
            $documentreply->save();

            //log
                $log_history = new LogHistory();
                $log_history->document_id =  $_GET['document_id'];
                $log_history->form_id = $_GET['form_id'];
                $log_history->log_history_action = 'declined';
                $log_history->log_name = "";
                $log_history->log_email =  "";
                $log_history->log_date_time = date("Y-m-d H:i:s");
                $log_history->log_date_time_zone = "GMT";
                //$log_history->log_ip_address = $_SERVER['REMOTE_ADDR'];
                $log_history->log_ip_address = $this->getUserIP();
                $log_history->log_message = "Document Sign Declined";
                $log_history->save();

                
                
                $log_history = new LogHistory();
                $log_history->document_id = $_GET['document_id'];
                $log_history->form_id = $_GET['form_id'];
                $log_history->log_history_action = 'completed';
                $log_history->log_name = "";
                $log_history->log_email =  "";
                $log_history->log_date_time = date("Y-m-d H:i:s");
                $log_history->log_date_time_zone = "GMT";
                //$log_history->log_ip_address = $_SERVER['REMOTE_ADDR'];
                $log_history->log_ip_address = $this->getUserIP();
                $log_history->log_message = "Agreement Completed.";
                $log_history->save();
            //log

            /*
            header('Access-Control-Allow-Origin:*');
            // pdf saving
            $filename = $_GET['document_id']."_".$_GET['form_id'];
            $tmpFilePath = $_FILES['pdfFile']['tmp_name'];

            if (move_uploaded_file($tmpFilePath, "signed_pdf_files/" . $filename . ".pdf")) {
                header('Content-Disposition: attachment; filename="' . $filename . '.pdf"');
                    readfile("signed_pdf_files/" . $filename . ".pdf");	
                    echo "Done";
            } else {
                    echo "Error moving uploaded file";
            }
            */
            //copy files to another folder
            $columns=Schema::getColumnListing('form');
            $form_res=Form::select($columns)
                            ->where('form_id', '=', $_GET['form_id'])
                            ->get();
            $form_file_name = "";
            foreach($form_res as $form)
            {
                $form_file_name =  $form->form_file;
            }

            //echo 'pdf_files/'.$form_file_name;
            //echo 'signed_pdf_files/'.$_GET['document_id'],$_GET['form_id'].".pdf";

            copy('pdf_files/'.$form_file_name, 'signed_pdf_files/'.$_GET['document_id']."_".$_GET['form_id'].".pdf");

            
            //copy files to another folder
            

            //generate certificate
            $this->generate_certificate($_GET['document_id'],$_GET['form_id']);
            //generate certificate

        //check for declined

        //return redirect()->back();
        $page_data['document_id']=$_GET['document_id'];
        $page_data['form_id']=$_GET['form_id'];
        $page_data['file_name']=$_GET['document_id']."_".$_GET['form_id'].".pdf";
        return view('cancel_review',$page_data);
           
    }

    public function get_status($document_id,$form_id)
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
