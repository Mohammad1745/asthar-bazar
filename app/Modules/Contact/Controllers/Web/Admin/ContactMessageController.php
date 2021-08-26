<?php

namespace App\Modules\Contact\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Modules\Contact\Requests\ReplyContactMessageRequest;
use App\Modules\Contact\Requests\StoreContactMessageRequest;
use App\Modules\Contact\Services\ContactMessageService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ContactMessageController extends Controller
{
    private $service;

    public function __construct(ContactMessageService $service)
    {
        $this->service = $service;
    }

    /**
     * @return Application|Factory|View
     */
    public function contact()
    {
        $data['base'] = 'account';
        $data['menu'] = 'contact';
        $data['user'] = Auth::user();

        return view('admin.contact.content', $data);
    }

    /**
     * @return array|JsonResponse|mixed
     */
    public function contactMessageList()
    {
        return $this->service->contactMessageListQuery();
    }

    /**
     * @param $encryptedContactMessageId
     * @return Application|Factory|RedirectResponse|View
     */
    public function details($encryptedContactMessageId)
    {
        $response = $this->service->message($encryptedContactMessageId);

        return $response['success'] ?
            $this->viewDetails($response)
            : redirect()->back()->with($response['message']);
    }

    /**
     * @param array $response
     * @return Application|Factory|View
     */
    private function viewDetails (array $response)
    {
        $data['base'] = 'account';
        $data['menu'] = 'contact';
        $data['user'] = Auth::user();
        $data['message'] = $response['data'];

        return view('admin.contact.details', $data);
    }

    /**
     * @param ReplyContactMessageRequest $request
     * @return RedirectResponse
     */
    public function reply(ReplyContactMessageRequest $request): RedirectResponse
    {
        return $this->webResponse($this->service->reply($request));
    }
}
