<?php


namespace App\Modules\FAQ\Services;

use App\Modules\FAQ\Repositories\FAQRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FAQService
{
    private $errorMessage;
    private $errorResponse;
    private $faqRepository;

    /**
     * FAQService constructor.
     * @param FAQRepository $faqRepository
     */
    public function __construct(FAQRepository $faqRepository)
    {
        $this->faqRepository = $faqRepository;
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
     * @param $request
     * @return array
     */
    public function saveSettings($request)
    {
        try {
            DB::beginTransaction();
            foreach ($request->except('_token') as $key => $value) {
                if ($request->hasFile($key)) {
                    $value = uploadFile($value, appImagePath());
                }
                $this->faqRepository->updateOrCreate(['slug' => $key], ['user_id' => Auth::user()->id,'value' => $value]);
            }
            DB::commit();
            return [
                'success' =>  true,
                'message' => __('FAQ has been updated successfully'),
                'data' => null,
                'webResponse' => [
                    'success' => __('FAQ has been updated successfully'),
                ],
            ];
        } catch (\Exception $exception) {
            DB::rollBack();

            return [
                'success' =>  false,
                'message' => __('Something went wrong. Please try again.') . $exception->getMessage(),
                'data' => null,
                'webResponse' => [
                    'dismiss' => __('Something went wrong. Please try again.') . $exception->getMessage(),
                ],
            ];
        }
    }
}
