<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    /**
     * @param string $message
     * @return string[]
     */
    public function successResponse(string $message): array
    {
        return [
            'success' => $message
        ];
    }

    /**
     * @param string $message
     * @return string[]
     */
    public function errorResponse(string $message): array
    {
        return [
            'error' => $message
        ];
    }

    /**
     * @param array $serviceResponse
     * @param string|null $successRoute
     * @param string|null $failRoute
     * @param array $successRouteParameter
     * @param array $failRouteParameter
     * @return RedirectResponse
     */
    protected function webResponse(array $serviceResponse, string $successRoute=null, string $failRoute=null, array $successRouteParameter = [], array $failRouteParameter = []): RedirectResponse
    {
        if ($serviceResponse['data']) {
            $successRouteParameter = array_merge($successRouteParameter, $serviceResponse['data']);
            $failRouteParameter = array_merge($failRouteParameter, $serviceResponse['data']);
        }

        $redirection = redirect();
        if (!$serviceResponse['success']){
            $redirection = $failRoute ?
                $redirection->route($failRoute, $failRouteParameter) :
                $redirection->back();

            return $redirection->with($this->errorResponse($serviceResponse['message']));
        }

        $redirection = $successRoute ?
            $redirection->route($successRoute, $successRouteParameter) :
            $redirection->back();

        return $redirection->with($this->successResponse($serviceResponse['message']));
    }
}
