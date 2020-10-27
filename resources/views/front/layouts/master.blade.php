<!--tüm sayfaları tek master page'den çekelim-->
@include('front.layouts.header') <!--tüm sayfalarda ortak olan header-->
@yield('content') <!--içerik-->
@include('front.layouts.footer') <!--tüm sayfalarda ortak olan footer-->
