<?php
class Sc{
    protected $container;
    public function bind($name,$instance){
        $this->container[$name] = $instance;
    }
    public function make($name){
       return $this->container[$name];
    }
}
