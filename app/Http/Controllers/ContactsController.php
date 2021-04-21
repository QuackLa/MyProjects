<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactsController extends Controller
{
    /**
     * Контроллер отвечает за работу с контактами
     * Вывод, добавление, изменение контактов
     * Подбор идёт по городу и району зарегистрированного пользователя
     */

    function __construct()
    {
        parent::__construct();
    }

    /**
     * Открываем страничку со всеми контактами
     */
    public function showContacts()
    {
        return view('contacts', [
            'contacts' => $this->contacts->userContacts(),
        ]);
    }
}
