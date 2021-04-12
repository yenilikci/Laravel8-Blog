@if(count($articles) > 0)
@foreach($articles as $article)
<div class="card border">
    <div class="card-header bg-dark">
        <a href="{{route('single',[$article->getCategory->slug,$article->slug])}}" class="text-white">
            <h2 class="post-title">
                {{$article->title}}
            </h2>
        </a>
    </div>
    <div class="card-body">
        <img src="{{$article->image}}" class="img-fluid" alt="Responsive image">
        <p>
            {!!Str::limit($article->content,100)!!}
        </p>
    </div>
    <div class="card-footer">
        <p class="post-meta"> Kategori:
            <a href="#">{{$article->getCategory->name}}</a>
            <span class="float-right">{{$article->created_at->diffForHumans()}}</span>
        </p>
    </div>
</div>
@if(!$loop->last)
<hr>
@endif
@endforeach
@else
<div class="alert alert-danger">
    <h1>Bu kategoriye ait yazı bulunamadı!</h1>
</div>
@endif
<div class="mt-2 d-flex justify-content-center align-items-center">
    {{$articles->links()}}
</div><!--sayfalama-->
