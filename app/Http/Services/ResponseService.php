<?php


namespace App\Http\Services;


class ResponseService
{
    /**
     * @var array
     */
    private $response = [
        'success' => null,
        'message' => '',
        'data' => null
    ];
    /**
     * @var string
     */
    private $errorMessage = 'Something went wrong! ';

    /**
     * @param array|null $data
     * @return $this
     */
    protected function response (array $data=null): ResponseService
    {
        $this->response['data'] = $data;

        return $this;
    }

    /**
     * @param string|null $message
     * @return array
     */
    protected function success (string $message=null): array
    {
        $this->response['success'] = true;
        $this->response['message'] = $message ?
            __($message) :
            __('Done');

        return $this->response;
    }

    /**
     * @param string|null $message
     * @return array
     */
    protected function error (string $message=null): array
    {
        $this->response['success'] = false;
        $this->response['message'] = $message ?
            __($message) :
            __($this->errorMessage);

        return $this->response;
    }
}
