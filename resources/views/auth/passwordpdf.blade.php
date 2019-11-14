@extends('layouts.layout')

<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th scope="col">eMail / Benutzer</th>
        <th scope="col">Generiertes Passwort</th>
    </tr>
    </thead>
    <tbody>
        @foreach($login_data as $teacher)
             <tr>
                 <td>{{$teacher[0]}}</td>
                 <td>{{$teacher[1]}}</td>
             </tr>
        @endforeach
    </tbody>
</table>