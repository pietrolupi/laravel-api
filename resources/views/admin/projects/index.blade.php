@extends('layouts.admin')

@section('content')

<div class="projects container">
    <h1 class="mb-3">I miei progetti</h1>

    @include('admin.partials.error_or_success')

    @if(session('deleted'))
        <div class="alert alert-success" role="alert">
            {{session('deleted')}}
        </div>
    @endif

    <table class="table mt-4">
        <thead>
          <tr>
            <th scope="col">Titolo</th>
            <th scope="col">Descrizione</th>
            <th scope="col">Tecnologie</th>
            <th scope="col">Tipologia</th>
            <th scope="col">Link</th>
            <th scope="col">Altri sviluppatori</th>
            <th scope="col">Azioni</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)

            <tr>
              <td>{{$project->title}}</td>
              <td>{!!$project->description!!}</td>

              <td>
                @forelse ($project->technologies as $technology)

                    <a href="{{route('admin.project-technology', $technology)}}">

                       {{$technology->name}}

                    </a>

                @empty
                    -
                @endforelse
              </td>

              <td>{{$project->type?->name ?? '-'}}</td>
              <td>{{$project->github_link}}</td>
              <td>{{$project->other_developers}}</td>
              <td>
                <a class="btn btn-primary d-inline-block " href="{{route('admin.projects.show', $project)}}"><i class="fa-solid fa-eye"></i></a>

                <a href="{{route('admin.projects.edit', $project)}}" class="btn btn-warning d-inline-block "><i class="fa-solid fa-pencil"></i></a>

                @include('admin.partials.form_delete', ['route' => route('admin.projects.destroy', $project),
                 'message' => 'Vuoi davvero procedere ad eliminare permanentemente questo progetto '])

              </td>
            </tr>
            @endforeach

        </tbody>
      </table>
      {{$projects->links()}}

      <a class="btn btn-success mt-3" href="{{route('admin.projects.create')}}">Inserisci un nuovo progetto</a>
</div>
@endsection
