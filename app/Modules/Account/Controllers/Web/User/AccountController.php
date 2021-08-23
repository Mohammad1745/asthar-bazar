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
    private $accountService;

    /**
     * AccountController constructor.
     * @param AccountService $accountService
     */
    public function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }

    /**
     * @return Application|Factory|View
     */
    public function account()
    {
        $data['base'] = 'account';
        $data['menu'] = 'account';
        $data['user'] = Auth::user();
        $data['profilePercentage'] = $this->accountService->profilePercentage();
        $data['wallet'] = $this->accountService->wallet();
        $data['referralUsersCount'] = $this->accountService->referralUsersCount();
        $data['orderCount'] = $this->accountService->orderCount();

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
        $data['referralCode'] = $this->accountService->referralCode();
        $data['referralUsersCount'] = $this->accountService->referralUsersCount();

        return view('user.account.referral', $data);
    }

    /**
     * @return Application|RedirectResponse|Redirector
     */
    public function generateReferralCode()
    {
        $response = $this->accountService->generateReferralCode();

        return $response['success'] ?
            redirect(route('account.referral'))->with($response['webResponse']) :
            redirect()->back()->with($response['webResponse']);
    }

    /**
     * @return Application|Factory|View
     */
    public function wallet()
    {
        $data['base'] = 'account';
        $data['menu'] = 'wallet';
        $data['user'] = Auth::user();
        $data['wallet'] = $this->accountService->wallet();
        $data['walletSubscriptions'] = $this->accountService->walletSubscriptions();

        return view('user.account.wallet', $data);
    }

    /**
     * @return array|JsonResponse|mixed
     */
    public function walletSubscriptionPackageList()
    {
        return $this->accountService->walletSubscriptionPackageListQuery();
    }

    /**
     * @param $encryptedWalletSubscriptionId
     * @return Application|RedirectResponse|Redirector
     */
    public function subscribePackage($encryptedWalletSubscriptionId)
    {
        $response = $this->accountService->subscribePackage($encryptedWalletSubscriptionId);

        return $response['success'] ?
            redirect(route('account.wallet'))->with($response['webResponse']) :
            redirect()->back()->with($response['webResponse']);
    }
}
