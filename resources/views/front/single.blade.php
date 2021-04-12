@extends('front.layouts.master')
@section('title',$article->title)
@section('bg',$article->image)
@section('content')
 <!-- Post Content -->
        <div class="col-md-9 mx-auto">
            <div class="card">
                <div class="card-body p-4">
                {!!$article->content!!}
                </div>
                <div class="card-footer p-4">
                    Okunma Sayısı:
                    {{$article->hit}}
                </div>
            </div>
        </div>

@include('front.widgets.categoryWidget')
@endsection
