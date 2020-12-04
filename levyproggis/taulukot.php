<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of taulukot
 *
 * @author Vesa Jokikokko
 */
class Taulukot {
   public $tyyppi;
   
   function __construct($tyyppi) {
       $this->tyyppi = $tyyppi;
   }
   function get_tyyppi() {
    return $this->tyyppi;
  }
   
}
