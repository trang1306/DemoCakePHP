<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

/**
 * User Entity
 *
 * @property int $idUSER
 * @property string|null $USERNAME
 * @property string|null $PASSWORD
 * @property string|null $ROLE
 * @property string|null $CREATED
 * @property string|null $MODIFIED
 */
class User extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'USERNAME' => true,
        'password' => true,
        'ROLE' => true,
        'CREATED' => true,
        'MODIFIED' => true,
    ];

    protected $_hidden = [
        'password'
    ];

    protected function _setPassword($password) {
        return (new DefaultPasswordHasher)->hash($password);
    }
}
