@extends('front.layouts.master')
@section('title','Laravel8 Blog Sitesi - Anasayfa')
@section('content')
<!-- Main Content -->
<div class="col-md-9 mx-auto">
    @include('front.widgets.articleListWidge')
</div>

@include('front.widgets.categoryWidget')
@endsection
