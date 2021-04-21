<table class="Checks">
<form action="{{ route('checkShow') }}" method="POST">
@csrf
    <tr>
        <td colspan="2" class="title"> Просмотр чеков: </td>
    </tr>
    <tr>
        <td> Месяц </td>
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
        <td> Год </td>
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
        <td colspan="2"> <button type="submit" class="submit"> Посмотреть </button> </td>
    </tr>
</form>
</table>