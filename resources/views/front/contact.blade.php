@extends('front.layouts.master')
@section('title','İletişim')
@section('bg','https://portugaltantrafestival.com/wp-content/uploads/2017/02/40026308-contact-wallpapers.jpeg')
@section('content')


    <div class="col-md-8">

        @if(session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card-header bg-dark text-white">
            Bizimle iletişime geçebilirsiniz
        </div>
        <div class="card-body">
            <form method="post" action="{{route('contact.post')}}">
                @csrf
                <div class="control-group">
                    <div class="form-group">
                        <label>Ad Soyad</label>
                        <input type="text" class="form-control" value="{{old('name')}}" placeholder="Adınız Soyadınız"
                               name="name" required>
                        <p class="help-block text-danger"></p>
                    </div>
                </div>
                <div class="control-group">
                    <div class="form-group">
                        <label>Email Adresi</label>
                        <input type="email" class="form-control" value="{{old('email')}}" placeholder="Email Adresiniz"
                               name="email" required>
                        <p class="help-block text-danger"></p>
                    </div>
                </div>
                <div class="control-group">
                    <div class="form-group col-xs-12 ">
                        <label>Konu:</label>
                        <select name="topic" class="form-control">
                            <option @if(old('topic')=="bilgi") selected @endif value="bilgi">Bilgi</option>
                            <option @if(old('topic')=="destek") selected @endif  value="destek">Destek</option>
                            <option @if(old('topic')=="genel") selected @endif value="genel">Genel</option>
                        </select>
                        <p class="help-block text-danger"></p>
                    </div>
                </div>
                <div class="control-group">
                    <div class="form-group">
                        <label>Mesaj</label>
                        <textarea rows="5" class="form-control" name="message" placeholder="Mesajınız" id="message"
                                  required>{{old('message')}}
              </textarea>
                        <p class="help-block text-danger"></p>
                    </div>
                </div>
                <br>
                <div id="success"></div>
                <button type="submit" class="btn btn-success">Gönder</button>
            </form>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                Adres
            </div>
            <div class="card-body">
                Lorem ipsum dolor sit amet.
            </div>
        </div>
        <div class="card my-2">
            <div class="card-header">
                Telefon
            </div>
            <div class="card-body">
                Lorem ipsum.
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                Email
            </div>
            <div class="card-body">
                Lorem ipsum dolor.
            </div>
        </div>
    </div>
@endsection
