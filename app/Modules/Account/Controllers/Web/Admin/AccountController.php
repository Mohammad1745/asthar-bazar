<?php

namespace App\Modules\Account\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Modules\Account\Services\AccountService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AccountController extends Controller
{
    private $accountRepository;

    /**
     * AccountController constructor.account.php
     * @param AccountService $accountRepository
     */
    public function __construct(AccountService $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }

    /**
     * @return Application|Factory|View
     */
    public function account()
    {
        $data['base'] = 'account';
        $data['menu'] = 'account';
        $data['user'] = Auth::user();
        $data['profilePercentage'] = $this->accountRepository->profilePercentage();
        $data['revenue'] = $this->accountRepository->departmentRevenue();

        return view('admin.account.content', $data);
    }

    /**
     * @return Application|Factory|View
     */
    public function transactions()
    {
        $data['base'] = 'account';
        $data['menu'] = 'transactions';
        $data['user'] = Auth::user();
        $data['transactions'] = $this->accountRepository->departmentTransactions();

        return view('admin.account.transactions', $data);
    }
}
