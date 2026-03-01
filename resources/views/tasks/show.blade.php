@extends('layouts.app')

@section('content')
<h1>{{ $task->title }}</h1>
<p>{{ $task->description }}</p>

<a href="{{ route('tasks.index') }}" class="btn btn-secondary">Back</a>
@endsection