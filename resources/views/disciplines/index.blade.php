@extends('layouts.layout')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Disziplinen</li>
        <li class="ml-auto">SportManager</li>
    </ol>
</nav>

<div class="title text-center">
    <h1>Disziplin wählen</h1>
</div>

<div class="container">
    @foreach($disciplines as $key => $discipline)
        @if(($key % 2 == 0))
            <div class="card-deck text-center py-2">
        @endif
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{$discipline->name}}</h5>
                        <a href="#" class="btn btn-success">Disziplin wählen</a>
                    </div>
                </div>
        @if($key % 2 == 1)
            </div>
        @endif



    @endforeach
</div>




<div class="container">
    <a href="{{route('disciplines.create')}}" role="button" class="btn btn-primary btn-lg btn-block fixed-bottom py-3">Disziplin hinzufügen</a>
</div>