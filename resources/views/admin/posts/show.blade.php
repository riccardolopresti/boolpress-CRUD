@extends('layouts.app')

@section('title')
    | {{$post->title}}
@endsection

@section('content')
<div class="container">

    @if (session('message'))
         <div class="alert alert-success" role="alert">
            {{session('message')}}
        </div>
    @endif




    <h1 class="my-5"> {{$post->title}} <a class="btn btn-warning " href="{{route('admin.posts.edit', $post)}}">EDIT</a> </h1>
    <p>{{date_format(date_create($post->date),'d/m/Y')}}</p>

    @if($post->image)
        <div>
            <img width="500" src="{{asset('storage/' . $post->image)}}" alt="{{$post->image_original_name}}">
            <div><i>{{$post->image_original_name}}</i></div>
        </div>
    @endif

    <img  src="{{ $post->image}}" alt="{{ $post->title }}">



    <p>
        {!!$post->text!!}
    </p>

    <a class="btn btn-primary" href="{{route('admin.posts.index')}}">Torna all'elenco</a>



</div>
@endsection
