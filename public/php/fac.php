 <?php
class per{
    protected $container='per';
    public function __callStatic($name, $args){
        $sc=new sc;
        $sc->make(self::$container);
        // $per;
    }
} 

