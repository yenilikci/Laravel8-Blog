@isset($categories)
<div class="col-md-3">
    <div class="card">
      <div class="card-header">Kategoriler</div>
        <div class="list-group">
            @foreach($categories as $category)
                <a  @if(Request::segment(2) != $category->slug) href="{{route('category',$category->slug)}}"  @endif class="list-group-item  @if(Request::segment(2) == $category->slug) active @endif list-group-item-action">{{$category->name}} <span
                    class="badge badge-dark float-right">{{$category->articleCount()}}</span></a>
            @endforeach
        </div>
    </div>
</div>
@endisset
