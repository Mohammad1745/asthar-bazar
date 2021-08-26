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
    private $service;

    /**
     * CollectionController constructor.
     * @param CollectionService $service
     */
    public function __construct (CollectionService $service)
    {
        $this->service = $service;
    }

    /**
     * @return Application|Factory|View
     */
    public function collection ()
    {
        $data['base'] = 'dashboard';
        $data['menu'] = 'collection';
        $data['user'] = Auth::user();
        $data['collections'] = $this->service->collections();

        return view('admin.collection.content', $data);
    }

    /**
     * @return array|JsonResponse|mixed
     */
    public function collectionList ()
    {
        return $this->service->collectionListQuery();
    }

    /**
     * @param StoreCollectionRequest $request
     * @return RedirectResponse
     */
    public function store (StoreCollectionRequest $request): RedirectResponse
    {
        return $this->webResponse( $this->service->store($request),'admin.collection');
    }

    /**
     * @param UpdateCollectionRequest $request
     * @return RedirectResponse
     */
    public function update (UpdateCollectionRequest $request): RedirectResponse
    {
        return $this->webResponse( $this->service->update($request),'admin.collection');
    }

    /**
     * @param $encryptedCollectionId
     * @return RedirectResponse
     */
    public function delete ($encryptedCollectionId): RedirectResponse
    {
        return $this->webResponse( $this->service->delete($encryptedCollectionId),'admin.collection');
    }

    /**
     * @param $encryptedCollectionId
     * @return Application|Factory|View
     */
    public function details ($encryptedCollectionId)
    {
        $data['base'] = 'dashboard';
        $data['menu'] = 'collection';
        $data['user'] = Auth::user();
        $data['collection'] = $this->service->collection($encryptedCollectionId);
        $data['productVariations'] = $this->service->productVariations();

        return view('admin.collection.details', $data);
    }

    /**
     * @param $encryptedCollectionItemId
     * @return Application|Factory|View
     */
    public function itemDetails ($encryptedCollectionItemId)
    {
        $data['base'] = 'dashboard';
        $data['menu'] = 'collection';
        $data['user'] = Auth::user();
        $data['collectionItem'] = $this->service->collectionItem($encryptedCollectionItemId);
        $data['productVariations'] = $this->service->productVariations();

        return view('admin.collection.item', $data);
    }

    /**
     * @param $encryptedCollectionId
     * @return array|JsonResponse|mixed
     */
    public function collectionItemList ($encryptedCollectionId)
    {
        return $this->service->collectionItemListQuery($encryptedCollectionId);
    }

    /**
     * @param $encryptedCollectionId
     * @return RedirectResponse
     */
    public function refreshItem ($encryptedCollectionId): RedirectResponse
    {
        return $this->webResponse( $this->service->refreshItem($encryptedCollectionId),'admin.collection');
    }

    /**
     * @param StoreCollectionItemRequest $request
     * @return RedirectResponse
     */
    public function storeItem(StoreCollectionItemRequest $request): RedirectResponse
    {
        return $this->webResponse( $this->service->storeItem($request),'admin.collection');
    }

    /**
     * @param UpdateCollectionItemRequest $request
     * @return RedirectResponse
     */
    public function updateItem(UpdateCollectionItemRequest $request): RedirectResponse
    {
        return $this->webResponse( $this->service->updateItem($request));
    }

    /**
     * @param $encryptedCollectionItemId
     * @return RedirectResponse
     */
    public function deleteItem($encryptedCollectionItemId): RedirectResponse
    {
        return $this->webResponse( $this->service->deleteItem($encryptedCollectionItemId),'admin.collection');
    }
}
