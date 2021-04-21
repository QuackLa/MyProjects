<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CountersController extends Controller
{
    /**
     * Этот контроллер отвечает за работу со счётчиками
     * Информация о самих приборах и показаниям по ним за месяцы и годы
     * Информация о замене приборов
    */

    function __construct()
    {
        parent::__construct();
    }

    /**
     * Демонстрируем показания счётчиков за выбранный период
     */
    public function showIndications(Request $request)
    {
        return redirect()->back()->withInfo($this->indi->showIndi($request));
    }

    /**
     * Проверяем заполнение формы и добавляем показания в БД, если валидация пройдена
     */
    public function addIndications(Request $request)
    {
        $request->request->add(['user_id' => auth()->id()]);
        $this->validate($request, $this->indi->validateRules());
        $this->indi->fill($request->all())->save();
        $this->noticeLog(' добавил показания счётчика: '.$request->counter_id);

        return redirect()->route('home')->withMessage('Показания добавлены!');  
    }

    /**
     * Страница замены счётчиков
     */
    public function changeCounter()
    {
        return view('changeCounter', [
            'counters' => $this->counters->countersOfThisUser(),
            'location' => $this->counters->locationOfCounters(),
            'typeCounters' => $this->counters->typeOfCounters(),
        ]);
    }

    /**
     * Логика замены счётчиков
     */
    public function changeCounterDo(Request $request)
    {
        $this->validate($request, $this->counters->validateChangeCounter());
        $this->counters->fill($this->counters->addNewCounter($request))->save();
        $this->noticeLog(' произвёл замену счётчика: '.$request->old_serial.'. Новый счётчик-> '.$request->serial);

        return redirect()->route('home')->withMessage('Замена произведена!');
    }
}
