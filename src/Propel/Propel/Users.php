<?php
namespace Propel\Propel;
use Propel\Propel\Base\Users as BaseUsers;
use Symfony\Component\Security\Core\User\UserInterface;
/**
 * Skeleton subclass for representing a row from the 'users' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class Users extends BaseUsers implements UserInterface
{
    public function eraseCredentials() {
        
    }
    public function getRoles() {
        return explode('|', $this->getRole());
    }
    public function setRole($role){
        $this->role = $role;
    }
}
