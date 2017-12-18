<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Constraints;
use Symfony\Component\Validator\Constraint;
/**
 * Description of RoleConstraint
 *
 * @author apple
 */
class RoleConstraint extends Constraint{
    
    public $message = 'This role is not valid';
    public $role;
    
    public function __construct($options = null) 
    {
        
        if(is_array($options)){
            $this->role = $options['role'];
        }
        parent::__construct($options);
    }
    
    public function validatedBy()
    {
        return get_class($this).'Validator';
    }
    
    function getRole() {
        return $this->role;
    }


    
}
