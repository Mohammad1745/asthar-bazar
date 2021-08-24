<?php

namespace App\Modules\Account\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Modules\Account\Services\AccountService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AccountController extends Controller
{
    private $service;

    /**
     * AccountController constructor.
     * @param AccountService $service
     */
    public function __construct(AccountService $service)
    {
        $this->service = $service;
    }

    /**
     * @return Application|Factory|View
     */
    public function account()
    {
        $data['base'] = 'account';
        $data['menu'] = 'account';
        $data['user'] = Auth::user();
        $data['profilePercentage'] = $this->service->profilePercentage();
        $data['wallet'] = $this->service->wallet();
        $data['referralUsersCount'] = $this->service->referralUsersCount();
        $data['orderCount'] = $this->service->orderCount();

        return view('user.account.content', $data);
    }

    /**
     * @return Application|Factory|View
     */
    public function referral()
    {
        $data['base'] = 'account';
        $data['menu'] = 'referral';
        $data['user'] = Auth::user();
        $data['referralCode'] = $this->service->referralCode();
        $data['referralUsersCount'] = $this->service->referralUsersCount();

        return view('user.account.referral', $data);
    }

    /**
     * @return RedirectResponse
     */
    public function generateReferralCode(): RedirectResponse
    {
        return $this->webResponse($this->service->generateReferralCode(), 'account.referral');
    }

    /**
     * @return Application|Factory|View
     */
    public function wallet()
    {
        $data['base'] = 'account';
        $data['menu'] = 'wallet';
        $data['user'] = Auth::user();
        $data['wallet'] = $this->service->wallet();
        $data['walletSubscriptions'] = $this->service->walletSubscriptions();

        return view('user.account.wallet', $data);
    }

    /**
     * @return array|JsonResponse|mixed
     */
    public function walletSubscriptionPackageList()
    {
        return $this->service->walletSubscriptionPackageListQuery();
    }

    /**
     * @param $encryptedWalletSubscriptionId
     * @return RedirectResponse
     */
    public function subscribePackage($encryptedWalletSubscriptionId): RedirectResponse
    {
        return $this->webResponse($this->service->subscribePackage($encryptedWalletSubscriptionId), 'account.wallet');
    }
}
