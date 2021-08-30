<?php

namespace App\Modules\FAQ\Controllers\Web\SuperAdmin;


use App\Http\Controllers\Controller;
use App\Modules\FAQ\Requests\UpdateFAQRequest;
use App\Modules\FAQ\Services\FAQService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class FAQController extends Controller
{
    private $service;

    /**
     * FAQController constructor.
     * @param FAQService $service
     */
    public function __construct(FAQService $service)
    {
        $this->service = $service;
    }

    /**
     * @return Application|Factory|View
     */
    public function faq()
    {
        $data['base'] = 'dashboard';
        $data['menu'] = 'faq';
        $data['user'] = Auth::user();
        $data['faq'] = faq();

        return view('super_admin.faq.content', $data);
    }

    /**
     * @param UpdateFAQRequest $request
     * @return RedirectResponse
     */
    public function update(UpdateFAQRequest $request): RedirectResponse
    {
        return $this->webResponse($this->service->saveSettings($request), 'superAdmin.faq');
    }
}
