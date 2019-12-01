@extends('layouts.layout')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('stats.select')}}">Modus</a></li>
        <li class="breadcrumb-item active" aria-current="page">Eingabe</li>
        <li class="ml-auto">SportManager</li>
    </ol>
</nav>

<div class="title text-center">
    <h1>Suche definieren</h1>
</div>

<div class="container">
    <form action="{{route('stats.deliver')}}" method="post">
        <input type="hidden" name="mode" value="{{$mode}}">
        <div class="form-row my-3">
            <select name="discipline_id" id="discipline_id" class="form-control">
                <option disabled selected>Disziplin</option>
                @foreach($disciplines as $discipline)
                    <option value="{{$discipline->id}}">{{$discipline->name}}</option>
                @endforeach
            </select>
        </div>

        @if($mode == '3')
            <div class="form row my-3">
                <select name="upper" class="form-control">
                    <option disabled selected>Ober- oder Unterstufe</option>
                    <option value="1">Oberstufe</option>
                    <option value="0">Unterstufe</option>
                </select>
            </div>
        @else <input type="hidden" name="upper" value="-1">
        @endif
        @csrf

        <div class="form row my-3">
            <select name="limit" class="form-control">
                <option disabled selected>Anzahl an Werten</option>
                <option value="0">Alle</option>
                <option value="3">3</option>
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>

        <div class="form-row my-3">
            <div class="col-6">
                <button type="submit" name="gender" class="btn btn-primary btn-lg btn-block" value="m">♂</button>
            </div>
            <div class="col-6">
                <button type="submit" name="gender" class="btn btn-danger btn-lg btn-block" value="f">♀</button>
            </div>
        </div>



    </form>
</div>
