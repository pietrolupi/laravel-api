@extends('layouts.admin')

@section('content')

<h1>Tutti i progetti che utilizzano la tecnologia "{{$technology->name}}"</h1>

<table class="table">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Nome post</th>
        <th scope="col">Azioni</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($technology->projects as $project)
        <tr>

            <td>{{ $project->id }}</td>
            <td>{{ $project->title }}</td>
            <td>
                <a class="btn btn-primary" href="{{route('admin.projects.show', $project)}}"><i class="fa-solid fa-eye"></i></a>

                <a href="{{route('admin.projects.edit', $project)}}" class="btn btn-warning"><i class="fa-solid fa-pencil"></i></a>

                @include('admin.partials.form_delete', ['route' => route('admin.projects.destroy', $project),
                 'message' => 'Vuoi davvero procedere ad eliminare permanentemente questo progetto '])

              </td>

        </tr>
        @endforeach
    </tbody>
  </table>
@endsection
