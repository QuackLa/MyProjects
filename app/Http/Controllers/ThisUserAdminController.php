<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ThisUserAdminController extends Controller
{
    /**
     * Контроллер отвечает за администрирование данных конкретного пользователя
     * Добавление/изменение/удаление именно его счётчиков, чеков
     */

    function __construct()
    {
        parent::__construct();
    }

    /**
     * Страница локального админа
     */
    public function myAdmin()
    {
        $select = $this->indi->whereUser_id(auth()->id());

        return view('administration', [
            'counters' => $this->counters->countersOfThisUser(),
            'checks' => $this->checks->whereUser_id(auth()->id())->get(),
            'contacts' => $this->contacts->userContacts(),
            'result' => $select->get(),
            'year' => $select->groupBy('year')->get(),
            'counter_id' => $select->groupBy('counter_id')->get(),
        ]);
    }


    // Блок контактов

    /**
     * Добавление контактов
     */
    public function addContact(Request $request)
    {
        $request->request->add(['city' => auth()->user()->city, 'district' => auth()->user()->district]);
        $this->validate($request, $this->thisAdmin->addContactValidate());
        $this->contacts->fill($request->all())->save();
        $this->warningLog(' добавил новый контакт');

        return redirect()->route('myAdmin')->withMessage('Контакт добавлен!!');
    }

    /**
     * Редактирование контактов
     */
    public function editContact(Request $request)
    {
        $this->validate($request, $this->thisAdmin->editContactValidate());
        $this->contacts::find($request->contact)->update($this->contacts->editContact($request));
        $this->warningLog(' отредактировал контакт '.$request->contact);

        return redirect()->route('myAdmin')->withMessage('Контакт изменён!!');
    }


    // Блок счётчиков

    /**
     * Добавление счётчика
     */
    public function addCounter(Request $request)
    {
        $this->validate($request, $this->thisAdmin->addCounterValidate());
        $this->counters->fill($this->counters->addNewCounter($request))->save();
        $this->warningLog(' добавил новый счётчик '.$request->counter_id);

        return redirect()->route('myAdmin')->withMessage('Счётчик добавлен!!');
    }

    /**
     * Редактирование счётчика
     */
    public function editCounter(Request $request)
    {
        $this->validate($request, $this->thisAdmin->editCounterValidate());
        $this->counters::find($request->counter_id)->update($this->counters->addNewCounter($request));
        $this->warningLog(' отредактировал счётчик '.$request->counter_id);

        return redirect()->route('myAdmin')->withMessage('Данные прибора изменены!!');
    }

    /**
     * Удаление счётчика
     */
    public function deleteCounter(Request $request)
    {
        $this->validate($request, $this->thisAdmin->deleteCounterValidate());
        $this->counters::find($request->counter_id)->delete();
        $this->warningLog(' удалил счётчик: '.$request->counter_id);

        return redirect()->route('myAdmin')->withMessage('Счётчик удалён!!');
    }


    // Блок Чеков

    /**
     * Удаление чека
     */
    public function deleteCheck(Request $request)
    {
        \Storage::delete('checks/user_'.auth()->id().'/'.$request->filename); // Удаление файла
        $this->checks::whereFilename($request->filename)->delete(); // Удаление записи о нём из БД
        $this->warningLog(' удалил чек: '.'checks/user_'.auth()->id().'/'.$request->filename);

        return redirect()->route('myAdmin')->withMessage('Чек удалён!!');
    }

    
    // Блок показаний

    /**
     * Редактирование показаний
     */
    public function changeIndications(Request $request)
    {
        $request->request->add(['user_id' => auth()->id()]);
        $this->validate($request, $this->indi->validateRules());
        $this->indi->editIndi($request);
        $this->warningLog(' изменил показания счётчика: '.$request->counter_id);

        return redirect()->back()->withMessage('Показания изменены!');
    }
}
