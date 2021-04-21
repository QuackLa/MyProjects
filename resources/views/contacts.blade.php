@extends('layouts.app')

@section('content')

@if($contacts)
<table class="contacts-detail">
    <tr>
        <td> Наименование </td>
        <td> Телефон </td>
        <td> Email </td>
        <td> Сайт </td>
        <td> Адрес </td>
    </tr>
    @foreach($contacts as $key)
    <tr>
        <td> {{ $key->title }} </td>
        <td> {{ $key->phone }} </td>
        <td> {{ $key->email }} </td>
        <td> {{ $key->website }} </td>
        <td> {{ $key->address }} </td>
    </tr>
    @endforeach
</table>
@endif

<div class="backButton"> <a href="{{ route('home') }}"> Назад </a> </div>

@endsection