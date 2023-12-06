@extends('layouts.admin')

@section('content')
    <div class="project-create container">
        <h1>Inserisci un nuovo progetto</h1>

        @if($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form
        class="form-group"
        action="{{route('admin.projects.store')}}"
        method="POST"
        enctype="multipart/form-data">

        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Titolo</label>
            <input
            type="text"
            id="title"
            name="title"
            class="form-control
            @error('title')
            is-invalid
            @enderror"
            value="{{old('title')}}">
        </div>

        <div class="mb-3">
            <label for="type_id" class="form-label">Titolo</label>
            <select id="type_id" name="type_id" class="form-select" >
                <option>Selezionare una tipologia:</option>
                @foreach ($types as $type)

                    <option
                    value="{{$type->id}}"
                    {{old('type_id') == $type->id ? 'selected': ''}}>
                        {{$type->name}}
                    </option>
                @endforeach

            </select>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descrizione</label>
            <textarea
            id="description"
            name="description"
            rows="3"
            class="form-control
            @error('description')
            is-invalid
            @enderror"
            value="{{old('description')}}"
            ></textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Immagine</label>
            <input
            type="file"
            id="image"
            name="image"
            class="form-control
            @error('image')
            is-invalid
            @enderror"
            onchange="showImage(event)"
            value="{{old('image')}}"
            >

            <img id="thumb" src="/img/placeholder.jpg" alt="">

        </div>
        <div class="mb-3">
            <label for="github_link" class="form-label">Link Github</label>
            <input
            type="text"
            id="github_link"
            name="github_link"
            class="form-control
            @error('github_link')
            is-invalid
            @enderror"
            value="{{old('github_link')}}"
            >
        </div>
        <div class="mb-3">
            <label for="other_developers" class="form-label">Altri Developer</label>
            <input
            type="text"
            id="other_developers"
            name="other_developers"
            class="form-control
            @error('other_developers')
            is-invalid
            @enderror"
            value="{{old('other_developers')}}"
            >

        </div>

        <div class="mb-3">
            <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                @foreach ($technologies as $technology)

                    <input
                    name="technologies[]"
                    id="technology_{{$technology->id}}"
                    value="{{$technology->id}}"
                    type="checkbox"
                    class="btn-check"
                    autocomplete="off"
                    @if(old('technologies') && in_array($technology->id, old('technologies')))
                    checked
                    @endif>

                    <label class="btn btn-outline-primary" for="technology_{{$technology->id}}">{{$technology->name}}</label>

                @endforeach

              </div>
        </div>



        <button type="submit" class="btn btn-success">Invia</button>
        <button type="reset" class="btn btn-danger">Annulla</button>

        </form>

    </div>



    <script>

        /* CKeditor */

        ClassicEditor
        .create( document.querySelector( '#description' ) )
        .catch( error => {
            console.error( error );
        } );

        /////////////////////////////////
        function showImage(event) {

            const thumb = document.getElementById('thumb');

            thumb.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>

@endsection
