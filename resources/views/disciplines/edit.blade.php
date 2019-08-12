@extends('layouts.layout')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('disciplines.index')}}">Disziplinen</a></li>
        <li class="breadcrumb-item"><a href="/disciplines/{{$discipline->id}}">{{$discipline->name}}</a></li>
        <li class="breadcrumb-item active" aria-current="page">Details</li>
        <li class="ml-auto">SportManager</li>
    </ol>
</nav>

<div class="col-12 text-center py-3">
    <h1>Details zu {{$discipline->name}} bearbeiten</h1>
</div>

<div class="container text-center">
    <div class="row">
        <div class="col-12">
            <form action="{{route('disciplines.update', ['discipline' => $discipline])}}" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                @include('disciplines.form')

                <button type="submit" class="btn btn-primary m-3">Änderungen bestätigen</button>
            </form>
        </div>
    </div>
</div>

<div class="container">
    <a href="/disciplines/{{$discipline->id}}" role="button" class="btn btn-info btn-lg btn-block fixed-bottom py-3">Zurück</a>
</div>