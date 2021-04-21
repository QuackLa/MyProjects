@extends('layouts.app')

@section('content')

<!-- Сообщение о поверке/замене счётчика -->
@include('verificationOrEndofServiceAlarm')

<table class='content'>
<tr>
    <td>

        <!-- Добавление чеков -->
        @include('addChecks')

    </td>
    <td>

        <!-- Добавление показаний счётчиков -->
        @include('addIndications')

    </td>
</tr>
<tr>
    <td>

        <!-- Добавление чеков -->
        @include('lookChecks')

    </td>
    <td>

        <!-- Просмотр показаний счётчиков -->
        @include('lookIndications')

    </td>
</tr>
</table>

@endsection