@extends('layouts.layout')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">home</a></li>
        <li class="breadcrumb-item"><a href="{{route('stats.select')}}">Modus</a></li>
        <li class="breadcrumb-item active" aria-current="page">Eingabe</li>
        <li class="ml-auto">SportManager</li>
    </ol>
</nav>

<div class="title text-center">
    <h1>Suche nach @if($useAge == 1) Alter @else Schulstufe @endif</h1>
</div>



<div class="container">
    <form action="{{route('stats.deliverDetail')}}" method="post">
        <input type="hidden" name="mode" value="{{$mode}}">
        <input type="hidden" name="discipline_id" value="{{$discipline_id}}">
        <input type="hidden" name="gender" value="{{$gender}}">
        <input type="hidden" name="useAge" value="{{$useAge}}">
        <input type="hidden" name="limit" value="{{$limit}}">

        @if($useAge == 1)
            <div class="form-group">
                <input type="text" class="form-control" name="age" placeholder="Alter eingeben...">
            </div>
            <input type="hidden" name="class" value="-1">
        @else
            <div class="form-group">
                <input type="text" class="form-control" name="class" placeholder="Schulstufe (zwischen 1 und 8) eingeben...">
            </div>
            <input type="hidden" name="age" value="-1">
        @endif

        <div class="form-row my-3">
            <button type="submit" class="btn btn-primary btn-lg btn-block">Filter anwenden</button>
        </div>
        @csrf
    </form>
</div>
