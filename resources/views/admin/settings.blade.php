@extends('layouts.layout')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Admin</li>
        <li class="ml-auto">SportManager</li>
    </ol>
</nav>

<div class="title text-center">
    <h1>Schülerliste hochladen</h1>
</div>

<div class="container py-3 text-center">
    <form action="{{route('admin.list.upload')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="studentList">Schülerliste: </label>
            <input type="file" name="studentList">
        </div>
        <div>{{$errors->first('studentList')}}</div>
        <div class="form-group">
            <label for="groupList">Schüler-Gruppen Relation: </label>
            <input type="file" name="groupList">
        </div>
        <div>{{$errors->first('groupList')}}</div>
        <div>
            <label for="teacherList">Lehrer-Gruppen Relation: </label>
            <input type="file" name="teacherList">
        </div>

        <button type="submit" class="btn btn-primary my-3">Upload</button>
    </form>
</div>