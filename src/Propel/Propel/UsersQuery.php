<?php
namespace Propel\Propel;

use ArrayAccess;
use Propel\Propel\Base\UsersQuery as BaseUsersQuery;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
/**
 * Skeleton subclass for performing query and update operations on the 'users' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class UsersQuery extends BaseUsersQuery implements UserProviderInterface, ArrayAccess
{
    public function loadUserByUsername($username): UserInterface {
        $user =  self::create()->findOneByUsername($username);
        if(is_null($user)){
            throw new UsernameNotFoundException();
        }
        return $user;
    }
    public function refreshUser(UserInterface $user): UserInterface {
        return self::create()->findOneByUsername($user->getUsername());
    }

    public function supportsClass($class){
        return $class === 'Users';
    }

    public function offsetExists($offset){
        return null;
    }

    public function offsetGet($offset) {
        
    }

    public function offsetSet($offset, $value): void {
        
    }

    public function offsetUnset($offset): void {
        
    }
}