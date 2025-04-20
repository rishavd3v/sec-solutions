<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;

class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = [
            'title' => 'Admin'
        ];
        return view('contents.admin.home', $data);
    }

    // products
    public function product(Request $request)
    {
        $reqsearch = $request->get('search');  
        $productDb = Product::leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->select('categories.category_name', 'products.*')
            ->when($reqsearch, function($query, $reqsearch) {
                $search = '%'.$reqsearch.'%';
                return $query->whereRaw('category_name like ? or product_name like ?', [
                        $search, $search
                    ]);
            });
        $data = [
            'title'     => 'Product Data',
            'categories' => Category::all(),
            'products'  => $productDb->latest()->paginate(5),
            'request'   => $request
        ];
        return view('contents.admin.product', $data);
    }

    public function edit_product(Request $request)
    {
        $data = [
            'edit' => Product::findOrFail($request->get('id')),
            'categories' => Category::all(),
        ];
        return view('components.admin.product.edit', $data);
    }

    // process product data
    public function create_product(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            "category_id"   => "required",
            "image"         => 'required|file|max:2048',
            "product_name"  => "required",
            "description"   => "required",
            "sale_price"    => "required",
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->with("failed", "Failed to Insert Data!");
        }
    
        $image = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
    
            // Check file extension
            $extension = $file->getClientOriginalExtension();
            $validExtensions = ['jpeg', 'png', 'jpg', 'gif', 'svg'];
    
            if (!in_array(strtolower($extension), $validExtensions)) {
                return redirect()->back()->with("failed", "Invalid image file! Incorrect extension.");
            }
    
            // Validate MIME type using finfo
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimeType = finfo_file($finfo, $file->getPathname());
            finfo_close($finfo);
    
            $validMimeTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/svg+xml'];
            if (!in_array($mimeType, $validMimeTypes)) {
                return redirect()->back()->with("failed", "Invalid image file! Incorrect MIME type.");
            }
    
            // Generate unique filename
            $customName = 'product_' . time() . '.' . $extension;
    
            // Save file
            $file->move(storage_path('app/public/images'), $customName);
            $image = $customName;
        }
    
        // Save data to database
        Product::create([
            'category_id'   => $request->get("category_id"),
            'image'         => $image,
            'product_name'  => $request->get("product_name"),
            'description'   => $request->get("description"),
            'sale_price'    => $request->get("sale_price"),
            'created_at'    => now(),
        ]);
    
        return redirect()->back()->with("success", "Data Inserted Successfully!");
    }

    public function update_product(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            "id"            => "required|exists:products,id",
            "category_id"   => "required",
            "product_name"  => "required",
            "description"   => "required",
            "sale_price"    => "required",
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->with("failed", "Failed to Update Data!");
        }
    
        $productDb = Product::findOrFail($request->get('id'));
        $image = $productDb->image;
    
        if ($request->hasFile('image')) {
            $file = $request->file('image');
    
            // Check file extension
            $extension = $file->getClientOriginalExtension();
            $validExtensions = ['jpeg', 'png', 'jpg', 'gif', 'svg'];
    
            if (!in_array(strtolower($extension), $validExtensions)) {
                return redirect()->back()->with("failed", "Invalid image file! Incorrect extension.");
            }
    
            // Validate MIME type using finfo
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimeType = finfo_file($finfo, $file->getPathname());
            finfo_close($finfo);
    
            $validMimeTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/svg+xml'];
            if (!in_array($mimeType, $validMimeTypes)) {
                return redirect()->back()->with("failed", "Invalid image file! Incorrect MIME type.");
            }
    
            // Generate unique filename
            $customName = 'product_' . time() . '.' . $extension;
    
            // Save file
            $file->move(storage_path('app/public/images'), $customName);
            $image = $customName;
        }
    
        // Update data in database
        $productDb->update([
            'category_id'   => $request->get("category_id"),
            'image'         => $image,
            'product_name'  => $request->get("product_name"),
            'description'   => $request->get("description"),
            'sale_price'    => $request->get("sale_price"),
            'updated_at'    => now(),
        ]);
    
        return redirect()->back()->with("success", "Product Data Updated Successfully: " . $request->get("product_name"));
    }

    public function delete_product(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->back()->with("success", "Product Data Deleted Successfully!");
    }

    // categories
    public function category(Request $request)
    {
        if(!empty($request->get('id'))){
            $edit = Category::findOrFail($request->get('id'));
        }
        else{
            $edit = '';
        }

        $data = [
            'title'     => 'Category Data',
            'categories'  => Category::paginate(5),
            'edit'      => $edit,
            'request'   => $request
        ];
        return view('contents.admin.category', $data);
    }

    // process category data
    public function create_category(Request $request)
    {
        $validator = \Validator::make($request->all(),[
            "category_name" => "required",
        ]);
        if($validator->passes()) {
            Category::insert([
                'category_name' => $request->get("category_name"),
                'created_at'    => now(),
            ]);
            return redirect()->back()->with("success", "Category Data Inserted Successfully!");
        }
        else{
            return redirect()->back()->withErrors($validator)->with("failed", "Failed to Insert Category Data!");
        }
    }

    public function update_category(Request $request)
    {
        $validator = \Validator::make($request->all(),[
            "id"            => "required",
            "category_name" => "required",
        ]);
        if($validator->passes()) {
            Category::findOrFail($request->get('id'))->update([
                'category_name' => $request->get("category_name"),
                'updated_at' => now(),
            ]);
            return redirect()->back()->with("success", "Category Data Updated Successfully!");
        }
        else{
            return redirect()->back()->withErrors($validator)->with("failed", "Failed to Update Category Data!");
        }
    }

    public function delete_category(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->back()->with("success", "Category Data Deleted Successfully!");
    }

    // profile
    public function profile(Request $request)
    {
        $data = [
            'title' => 'Profile Data',
            'edit' => User::findOrFail(auth()->user()->id),
            'request' => $request
        ];
        return view('contents.admin.profile', $data);
    }

    // process profile data
    public function update_profile(Request $request)
    {
        $validator = \Validator::make($request->all(),[
            "name"                  => "required",
            "email"                 => "required",
            "password"              => "required|min:6",
            "password_confirmation" => "required|min:6",
        ]);

        if($validator->passes())
        {
            if($request->get("password") == $request->get("password_confirmation"))
            {
                User::findOrFail(auth()->user()->id)->update([
                    'name'          => $request->get("name"),
                    'email'         => $request->get("email"),
                    'phone'         => $request->get("phone"),
                    'address'       => $request->get("address"),
                    'password'      => Hash::make($request->get("password")),
                    'updated_at'    => now(),
                ]);
                return redirect()->back()->with("success", "Profile Updated Successfully!");
            }
            else{
                return redirect()->back()->with("failed", "Confirm Password Does Not Match!");
            }
        }
        else{
            return redirect()->back()->withErrors($validator)->with("failed", "Failed to Update Profile Data!");
        }
    }
}
