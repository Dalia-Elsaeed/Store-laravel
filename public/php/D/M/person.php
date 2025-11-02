<?php
// PSR-4
namespace D\M;
use M\pepole;
// use info;
// define('dd',True);
// const Laravel='laravel d';
// function hello(){
//     echo "hello D\M";
// }
class Person implements pepole
{
    // use info ;
    const Male='m';
    const Female= 'f';
    public $name;
    protected $gender;
    private $age;
    public static $country;
    public function construct()
    {echo __CLASS__;}

    public function setAge($age)
    {
        $this->age = $age;
        return $this;
    }
    public function setGender($gender){
        $this->gender = $gender;
        return $this;
    }
    public static function setCountry($country){
        self::$country = $country;
    }
}
