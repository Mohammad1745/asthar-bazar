<?php

namespace App\Modules\News\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Modules\News\Requests\StoreNewsRequest;
use App\Modules\News\Requests\UpdateNewsRequest;
use App\Modules\News\Services\NewsService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class NewsController extends Controller
{
    private $service;

    public function __construct(NewsService $service)
    {
        $this->service = $service;
    }

    /**
     * @return Application|Factory|View
     */
    public function news()
    {
        $data['base'] = 'home';
        $data['menu'] = 'news';
        $data['user'] = Auth::user();
        $data['allNews'] = $this->service->allNews();

        return view('user.news.details', $data);
    }
}
