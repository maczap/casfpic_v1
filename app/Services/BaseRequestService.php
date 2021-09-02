<?php

namespace App\Services;


use Illuminate\Support\Facades\Http;

class BaseRequestService 
{
    private function makeRequest()
    {
        return Http::withBasicAuth(config('services.pagarme.api_key'), 'x');
    }

    protected function get($action)
    {
        return $this->makeRequest()->get($this->getUri($action))->json();
    }

    protected function post($action, $data)
    {
        return $this->makeRequest()->post($this->getUri($action), $data)->json();
    }

    protected function put($action, $data = null)
    {
        return $this->makeRequest()->put($this->getUri($action), $data)->json();
    }

    protected function delete($action)
    {
        return $this->makeRequest()->delete($this->getUri($action))->json();
    }

    private function getUri($action)
    {
        return sprintf('%s%s', config('services.pagarme.url_base'), $action);
    }    
}
