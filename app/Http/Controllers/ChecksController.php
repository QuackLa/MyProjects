<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\PdfToImage\Pdf;

class ChecksController extends Controller
{
    /**
    * Контроллер отвечает за работу с чеками на оплату. 
    * Добавление чеков и их просмотр
    */

    function __construct()
    {
        parent::__construct();
    }

    /**
     * Добавление чека в папку и инорфмации о файле в БД
     */
    public function checkAdd(Request $request)
    {
        $request->request->add(['user_id' => auth()->id()]);
        $this->validate($request, $this->checks->validateRules()); // Валидация формы
        $request->request->add(['filename' => $this->checks->addCheck($request->checkPhoto)]);
        $request->checkPhoto->storeAs('checks/user_'.auth()->id(), $request->filename); // Создаём файл
        $this->checks->fill($request->all())->save(); // В БД отправляем данные о чеке
        $this->noticeLog(' загрузил файл: /user_'.auth()->id().'/'.$request->filename); // Логирования действия
        
        return redirect()->back()->withMessage('Чек добавлен в базу');
    }

    /**
     * Просмотр чеков по месяцу и году. Разделять их по типам крайне проблематично ввиду того,
     * что услуги часто оплачиваются не отдельно и в разном сочитании
     */
    public function checkShow(Request $request)
    {
        return view('showChecks', [
            'folder' => '../storage/app/checks/user_'.auth()->id().'/',
            'filename' => $this->checks->findChecks($request->month, $request->year),
        ]);
    }

    /**
     * Скачиваем чек
     */
    public function downloadCheck(Request $request)
    {
        $this->validate($request, $this->checks->validFile());
        $this->noticeLog(' cкачал файл: /user_'.auth()->id().'/'.$request->filename);

        return response()->download(
            '../storage/app/checks/user_'.auth()->id().'/'.$request->filename,
            $request->filename
        );
    }
}
