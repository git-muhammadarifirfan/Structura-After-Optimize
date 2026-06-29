<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class LandingPageController extends Controller
{
    public function index()
    {

        $user = Auth::user();
        if ($user?->role === 'admin' || $user?->role === 'super-admin') {
            return redirect('/structuradmin');
        }

        $latestProducts = Cache::remember('landing.latest_products', 300, function () {
            return Product::select(['id','image','product_name','sku','price','stock','category_id'])
                ->orderByDesc('id')
                ->limit(4)
                ->get();
        });
        $categories = Cache::remember('categories.all', 3600, function () {
            return Category::select(['id','image','slug','category_name','short_description'])->orderBy('category_name')->get();
        });

        return view('home.landingpage', compact('latestProducts', 'categories'));
    }
}
