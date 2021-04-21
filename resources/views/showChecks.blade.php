@extends('layouts.app')

@section('content')
@if(!$errors->any() and !session()->has('message'))

    @if($filename and !$filename->isEmpty() and $folder)
    <form id="checks" action="{{ route('downloadCheck') }}" method="POST">
    @csrf
    <table class="showChecks">
        <tr>
            @foreach($filename as $value)
            <td>
                <a href="{{ $folder }}{{ $value->filename }}">
                    <img src="{{ $folder }}{{ $value->filename }}" alt="">
                </a>
                <div class="form_radio_btn">

                </div>
                <input id="radio-{{ $value->id }}" type="radio" name="filename" value="{{ $value->filename }}"> 
                <label for="radio-{{ $value->id }}"> </label>
            </td>
            @endforeach
        </tr>
    </table>
    </form>

    <div class="buttonsBlock">
        <div> <a href="{{ route('home') }}"> Назад </a> </div>
        <div> <button form="checks"> Скачать </button> </div>
    </div>

    @else
    
    <div class="errorNoChecks"> Нет файлов за выбранный месяц/год </div>

    @endif

@endif
@endsection