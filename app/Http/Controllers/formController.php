<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

use App\Models\Form;
use App\Models\Category;

use App\Http\Middleware\checkLogin;

use Session;

class formController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkLogin');
    }
    public function add_form()
    {
        $columns=Schema::getColumnListing('category');
        $data['category_list']=Category::select($columns)
                    ->where("company_id",'=',Session::get('company_id'))
                    ->get();
        
        return view('add_form',$data);
    }
    //
    public function upload_form(Request $request)
    {
        print("<pre>");
        print_r($_FILES);
        print("</pre>");
        $categories = implode(",",$request->input('cmb_category'));
        for($i=0;$i<count($_FILES['formFile']['name']);$i++)
        {
            //upload files
            $destinationPath = 'pdf_files/';
            //$destinationPath = '';
            $tmp_name = $_FILES['formFile']['tmp_name'][$i];
            $name = rand(11111,99999)."_".$_FILES['formFile']['name'][$i];
            move_uploaded_file($tmp_name, $destinationPath."/".$name);
            //upload files

            $form = new Form();
            $form->form_title= $_FILES['formFile']['name'][$i];
            $form->form_file = $name;
            $form->form_created_date = date('Y-m-d');
            $form->form_status='Active';
            $form->category_id = $categories;
            $form->company_id = Session::get('company_id');
            $form->save();
        }
        //return redirect()->back();
        return redirect('form_list');
    }

    public function form_list()
    {
        
        $columns=Schema::getColumnListing('form');
        $data['forms_list']=Form::select($columns)
                    ->where('company_id',"=",Session::get('company_id'))
                    ->get()
                    ->sortByDesc("form_id");
        return view('forms',$data);
        
        //echo $this->get_category_names('1,2');
    }

    public static function get_category_names($categories)
    {
        $catname_array = array();
        $category_array = explode(",",$categories);
        for($i=0;$i<count($category_array);$i++)
        {
            $columns=Schema::getColumnListing('category');
            $category_res=Category::select($columns)
                        ->where('category_id', '=', $category_array[$i])
                        ->get();
            foreach($category_res as $category)
            {
                $catname_array[]=$category->category_name;
            }
        }
        return implode(",",$catname_array);
    }
    
    public function download_file_by_id($form_id) 
    {
        $columns=Schema::getColumnListing('form');
        $single_form_list=Form::select($columns)
                    ->where('form_id', '=', $form_id)
                    ->get();
        $file_name = "";
        foreach($single_form_list as $single_form)
        {
            $file_name=$single_form->form_file;
        }

        
        $file_path = public_path('pdf_files/'.$file_name);
        return response()->download($file_path);
    }

    public function form_delete($form_id)
    {
        $form=Form::find($form_id);
        $form->delete(); 

        return redirect()->back();
    }
}
