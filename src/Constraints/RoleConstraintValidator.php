<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Constraints;

use Propel\Runtime\Connection\ConnectionInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;


/**
 * Description of RoleConstraintValidator
 *
 * @author apple
 */
class RoleConstraintValidator extends ConstraintValidator{
    
    public function validate($value, Constraint $constraint) 
    {
        $role = $constraint->getRole();
        
        //$entity = $dao->findOne(["$field = ?" => $value]);
        $roles = \Propel\Propel\UsersQuery::create()->findBy(explode('|', $role));
        
        if($entity){
            $this->context->buildViolation($constraint->message)
                    ->setParameter('{{column}}', $field)
                    ->addViolation();
        }
        
    }
}
