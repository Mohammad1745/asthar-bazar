<?php


namespace App\Modules\News\Services;


use App\Modules\News\Repositories\NewsRepository;
use App\Modules\News\Repositories\DepartmentOwnershipRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class NewsService
{
    private $errorMessage;
    private $errorResponse;
    private $departmentOwnershipRepository;
    private $newsRepository;

    /**
     * NewsRepository constructor.
     * @param DepartmentOwnershipRepository $departmentOwnershipRepository
     * @param NewsRepository $newsRepository
     */
    public function __construct(DepartmentOwnershipRepository $departmentOwnershipRepository, NewsRepository $newsRepository)
    {
        $this->departmentOwnershipRepository = $departmentOwnershipRepository;
        $this->newsRepository = $newsRepository;
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
    public function allNews()
    {
        return $this->newsRepository->paginate();
    }

    /**
     * @param $encryptedNewsId
     * @return mixed
     */
    public function details($encryptedNewsId)
    {
        $where = ['id' => decrypt($encryptedNewsId)];

        return $this->newsRepository->whereLast($where);
    }

    /**
     * @param $request
     * @return mixed
     */
    public function store($request) {
        try{
            $where = ['department_ownerships.user_id' => Auth::user()->id];
            $departmentOwnership = $this->departmentOwnershipRepository->details($where);
            if(empty($departmentOwnership)){
                $newsData = $this->prepareNewsData('Company', $request);
            }else{
                $newsData = $this->prepareNewsData($departmentOwnership->department_title, $request);
            }
            $this->newsRepository->create($newsData);

            return [
                'success' => true,
                'message' => __('News has been added.'),
                'webResponse' => [
                    'success' => __('News has been added.')
                ],
            ];
        }catch (\Exception $exception){
            return $this->errorResponse;
        }
    }

    /**
     * @param $departmentTitle
     * @param $request
     * @return array
     */
    private function prepareNewsData($departmentTitle, $request)
    {
        return [
            'user_id' => Auth::user()->id,
            'department' => $departmentTitle,
            'content' => $request->content,
            'image' => uploadFile($request->image, newsImagePath()),
        ];
    }

    /**
     * @param $request
     * @return mixed
     */
    public function update($request) {
        try{
            $where = ['department_ownerships.user_id' => Auth::user()->id];
            $departmentOwnership = $this->departmentOwnershipRepository->details($where);
            $where = ['id' => $request->id];
            if(empty($departmentOwnership)){
                $newsData = $this->prepareUpdatedNewsData('Company', $request);
            }else{
                $newsData = $this->prepareUpdatedNewsData($departmentOwnership->department_title, $request);
            }
            $this->newsRepository->update($where, $newsData);

            return [
                'success' => true,
                'message' => __('News has been updated.'),
                'webResponse' => [
                    'success' => __('News has been updated.')
                ],
            ];
        }catch (\Exception $exception){
            return $this->errorResponse;
        }
    }

    /**
     * @param $departmentTitle
     * @param $request
     * @return array
     */
    private function prepareUpdatedNewsData($departmentTitle, $request)
    {
        $preparedData = [
            'user_id' => Auth::user()->id,
            'department' => $departmentTitle,
            'content' => $request->content,
        ];
        if(isset($request->image)){
            $where = ['id' => $request->id];
            $oldImage = $this->newsRepository->whereLast($where)->image;
            $preparedData['image'] = uploadFile($request->image, newsImagePath(), $oldImage);
        }

        return $preparedData;
    }

    /**
     * @param $encryptedNewsId
     * @return array
     */
    public function delete($encryptedNewsId)
    {
        try{
            $where = ['id' => decrypt($encryptedNewsId)];
            $this->newsRepository->deleteWhere($where);

            return [
                'success' => true,
                'message' => 'News has been deleted.',
                'data' => [],
                'webResponse' => [
                    'success' => 'News has been deleted.'
                ],
            ];
        }catch (\Exception $e){
            return $this->errorResponse;
        }
    }

    /**
     * @return array|JsonResponse|mixed
     */
    public function newsListQuery() {
        $news = $this->newsRepository->getAllQuery();
        try {
            return datatables($news)
                ->editColumn('created_at', function ($item) {
                    return date_format($item->created_at, 'Y-m-d');
                })
                ->editColumn('department', function ($item) {
                    return $item->department;
                })
                ->editColumn('content', function ($item) {
                    return (strlen($item->content)>50) ? substr($item->content, 0, 200) . '...' : $item->content;
                })
                ->addColumn('image', function ($item) {
                    $generatedData = '<img src="';
                    $generatedData .= asset(newsImageViewPath().$item->image);
                    $generatedData .= '" height="100" weight="100">';

                    return $generatedData;
                })
                ->addColumn('actions', function ($item) {
                    $generatedData = '<ul class="d-flex justify-content-center activity-menus mb-0">';
                    $generatedData .= '<a class="text-primary" href="';
                    if(Auth::user()->role==SUPER_ADMIN_ROLE) {
                        $generatedData .= route('superAdmin.news.details', encrypt($item->id));
                    }else{
                        $generatedData .= route('admin.news.details', encrypt($item->id));
                    }
                    $generatedData .= '" data-toggle="tooltip" title="View">';
                    $generatedData .= '<i class="fa fa-eye"></i>';
                    $generatedData .= '</a>';
                    $generatedData .= '</ul>';

                    return $generatedData;
                })
                ->rawColumns(['image','actions'])
                ->make(true);
        } catch (\Exception $e) {
            return [];
        }
    }
}
