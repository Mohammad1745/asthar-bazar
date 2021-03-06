<?php

namespace App\Modules\FAQ\Controllers\Web\Admin;


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
     * @param $faq
     * @return Application|Factory|View
     */
    public function faq($faq)
    {
        $data['menu'] = 'faq';
        $data['user'] = Auth::user();
        $data['faq_title'] = ucwords(str_replace('_', ' ', $faq));
        $data['faq'] = faq($faq);
        $data['faqBn'] = faq($faq.'_bn');

        return view('admin.faq.content', $data);
    }
}
