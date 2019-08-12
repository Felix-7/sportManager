@extends('layouts.layout')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('disciplines.index')}}">Disziplinen</a></li>
        <li class="breadcrumb-item active" aria-current="page">Neue Disziplin</li>
        <li class="ml-auto">SportManager</li>
    </ol>
</nav>


<div class="row">
    <div class="col-12 text-center py-3">
        <h1>Disziplin hinzufügen</h1>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-12">
            <form action="{{route('disciplines.store')}}" method="POST" enctype="multipart/form-data">
                @include('disciplines.form')
            </form>
        </div>
    </div>
</div>