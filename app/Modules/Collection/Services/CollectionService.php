<?php


namespace App\Modules\Collection\Services;


use App\Http\Services\ResponseService;
use App\Modules\Collection\Repositories\CollectionItemRepository;
use App\Modules\Collection\Repositories\CollectionRepository;
use App\Modules\Collection\Repositories\DepartmentOwnershipRepository;
use App\Modules\Collection\Repositories\DepartmentRepository;
use App\Modules\Collection\Repositories\ProductVariationRepository;
use App\Modules\Collection\Repositories\TypeRepository;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CollectionService extends ResponseService
{
    private $departmentRepository;
    private $departmentOwnershipRepository;
    private $typeRepository;
    private $productVariationRepository;
    private $collectionRepository;
    private $collectionItemRepository;

    /**
     * CollectionService constructor.
     * @param DepartmentRepository $departmentRepository
     * @param DepartmentOwnershipRepository $departmentOwnershipRepository
     * @param TypeRepository $typeRepository
     * @param ProductVariationRepository $productVariationRepository
     * @param CollectionRepository $collectionRepository
     * @param CollectionItemRepository $collectionItemRepository
     */
    public function __construct(
        DepartmentRepository $departmentRepository,
        DepartmentOwnershipRepository $departmentOwnershipRepository,
        TypeRepository $typeRepository,
        ProductVariationRepository $productVariationRepository,
        CollectionRepository $collectionRepository,
        CollectionItemRepository $collectionItemRepository
    )
    {
        $this->departmentRepository = $departmentRepository;
        $this->departmentOwnershipRepository = $departmentOwnershipRepository;
        $this->typeRepository = $typeRepository;
        $this->productVariationRepository = $productVariationRepository;
        $this->collectionRepository = $collectionRepository;
        $this->collectionItemRepository = $collectionItemRepository;
    }

    /**
     * @return mixed
     */
    public function collections()
    {
        $where = ['user_id' => Auth::user()->id];
        $departmentId = $this->departmentOwnershipRepository->whereFirst($where)->department_id;
        $where = ['department_id' => $departmentId];

        return $this->collectionRepository->getWhere($where);
    }

    /**
     * @param string $encryptedCollectionId
     * @return mixed
     */
    public function collection(string $encryptedCollectionId)
    {
        $where = ['id' => decrypt($encryptedCollectionId)];

        return $this->collectionRepository->whereFirst($where);
    }

    /**
     * @param string $encryptedCollectionItemId
     * @return mixed
     */
    public function collectionItem(string $encryptedCollectionItemId)
    {
        $where = ['collection_items.id' => decrypt($encryptedCollectionItemId)];

        return $this->collectionItemRepository->itemDetails($where);
    }

    /**
     * @return mixed
     */
    public function productVariations()
    {
        $where = ['user_id' => Auth::user()->id];
        $departmentId = $this->departmentOwnershipRepository->whereFirst($where)->department_id;
        $where = ['departments.id' => $departmentId];
        $itemVariationIds = $this->collectionItemRepository->pluckWhere([], 'product_variation_id');

        return $this->productVariationRepository->detailLists($where, $itemVariationIds);
    }

    /**
     * @param object $request
     * @return array
     */
    public function store(object $request): array
    {
        try{
            $where = ['user_id' => Auth::user()->id];
            $collectionData = $this->prepareCollectionData($request);
            $collectionData['department_id'] = $this->departmentOwnershipRepository->whereFirst($where)->department_id;
            $this->collectionRepository->create($collectionData);

            return $this->response()->success('Collection added successfully.');
        }catch (\Exception $exception){
            return  $this->response()->error($exception->getMessage());
        }
    }

    /**
     * @param object $request
     * @return array
     */
    public function update(object $request): array
    {
        try{
            $where = ['id' => $request->id];
            $collectionData = $this->prepareCollectionData($request);
            $this->collectionRepository->update($where, $collectionData);

            return $this->response()->success('Collection updated successfully.');
        }catch (\Exception $exception){
            return  $this->response()->error($exception->getMessage());
        }
    }

    /**
     * @param object $request
     * @return array
     */
    public function prepareCollectionData(object $request): array
    {
        return [
            'title' => $request->title,
            'discount' => $request->discount,
            'expires_at' => $request->expires_at,
        ];
    }

    /**
     * @param string $encryptedCollectionId
     * @return array
     */
    public function delete(string $encryptedCollectionId): array
    {
        try{
            $where = ['id' => decrypt($encryptedCollectionId)];
            $this->collectionRepository->deleteWhere($where);

            return $this->response()->success('Collection deleted successfully.');
        }catch (\Exception $exception){
            return  $this->response()->error($exception->getMessage());
        }
    }

    /**
     * @param string $encryptedCollectionId
     * @return array
     */
    public function refreshItem(string $encryptedCollectionId): array
    {
        try{
            DB::beginTransaction();
            $where = ['id' => decrypt($encryptedCollectionId)];
            $collection = $this->collectionRepository->whereLast($where);
            $where =  ['collection_id' => $collection->id];
            $this->collectionItemRepository->deleteWhere($where);
            $collectionItemData = $this->prepareNewCollectionItemData($this->productVariations(), $collection);
            foreach ($collectionItemData as $item){
                $this->collectionItemRepository->create($item);
            }
            DB::commit();

            return $this->response()->success('Collection Item has been added.');
        }catch (\Exception $exception){
            DB::rollBack();

            return  $this->response()->error($exception->getMessage());
        }
    }

    /**
     * @param $productVariations
     * @param $collection
     * @return array
     * @throws \Exception
     */
    public function prepareNewCollectionItemData($productVariations, $collection): array
    {
        $newCollectionItems = [];
        foreach ($productVariations as $productVariation){
            $where = ['id' => $productVariation->id];
            $productVariation = $this->productVariationRepository->whereLast($where);
            $unit_price = ($productVariation->regular_price*(100-$collection->discount))/100;
            $productVariationData = ['unit_price' => $unit_price>$productVariation['manufacturing_cost'] ? $unit_price : $productVariation['manufacturing_cost']];
            $this->productVariationRepository->update($where, $productVariationData);
            $date = new Carbon($productVariation->created_at);
            $item = [
                'collection_id' => $collection->id,
                'product_variation_id' => $productVariation->id,
                'discount' => $collection->discount,
                'expires_at' => dateOf($date->addDays(30)),
            ];
            if(date_diff(new Carbon($productVariation->created_at), Carbon::now())->days<30){
                array_push($newCollectionItems, $item);
            }
        }

        return $newCollectionItems;
    }

    /**
     * @param object $request
     * @return array
     */
    public function storeItem(object $request): array
    {
        try{
            DB::beginTransaction();
            $collectionItemData = $this->prepareCollectionItemData($request);
            $this->collectionItemRepository->create($collectionItemData);
            DB::commit();

            return $this->response($collectionItemData)->success('Collection Item has been added.');
        }catch (\Exception $exception){
            DB::rollBack();

            return  $this->response()->error($exception->getMessage());
        }
    }

    /**
     * @param object $request
     * @return array
     */
    public function updateItem(object $request): array
    {
        try{
            DB::beginTransaction();
            $where = ['id' => $request->id];
            $collectionItemData = $this->prepareCollectionItemData($request);
            $this->collectionItemRepository->update($where, $collectionItemData);
            DB::commit();

            return $this->response()->success('Collection Item has been updated.');
        }catch (\Exception $exception){
            DB::rollBack();

            return  $this->response()->error($exception->getMessage());
        }
    }

    /**
     * @param object $request
     * @return array
     */
    public function prepareCollectionItemData(object $request): array
    {
        $where = ['id' => $request->product_variation_id];
        $productVariation = $this->productVariationRepository->whereLast($where);
        $unit_price = ($productVariation->regular_price*(100-$request->discount))/100;
        $productVariationData = ['unit_price' => $unit_price>$productVariation['manufacturing_cost'] ? $unit_price : $productVariation['manufacturing_cost']];
        $this->productVariationRepository->update($where, $productVariationData);

        return [
            'collection_id' => $request->collection_id,
            'product_variation_id' => $request->product_variation_id,
            'discount' => $request->discount,
            'expires_at' => $request->expires_at,
        ];
    }

    /**
     * @param string $encryptedCollectionItemId
     * @return array
     */
    public function deleteItem(string $encryptedCollectionItemId): array
    {
        try{
            $where = ['id' => decrypt($encryptedCollectionItemId)];
            $this->collectionItemRepository->deleteWhere($where);

            return $this->response()->success('Collection Item has been deleted.');
        }catch (\Exception $exception){

            return  $this->response()->error($exception->getMessage());
        }
    }

    /**
     * @return array|JsonResponse|mixed
     */
    public function collectionListQuery() {
        $where = ['user_id' => Auth::user()->id];
        $departmentId = $this->departmentOwnershipRepository->whereFirst($where)->department_id;
        $where = ['department_id' => $departmentId];
        $collections = $this->collectionRepository->getWhereQuery($where);
        try {
            return datatables($collections)
                ->editColumn('title', function ($item) {
                    return ($item->title);
                })
                ->addColumn('items', function ($item) {
                    $where = ['collection_id' => $item->id];

                    return $this->collectionItemRepository->countWhere($where);
                })
                ->addColumn('actions', function ($item) {
                    $generatedData = '<ul class="d-flex justify-content-center activity-menus mb-0">';

                    $generatedData .= '<a class="text-primary" href="';
                    $generatedData .= route('admin.collection.details', encrypt($item->id));
                    $generatedData .= '" data-toggle="tooltip" title="Open">';
                    $generatedData .= '<i class="fa fa-eye"></i>';
                    $generatedData .= '</a>';
                    $generatedData .= '</ul>';

                    return $generatedData;
                })
                ->rawColumns(['actions'])
                ->make(true);
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * @param $encryptedCollectionId
     * @return array|JsonResponse|mixed
     */
    public function collectionItemListQuery($encryptedCollectionId) {
        $where = ['collection_items.collection_id' => decrypt($encryptedCollectionId)];
        $collectionItems = $this->collectionItemRepository->collectionItemsQuery($where);
        try {
            return datatables($collectionItems)
                ->editColumn('title', function ($item) {
                    return $item->product_title.' '.$item->title.' ('.$item->type_title.')';
                })
                ->editColumn('regular_price', function ($item) {
                    return '৳'.$item->regular_price;
                })
                ->editColumn('discount', function ($item) {
                    return $item->discount.'%';
                })
                ->editColumn('net_price', function ($item) {
                    return '৳'.$item->unit_price;
                })
                ->editColumn('expires_at', function ($item) {
                    return $item->expires_at;
                })
                ->addColumn('actions', function ($item) {
                    $generatedData = '<ul class="d-flex justify-content-center activity-menus mb-0">';
                    $generatedData .= '<li><a class="text-primary" href="';
                    $generatedData .= route('admin.collection.itemDetails', encrypt($item->id));
                    $generatedData .= '" data-toggle="tooltip" title="Open">';
                    $generatedData .= '<i class="fa fa-eye"></i>';
                    $generatedData .= '</a></li>';
                    $generatedData .= '</ul>';

                    return $generatedData;
                })
                ->rawColumns(['actions'])
                ->make(true);
        } catch (\Exception $e) {
            return [];
        }
    }
}
