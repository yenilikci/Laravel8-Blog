@extends('back.layouts.master')
@section('title','Tüm makaleler')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><strong>{{$articles->count()}} adet makale bulundu</strong></h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Fotoğraf</th>
                        <th>Makale Başlığı</th>
                        <th>Kategori</th>
                        <th>Tıklanma</th>
                        <th>Oluşturma</th>
                        <th>Durum</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($articles as $article)
                    <tr>
                        <td>
                            <img src="{{$article->image}}" width="150" alt="">
                        </td>
                        <td>{{$article->title}}</td>
                        <td>{{$article->getCategory->name}}</td>
                        <td>{{$article->hit}}</td>
                        <td>{{$article->created_at->diffForHumans()}}</td>
                        <td><b>{!!$article->status == 0 ? "<span class='text-danger'> Pasif </span>" : "<span class='text-success'>Aktif</span>"!!}</b></td>
                        <td>
                            <a href="#" title="Görüntüle" class="btn btn-sm d-block m-1 btn-success"><i class="fa fa-eye"></i> </a>
                            <a href="#" title="Düzenle" class="btn btn-sm d-block m-1 btn-warning"><i class="fa fa-pen"></i> </a>
                            <a href="#" title="Sil" class="btn btn-sm d-block m-1 btn-danger"><i class="fa fa-times"></i> </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
