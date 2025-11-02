<?php
trait info{
    // لو عندي نفس الكود في كذا حاجة =trait
     public function setAge($age)
    {
        $this->age = $age;
        return $this;
    }
    public function setGender($gender){
        $this->gender = $gender;
        return $this;
    }
}
