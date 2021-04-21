<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguagesController extends Controller
{
     /**
     * Метод смены языка сайта
     */
    public function changeLanguage(Request $request)
    {
        // Основную работу выполняет мидрвэр на основе содержимого сессии
        $lang = $request->language; // Получаем через форму от пользователя желаемый язык
        session()->put('language', $lang); // Засовываем это в сессию
        return redirect()->back(); // Пересылаем пользователя обратно, откуда пришёл
    }
}
