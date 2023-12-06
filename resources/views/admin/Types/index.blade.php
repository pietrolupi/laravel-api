@extends('layouts.admin')

@section('content')

<div class="types container">

    <h1>Tipologie di lavoro</h1>

    @if($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{route('admin.types.store')}}" method="POST" >
        @csrf

        <div class="input-group mb-3">

            <input type="text" class="form-control" id="name" name="name" placeholder="Aggiungi nuova tipologia">

            <div class="input-group-append">
              <button class="btn btn-success" type="submit">Aggiungi Nuova Tipologia </button>
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
            @foreach ($types as $type)

            <tr>

                <td>
                    <form
                    action="{{route('admin.types.update',$type)}}"
                    method="POST"
                    id="form-edit">

                    @csrf
                    @method('PUT')

                        <input type="text" class="hidden-form" value="{{$type->name}}" name="name" >

                    </form>

                </td>

                <td>
                    <button onclick="submitForm()" class="btn btn-warning"><i class="fa-solid fa-pencil"></i></button>

                    @include('admin.partials.form_delete', ['route' => route('admin.types.destroy', $type),
                    'message' => 'Vuoi davvero procedere ad eliminare permanentemente questa tipologia?'])

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
