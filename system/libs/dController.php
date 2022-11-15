<?php
class dController   //lớp cha của mọi controller
{
    protected $load = array();

    public function __construct()
    {
        $this->load = new Load();
    }
}
