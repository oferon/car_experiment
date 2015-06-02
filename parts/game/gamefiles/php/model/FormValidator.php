<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'FormField.php';

class FormValidator
{
    private $Afields_to_validate;
    private $Aval_errors ;
    
    public function __construct(array $Afields) {
        
        $this->Afields_to_validate = $Afields;
        $this->Aval_errors = [];
    }
    
    public function validate()
    {
        /*
         * TODO: This is not the most flexible way of doing validation. 
         *  
         */
        
        /* @var $form_field FormField */
        foreach($this->Afields_to_validate as $form_field )
        {
            if ($form_field->is_required()) {
                if (is_null($form_field->getValue())) {
                    $this->Aval_errors[$form_field->getName()] = "This field must be set";
                }
            }
        }
        
        return $this->Aval_errors;
    }
    
}

