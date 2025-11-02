<?php
namespace M;
    use info;

use D\M\Person as PersonD;
// define('dd',True);
const Laravel='laravel M';
function hello(){
    echo "hello m";
}
class Person extends PersonD implements pepole
{
    use info;
    const Male='m';
    const Female= 'f';
    public $name;
    protected $gender;
    private $age;
    public static $country;
    public function __construct()
    {}

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
