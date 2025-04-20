<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index(Request $request)
    {
        $reqsearch = $request->get('search');  
        $productDb = Product::leftJoin('categories', 'products.category_id', '=', 'categories.id')
                    ->select('categories.category_name', 'products.*');
        $data = [
            'title'     => 'Gaurav Security Solutions',
            'categories' => Category::all(),
            'products'  => $productDb->latest()->paginate(8),
        ];
        return view('contents.frontend.home', $data);
    }

    public function category(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $productDb = Product::leftJoin('categories', 'products.category_id', '=', 'categories.id')
                    ->select('categories.category_name', 'products.*')
                    ->where('products.category_id', $id);
        $data = [
            'title'     => $category->category_name,
            'categories' => Category::all(),
            'products'  => $productDb->latest()->paginate(8),
        ];
        return view('contents.frontend.category', $data);
    }

    public function search(Request $request)
    {
        $reqsearch = $request->get('keyword');  
        $productDb = Product::leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->select('categories.category_name', 'products.*')
            ->when($reqsearch, function($query, $reqsearch) {
                $search = '%'.$reqsearch.'%';
                return $query->whereRaw('category_name like ? or product_name like ?', [
                    $search, $search
                ]);
            });
        $data = [
            'title'     => 'Search Results: '.$reqsearch,
            'categories' => Category::all(),
            'products'  => $productDb->latest()->paginate(8),
        ];
        return view('contents.frontend.category', $data);
    }

    public function product(Request $request, $id)
    {
        $reqsearch = $request->get('keyword');  
        $productDb = Product::leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->select('categories.category_name', 'products.*')
            ->where('products.id', $id)
            ->first();

        if (!$productDb) { 
            abort(404); 
        }

        $data = [
            'title'     => $productDb->product_name,
            'categories' => Category::all(),
            'store_profile' => User::find(1),
            'product'   => $productDb,
        ];
        return view('contents.frontend.product', $data);
    }

    public function redirectToAdmin(){
        return redirect('admin');
    }
}
