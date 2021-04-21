<!-- После получения показаний из БД заменяем окно запроса окном с результатом -->
@if(session()->has('info'))
<table class='Counters'>
    <tr>
        <td> Месяц/Год: </td>
        <td> {{ session('info')[0]->year }}/{{ session('info')[0]->month }} </td>
    </tr>
    @foreach(session('info') as $result)
    <tr>
        <td>
            {{ $result->counters->affiliation }} 
            {{ $result->counters->description }} 
            ({{ $result->counters->number_in_social_garanty }})
        </td>
        <td>
            {{ $result->indications }}
        </td>
    </tr>
    @endforeach
    <tr>
        <td colspan="2" class="backButtonIndications"> <a href="{{ route('home') }}"> Назад </a> </td>
    </tr>
</table>
<!-- Иначе отображаем окошко указания месяца/года/счётчика для дальнейшего их извлечения -->
@else
<table class='Counters'>
    <form action="{{ route('showIndications') }}" method="POST" id="showIndiForm">
    @csrf
    <tr>
        <td colspan="2" class="title"> Просмотр показаний: </td>
    </tr>
    <tr>   
        <td> Месяц </td>
        <td>
            <select name="selectedMonth">
            @if($months)
                @foreach($months as $month)
                <option value=" {{ $month }} "> {{ $month }} </option>
                @endforeach
            @endif
            </select>
        </td>
    </tr>
    <tr>
        <td> Год </td>
        <td>
            <select name="selectedYear">
            @if($years)
                @foreach($years as $year)
                <option value=" {{ $year }} "> {{ $year }} </option>
                @endforeach
            @endif
            </select>
        </td>
    </tr>
    </form>

    <!-- По той же логике показываем или не показываем нужные кнопки -->
    @if(!session()->has('info'))
    <tr>
        <td colspan="2"> 
            <button form="showIndiForm" name="show" value="show" class="submit">
                Посмотреть
            </button> 
        </td>
    </tr>
    @endif
</table>

@endif