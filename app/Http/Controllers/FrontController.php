<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\OrderProduct;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class FrontController extends Controller
{
    public function home()
    {
        $categories = Category::WithTranslation()
        ->translatedIn(app()->getLocale())
        ->get();
            
        return view('home')->with('categories', $categories);
    }
    public function catalog(Request $request, $category_name)
    {

            $category = Category::whereTranslation('name', $category_name)->first();
            $products = Product::where('category_id', $category->id)->paginate('16');
        if(request('sort') == 'price_asc')
        {
            $products = Product::where('category_id', $category->id)->orderBy('price', 'asc')->paginate('16');
        }
        if(request('sort') == 'price_desc')
        {
            $products = Product::where('category_id', $category->id)->orderBy('price', 'desc')->paginate('16');
        }
        if(request('sort') == 'relevance')
        {
            //there is nothing cause of the first $products is the relevance filtered
        }
        return view('catalog.catalog')
            ->with('category_name', $category->name)
            ->with('products', $products);
    }
    public function product(Product $product)
    {
        $related_products = Product::WithTranslation()
        ->translatedIn(app()->getLocale())
        ->where('id', '!=', $product->id)
        ->where('category_id', $product->category->id)
        ->limit(6)
        ->get();
        return view('catalog.product-details')
        ->with('product', $product)
        ->with('related_products', $related_products);
    }
    public function about()
    {
        return view('landing.about');
    }
    public function contact()
    {
        return view('landing.contact');
    }
    public function change_lang($lang)
    {
        app()->setLocale($lang);
        session()->put('locale', $lang);

        return redirect()->back();
    }
}
