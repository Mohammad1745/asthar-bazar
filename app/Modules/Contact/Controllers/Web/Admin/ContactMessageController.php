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
    private $contactMessageService;

    public function __construct(ContactMessageService $contactMessageService)
    {
        $this->contactMessageService = $contactMessageService;
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
        return $this->contactMessageService->contactMessageListQuery();
    }

    /**
     * @param $encryptedContactMessageId
     * @return Application|Factory|RedirectResponse|View
     */
    public function details($encryptedContactMessageId)
    {
        $response = $this->contactMessageService->message($encryptedContactMessageId);
        if($response['success']) {
            $data['base'] = 'account';
            $data['menu'] = 'contact';
            $data['user'] = Auth::user();
            $data['message'] = $response['data'];

            return view('admin.contact.details', $data);
        }else{
            return redirect()->back()->with($response['webResponse']);
        }
    }

    /**
     * @param ReplyContactMessageRequest $request
     * @return RedirectResponse
     */
    public function reply(ReplyContactMessageRequest $request)
    {
        $response = $this->contactMessageService->reply($request);

        return redirect()->back()->with($response['webResponse']);
    }
}
