@extends('layouts.admin')

@section('content')

<div class="technologies container">

    <h1>Elenco Tencologie Utilizzate</h1>

    @if($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{route('admin.technologies.store')}}" method="POST" >
        @csrf

        <div class="input-group mb-3">

            <input type="text" class="form-control" id="name" name="name" placeholder="Aggiungi nuova tecnologia">

            <div class="input-group-append">
              <button class="btn btn-success" type="submit">Aggiungi Nuova Tecnologia </button>
            </div>
          </div>

    </form>

   @include('admin.partials.error_or_success')



    <table class="table">
        <thead>
          <tr>
            <th scope="col">Nome</th>
            <th scope="col">Azioni</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($technologies as $technology)

            <tr>
                <td>
                    <form
                    action="{{route('admin.technologies.update',$technology)}}"
                    method="POST"
                    id="form-edit">

                    @csrf
                    @method('PUT')

                        <input type="text" class="hidden-form" value="{{$technology->name}}" name="name" >

                    </form>
                </td>

                <td>

                    {{-- bottone modifica per inviare le modifiche effettuate nel form nel <td> precedente --}}

                    <button onclick="submitForm()" class="btn btn-warning"><i class="fa-solid fa-pencil"></i></button>

                    @include('admin.partials.form_delete', ['route' => route('admin.technologies.destroy', $technology),
                 'message' => 'Vuoi davvero procedere ad eliminare permanentemente questa tecnologia?'])


                </td>
            </tr>
            @endforeach

        </tbody>
      </table>
</div>

<script>

    function submitForm(){
        const form = document.getElementById('form-edit');
        form.submit();

    }

</script>

@endsection
