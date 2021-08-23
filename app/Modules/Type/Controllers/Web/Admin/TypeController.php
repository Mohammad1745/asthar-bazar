<?php

namespace App\Modules\Type\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Modules\Type\Requests\StoreTypeRequest;
use App\Modules\Type\Requests\UpdateTypeRequest;
use App\Modules\Type\Services\TypeService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TypeController extends Controller
{
    private $typeService;

    public function __construct(TypeService $typeService)
    {
        $this->typeService = $typeService;
    }

    /**
     * @return Application|Factory|View
     */
    public function type()
    {
        $data['base'] = 'department';
        $data['menu'] = 'type';
        $data['user'] = Auth::user();

        return view('admin.type.content', $data);
    }

    /**
     * @return mixed
     */
    public function typeList()
    {
        return $this->typeService->typeListQuery();
    }

    /**
     * @param $encryptedTypeId
     * @return Application|Factory|View
     */
    public function details($encryptedTypeId)
    {
        $data['base'] = 'department';
        $data['menu'] = 'type';
        $data['user'] = Auth::user();
        $data['type'] = $this->typeService->details($encryptedTypeId);

        return view('admin.type.details', $data);
    }

    /**
     * @param StoreTypeRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(StoreTypeRequest $request)
    {
        $response = $this->typeService->store($request);

        return redirect(route('admin.type'))->with($response['webResponse']);
    }

    /**
     * @param UpdateTypeRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function update(UpdateTypeRequest $request)
    {
        $response = $this->typeService->update($request);

        return redirect(route('admin.type'))->with($response['webResponse']);
    }

    /**
     * @param $encryptedTypeId
     * @return Application|RedirectResponse|Redirector
     */
    public function delete($encryptedTypeId)
    {
        $response = $this->typeService->delete($encryptedTypeId);

        return $response['success'] ?
            redirect(route('admin.type'))->with($response['webResponse']):
            redirect()->back()->with($response['webResponse']);
    }
}
