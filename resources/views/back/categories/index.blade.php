@extends('back.layouts.master')
@section('title','Tüm kategoriler')
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Yeni Kategori Oluştur
                    </h6>
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('admin.category.create')}}">
                        @csrf
                        <div class="form-group">
                            <label>Kategori Adı</label>
                            <input type="text" name="category" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary float-right">Ekle</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        @yield('title')
                    </h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Kategori Adı</th>
                                <th>Makale Sayısı</th>
                                <th>Durum</th>
                                <th>İşlemler</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{$category->name}}</td>
                                    <td>{{$category->articleCount()}}</td>
                                    <td>
                                        <input class="switch" data="{{$category->id}}" type="checkbox" data-on="Aktif"
                                               data-off="Pasif" data-offstyle="danger"
                                               data-onstyle="success" @if($category->status == 1) checked
                                               @endif data-toggle="toggle">
                                    </td>
                                    <td>
                                        <a category-id="{{$category->id}}" class="edit-click btn btn-sm btn-primary" title="Kategoriyi Düzenle"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('js')
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script>
        $(function () {

            $('.edit-click').click(function(){
                var id = $(this)[0].getAttribute('category-id');
                console.log(id);
            });


            $('.switch').change(function () {
                var id = $(this).attr('data');
                var status = $(this).prop('checked');
                $.get("{{route('admin.category.switch')}}", {id: id, status: status}, function (data, status) {
                    console.log(data);
                });
            })
        })
    </script>
@endsection
