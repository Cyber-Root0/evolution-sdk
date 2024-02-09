<?php
namespace EvolutionSDK\util;
class Config{

    private string $url = '';
    private string $apikey = '';
    /**
     * get url param
     *
     * @return string
     */
    public function getUrl(){
        return $this->url;
    }
    /**
     * get apikey param
     *
     * @return string
     */
    public function getApikey(){
        return $this->apikey;
    }    
    /**
     * setUrl
     *
     * @param  string $url
     * @return void
     */
    public function setUrl(string $url){
        $this->url = $url;
    }    
    /**
     * set apikey param
     *
     * @param  string $apikey
     * @return void
     */
    public function setApikey(string $apikey){
        $this->apikey = $apikey;
    }

}