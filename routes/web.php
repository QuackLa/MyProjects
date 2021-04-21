<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CountersController;
use App\Http\Controllers\ChecksController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\LanguagesController;
use App\Http\Controllers\ThisUserAdminController;
use App\Http\Controllers\BankDetailsController;


/*
**Пускаем пользователей только после авторизации
*/

Route::group(
[
    'middleware' => 'auth'
]
, function()
{
    /**
     * Блок работы со счётчиками
     */
    // Вывод показаний счётчиков за указанный период. Get нужен на случай ошибки при валидации
    Route::post('/show', [CountersController::class, 'showIndications'])
        ->name('showIndications');
    // Обработчик добавления новых показаний
    Route::post('/addIntoBD', [CountersController::class, 'addIndications'])
        ->name('addIndications');
    // Обработчик изменения показаний счётчиков
    Route::post('/changeIndications', [ThisUserAdminController::class, 'changeIndications'])
        ->name('changeIndications');
    // Страница замены счётчиков
    Route::get('/changeCounter', [CountersController::class, 'changeCounter'])
        ->name('changeCounter');
    // Обработчик замены счётчиков
    Route::post('/changeCounterDo', [CountersController::class, 'changeCounterDo'])
        ->name('changeCounterDo');
    

    /**
     * Блок работы с чеками
     */
    // Добавляем фотку чека
    Route::post('/checkAdd', [ChecksController::class, 'checkAdd'])
        ->name('checkAdd');
    // Роут get нужен для отображения ошибок при нажатии клавиши 'скачать', когда файл не выбран
    Route::get('/checkShow', [ChecksController::class, 'checkShow'])
        ->name('checkShow');
    // Смотрим cписок чеков по дате и id пользователя.
    Route::post('/checkShow', [ChecksController::class, 'checkShow'])
        ->name('checkShow');
    // Скачиваем чек
    Route::post('/downloadCheck', [ChecksController::class, 'downloadCheck'])
        ->name('downloadCheck');


    /**
     * Блок администрирования пользователем своих данных
     */
    // Администрирование пользователем своих же данных
    Route::get('/myAdmin', [ThisUserAdminController::class, 'myAdmin'])
        ->name('myAdmin');
    // Добавление контактов
    Route::post('/addContact', [ThisUserAdminController::class, 'addContact'])
        ->name('addContact');
    // Добавление счётчика
    Route::post('/addCounter', [ThisUserAdminController::class, 'addCounter'])
        ->name('addCounter');
    // Редактирование счётчика
    Route::post('/editCounter', [ThisUserAdminController::class, 'editCounter'])
        ->name('editCounter');
    // Удаление счётчика
    Route::post('/deleteCounter', [ThisUserAdminController::class, 'deleteCounter'])
        ->name('deleteCounter');
    // Удаление чека
    Route::post('/deleteCheck', [ThisUserAdminController::class, 'deleteCheck'])
        ->name('deleteCheck');
    // Удаление контактов
    Route::post('/editContact', [ThisUserAdminController::class, 'editContact'])
        ->name('editContact');


    /**
     * Блок работы с контактами
     */
    // Показываем все контакты по городу и району пользователя
    Route::get('/contacts', [ContactsController::class, 'showContacts'])
        ->name('contacts');

    /**
     * Блок 'Как оплатить?'
     */
    Route::get('/howToPay',[BankDetailsController::class, 'howToPay'])
        ->name('howToPay');


    /**
     * Главная страница
     */
    Route::get('/', [HomeController::class, 'welcomeHome'])
        ->name('home');


    /**
     * Личный кабинет, работа с аккаунтом
     */
    // Отображение данных аккаунта
    Route::get('/account', [UsersController::class, 'account'])
        ->name('account');
    // Редактирование аккаунта
    Route::post('/editAccount', [UsersController::class, 'editAccount'])
        ->name('editAccount');


    /**
     * Выход из аккаунта
     */
    Route::get('/logout', [LoginController::class, 'logout'])
        ->name('logout');


    /**
     * Смена языка
     */
    Route::post('/language', [LanguagesController::class, 'changeLanguage'])
        ->name('changeLanguage');
});


// Роуты авторизации/регистрации
Auth::routes();