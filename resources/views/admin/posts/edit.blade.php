@extends('layouts.app')

@section('title')
    | Modifica post: {{$post->title}}
@endsection

@section('content')
<div class="container">

    <h1 class="my-5"> Modifica post: {{$post->title}} </h1>

    @if ($errors->any())

        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error )
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>


    @endif

    <form class="mb-3" action="{{route('admin.posts.update',$post)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Titolo</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{old('title', $post->title)}}" placeholder="Titolo">
            @error('title')
                <p class="invalid-feedback">{{$message}}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">data</label>
            <input type="date" class="form-control @error('date') is-invalid @enderror"  id="date" name="date"
            value="{{old('date',$post->date)}}">
            @error('date')
                <p class="invalid-feedback">{{$message}}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Immagine</label>
            <input
            onchange="showImage(event)"
            type="file" class="form-control @error('image') is-invalid @enderror"  id="image" name="image"
            value="{{old('image',$post->image)}}" placeholder="URL immagine">
            @error('image')
                <p class="invalid-feedback">{{$message}}</p>
            @enderror
            <div class="image mt-2" >
                <img id='output-image' width="150" src="{{ asset('storage/' . $post->image) }}" alt="{{$post->image_original_name}}">
            </div>
        </div>
          <div class="mb-3">
            <label for="text" class="form-label">Testo</label>
            <textarea  name="text"  id="text" rows="3">{{old('text',$post->text)}}</textarea>
            @error('text')
                <p class="invalid-feedback">{{$message}}</p>
            @enderror
          </div>
          <button type="submit" class="btn btn-success">Invio</button>
    </form>

    @include('admin.partials.form-delete')

</div>

<script>
    ClassicEditor
            .create( document.querySelector( '#text' ),{
                toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ],
            })
            .catch( error => {
                console.error( error );
            } );

    function showImage(event){
        const tagImage = document.getElementById('output-image');
        tagImage.src = URL.createObjectURL(event.target.files[0]);
    }

    </script>
@endsection
