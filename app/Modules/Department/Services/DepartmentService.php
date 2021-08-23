<?php


namespace App\Modules\Department\Services;


use App\Modules\Department\Repositories\CategoryRepository;
use App\Modules\Department\Repositories\CollectionRepository;
use App\Modules\Department\Repositories\DepartmentOwnershipRepository;
use App\Modules\Department\Repositories\DepartmentRepository;
use App\Modules\Department\Repositories\DepartmentTransactionRepository;
use App\Modules\Department\Repositories\OrderRepository;
use App\Modules\Department\Repositories\ProductRepository;
use App\Modules\Department\Repositories\ProductVariationRepository;
use App\Modules\Department\Repositories\SaleRecordRepository;
use App\Modules\Department\Repositories\TypeRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DepartmentService
{
    private $errorMessage;
    private $errorResponse;
    private $departmentRepository;
    private $departmentOwnershipRepository;
    private $departmentTransactionRepository;
    private $saleRecordRepository;
    private $collectionRepository;
    private $orderRepository;
    private $typeRepository;
    private $categoryRepository;
    private $productRepository;
    private $productVariationRepository;

    /**
     * DepartmentService constructor.
     * @param DepartmentRepository $departmentRepository
     * @param DepartmentOwnershipRepository $departmentOwnershipRepository
     * @param DepartmentTransactionRepository $departmentTransactionRepository
     * @param SaleRecordRepository $saleRecordRepository
     * @param CollectionRepository $collectionRepository
     * @param TypeRepository $typeRepository
     * @param CategoryRepository $categoryRepository
     * @param ProductRepository $productRepository
     * @param ProductVariationRepository $productVariationRepository
     * @param OrderRepository $orderRepository
     */
    public function __construct(
        DepartmentRepository $departmentRepository,
        DepartmentOwnershipRepository $departmentOwnershipRepository,
        DepartmentTransactionRepository $departmentTransactionRepository,
        SaleRecordRepository $saleRecordRepository,
        CollectionRepository $collectionRepository,
        TypeRepository $typeRepository,
        CategoryRepository $categoryRepository,
        ProductRepository $productRepository,
        ProductVariationRepository $productVariationRepository,
        OrderRepository $orderRepository
    )
    {
        $this->departmentRepository = $departmentRepository;
        $this->departmentOwnershipRepository = $departmentOwnershipRepository;
        $this->departmentTransactionRepository = $departmentTransactionRepository;
        $this->saleRecordRepository = $saleRecordRepository;
        $this->collectionRepository = $collectionRepository;
        $this->orderRepository = $orderRepository;
        $this->typeRepository = $typeRepository;
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
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
     * @return mixed
     */
    public function department()
    {
        $where = ['user_id' => Auth::user()->id];
        $departmentId = $this->departmentOwnershipRepository->whereFirst($where)->department_id;
        $where = ['id' => $departmentId];

        return $this->departmentRepository->whereFirst($where);
    }

    /**
     * @return mixed
     */
    public function typeCount()
    {
        $where = ['user_id' => Auth::user()->id];
        $departmentId = $this->departmentOwnershipRepository->whereFirst($where)->department_id;
        $where = ['department_id' => $departmentId];

        return $this->typeRepository->countWhere($where);
    }

    /**
     * @return mixed
     */
    public function categoryCount()
    {
        $where = ['user_id' => Auth::user()->id];
        $departmentId = $this->departmentOwnershipRepository->whereFirst($where)->department_id;
        $where = ['department_id' => $departmentId];

        return $this->categoryRepository->countWhere($where);
    }

    /**
     * @return mixed
     */
    public function productCount()
    {
        $where = ['user_id' => Auth::user()->id];
        $departmentId = $this->departmentOwnershipRepository->whereFirst($where)->department_id;
        $where = ['department_id' => $departmentId];
        $categoryIds = $this->categoryRepository->pluckWhere($where, 'id');

        return $this->productRepository->countWhereIn('category_id', $categoryIds);
    }

    /**
     * @return mixed
     */
    public function productVariationCount()
    {
        $where = ['user_id' => Auth::user()->id];
        $departmentId = $this->departmentOwnershipRepository->whereFirst($where)->department_id;
        $where = ['department_id' => $departmentId];
        $typeIds = $this->typeRepository->pluckWhere($where, 'id');

        return $this->productVariationRepository->countWhereIn('type_id', $typeIds);
    }

    /**
     * @return mixed
     */
    public function saleRecordCount()
    {
        $where = ['user_id' => Auth::user()->id];
        $departmentId = $this->departmentOwnershipRepository->whereFirst($where)->department_id;
        $where = ['department_id' => $departmentId];

        return $this->saleRecordRepository->sumWhere($where, 'quantity');
    }

    /**
     * @return mixed
     */
    public function freshAdmins()
    {
        return $this->departmentOwnershipRepository->getFreshAdmins();
    }

    /**
     * @param $encryptedDepartmentId
     * @return mixed
     */
    public function details($encryptedDepartmentId)
    {
        $where = ['departments.id' => decrypt($encryptedDepartmentId)];
        $department = $this->departmentRepository->details($where);
        $where = [
            'department_id' => $department->id,
            'status' => true
        ];
        $department['revenue'] = $this->departmentTransactionRepository->sumWhere($where, 'revenue');
        $department['revenue_from_wallet'] = $this->departmentTransactionRepository->sumWhere($where, 'revenue_from_wallet');
        $department['manufacturing_cost'] = $this->departmentTransactionRepository->sumWhere($where, 'manufacturing_cost');
        $department['profit'] = $this->departmentTransactionRepository->sumWhere($where, 'profit');
        $department['customer_reward'] = $this->departmentTransactionRepository->sumWhere($where, 'customer_reward');
        $department['net_profit'] = $this->departmentTransactionRepository->sumWhere($where, 'net_profit');
        $firstTransaction = $this->departmentTransactionRepository->whereFirst($where);
        if(empty($firstTransaction)){
            $department['started_at'] = dateOf();
        }else{
            $department['started_at'] = dateOf($firstTransaction->created_at);
        }
        $where = ['department_id' => $department->id];
        $department['collection_count'] = $this->collectionRepository->countWhere($where);
        $department['type_count'] = $this->typeRepository->countWhere($where);
        $department['category_count'] = $this->categoryRepository->countWhere($where);
        $department['sale_record_count'] = $this->saleRecordRepository->sumWhere($where, 'quantity');
        $categoryIds = $this->categoryRepository->pluckWhere($where, 'id');
        $department['product_count'] = $this->productRepository->countWhereIn('category_id', $categoryIds);
        $typeIds = $this->typeRepository->pluckWhere($where, 'id');
        $department['product_variation_count'] = $this->productVariationRepository->countWhereIn('type_id', $typeIds);

         return $department;
    }

    /**
     * @param $request
     * @return array
     */
    public function store($request) {
        try{
            DB::beginTransaction();
            $departmentData = $this->prepareDepartmentData($request);
            $department = $this->departmentRepository->create($departmentData);
            $departmentOwnershipData = $this->prepareDepartmentOwnershipData($department, $request);
            $this->departmentOwnershipRepository->create($departmentOwnershipData);
            $collectionData = $this->prepareCollectionData($department);
            $this->collectionRepository->create($collectionData);
            DB::commit();

            return [
                'success' => true,
                'message' => __('Department has been added.'),
                'data' => $department,
                'webResponse' => [
                    'success' => __('Department has been added.')
                ],
            ];
        }catch (\Exception $exception){
            DB::rollBack();

            return $this->errorResponse;
        }
    }

    /**
     * @param $department
     * @return array
     */
    private function prepareCollectionData($department)
    {
        return [
            'title' => 'new',
            'department_id' => $department->id,
            'discount' => 5,
            'expires_at' => '2022-09-01',
        ];
    }

    /**
     * @param $request
     * @return array
     */
    public function update($request) {
        try{
            DB::beginTransaction();
            $where = ['id' => $request->id];
            $departmentData = $this->prepareDepartmentData($request);
            $this->departmentRepository->update($where, $departmentData);
            $department = $this->departmentRepository->whereFirst($where);
            $where = ['department_id' => $department->id];
            $departmentOwnershipData = $this->prepareDepartmentOwnershipData($department, $request);
            $this->departmentOwnershipRepository->update($where, $departmentOwnershipData);
            DB::commit();

            return [
                'success' => true,
                'message' => __('Department has been updated.'),
                'data' => $department,
                'webResponse' => [
                    'success' => __('Department has been updated.')
                ],
            ];
        }catch (\Exception $exception){
            DB::rollBack();

            return $this->errorResponse;
        }
    }

    /**
     * @param $request
     * @return array
     */
    private function prepareDepartmentData($request)
    {
        return [
            'title' => $request->title,
            'cover_photo' => 'null',
            'description' => $request->description,
        ];
    }

    /**
     * @param $department
     * @param $request
     * @return array
     */
    private function prepareDepartmentOwnershipData($department, $request)
    {
        return [
            'user_id' => $request->owner_id,
            'department_id' => $department->id,
            'status' => DEPARTMENT_UPCOMING_STATUS,
        ];
    }

    /**
     * @param $encryptedDepartmentId
     * @return array
     */
    public function activate($encryptedDepartmentId)
    {
        try{
            $where = ['department_id' => decrypt($encryptedDepartmentId)];
            $data = ['status' => DEPARTMENT_ACTIVE_STATUS];
            $this->departmentOwnershipRepository->update($where, $data);

            return [
                'success' => true,
                'message' => 'Department has been activated.',
                'data' => [],
                'webResponse' => [
                    'success' => 'Department has been activated.'
                ],
            ];
        }catch (\Exception $e){
            return $this->errorResponse;
        }
    }

    /**
     * @param $encryptedDepartmentId
     * @return array
     */
    public function deactivate($encryptedDepartmentId)
    {
        try{
            $where = ['department_id' => decrypt($encryptedDepartmentId)];
            $data = ['status' => DEPARTMENT_INACTIVE_STATUS];
            $this->departmentOwnershipRepository->update($where, $data);

            return [
                'success' => true,
                'message' => 'Department has been deactivated.',
                'data' => [],
                'webResponse' => [
                    'success' => 'Department has been deactivated.'
                ],
            ];
        }catch (\Exception $e){
            return $this->errorResponse;
        }
    }

    /**
     * @param $encryptedDepartmentId
     * @return array
     */
    public function paymentDone($encryptedDepartmentId)
    {
        try{
            $where = [
                'department_id' => decrypt($encryptedDepartmentId),
                'status' => true
            ];
            $data = ['status' => false];
            $this->departmentTransactionRepository->update($where, $data);

            return [
                'success' => true,
                'message' => 'Department Payment Done.',
                'data' => [],
                'webResponse' => [
                    'success' => 'Department Payment Done.'
                ],
            ];
        }catch (\Exception $e){
            return $this->errorResponse;
        }
    }

    /**
     * @return array|JsonResponse|mixed
     */
    public function departmentListQuery() {
        $departments = $this->departmentRepository->getAllQuery();
        try {
            return datatables($departments)
                ->editColumn('title', function ($item) {
                    return $item->title;
                })
                ->addColumn('revenue', function ($item) {
                    $where = [
                        'department_id' => $item->id,
                        'status' => true
                    ];
                    return '৳ '.($this->departmentTransactionRepository->sumWhere($where, 'revenue'));
                })
                ->addColumn('profit', function ($item) {
                    $where = [
                        'department_id' => $item->id,
                        'status' => true
                    ];
                    return '৳ '.($this->departmentTransactionRepository->sumWhere($where, 'net_profit'));
                })
                ->addColumn('status', function ($item) {
                    $where = ['department_id' => $item->id];

                    return departmentStatus($this->departmentOwnershipRepository->whereFirst($where)->status);
                })
                ->addColumn('actions', function ($item) {
                    $generatedData = '<ul class="d-flex justify-content-center activity-menus mb-0">';

                    $generatedData .= '<a class="text-primary" href="';
                    $generatedData .= route('superAdmin.department.details', encrypt($item->id));
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

    /**
     * @return array|JsonResponse|mixed
     */
    public function saleRecordListQuery() {
        $where = ['user_id' => Auth::user()->id];
        $departmentId =  $this->departmentOwnershipRepository->whereLast($where)->department_id;
        $where = ['department_id' => $departmentId];
        $saleRecords = $this->saleRecordRepository->getWhereQuery($where);
        try {
            return datatables($saleRecords)
                ->editColumn('product_title', function ($item) {
                    return $item->product_title;
                })
                ->editColumn('product_variation_title', function ($item) {
                    return $item->product_variation_title;
                })
                ->editColumn('type_title', function ($item) {
                    return $item->type_title;
                })
                ->addColumn('quantity', function ($item) {
                    return $item->quantity;
                })
                ->rawColumns([])
                ->make(true);
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * @param $encryptedDepartmentId
     * @return array|JsonResponse|mixed
     */
    public function specificSaleRecordListQuery($encryptedDepartmentId) {
        $where = ['department_id' => decrypt($encryptedDepartmentId)];
        $saleRecords = $this->saleRecordRepository->getWhereQuery($where);
        try {
            return datatables($saleRecords)
                ->editColumn('product_title', function ($item) {
                    return $item->product_title;
                })
                ->editColumn('product_variation_title', function ($item) {
                    return $item->product_variation_title;
                })
                ->editColumn('type_title', function ($item) {
                    return $item->type_title;
                })
                ->addColumn('quantity', function ($item) {
                    return $item->quantity;
                })
                ->rawColumns([])
                ->make(true);
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * @param $encryptedDepartmentId
     * @return array|JsonResponse|mixed
     */
    public function specificProductVariationListQuery($encryptedDepartmentId) {
        $where = ['types.department_id' => decrypt($encryptedDepartmentId)];
        $productVariations = $this->productVariationRepository->details($where);
        try {
            return datatables($productVariations)
                ->editColumn('title', function ($item) {
                    return $item->title;
                })
                ->editColumn('product_title', function ($item) {
                    return $item->product_title;
                })
                ->editColumn('type_title', function ($item) {
                    return $item->type_title;
                })
                ->editColumn('manufacturing_cost', function ($item) {
                    return '৳'.$item->manufacturing_cost;
                })
                ->editColumn('unit_price', function ($item) {
                    return '৳'.$item->unit_price;
                })
                ->editColumn('weight_per_unit', function ($item) {
                    return $item->weight_per_unit.'kg';
                })
                ->editColumn('quantity', function ($item) {
                    return $item->quantity.$item->unit_of_quantity;
                })
                ->editColumn('status', function ($item) {
                    return $item->status ?
                        '<span class="text-success">Active</span>':
                        '<span class="text-danger">Inactive</span>';
                })
                ->rawColumns(['status'])
                ->make(true);
        } catch (\Exception $e) {
            return [];
        }
    }
}
