<?php
namespace D;
include __DIR__ ."/autoload..php";
use D\M\Person as PersonD;
use M\Person as PersonM;

// use M\Person;

// =use function M\hello;

// hello();
$person = new \D\M\Person;
$person2 = new \M\Person;
if($person instanceof \M\pepole){
    echo 'Yeah';
}
$person->name='DODY';
$person2->name='MODY';
$person->setAge(10);
$person::$country='EGYPT';
$person2::$country= 'USA';

echo '<pre>';
var_dump($person);
echo M\person::$country;
echo $person::Male;
