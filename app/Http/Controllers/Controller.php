<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Checks;
use App\Models\AccountNumbers;
use App\Models\Contacts;
use App\Models\Indications;
use App\Models\Counters;
use App\Models\ThisUserAdmin;
use App\Models\User;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // Свойство для модели Indications
    protected $indi;
    // Свойство для модели Counters
    protected $counters;
    // Свойство для модели Contacts
    protected $contacts;
    // Свойство для модели лицевых счетов пользователя
    protected $account_numbers;
    // Свойство для модели ThisUserAdmin
    protected $thisAdmin;
    // Свойство для модели Checks
    protected $checks;
    // Свойство для модели User
    protected $users;

    function __construct()
    {
        $this->indi = new Indications();
        $this->counters = new Counters();
        $this->contacts = new Contacts();
        $this->account_numbers = new Accountnumbers();
        $this->thisAdmin = new ThisUserAdmin();
        $this->checks = new Checks();
        $this->users = new User();
    }

    /**
     * Предупредительная запись в лог
     */
    public function warningLog($string)
    {
        \Log::warning(auth()->user()->login.$string);
    }

    /**
     * Уведомительная запись в лог
     */
    public function noticeLog($string)
    {
        \Log::notice(auth()->user()->login.$string);
    }

}
