@extends('layouts.app')

@section('content')

<!-- Работа с показаниями счётчиков -->

@if($result)
    <form method="POST">
    @csrf
    <table class="changeIndications">
        <tr>
            <td colspan="2" class="title"> Изменение показааний: </td>
        </tr>
        <tr>
            <td> Показания: </td>
            <td> <input type="text" name="indications" value=""> </td>
        </tr>

        <tr>
            <td> Месяц: </td>
            <td>
                <select name="month">
                    @foreach($result as $item)
                    <option value=" {{ $item->month }} "> {{ $item->month }} </option>
                    @endforeach
                </select>
            </td>
        </tr>

        <tr>
            <td> Год: </td>
            <td>
                <select name="year">
                    @foreach($year as $item)
                    <option value=" {{ $item->year }} "> {{ $item->year }} </option>
                    @endforeach
                </select>
            </td>
        </tr>
        
        <tr>
            <td> Счётчик: </td>
            <td>
            <select name="counter_id">
                @foreach($counter_id as $item)
                <option value=" {{ $item->counter_id }} ">
                    {{ $item->counters->affiliation }}
                    {{ $item->counters->description }}
                    {{ $item->counters->number_in_social_garanty }} 
                </option>
                @endforeach
            </select>
            </td>
        </tr>

        <tr>
            <td colspan="2"> 
                <button formaction="{{ route('changeIndications') }}" name="edit" value="edit" class="buttonEdit"> 
                    Исправить 
                </button> 
            </td>
        </tr>
    </table>
    </form>
@endif


<!-- Работа со счётчиками -->

<form method="POST">
@csrf

    <table class="adminChangeCounters">
        <tr>
            <td colspan="2" class="title"> Справка: Если изменяем или удаляем, то укажите какой счётчик. Иначе игнорируем поле 'Счётчик' </td>
        </tr>
        <tr>
            <td> Счётчик: </td>
            <td>
                <select name="counter_id">
                    @if($counters)
                    @foreach($counters as $key)
                    <option value=" {{ $key->id }} ">
                        {{ $key->description }} / {{ $key->affiliation }}
                        {{ $key->serial }}
                    </option>
                    @endforeach
                    @endif
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2"> <button class="adminButtonDelete" formaction="{{ route('deleteCounter') }}" onclick="return proverka()"> Удалить </button> </td>
        </tr>
        <tr>
            <td> Где установлен: </td>
            <td>
                <input type="text" name="description" placeholder="Кухня/Туалет">
            </td>
        </tr>
        <tr>
            <td> Тип счётчика: </td>
            <td>
                <input type="text" name="affiliation" placeholder="Горячая вода / Холодная вода">
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
            <td> <button class="adminButtonEdit" formaction="{{ route('editCounter') }}"> Изменить </button> </td>
            <td> <button class="adminButtonAdd" formaction="{{ route('addCounter') }}"> Добавить счётчик </button> </td>
        </tr>
    </table>

</form>


<!-- Работа с контактами -->
<form method="POST">
@csrf
<table class="adminChangeContacts">
    <tr>
        <td colspan="2" class="title"> Справка: если добавляем контакт, то игнорируем поле 'Редактировать' </td>
    </tr>
    <tr>
        <td> Редактировать: </td>
        <td>
            <select name="contact">
                @if($contacts)
                @foreach($contacts as $key)
                <option value=" {{ $key->id }} ">
                    {{ $key->title }}
                </option>
                @endforeach
                @endif
            </select>
        </td>
    </tr>
    <tr>
        <td> Наименование: </td>
        <td> <input type="text" name="title"> </td>
    </tr>
    <tr>
        <td> Телефон: </td>
        <td> <input type="text" name="phone"> </td>
    </tr>
    <tr>
        <td> Email: </td>
        <td> <input type="email" name="email"> </td>
    </tr>
    <tr>
        <td> Сайт: </td>
        <td> <input type="text" name="website"> </td>
    </tr>
    <tr>
        <td> Адрес: </td>
        <td> <input type="text" name="address"> </td>
    </tr>

    <tr>
        <td> <button class="adminButtonEdit" formaction="{{ route('editContact') }}"> Редактировать </button> </td>
        <td> <button class="adminButtonAdd" formaction="{{ route('addContact') }}"> Добавить </button> </td>
    </tr>
</table>

</form>


<!-- Работа с чеками -->

@if($checks)
<form action="{{ route('deleteCheck') }}" method="POST">
@csrf
<table class="adminChangeChecks">
    <tr>
        <td colspan="2" class="title"> Работа с чеками: </td>
    </tr>
    <tr>
        <td> Выберите чек: </td>
        <td>
            <select name="filename">
                @foreach($checks as $key)
                <option value=" {{ $key->filename }} ">
                    {{ $key->filename}} / {{ $key->month }} {{ $key->year }}
                </option>
                @endforeach
            </select>
        </td>
    </tr>

    <tr>
        <td colspan="2"> <button class="adminButtonDelete" onclick="return proverka()"> Удалить чек </button> </td>
    </tr>
</table>

</form>
@endif

@endsection