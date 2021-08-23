<?php

namespace App\Modules\Contact\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Modules\Contact\Requests\StoreContactMessageRequest;
use App\Modules\Contact\Services\ContactMessageService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
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
        $data['menu'] = 'contact';
        $data['user'] = Auth::user();

        return view('user.contact.form', $data);
    }


    /**
     * @param StoreContactMessageRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(StoreContactMessageRequest $request)
    {
        $response = $this->contactMessageService->store($request);

        return redirect()->back()->with($response['webResponse']);
    }
}
