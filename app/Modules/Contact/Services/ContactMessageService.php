<?php


namespace App\Modules\Contact\Services;


use App\Http\Services\ResponseService;
use App\Jobs\SendReplyToContactMessageJob;
use App\Jobs\SendVerificationEmailJob;
use App\Modules\Contact\Repositories\ContactMessageRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ContactMessageService extends ResponseService
{
    private $contactMessageRepository;

    /**
     * ContactMessageRepository constructor.
     * @param ContactMessageRepository $contactMessageRepository
     */
    public function __construct(ContactMessageRepository $contactMessageRepository)
    {
        $this->contactMessageRepository = $contactMessageRepository;
    }

    /**
     * @param object $request
     * @return array
     */
    public function store(object $request): array
    {
        try{
            $contactMessageData = $this->prepareContactMessageData($request);
            $this->contactMessageRepository->create($contactMessageData);

            return $this->response()->success(__('Message sent.'));
        }catch (\Exception $exception){
            return $this->response()->error($exception->getMessage());
        }
    }

    /**
     * @param object $request
     * @return array
     */
    private function prepareContactMessageData(object $request): array
    {
        return [
            'user_id' => Auth::user()->id,
            'to' => $request->to,
            'message' => $request->message,
            'read' => false,
            'replied_by' => null,
        ];
    }

    /**
     * @param string $encryptedContactMessageId
     * @return array
     */
    public function message(string $encryptedContactMessageId): array
    {
        try{
            $where = ['contact_messages.id' => decrypt($encryptedContactMessageId)];
            $message = $this->contactMessageRepository->detail($where);
            if(!$message['read']){
                $data = ['read' => true];
                $this->contactMessageRepository->update($where, $data);
            }

            return $this->response($message->toArray())->success();
        }catch (\Exception $exception){
            return $this->response()->error($exception->getMessage());
        }
    }

    /**
     * @param object $request
     * @return array
     */
    public function reply(object $request): array
    {
        try{
            DB::beginTransaction();
            $where = ['contact_messages.id' => $request->message_id];
            $message = $this->contactMessageRepository->detail($where);
            $messageData = [
                'replied_by' => Auth::user()->email,
                'reply' => $request->message
            ];
            $this->contactMessageRepository->update($where, $messageData);
            $defaultEmail = 'astharbazar@gmail.com';
            $defaultName = 'Asthar Bazar';
            dispatch(new SendReplyToContactMessageJob($defaultName, $defaultEmail, $message, $request->message))->onQueue('email-send');
            DB::commit();

            return $this->response()->success('Message replied.');
        }catch (\Exception $exception){
            DB::rollBack();

            return $this->response()->error($exception->getMessage());
        }
    }

    /**
     * @return array|JsonResponse|mixed
     */
    public function contactMessageListQuery() {
        $contactMessages = $this->contactMessageRepository->detailQuery();
        try {
            return datatables($contactMessages)
                ->editColumn('first_name', function ($item) {
                    return $item->first_name;
                })
                ->editColumn('last_name', function ($item) {
                    return $item->last_name;
                })
                ->editColumn('email', function ($item) {
                    return $item->email;
                })
                ->editColumn('to', function ($item) {
                    return $item->to;
                })
                ->editColumn('read', function ($item) {
                    return yesOrNo($item->read);
                })
                ->editColumn('replied_by', function ($item) {
                    return $item->replied_by;
                })
                ->addColumn('actions', function ($item) {
                    $generatedData = '<ul class="d-flex justify-content-center activity-menus mb-0">';

                    $generatedData .= '<a class="text-primary" href="';
                    if(Auth::user()->role==SUPER_ADMIN_ROLE) {
                        $generatedData .= route('superAdmin.contactMessage.details', encrypt($item->id));
                    }else{
                        $generatedData .= route('admin.contactMessage.details', encrypt($item->id));
                    }
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
