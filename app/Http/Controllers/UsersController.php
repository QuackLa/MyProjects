<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * Этот контроллер отвечает за работу с личными данными пользователей
     * В частности за отображение их личного кабинета, изменение этих данных
     */

    function __construct()
    {
        parent::__construct();
    }

    /**
     * Настройки аккаунта пользователя. Пункт в меню
     */
    public function account()
    {
        return view('account',[
            'user' => auth()->user(),
       ]);
    }

    /**
     * Логика редактирования данных аккаунта
     */
    public function editAccount(Request $request)
    {
        $this->validate($request, $this->users->dataValidate());
        $this->users::find(auth()->id())->update($this->users->changeData($request));
        $this->warningLog(' отредактировал свой аккаунт');
        
        return redirect()->route('account')->withMessage('Изменено!');
    }
}
