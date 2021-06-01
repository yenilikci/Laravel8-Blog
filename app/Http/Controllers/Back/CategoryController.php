<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;
use Illuminate\Support\Str;
use PhpParser\Node\Stmt\Catch_;
use Prophecy\Call\Call;

class CategoryController extends Controller
{
    public function __construct()
    {
        view()->share('articles', Article::all());
    }

    public function index()
    {
        $categories = Category::all();
        return view('back.categories.index', compact('categories'));
    }

    public function create(Request $request)
    {
        $isExist = Category::whereSlug(Str::slug($request->category))->first();
        if ($isExist) {
            toastr()->error($request->category . ' adında bir kategori zaten mevcut!');
            return redirect()->back();
        }
        $category = new Category;
        $category->name = $request->category;
        $category->slug = Str::slug($request->category);
        $category->save();
        toastr()->success('Kategori Başarıyla Oluşturuldu');
        return redirect()->back();
    }

    public function update(Request $request)
    {
        $isSlug = Category::whereSlug(Str::slug($request->category))->whereNotIn('id', [$request->id])->first();
        $isName = Category::whereName($request->name)->whereNotIn('id', [$request->id])->first();
        if ($isSlug or $isName) {
            toastr()->error($request->category . ' adında bir kategori zaten mevcut!');
            return redirect()->back();
        }
        $category = Category::find($request->id);
        $category->name = $request->category;
        $category->slug = Str::slug($request->category);
        $category->save();
        toastr()->success('Kategori Başarıyla Güncellendi');
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        $category = Category::findOrFail($request->id);
        $message = '';
        $count = $category->articleCount();
        if($count > 0){
            Article::where('category_id',$category->id)->update(['category_id' => 1]);
            $defaultCategory = Category::find(1);
            $message = 'Bu kategoriye ait '.$count.' makale '.$defaultCategory->name.' kategorisine taşındı.';
        }
        $category->delete();
        toastr()->success($message,'Kategori başarı ile silindi!');
        return redirect()->back();
    }

    public function switch(Request $request)
    {
        $category = Category::findOrFail($request->id);
        $category->status = $request->status == "true" ? 1 : 0;
        $category->save();
    }

    public function getData(Request $request)
    {
        $category = Category::findOrFail($request->id);
        return response()->json($category);
    }
}
