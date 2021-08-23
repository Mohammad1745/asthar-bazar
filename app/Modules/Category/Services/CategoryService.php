<?php


namespace App\Modules\Category\Services;


use App\Modules\Category\Repositories\CategoryRepository;
use App\Modules\Category\Repositories\DepartmentOwnershipRepository;
use App\Modules\Category\Repositories\ProductRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class CategoryService
{
    private $errorMessage;
    private $errorResponse;
    private $departmentOwnershipRepository;
    private $categoryRepository;
    private $productRepository;

    /**
     * CategoryRepository constructor.
     * @param DepartmentOwnershipRepository $departmentOwnershipRepository
     * @param CategoryRepository $categoryRepository
     * @param ProductRepository $productRepository
     */
    public function __construct(DepartmentOwnershipRepository $departmentOwnershipRepository, CategoryRepository $categoryRepository, ProductRepository $productRepository)
    {
        $this->departmentOwnershipRepository = $departmentOwnershipRepository;
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
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
    public function categoriesNotHavingProducts() {
        $where = ['department_ownerships.user_id' => Auth::user()->id];
        $categories = $this->categoryRepository->categories($where)->get();
        $categoriesNotHavingProducts = [];
        foreach ($categories as $category){
            $where = ['category_id' => $category->id];
            $product = $this->productRepository->whereLast($where);
            if(empty($product)){
                array_push($categoriesNotHavingProducts, $category);
            }
        }

        return $categoriesNotHavingProducts;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function store($request) {
        try{
            $where = ['user_id' => Auth::user()->id];
            $departmentOwnership = $this->departmentOwnershipRepository->whereLast($where);
            $categoryData = $this->prepareCategoryData($departmentOwnership->department_id, $request);
            $this->categoryRepository->create($categoryData);

            return [
                'success' => true,
                'message' => __('Category has been added.'),
                'webResponse' => [
                    'success' => __('Category has been added.')
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
    private function prepareCategoryData($departmentId, $request)
    {
        $preparedData = [
            'title' => $request->title,
            'department_id' => $departmentId,
            'description' => $request->description,
        ];
        if(isset($request->parent_id)){
            $preparedData['parent_id'] = $request->parent_id;
        }

        return $preparedData;
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
            $categoryData = $this->prepareUpdatedCategoryData($departmentOwnership->department_id, $request);
            $this->categoryRepository->update($where, $categoryData);

            return [
                'success' => true,
                'message' => __('Category has been updated.'),
                'webResponse' => [
                    'success' => __('Category has been updated.')
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
    private function prepareUpdatedCategoryData($departmentId, $request)
    {
        $preparedData = [
            'title' => $request->title,
            'department_id' => $departmentId,
            'description' => $request->description,
        ];
        if(isset($request->parent_id)){
            $preparedData['parent_id'] = $request->parent_id;
        }else{
            $preparedData['parent_id'] = mull;
        }

        return $preparedData;
    }

    /**
     * @param $encryptedCategoryId
     * @return mixed
     */
    public function details($encryptedCategoryId)
    {
        $where = ['id' => decrypt($encryptedCategoryId)];
        $category = $this->categoryRepository->whereLast($where);
        $parent = [];
        $parentCategory = $category;
        while(!is_null($parentCategory['parent_id']))
        {
            $where = ['id' => $parentCategory['parent_id']];
            $parentCategory = $this->categoryRepository->whereLast($where);
            array_unshift($parent, $parentCategory['title']);
        }

        $category['parent'] = $parent;

        return $category;
    }

    /**
     * @param $encryptedCategoryId
     * @return array
     */
    public function delete($encryptedCategoryId)
    {
        try{
            $where = ['id' => decrypt($encryptedCategoryId)];
            $this->categoryRepository->deleteWhere($where);

            return [
                'success' => true,
                'message' => 'Category has been deleted.',
                'data' => [],
                'webResponse' => [
                    'success' => 'Category has been deleted.'
                ],
            ];
        }catch (\Exception $e){
            return $this->errorResponse;
        }
    }

    /**
     * @return array|JsonResponse|mixed
     */
    public function categoryListQuery() {
        $where = ['department_ownerships.user_id' => Auth::user()->id];
        $categories = $this->categoryRepository->categories($where);
        try {
            return datatables($categories)
                ->editColumn('title', function ($item) {
                    return $item->title;
                })
                ->addColumn('parent', function ($item) {
                    if($item->parent_id==null){
                        return "-----";
                    }else{
                        $where = ['id' => $item->parent_id];
                        return $this->categoryRepository->whereLast($where)['title'];
                    }
                })
                ->editColumn('description', function ($item) {
                    return (strlen($item->description)>50) ? substr($item->description, 0, 50) . '...' : $item->description;
                })
                ->addColumn('actions', function ($item) {
                    $generatedData = '<ul class="d-flex justify-content-center activity-menus mb-0">';

                    $generatedData .= '<a class="text-primary" href="';
                    $generatedData .= route('admin.category.details', encrypt($item->id));
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
