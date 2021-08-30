<?php

namespace App\Modules\News\Controllers\Web\Admin;

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
        $data['base'] = 'account';
        $data['menu'] = 'news';
        $data['user'] = Auth::user();

        return view('admin.news.content', $data);
    }

    /**
     * @return mixed
     */
    public function newsList()
    {
        return $this->service->newsListQuery();
    }

    /**
     * @param $encryptedNewsId
     * @return Application|Factory|View
     */
    public function details($encryptedNewsId)
    {
        $data['base'] = 'account';
        $data['menu'] = 'news';
        $data['user'] = Auth::user();
        $data['news'] = $this->service->details($encryptedNewsId);

        return view('admin.news.details', $data);
    }

    /**
     * @param StoreNewsRequest $request
     * @return RedirectResponse
     */
    public function store(StoreNewsRequest $request): RedirectResponse
    {
        return $this->webResponse($this->service->store($request), 'admin.news');
    }

    /**
     * @param UpdateNewsRequest $request
     * @return RedirectResponse
     */
    public function update(UpdateNewsRequest $request): RedirectResponse
    {
        return $this->webResponse($this->service->update($request), 'admin.news');
    }

    /**
     * @param string $encryptedNewsId
     * @return RedirectResponse
     */
    public function delete(string $encryptedNewsId): RedirectResponse
    {
        return $this->webResponse($this->service->delete($encryptedNewsId), 'admin.news');
    }
}
