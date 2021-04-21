@extends('layouts.app')

@section('content')

@foreach($result as $item)
<table>
<form action="{{ route('editIndications') }}" method="POST">
@csrf
    <tr>
        <td> Показания: </td>
        <td> <input type="text" name="indications" value="{{ $item->indications }}"> </td>
    </tr>
    <tr>
        <td> Месяц: </td>
        <td> {{ $item->month }} </td>
        <td> <input type="hidden" name="month" value="{{ $item->month }}"> </td>
    </tr>
    <tr>
        <td> Год: </td>
        <td> {{ $item->year }} </td>
        <td> <input type="hidden" name="year" value="{{ $item->year }}"> </td>
    </tr>
    <tr>
        <td> Счётчик: </td>
        <td> 
            {{ $item->counters->affiliation }} 
            {{ $item->counters->description }} 
            {{ $item->counters->number_in_social_garanty }} 
        </td>
        <td> <input type="hidden" name="counter_id" value="{{ $item->counter_id }}"> </td>
    </tr>
    <tr>
        <td> Пользователь: </td>
        <td> {{ $item->users->surname }} </td>
    </tr>
    <tr>
        <td> <button type="submit" name="edit" value="edit"> Исправить </button> </td>
    </tr>
</form>
</table>
@endforeach

@endsection