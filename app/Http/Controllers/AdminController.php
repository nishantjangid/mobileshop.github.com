<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\wishlist;
use Illuminate\Support\Facades\DB;
use Session;

class AdminController extends Controller
{
    //

    function DashboardCharts()
    {
        $products = Product::select(DB::raw("COUNT(*) as count"))
                    ->whereYear("created_at",date('Y'))
                    ->groupBy(DB::raw("Month(created_at)"))
                    ->pluck("count");
        $months = Product::select(DB::raw("Month(created_at) as month"))
                    ->whereYear("created_at",date('Y'))
                    ->groupBy(DB::raw("Month(created_at)"))
                    ->pluck("month");
        $datas = array(0,0,0,0,0,0,0,0,0,0,0,0);

        foreach($months as $index => $month)
        {
            $datas[$month] = $products[$index];
        }

        return view('admin-area/master',compact('datas'));
        
    }

    public function insertProducts(Request $req)
    {
        $filemodel = new Product;
         $req->input();
        // $req->file('product_img1');
        $filemodel->category_id = $req->category_id;
        $filemodel->product_title = $req->product_title;
        $filemodel->product_description = $req->product_description;
        $filemodel->product_price = $req->product_price;
        $filemodel->product_discount = $req->product_discount;
        $filemodel->product_label = $req->product_label;

        $fileName = time().'_'.$req->file('product_img1')->getClientOriginalName();
        $filePath1 = $req->file('product_img1')->storeAs('productImages', $fileName, 'public');
        $fileName = time().'_'.$req->file('product_img2')->getClientOriginalName();
        $filePath2 = $req->file('product_img2')->storeAs('productImages', $fileName, 'public');
        $fileName = time().'_'.$req->file('product_img3')->getClientOriginalName();
        $filePath3 = $req->file('product_img3')->storeAs('productImages', $fileName, 'public');
        $fileName = time().'_'.$req->file('product_img4')->getClientOriginalName();
        $filePath4 = $req->file('product_img4')->storeAs('productImages', $fileName, 'public');
        $filemodel->product_img1 =  $filePath1;
        $filemodel->product_img2 =  $filePath2;
        $filemodel->product_img3 =  $filePath3;
        $filemodel->product_img4 =  $filePath4;

        $filemodel->save();
        // return $filemodel;
        alert()->success('Product Has been added')->persistent('Close')->autoClose(3000);
        return redirect('admin-area/insert-products');
    }   
    
    public function allProduct()
    {
        $data = Product::all();
        $catData = Category::all();
        return view('admin-area/master',['data'=>$data,'catData'=>$catData]);
    }
    public function porductCategory()
    {
        $catData = Category::all();
        return view('admin-area/master',['catData'=>$catData]);
    }    


    function deleteProduct($id)
    {
        $product = Product::find($id);
        $product->delete();
        alert()->success('Product successfully deleted')->persistent('Close')->autoClose(3000);
        return redirect('admin-area/view-products');
    }

    function editProductview($id)
    {
        $product = Product::find($id);
        $catData = Category::all();
        return view('admin-area/edit-product',['product'=>$product,'catData'=>$catData]);
    }

    function updateProduct(Request $req)
    {

            if($req->product_img1 == "" && $req->product_img2 == "" && $req->product_img3 == "" && $req->product_img4 == "")
            {
                $data = Product::where('id',$req->id)
                ->update(
                    [
                        'category_id'=>$req->category_id,
                        'product_title'=>$req->product_title,
                        'product_description'=>$req->product_description,
                        'product_price'=>$req->product_price,
                        'product_discount'=>$req->product_discount,
                        'product_label'=>$req->product_label
                    ]
                );
                
                return redirect('admin-area/view-products');

            }
            else
            {

                $fileName = time().'_'.$req->file('product_img1')->getClientOriginalName();
                $filePath1 = $req->file('product_img1')->storeAs('productImages', $fileName, 'public');
                $fileName = time().'_'.$req->file('product_img2')->getClientOriginalName();
                $filePath2 = $req->file('product_img2')->storeAs('productImages', $fileName, 'public');
                $fileName = time().'_'.$req->file('product_img3')->getClientOriginalName();
                $filePath3 = $req->file('product_img3')->storeAs('productImages', $fileName, 'public');
                $fileName = time().'_'.$req->file('product_img4')->getClientOriginalName();
                $filePath4 = $req->file('product_img4')->storeAs('productImages', $fileName, 'public');                

                Product::where('id',$req->id)
                ->update(
                    [
                        'category_id'=>$req->category_id,
                        'product_title'=>$req->product_title,
                        'product_description'=>$req->product_description,
                        'product_price'=>$req->product_price,
                        'product_discount'=>$req->product_discount,
                        'product_img1'=>$filePath1,
                        'product_img2'=>$filePath2,
                        'product_img3'=>$filePath3,
                        'product_img4'=>$filePath4,                
                        'product_label'=>$req->product_label
                    ]
                );
                alert()->success('Product Has been added')->persistent('Close')->autoClose(3000);
                return redirect('admin-area/view-products');
            }

    }    

    function ProductCategoryShow()
    {
        return view('admin-area/master');
    }
    

    function insertProductCategory(Request $req)
    {
        $proCat = new Category;
        $proCat->name = $req->category_name;
        $proCat->save();

        return redirect('admin-area/view-product-category');
    }
    function viewProductCategory()
    {
        $proCat = Category::all();
        return view('admin-area/master',['proCat'=>$proCat]);
    }

    function deleteProductCategory($id)
    {
        $proCat = Category::find($id);
        $proCat->delete();

        alert()->success('Category Deleted Successfully!!')->persistent('Close')->autoClose(2000);
        return redirect('admin-area/view-product-category');
    }

    function editProductCategory($id)
    {
        $proCat = Category::find($id);
        return view('admin-area/edit-product-category',['proCat'=>$proCat]);
    }
  
    function updateProductCategory(Request $req)
    {
        Category::where('id',$req->id)
        ->update([
            'name'=>$req->category_name
        ]);
        alert()->success('Category Updated Successfully!!')->persistent('Close')->autoClose(2000);

        return redirect('admin-area/view-product-category');
    }
}
