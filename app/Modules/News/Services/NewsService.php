<?php


namespace App\Modules\News\Services;


use App\Http\Services\ResponseService;
use App\Modules\News\Repositories\NewsRepository;
use App\Modules\News\Repositories\DepartmentOwnershipRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class NewsService extends ResponseService
{
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
    }

    /**
     * @return mixed
     */
    public function allNews()
    {
        return $this->newsRepository->paginate();
    }

    /**
     * @param string $encryptedNewsId
     * @return mixed
     */
    public function details(string $encryptedNewsId)
    {
        $where = ['id' => decrypt($encryptedNewsId)];

        return $this->newsRepository->whereLast($where);
    }

    /**
     * @param object $request
     * @return array
     */
    public function store(object $request): array
    {
        try{
            $where = ['department_ownerships.user_id' => Auth::user()->id];
            $departmentOwnership = $this->departmentOwnershipRepository->details($where);

            $newsData = empty($departmentOwnership) ?
                $this->prepareNewsData('Company', $request)
                : $this->prepareNewsData($departmentOwnership->department_title, $request);

            $this->newsRepository->create($newsData);

            return $this->response()->success('News has been added.');
        }catch (\Exception $exception){
            return $this->response()->error($exception->getMessage());
        }
    }

    /**
     * @param string $departmentTitle
     * @param object $request
     * @return array
     */
    private function prepareNewsData(string $departmentTitle, object $request): array
    {
        return [
            'user_id' => Auth::user()->id,
            'department' => $departmentTitle,
            'content' => $request->content,
            'image' => uploadFile($request->image, newsImagePath()),
        ];
    }

    /**
     * @param object $request
     * @return array
     */
    public function update(object $request): array
    {
        try{
            $where = ['department_ownerships.user_id' => Auth::user()->id];
            $departmentOwnership = $this->departmentOwnershipRepository->details($where);
            $where = ['id' => $request->id];

            $newsData = empty($departmentOwnership) ?
                $this->prepareUpdatedNewsData('Company', $request)
                : $this->prepareUpdatedNewsData($departmentOwnership->department_title, $request);

            $this->newsRepository->update($where, $newsData);

            return $this->response()->success('News has been updated.');
        }catch (\Exception $exception){
            return $this->response()->error($exception->getMessage());
        }
    }

    /**
     * @param string $departmentTitle
     * @param object $request
     * @return array
     */
    private function prepareUpdatedNewsData(string $departmentTitle, object $request): array
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
     * @param string $encryptedNewsId
     * @return array
     */
    public function delete(string $encryptedNewsId): array
    {
        try{
            $where = ['id' => decrypt($encryptedNewsId)];
            $this->newsRepository->deleteWhere($where);

            return $this->response()->success('News has been deleted.');
        }catch (\Exception $exception){
            return $this->response()->error($exception->getMessage());
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
