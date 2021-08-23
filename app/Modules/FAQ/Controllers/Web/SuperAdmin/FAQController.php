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
    private $faqService;

    /**
     * FAQController constructor.
     * @param FAQService $faqService
     */
    public function __construct(FAQService $faqService)
    {
        $this->faqService = $faqService;
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
     * @return Application|RedirectResponse|Redirector
     */
    public function update(UpdateFAQRequest $request)
    {
        $response = $this->faqService->saveSettings($request);

        return redirect(route('superAdmin.faq'))->with($response['webResponse']);
    }
}
