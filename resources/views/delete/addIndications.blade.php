@extends('layouts.app')

@section('content')
<!-- Форма внесения новых показаний счётчиков -->
<form action="{{ route('addIndications') }}" method="POST">
@csrf
    <table>
        <tr>
            <td> Введите показания </td>
            <td> <input type="text" name="indications"> </td>
        </tr>
        <tr>
            <td> <lable> Выберите счётчик </lable> </td>
            <td>
                <select name="counter_id">
                @if($counters)
                    @foreach($counters as $items)
                    <option value=" {{ $items->id }} ">
                        {{ $items->affiliation }}
                        {{ $items->description }}
                        {{ $items->number_in_social_garanty }} 
                    </option>
                    @endforeach
                @endif
                </select>
            </td>
        </tr>
        <tr>
            <td> <lable> Укажите месяц </lable> </td>
            <td>
                <select name="month">
                @if($months)
                    @foreach($months as $month)
                    <option value=" {{ $month }} "> {{ $month }} </option>
                    @endforeach
                @endif
                </select>
            </td>
        </tr>
        <tr>
            <td> <lable> Укажите год </lable> </td>
            <td>
                <select name="year">
                @if($years)
                    @foreach($years as $year)
                    <option value=" {{ $year }} "> {{ $year }} </option>
                    @endforeach
                @endif
                </select>
            </td>
        </tr>
        <tr>
            <td> <button type="submit" name="add" value="add"> Добавить показания в базу </button> </td>
        </tr>
    </table>
</form>
@endsection