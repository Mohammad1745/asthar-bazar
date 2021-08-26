<?php

namespace App\Modules\Contact\Controllers\Web\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Modules\Contact\Requests\ReplyContactMessageRequest;
use App\Modules\Contact\Services\ContactMessageService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
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

        return view('super_admin.contact.content', $data);
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
        if($response['success']) {
            $data['base'] = 'account';
            $data['menu'] = 'contact';
            $data['user'] = Auth::user();
            $data['message'] = $response['data'];

            return view('super_admin.contact.details', $data);
        }else{
            return redirect()->back()->with($response['webResponse']);
        }
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
