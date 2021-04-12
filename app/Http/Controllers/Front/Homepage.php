<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Models\Category;
use App\Models\Article;

class Homepage extends Controller
{
    public function index()
    {
        Paginator::useBootstrap();
        $data['articles'] = Article::orderBy('created_at','DESC')->paginate(2);
        $data['articles']->withPath(url('sayfa'));
        $data['categories'] = Category::inRandomOrder()->get();
        return view('front.homepage',$data);
    }

    public function single($categorySlug,$slug){
        $category = Category::whereSlug($categorySlug)->first() ?? abort(403,'Böyle bir kategori bulunamadı');
        $article = Article::whereSlug($slug)->whereCategoryId($category->id)->first() ?? abort(403,'Böyle bir yazı bulunamadı');
        $data['article'] = $article;
        $article->increment('hit');
        $data['categories'] = Category::inRandomOrder()->get();
        return view('front.single',$data);
    }

    public function category($slug){
        Paginator::useBootstrap();
        $data['categories'] = Category::inRandomOrder()->get();
        $category = Category::whereSlug($slug)->first() ?? abort(403,'Böyle bir kategori bulunamadı!');
        $data['category'] = $category;
        $data['articles'] = Article::where('category_id',$category->id)->orderBy('created_at','DESC')->paginate(1);
        return view('front.category',$data);
    }
}
