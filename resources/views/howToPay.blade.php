@extends('layouts.app')

@section('content')
@if($contactsDetail)

<table class='howToPay'>
    <tr>
        <td> Наименование: </td>
        <td> Номер счёта: </td>
        <td> Как платить: </td>
    </tr>
    @foreach($contactsDetail as $key)
    <tr>
        <td> {{ $key->contacts->title }} </td>
        <td> {{ $key->account_number }} </td>
        <td> {{ $key->description }} </td>
    </tr>
    @endforeach
</table>

<div class="backButtonPay"> <a href="{{ route('home') }}"> Назад </a> </div>

@endif
@endsection