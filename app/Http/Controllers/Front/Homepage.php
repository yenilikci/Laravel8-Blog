<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Models\Category;
use App\Models\Article;
use App\Models\Page;

class Homepage extends Controller
{

    public function __construct()
    {
        view()->share('pages',Page::orderBy('order','ASC')->get());
        view()->share('categories',Category::inRandomOrder()->get());
    }

    public function index()
    {
        Paginator::useBootstrap();
        $data['articles'] = Article::orderBy('created_at','DESC')->paginate(2);
        $data['articles']->withPath(url('sayfa'));
        return view('front.homepage',$data);
    }

    public function single($categorySlug,$slug){
        $category = Category::whereSlug($categorySlug)->first() ?? abort(403,'Böyle bir kategori bulunamadı');
        $article = Article::whereSlug($slug)->whereCategoryId($category->id)->first() ?? abort(403,'Böyle bir yazı bulunamadı');
        $data['article'] = $article;
        $article->increment('hit');
        return view('front.single',$data);
    }

    public function category($slug){
        Paginator::useBootstrap();
        $category = Category::whereSlug($slug)->first() ?? abort(403,'Böyle bir kategori bulunamadı!');
        $data['category'] = $category;
        $data['articles'] = Article::where('category_id',$category->id)->orderBy('created_at','DESC')->paginate(1);
        return view('front.category',$data);
    }
    
    public function page($slug){
        $page = Page::whereSlug($slug)->first() ?? abort(403,'Böyle bir sayfa bulunamadı');
        $data['page'] = $page;
        return view('front.page',$data);
    }
}
