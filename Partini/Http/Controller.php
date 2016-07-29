<?php
/**
 * Created by PhpStorm.
 * User: jesusslim
 * Date: 16/7/28
 * Time: 下午6:27
 */

namespace Partini\Http;


use Partini\ApplicationInterface;

class Controller
{

    protected $context;

    public function __construct(ApplicationInterface $context)
    {
        $this->context = $context;
    }

    public function redirect($url){
        $headers = array(
            'Location' => $url
        );
        return new Response(null,302,$headers);
    }

    public function json($data){
        $headers = array(
            'Content-Type' => 'application/json; charset=utf-8'
        );
        return new Response(json_encode($data),200,$headers);
    }

    public function xml($data){
        //TODO
    }

    public function error($msg){

    }

    public function view($data){

    }

}