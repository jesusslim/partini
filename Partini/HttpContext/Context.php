<?php
/**
 * Created by PhpStorm.
 * User: jesusslim
 * Date: 16/8/3
 * Time: 下午5:12
 */

namespace Partini\HttpContext;


use Inject\Injector;
use Partini\ApplicationInterface;

class Context extends Injector
{

    protected $KeysInside = array(
        'input',
        'output',
        Context::class,
        'parent'
    );

    public function __construct(ApplicationInterface $parent)
    {
        $this->mapSingleton('input',Input::class);
        $this->mapSingleton('output',Output::class);
        $this->mapData(Context::class,$this);
        $this->mapData('parent',$parent);
    }

    public function getParent(){
        return $this->produce('parent');
    }

    public function input(){
        return $this->produce('input');
    }

    public function output(){
        return $this->produce('output');
    }

    public function stash($k,$v){
        if(!$this->keyValid($k)) return false;
        $this->mapData($k,$v);
        return true;
    }

    public function getStash($k){
        return $this->produce($k);
    }

    public function mapLazy($k,$class){
        if(!$this->keyValid($k)) return false;
        $this->mapSingleton($k,$class);
        return true;
    }

    public function keyValid($key){
        return !in_array($key,$this->KeysInside);
    }

    public function getCookie($key){
        return $this->input()->cookie($key);
    }

    public function setCookie($k,$v,...$params){
        $this->output()->cookie($k,$v,...$params);
    }

    public function redirect($url){
        $this->output()->header("Location", $url);
        $this->output()->setStatus(Output::HTTP_FOUND);
    }
}