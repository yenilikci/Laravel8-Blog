@extends('front.layouts.master')
@section('title',$category->name. ' Kategorisi | ' .count($articles). ' yazı bulundu!')
@section('content')
<!-- Main Content -->
<div class="col-md-9 mx-auto">
    @include('front.widgets.articleListWidget')
</div>

@include('front.widgets.categoryWidget')
@endsection
