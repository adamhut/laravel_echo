@extends('layouts.app')


@section('content')
<div class="container flex-center position-ref full-height">
    <project-task-list :data-project="{{$project}}"></project-task-list>
</div>
@endsection


