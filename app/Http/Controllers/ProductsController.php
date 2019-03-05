<?php

namespace App\Http\Controllers;
use App\Product;
use App\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class ProductsController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function Products(){
       // $product = DB::table('products')->get();
        $product = PRODUCT::paginate(20);
        $department = DB::table('departments')->get();
        $color=DB::table('attribute_value')->where("attribute_id",2)->get();
        $Size=DB::table('attribute_value')->where("attribute_id",1)->get();
        return view('pages.products',['products' => $product])->with('department',$department)->with('color',$color)->with('size',$Size);
    }
    public function Product($id){
        $id =$id;
        $product = DB::table('products')->where('product_id',$id)->get();
        return view('pages.productcomponent',['product' => $product]);
    }
    public function DepartmentCategory(Request $request){
        $departmentid=$request->id;
        $categories=DB::table('categories')->where('department_id',$departmentid)->get();
        return \Response::json($categories);
    }

    public function CategoryProducts(Request $request){
        $categoryid=$request->id;
        $data=DB::table('products')
        ->join('product_category','product_category.product_id','=','products.product_id')
        ->select('products.*')
        ->where('product_category.category_id','=',$categoryid)->get();
        return \Response::json($data);
    }

    public function ColorProducts(Request $request){
        $attrid=$request->id;
        $data=DB::table('products')
        ->join('product_attribute','product_attribute.product_id','=','products.product_id')
        ->select('products.*')
        ->where('product_attribute.attribute_value_id','=',$attrid)->get();
        return \Response::json($data);
    }

    public function SizeProducts(Request $request){
        $attrid=$request->id;
        $data=DB::table('products')
        ->join('product_attribute','product_attribute.product_id','=','products.product_id')
        ->select('products.*')
        ->where('product_attribute.attribute_value_id','=',$attrid)->get();
        return \Response::json($data);
    }


    public function cart(){
      return view('pages.cart');
    }
    public function AddCart($id){
        $id =$id;
        $product = DB::table('products')->where('product_id',$id)->first();

        if(!$product){
            abort(404);
        }
        $cart=session()->get('cart');

        //check if cart empty
        if(!$cart){
            $cart = [
                $id=>[
                    "name"=>$product->name,
                    "quantity"=>1,
                    "description" => $product->description,
                    "price"=>$product->price,
                    "discount"=>$product->discounted_price
                ]
            ];
            session()->put('cart',$cart);
            return redirect()->back()->with('success','Product Successfully Added to Cart');
        }

        //if the product update the cart
       if (isset($cart[$id])) {
           $cart[$id]['quantity']++;
           session()->put('cart',$cart);
           return redirect()->back()->with('success','Product Successfully Added to Cart');
       }

       $cart[$id] = [
            "name" => $product->name,
            "price" => $product->price,
            "description" => $product->description,
            "discount"=>$product->discounted_price,
            "quantity"=>1
       ];
       session()->put('cart',$cart);
       return redirect()->back()->with('success','Product Successfully Added to Cart');

        //return view('pages.cart',['product' => $product]);
    }

    public function update(Request $request)
    {
        if($request->id and $request->quantity)
        {
            $cart = session()->get('cart');
 
            $cart[$request->id]["quantity"] = $request->quantity;
 
            session()->put('cart', $cart);
 
            session()->flash('success', 'Cart updated successfully');
        }
    }
 
    public function remove(Request $request)
    {
        if($request->id) {
 
            $cart = session()->get('cart');
 
            if(isset($cart[$request->id])) {
 
                unset($cart[$request->id]);
 
                session()->put('cart', $cart);
            }
 
            session()->flash('success', 'Product removed successfully');
        }
    }
}