<?php


namespace App\Modules\Type\Services;


use App\Modules\Type\Repositories\TypeRepository;
use App\Modules\Type\Repositories\DepartmentOwnershipRepository;
use App\Modules\Type\Repositories\ProductVariationRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class TypeService
{
    private $errorMessage;
    private $errorResponse;
    private $departmentOwnershipRepository;
    private $typeRepository;
    private $productVariationRepository;

    /**
     * TypeRepository constructor.
     * @param DepartmentOwnershipRepository $departmentOwnershipRepository
     * @param TypeRepository $typeRepository
     * @param ProductVariationRepository $productVariationRepository
     */
    public function __construct(DepartmentOwnershipRepository $departmentOwnershipRepository, TypeRepository $typeRepository, ProductVariationRepository $productVariationRepository)
    {
        $this->departmentOwnershipRepository = $departmentOwnershipRepository;
        $this->typeRepository = $typeRepository;
        $this->productVariationRepository = $productVariationRepository;
        $this->errorMessage = __('Something went wrong');
        $this->errorResponse = [
            'success' => false,
            'message' => $this->errorMessage,
            'data' => [],
            'webResponse' => [
                'dismiss' => $this->errorMessage,
            ],
        ];
    }

    /**
     * @param $encryptedTypeId
     * @return mixed
     */
    public function details($encryptedTypeId)
    {
        $where = ['id' => decrypt($encryptedTypeId)];

        return $this->typeRepository->whereLast($where);
    }

    /**
     * @param $request
     * @return mixed
     */
    public function store($request) {
        try{
            $where = ['user_id' => Auth::user()->id];
            $departmentOwnership = $this->departmentOwnershipRepository->whereLast($where);
            $typeData = $this->prepareTypeData($departmentOwnership->department_id, $request);
            $this->typeRepository->create($typeData);

            return [
                'success' => true,
                'message' => __('Type has been added.'),
                'webResponse' => [
                    'success' => __('Type has been added.')
                ],
            ];
        }catch (\Exception $exception){
            return $this->errorResponse;
        }
    }

    /**
     * @param $departmentId
     * @param $request
     * @return array
     */
    private function prepareTypeData($departmentId, $request)
    {
        return [
            'title' => $request->title,
            'department_id' => $departmentId,
            'description' => $request->description,
        ];
    }

    /**
     * @param $request
     * @return mixed
     */
    public function update($request) {
        try{
            $where = ['user_id' => Auth::user()->id];
            $departmentOwnership = $this->departmentOwnershipRepository->whereLast($where);
            $where = ['id' => $request->id];
            $typeData = $this->prepareUpdatedTypeData($departmentOwnership->department_id, $request);
            $this->typeRepository->update($where, $typeData);

            return [
                'success' => true,
                'message' => __('Type has been updated.'),
                'webResponse' => [
                    'success' => __('Type has been updated.')
                ],
            ];
        }catch (\Exception $exception){
            return $this->errorResponse;
        }
    }

    /**
     * @param $departmentId
     * @param $request
     * @return array
     */
    private function prepareUpdatedTypeData($departmentId, $request)
    {
        return [
            'title' => $request->title,
            'department_id' => $departmentId,
            'description' => $request->description,
        ];
    }

    /**
     * @param $encryptedTypeId
     * @return array
     */
    public function delete($encryptedTypeId)
    {
        try{
            $where = ['id' => decrypt($encryptedTypeId)];
            $this->typeRepository->deleteWhere($where);

            return [
                'success' => true,
                'message' => 'Type has been deleted.',
                'data' => [],
                'webResponse' => [
                    'success' => 'Type has been deleted.'
                ],
            ];
        }catch (\Exception $e){
            return $this->errorResponse;
        }
    }

    /**
     * @return array|JsonResponse|mixed
     */
    public function typeListQuery() {
        $where = ['user_id' => Auth::user()->id];
        $departmentId =  $this->departmentOwnershipRepository->whereLast($where)->department_id;
        $where = ['department_id' => $departmentId];
        $types = $this->typeRepository->getWhereQuery($where);
        try {
            return datatables($types)
                ->editColumn('title', function ($item) {
                    return $item->title;
                })
                ->editColumn('product_variations', function ($item) {
                    $where = ['type_id' => $item->id];

                    return $this->productVariationRepository->countWhere($where);
                })
                ->editColumn('description', function ($item) {
                    return (strlen($item->description)>50) ? substr($item->description, 0, 50) . '...' : $item->description;
                })
                ->addColumn('actions', function ($item) {
                    $generatedData = '<ul class="d-flex justify-content-center activity-menus mb-0">';

                    $generatedData .= '<a class="text-primary" href="';
                    $generatedData .= route('admin.type.details', encrypt($item->id));
                    $generatedData .= '" data-toggle="tooltip" title="Edit">';
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
}
