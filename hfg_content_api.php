<?php

class HFG__Content__API {

    private $apiKey = false;
    private $error;
    private $apiUrlRoot = 'https://content.holyfiregames.com/api-public/';

    function __construct($apiKey = '') {
        if ($this->isValidKey($apiKey)) {
            $this->apiKey = $apiKey;
        } else {
            $this->error = 'Invalid API key';
        }
    }

    private function isValidKey($apiKey) {
        return strlen($apiKey) == 32;
    }

    public function getLastError() {
        return $this->error;
    }

    private function getCurlHeaders() {
        return ['X-HFGStudio-Key: ' . $this->apiKey];
    }

    private function callApi($path, $data = false) {
        $ch = curl_init();
//        debug($this->apiUrlRoot . $path);
        $url = $this->apiUrlRoot . $path;
        if ($data && !empty($data)) {
            $url .= '?' . $data;
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        $headers = $this->getCurlHeaders();
        if ($headers && is_array($headers)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $returnData = curl_exec($ch);
//        debug($returnData);
        if (curl_errno($ch)) {
            $this->error = curl_error($ch);
        }
        curl_close($ch);
        return json_decode($returnData);
    }

    public function getContent() {
        $return = $this->callApi('content/get');
        if($return->status == 'success'){
            return $return->content;
        }else{
            $this->lastError = $return->message;
            return false;
        }
    }

    public function getContentById($contentId = 0) {
        if($contentId > 0){
            $return = $this->callApi('content/get', "id={$contentId}");
            if($return->status == 'success'){
                return $return->content;
            }else{
                $this->lastError = $return->message;
                return false;
            }
        }else{
            return false;
        }
    }

    public function getContentBySlug($slug = '') {
        if($slug != ''){
            $return = $this->callApi('content/get', "slug={$slug}");
            if($return->status == 'success'){
                return $return->content;
            }else{
                $this->lastError = $return->message;
                return false;
            }
        }else{
            return false;
        }
    }

    public function getContentByCategoryId($categoryId = 0) {
        if($categoryId > 0){
            $return = $this->callApi('content/get', "category_id={$categoryId}");
            if($return->status == 'success'){
                return $return->content;
            }else{
                $this->lastError = $return->message;
                return false;
            }
        }else{
            return false;
        }
    }

    public function getContentByProjectId($projectId = 0) {
        if($projectId > 0){
            $return = $this->callApi('content/get', "project_id={$projectId}");
            if($return->status == 'success'){
                return $return->content;
            }else{
                $this->lastError = $return->message;
                return false;
            }
        }else{
            return false;
        }
    }

}
