<?php

namespace App\Http\Controllers;

abstract class Controller
{
    protected $regras;

    /**
     * Get the value of regras
     */ 
    public function getRegras()
    {
        return $this->regras;
    }

    /**
     * Set the value of regras
     */ 
    public function setRegras($regras)
    {
        $this->regras = $regras;
    }
}
