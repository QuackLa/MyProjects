@extends('layouts.app')

@section('content')

@if($user)
<form action="{{ route('editAccount') }}" method="POST">
@csrf
<table class='Account'>
    <tr>
        <td colspan="2"> Изменяемые данные Вашего аккаунта: </td>
    </tr>
    <tr>
        <td> Имя </td>
        <td> <input type="text" name="name" value="{{ $user->name }}"> </td>
    </tr>
    <tr>
        <td> Фамилия </td>
        <td> <input type="text" name="surname" value="{{ $user->surname }}"> </td>
    </tr>
    <tr>
        <td> Почта </td>
        <td> <input type="text" name="email" value="{{ $user->email }}"> </td>
    </tr>
    <tr>
        <td> Город </td>
        <td> <input type="text" name="city" value="{{ $user->city }}"> </td>
    </tr>
    <tr>
        <td> Район </td>
        <td> <input type="text" name="district" value="{{ $user->district }}"> </td>
    </tr>
    <tr>
        <td colspan="2"> <button class="accountButtonEdit"> Исправить </button> </td>
    </tr>
</table>
</form>
@endif

@endsection