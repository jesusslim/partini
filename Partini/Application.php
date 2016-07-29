<?php
/**
 * Created by PhpStorm.
 * User: jesusslim
 * Date: 16/7/25
 * Time: 下午9:58
 */

namespace Partini;


use Inject\Injector;

class Application extends Injector implements ApplicationInterface
{

    const VERSION = '1.0.0';

    protected static $instance;
    protected $is_debug = true;

    public function __construct()
    {
        self::$instance = $this;

        $this->mapData(ApplicationInterface::class,$this);

        $this->mapData('config',new Config());

        $this->is_debug = $this->getConfig('APP_DEBUG') ? true : false;
    }

    public function version(){
        return self::VERSION;
    }

    public function getConfig($key = null){
        if($key === null){
            return $this->getData('config');
        }else{
            return $this->getData('config')->get($key);
        }
    }

    public function addConfig($data){
        $this->getData('config')->add($data);
    }

    public function isDebug(){
        return $this->is_debug;
    }

    public static function getInstance(){
        return self::$instance;
    }
}