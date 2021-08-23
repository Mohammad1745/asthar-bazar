<?php

namespace App\Modules\Collection\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Modules\Collection\Requests\StoreCollectionItemRequest;
use App\Modules\Collection\Requests\StoreCollectionRequest;
use App\Modules\Collection\Requests\UpdateCollectionItemRequest;
use App\Modules\Collection\Requests\UpdateCollectionRequest;
use App\Modules\Collection\Services\CollectionService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CollectionController extends Controller
{
    private $collectionService;

    /**
     * CollectionController constructor.
     * @param CollectionService $collectionService
     */
    public function __construct(CollectionService $collectionService)
    {
        $this->collectionService = $collectionService;
    }

    /**
     * @return Application|Factory|View
     */
    public function collection()
    {
        $data['base'] = 'dashboard';
        $data['menu'] = 'collection';
        $data['user'] = Auth::user();
        $data['collections'] = $this->collectionService->collections();

        return view('admin.collection.content', $data);
    }

    /**
     * @return mixed
     */
    public function collectionList()
    {
        return $this->collectionService->collectionListQuery();
    }

    /**
     * @param StoreCollectionRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(StoreCollectionRequest $request)
    {
        $response = $this->collectionService->store($request);

        return redirect(route('admin.collection'))->with($response['webResponse']);
    }

    /**
     * @param UpdateCollectionRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function update(UpdateCollectionRequest $request)
    {
        $response = $this->collectionService->update($request);

        return redirect(route('admin.collection'))->with($response['webResponse']);
    }

    /**
     * @param $encryptedCollectionId
     * @return Application|RedirectResponse|Redirector
     */
    public function delete($encryptedCollectionId)
    {
        $response = $this->collectionService->delete($encryptedCollectionId);

        return $response['success'] ?
            redirect(route('admin.collection'))->with($response['webResponse']):
            redirect()->back()->with($response['webResponse']);
    }

    /**
     * @param $encryptedCollectionId
     * @return Application|Factory|View
     */
    public function details($encryptedCollectionId)
    {
        $data['base'] = 'dashboard';
        $data['menu'] = 'collection';
        $data['user'] = Auth::user();
        $data['collection'] = $this->collectionService->collection($encryptedCollectionId);
        $data['productVariations'] = $this->collectionService->productVariations();

        return view('admin.collection.details', $data);
    }

    /**
     * @param $encryptedCollectionItemId
     * @return Application|Factory|View
     */
    public function itemDetails($encryptedCollectionItemId)
    {
        $data['base'] = 'dashboard';
        $data['menu'] = 'collection';
        $data['user'] = Auth::user();
        $data['collectionItem'] = $this->collectionService->collectionItem($encryptedCollectionItemId);
        $data['productVariations'] = $this->collectionService->productVariations();

        return view('admin.collection.item', $data);
    }

    /**
     * @param $encryptedCollectionId
     * @return array|JsonResponse|mixed
     */
    public function collectionItemList($encryptedCollectionId)
    {
        return $this->collectionService->collectionItemListQuery($encryptedCollectionId);
    }

    /**
     * @param $encryptedCollectionId
     * @return Application|RedirectResponse|Redirector
     */
    public function refreshItem($encryptedCollectionId)
    {
        $response = $this->collectionService->refreshItem($encryptedCollectionId);

        return $response['success'] ?
            redirect(route('admin.collection'))->with($response['webResponse']) :
            redirect()->back()->with($response['webResponse']);
    }

    /**
     * @param StoreCollectionItemRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function storeItem(StoreCollectionItemRequest $request)
    {
        $response = $this->collectionService->storeItem($request);

        return $response['success'] ?
            redirect(route('admin.collection.details', encrypt($response['data']['collection_id'])))->with($response['webResponse']) :
            redirect()->back()->with($response['webResponse']);
    }

    /**
     * @param UpdateCollectionItemRequest $request
     * @return RedirectResponse
     */
    public function updateItem(UpdateCollectionItemRequest $request)
    {
        $response = $this->collectionService->updateItem($request);

        return redirect()->back()->with($response['webResponse']);
    }

    /**
     * @param $encryptedCollectionItemId
     * @return Application|RedirectResponse|Redirector
     */
    public function deleteItem($encryptedCollectionItemId)
    {
        $response = $this->collectionService->deleteItem($encryptedCollectionItemId);

        return $response['success'] ?
            redirect(route('admin.collection'))->with($response['webResponse']):
            redirect()->back()->with($response['webResponse']);
    }
}
