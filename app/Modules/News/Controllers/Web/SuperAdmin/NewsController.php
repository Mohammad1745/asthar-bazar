<?php

namespace App\Modules\News\Controllers\Web\SuperAdmin;

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
    private $newsService;

    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    /**
     * @return Application|Factory|View
     */
    public function news()
    {
        $data['base'] = 'account';
        $data['menu'] = 'news';
        $data['user'] = Auth::user();

        return view('super_admin.news.content', $data);
    }

    /**
     * @return mixed
     */
    public function newsList()
    {
        return $this->newsService->newsListQuery();
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
        $data['news'] = $this->newsService->details($encryptedNewsId);

        return view('super_admin.news.details', $data);
    }

    /**
     * @param StoreNewsRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(StoreNewsRequest $request)
    {
        $response = $this->newsService->store($request);

        return redirect(route('superAdmin.news'))->with($response['webResponse']);
    }

    /**
     * @param UpdateNewsRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function update(UpdateNewsRequest $request)
    {
        $response = $this->newsService->update($request);

        return redirect()->back()->with($response['webResponse']);
    }

    /**
     * @param $encryptedNewsId
     * @return Application|RedirectResponse|Redirector
     */
    public function delete($encryptedNewsId)
    {
        $response = $this->newsService->delete($encryptedNewsId);

        return $response['success'] ?
            redirect(route('superAdmin.news'))->with($response['webResponse']):
            redirect()->back()->with($response['webResponse']);
    }
}
