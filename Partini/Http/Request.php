<?php
/**
 * Created by PhpStorm.
 * User: jesusslim
 * Date: 16/7/27
 * Time: 下午11:45
 */

namespace Partini\Http;


class Request
{

    protected $base_req;
    protected $uri;
    protected $method;

    public function __construct()
    {
        $this->base_req = $_REQUEST;
        $uri = $_SERVER['REQUEST_URI'];
        $index = strpos($uri,'?');
        $this->uri = $index === false ? $uri : substr($uri,0,$index);
        $this->method = $_SERVER['REQUEST_METHOD'];
    }

    public function get($key){
        if(is_array($key)){
            return array_intersect_key($this->base_req,array_fill_keys($key,0));
        }else{
            return $this->base_req[$key];
        }
    }

    public function getUri(){
        return $this->uri;
    }

    public function getMethod(){
        return $this->method;
    }
}