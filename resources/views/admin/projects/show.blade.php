@extends('layouts.admin')

@section('content')

<div class="show container">

    <h1>{{$project->title}}</h1>
    <a href="{{route('admin.projects.edit', $project)}}" class="btn btn-warning"><i class="fa-solid fa-pencil"></i></a>

    @if($project->type)
        <span> Tipologia <strong>{{$project->type->name }}</strong> </span>
    @endif

    <br>

    @forelse ($project->technologies as $technology)

        <span> <strong>{{$technology->name }}</strong> </span>
    @empty
        -
    @endforelse

    <div class="img-container w-50">

        <img class="img-fluid" src="{{asset('storage/' . $project->image)}}" alt="{{$project->title}}">

        <p>{{$project->image_original_name}}</p>
    </div>
    <p>{!! $project->description !!}</p>
</div>
@endsection
