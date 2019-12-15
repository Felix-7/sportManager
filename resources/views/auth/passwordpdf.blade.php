@extends('layouts.layout')

<table class="table table-striped table-bordered" cellspacing="0" cellpadding="1" border="1">
    <thead>
    <tr>
        <th scope="col" style="text-align:center">eMail / Benutzer</th>
        <th scope="col" style="text-align:center">Generiertes Passwort</th>
    </tr>
    </thead>
    <tbody>
        @foreach($login_data as $teacher)
             <tr>
                 <td style="text-align:center">{{$teacher[0]}}</td>
                 <td style="text-align:center">{{$teacher[1]}}</td>
             </tr>
        @endforeach
    </tbody>
</table>