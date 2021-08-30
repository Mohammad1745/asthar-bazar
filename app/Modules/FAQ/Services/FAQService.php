<?php


namespace App\Modules\FAQ\Services;

use App\Http\Services\ResponseService;
use App\Modules\FAQ\Repositories\FAQRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FAQService extends ResponseService
{
    private $faqRepository;

    /**
     * FAQService constructor.
     * @param FAQRepository $faqRepository
     */
    public function __construct(FAQRepository $faqRepository)
    {
        $this->faqRepository = $faqRepository;
    }

    /**
     * @param $request
     * @return array
     */
    public function saveSettings($request): array
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

            return $this->response()->success('FAQ has been updated successfully');
        } catch (\Exception $exception) {
            DB::rollBack();

            return $this->response()->error($exception->getMessage());
        }
    }
}
