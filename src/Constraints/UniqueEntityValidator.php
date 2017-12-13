<?php

namespace Constraints;

use Propel\Runtime\Connection\ConnectionInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Description of UniqueEntityValidator
 *
 * @author Etudiant
 */
class UniqueEntityValidator extends ConstraintValidator
{
    
    public function validate($value, Constraint $constraint) 
    {
        $field = $constraint->getField();
        $dao = $constraint->getDao();
        
        //$entity = $dao->findOne(["$field = ?" => $value]);
        $entity = $dao->findOneBy($field, $value, $con = null);
        
        if($entity){
            $this->context->buildViolation($constraint->message)
                    ->setParameter('{{column}}', $field)
                    ->addViolation();
        }
        
    }

}
