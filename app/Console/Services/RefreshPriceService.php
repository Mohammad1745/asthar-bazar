<?php


namespace App\Console\Services;

use App\Console\Repositories\CollectionItemRepository;
use App\Console\Repositories\ProductVariationRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RefreshPriceService
{
    /**
     * @var CollectionItemRepository
     */
    private $collectionItemRepository;
    /**
     * @var ProductVariationRepository
     */
    private $productVariationRepository;

    /**
     * RefreshPriceService constructor.
     * @param CollectionItemRepository $collectionItemRepository
     * @param ProductVariationRepository $productVariationRepository
     */
    public function __construct(
        CollectionItemRepository $collectionItemRepository,
        ProductVariationRepository $productVariationRepository
    )
    {
        $this->collectionItemRepository = $collectionItemRepository;
        $this->productVariationRepository = $productVariationRepository;
    }

    /**
     *
     */
    public function refreshPrice()
    {
        try {
            DB::beginTransaction();
            $productVariations = $this->productVariationRepository->getAll();
            foreach ($productVariations as $item){
                $where = ['product_variation_id' => $item->id];
                $collectionItem = $this->collectionItemRepository->whereLast($where);
                $where = ['id' => $item->id];
                if (empty($collectionItem)||strtotime(Carbon::now())>strtotime(new Carbon($collectionItem->expires_at))) {
                    $productVariationData = ['unit_price' => $item->regular_price];
                    $where = ['id' => $collectionItem->id];
                    $this->collectionItemRepository->deleteWhere($where);
                } else {
                    $unit_price = ($item->regular_price*(100-$collectionItem->discount))/100;
                    $productVariationData = ['unit_price' => $unit_price>$item->manufacturing_cost ? $unit_price : $item->manufacturing_cost];
                }
                $this->productVariationRepository->update($where, $productVariationData);
            }
            DB::commit();
        }catch (\Exception $exception){
            DB::rollback();
        }

    }
}
