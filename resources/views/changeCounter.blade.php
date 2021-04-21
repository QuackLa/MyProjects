@extends('layouts.app')

@section('content')

<form action="{{ route('changeCounterDo') }}" method="POST">
@csrf
    <table class="changeCounter">
        <tr>    
            <td colspan="2"> Укажите данные нового счётчика </td>
        </tr>
        <tr>
            <td> Какой меняем? </td>
            <td>
                <select name="old_serial">
                    @foreach($counters as $key)
                    <option value=" {{ $key->id }} ">
                        {{ $key->serial }}
                    </option>
                    @endforeach
                </select>
            </td>
        </tr>
        <tr>
            <td> Где установлен: </td>
            <td>
                <select name="description">
                    @foreach($location as $key)
                    <option value=" {{ $key->description }} ">
                        {{ $key->description }}
                    </option>
                    @endforeach
                </select>
            </td>
        </tr>
        <tr>
            <td> Тип счётчика: </td>
            <td>
                <select name="affiliation">
                    @foreach($typeCounters as $key)
                    <option value=" {{ $key->affiliation }} ">
                        {{ $key->affiliation }}
                    </option>
                    @endforeach
                </select>
            </td>
        </tr>
        <tr>
            <td> Серийный номер: </td>
            <td> <input type="text" name="serial"> </td>
        </tr>
        <tr>
            <td> Номер прибора в листе соц.гарантий: </td>
            <td> <input type="number" name="number_in_social_garanty"> </td>
        </tr>
        <tr>
            <td> Установлен: </td>
            <td> <input type="date" name="installation_date"> </td>
        </tr>
        <tr>
            <td> Период поверки: </td>
            <td> <input type="number" name="verification_period" placeholder="количество лет"> </td>
        </tr>
        <tr>
            <td colspan="2"> <button type="submit" onclick="return proverka()"> Произвести замену </button> </td>
        </tr>
    </table>
</form>

<table class="changeCounter">
    <tr>
        <td> Где установлен: </td>
        <td> Серийный номер: </td>
        <td> Установлен: </td>
        <td> Период поверки: </td>
        <td> Дата поверки: </td>
        <td> Окончание эксплуатации: </td>
    </tr>
    @foreach($counters as $key)
    <tr>
        <td> {{ $key->description }}/{{ $key->affiliation }} </td>
        <td> {{ $key->serial }} </td>
        <td> {{ $key->installation_date }} </td>
        <td> {{ $key->verification_period }} </td>
        <td> {{ $key->verification_date }} </td>
        <td> {{ $key->end_of_service_date }} </td>
    </tr>
    @endforeach
</table>

@endsection