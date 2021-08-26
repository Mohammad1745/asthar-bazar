<?php


namespace App\Modules\Dashboard\Services;


use App\Http\Services\ResponseService;
use App\Modules\Dashboard\Repositories\CollectionItemRepository;
use App\Modules\Dashboard\Repositories\CollectionRepository;
use App\Modules\Dashboard\Repositories\DepartmentOwnershipRepository;
use App\Modules\Dashboard\Repositories\ProductVariationRepository;
use Illuminate\Support\Facades\Auth;

class DashboardService extends ResponseService
{
    private $departmentOwnershipRepository;
    private $collectionRepository;
    private $collectionItemRepository;
    private $productVariationRepository;

    public function __construct(
        DepartmentOwnershipRepository $departmentOwnershipRepository,
        CollectionRepository $collectionRepository,
        CollectionItemRepository $collectionItemRepository,
        ProductVariationRepository $productVariationRepository
    )
    {
        $this->departmentOwnershipRepository=$departmentOwnershipRepository;
        $this->collectionRepository=$collectionRepository;
        $this->collectionItemRepository=$collectionItemRepository;
        $this->productVariationRepository=$productVariationRepository;
    }

    /**
     * @return mixed
     */
    public function newCollectionDiscount()
    {
        $where = ['user_id' => Auth::user()->id];
        $departmentId = $this->departmentOwnershipRepository->whereFirst($where)->department_id;
        $where = [
            'title' => 'new',
            'department_id' => $departmentId
        ];

        return $this->collectionRepository->maxWhere($where, 'discount');
    }

    /**
     * @return mixed
     */
    public function randomProductVariations()
    {
        $where = [
            'product_variations.status' => true,
            'department_ownerships.user_id' => Auth::user()->id,
            'department_ownerships.status' => DEPARTMENT_ACTIVE_STATUS,
        ];
        $productVariations = $this->productVariationRepository->random($where, 12);
        foreach ($productVariations as $productVariation){
            $where = ['collection_items.product_variation_id' =>  $productVariation->id];
            $collectionItem = $this->collectionItemRepository->itemDetails($where);
            if(!empty($collectionItem)){
                $productVariation['collection_item'] = $collectionItem;
            }
        }

        return $productVariations;
    }
}

