<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

use App\Models\Category;

use App\Http\Middleware\checkLogin;

use Session;

class settingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkLogin');
    }
    //
    public function categories()
    {
        $data=array();
        $columns=Schema::getColumnListing('category');
        $data['category_list']=Category::select($columns)
                    ->where("company_id","=",Session::get('company_id'))
                    ->get();
        return view('categories',$data);
    }

    public function delete_category($delete_id)
    {
        $category=Category::find($delete_id);
        $category->delete(); 

        return redirect()->back();
    }

    public function add_category(Request $request)
    {
        $category = new Category();
        $category->category_name = $request->input('txt_category');
        $category->company_id = Session::get('company_id');
        echo "<h1>".$request->input('txt_category')."</h1>";

        $category->save();
        return redirect()->back();
        
    }
}
