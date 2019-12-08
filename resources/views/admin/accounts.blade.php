@extends('layouts.layout')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item active" aria-current="page">Accounts</li>
        <li class="ml-auto">SportManager</li>
    </ol>
</nav>

    <div class="container">
        <table class="table table-striped table-bordered text-center">
            <thead>
            <tr>
                <th scope="col">eMail / Benutzer</th>
                <th scope="col">Passwort zurücksetzen</th>
                <th scope="col">Account suspendieren</th>
            </tr>
            </thead>
            <tbody>

            @foreach($teacherList as $teacher)
                <tr>
                    <td>{{$teacher->email}}</td>
                    <td><a href="{{route('admin.reset', ['id' => $teacher->id])}}" class="btn btn-primary">Passwort von {{$teacher->name}} zurücksetzen</a></td>
                    <td>@if($teacher->active == true)<a href="{{route('admin.suspend', ['id' => $teacher->id])}}" class="btn btn-danger">{{$teacher->name}} suspendieren</a>
                    @else <a href="{{route('admin.activate', ['id' => $teacher->id])}}" class="btn btn-info">{{$teacher->name}} aktivieren</a> @endif</td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>