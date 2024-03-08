<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

class User extends Entity
{
   
protected $_virtual = ['profile_image_url'];

protected function _getProfileImageUrl()
{
    if (!empty($this->image)) {
        return '/img/uploads/' . $this->image;
    } else {
        return '/img/default.jpg'; 
    }
}


    protected $_accessible = [
        'name' => true,
        'email' => true,
        'password' => true,
        'created' => true,
        'modified' => true,
    ];

    
    protected $_hidden = [
        'password',
    ];

    protected function _setPassword(string $password)
    {
        $hasher = new DefaultPasswordHasher();
        return $hasher->hash($password);
    }
}
