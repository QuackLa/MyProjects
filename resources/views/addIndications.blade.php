<!-- Форма внесения новых показаний счётчиков -->
<form action="{{ route('addIndications') }}" method="POST">
@csrf
    <table class='Counters'>
        <tr>
            <td colspan="2" class="title"> Добавить показания: </td>
        </tr>
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
            <td colspan="2"> <button type="submit" name="add" value="add" class="submit"> Добавить </button> </td>
        </tr>
    </table>
</form>