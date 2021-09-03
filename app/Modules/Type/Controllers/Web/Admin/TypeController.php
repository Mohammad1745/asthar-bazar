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
    /**
     * @var TypeService
     */
    private $service;

    /**
     * @param TypeService $service
     */
    public function __construct(TypeService $service)
    {
        $this->service = $service;
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
        return $this->service->typeListQuery();
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
        $data['type'] = $this->service->details($encryptedTypeId);

        return view('admin.type.details', $data);
    }

    /**
     * @param StoreTypeRequest $request
     * @return RedirectResponse
     */
    public function store(StoreTypeRequest $request): RedirectResponse
    {
        return $this->webResponse( $this->service->store($request), 'admin.type');
    }

    /**
     * @param UpdateTypeRequest $request
     * @return RedirectResponse
     */
    public function update(UpdateTypeRequest $request): RedirectResponse
    {
        return $this->webResponse( $this->service->update($request), 'admin.type');
    }

    /**
     * @param string $encryptedTypeId
     * @return RedirectResponse
     */
    public function delete(string $encryptedTypeId): RedirectResponse
    {
        return $this->webResponse( $this->service->delete( $encryptedTypeId), 'admin.type');
    }
}
