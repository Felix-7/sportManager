@extends('layouts.layout')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('stats.select')}}">Modus</a></li>
        <li class="breadcrumb-item active" aria-current="page">Eingabe</li>
    </ol>
</nav>

<div class="title text-center">
    <h1>Suche definieren</h1>
</div>

<div class="container">
    <form action="{{route('stats.deliver')}}" method="post">
        <div class="form-row my-3">
            <div class="col-6">
                <select name="discipline_id" id="discipline_id" class="form-control">
                    <option disabled selected>Disziplin</option>
                    @foreach($disciplines as $discipline)
                        <option value="{{$discipline->id}}">{{$discipline->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-6">
                <select name="group_id" id="group_id" class="form-control">
                    <option value="0" selected>Gruppe</option>
                    @foreach($groups as $group)
                        <option value="{{$group->group}}">{{$group->group}}</option>
                    @endforeach
                </select>
            </div>

        </div>
        <button type="submit" class="btn btn-primary btn-lg btn-block">Suchen</button>
        @csrf
    </form>
</div>
