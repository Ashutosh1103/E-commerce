<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Roles;
use App\Models\User;
use App\Models\Banner;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\Product_images;
use App\Models\Product_categories;
use Illuminate\Support\Facades\Hash;

class firstController extends Controller
{
    public function addcategory()
    {
        return view('addcategory');
    }
    public function insertcategory(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|unique:categories',
            "description" => 'required|min:5|max:500'
        ], [
            'name.requried' => 'Name is required',
            'name.unique' => "Name is unique",
            'description.required' => "Description is required",
        ]);
        if ($validateData) {
            $data = new Category();
            $data->name = $request->name;
            $data->description = $request->description;
            if ($data->save()) {
                return redirect('/category');
            }
        }
    }
    public function editcategory($id)
    {
        $data = Category::where('id', $id)->first();
        return view('editcategory', compact('data'));
    }
    public function updatecategory(Request $request)
    {
        $data = Category::find($request->uid);
        $data->name = $request->name;
        $data->description = $request->description;
        if ($data->save()) {
            return redirect('/category');
        }
    }
    public function deletecategory($id)
    {
        $data = Category::find($id);
        if ($data->delete()) {
            return redirect('/category');
        }
    }
    public function showcategory()
    {
        $data = Category::all();
        return view('category', compact('data'));
    }
    public function adduser()
    {
        $data = Roles::all();
        return view('adduser', compact('data'));
    }
    public function insertuser(Request $request)
    {
        $validateData = $request->validate([
            "fname" => "required",
            "lname" => "required",
            "email" => "required|unique:users",
            "pass" => "required|min:6",
            "cpass" => "required|same:pass",
            "status" => "required",
            "role" => "required"
        ]);
        if ($validateData) {
            $password = $request->pass;
            User::insert([
                "first_name" => $request->fname,
                "last_name" => $request->lname,
                "email" => $request->email,
                "password" => Hash::make($password),
                "role_type" => $request->role,
                "status" => $request->status,
            ]);
            return redirect('/showuser');
        }
    }
    public function showuser()
    {
        $data = User::all();
        return view('user', compact('data'));
    }
    public function edituser($id)
    {
        $data = User::find($id);
        $role = Roles::all();
        return view('edituser', compact('data', 'role'));
    }
    public function updateuser(Request $request)
    {
        User::where('id', $request->uid)->update([

            "first_name" => $request->fname,
            "last_name" => $request->lname,
            "email" => $request->email,
            "role_type" => $request->role,
            "status" => $request->status,
        ]);
        return redirect('/showuser');
    }
    public function deleteuser($id)
    {
        User::find($id)->delete();
        return back();
    }
    public function banner()
    {
        return view('banner');
    }
    public function insertbanner(Request $request)
    {
        if ($request->hasFile('image')) {
            $images = $request->file('image');
            foreach ($images as $i) {
                $name = rand() . $i->getClientOriginalName();
                $i->move(public_path('uploads/'), $name);
                Banner::insert([
                    "image_path" => $name,
                    "caption" => $request->caption
                ]);
            }
            return back()->with('msg', "uploaded");
        }
    }
    public function showbanner()
    {
        $data = Banner::all();
        return view('displaybanner', compact('data'));
    }
    public function editbanner($id)
    {
        $data = Banner::where('id', $id)->first();
        return view('editbanner', compact('data'));
    }
    public function updatebanner(Request $request)
    {

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $img_path = rand() . $image->getClientOriginalName();
            if ($image->move(public_path('uploads/'), $img_path)) {
                Banner::where('id', $request->uid)->update([
                    'image_path' => $img_path,
                    "caption" => $request->caption
                ]);
                return redirect('/showbanner');
            }
        } else {
            Banner::where('id', $request->uid)->update([
                "caption" => $request->caption
            ]);
            return redirect('/showbanner');
        }
    }
    public function deletebanner($id)
    {
        Banner::find($id)->delete();
        return redirect('/showbanner');
    }
    public function addproduct()
    {
        $data = Category::all();
        return view("addproduct", compact('data'));
    }
    public function insertproducts(Request $request)
    {
        $data = Product::create([
            "category_id" => $request->category,
            "product_id" => $request->product_id,
            "name" => $request->name,
            "quantity" => $request->quantity,
            "price" => $request->price,
            "sale_price" => $request->sale,
            "features" => $request->features,
            "status" => $request->status,
        ]);
        if ($data) {
            $data1 = Product::latest()->first();
            ProductAttribute::insert([
                "price" => $data1->price,
                "quantity" => $data1->quantity,
                "features" => $data1->features,
                "products_id" => $data1->id
            ]);
            if ($request->hasFile('image')) {
                $images = $request->file('image');
                foreach ($images as $i) {
                    $name = rand() . $i->getClientOriginalName();
                    $i->move(public_path('uploads/'), $name);
                    Product_images::insert([
                        "image_path" => $name,
                        "products_id" => $data->id,
                    ]);
                }
            }
        }
        Product_categories::insert([
            "category_id" => $request->category,
            "products_id" => $data->id
        ]);
        return back();
    }
    public function editproducts($id)
    {
        $data = Product_categories::join('products', 'products.id', "=", "product_categories.products_id")
            ->where('products.id', $id)->first();
        $category = Category::all();
        $images = Product_images::where('products_id', $id)->get();
        return view("editproducts", compact('data', 'category', 'images'));
    }
    public function showproducts()
    {
        $data = Product::all();
        return view('products', compact('data'));
    }
    public function updateproducts(Request $request)
    {
        $data = Product::where('id', $request->uid)->update([
            "name" => $request->name,
            "quantity" => $request->quantity,
            "price" => $request->price,
            "sale_price" => $request->sale,
            "features" => $request->features,
            "status" => $request->status,
        ]);
        if ($data) {
            ProductAttribute::where('products_id', $request->uid)->update([
                "price" => $request->price,
                "quantity" => $request->quantity,
                "features" => $request->features,
            ]);
            Product_categories::where('products_id', $request->uid)->update([
                "category_id" => $request->category,
            ]);
            if ($request->hasFile('image')) {
                $deleteImages = Product_images::where('products_id', $request->uid)->get();
                foreach ($deleteImages as $i) {
                    unlink("uploads/$i->image_path");
                }
                Product_images::where('products_id', $request->uid)->delete();
                $images = $request->file('image');
                foreach ($images as $i) {
                    $name = rand() . $i->getClientOriginalName();
                    $i->move(public_path('uploads/'), $name);
                    Product_images::insert([
                        "image_path" => $name,
                        "products_id" => $request->uid,
                    ]);
                }
                return redirect('/products');
            }
            return redirect('/products');
        }
    }
    public function deleteproduct($id)
    {
        $product_data = Product::find($id);
        $images = Product_images::where('products_id', $id)->get();
        foreach ($images as $i) {
            unlink("uploads/$i->image_path");
        }
        $product_data->delete();
        return back()->with('msg', "donne");
    }
}
