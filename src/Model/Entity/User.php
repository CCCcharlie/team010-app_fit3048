<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Authentication\PasswordHasher\DefaultPasswordHasher;
use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property string $id
 * @property string $f_name
 * @property string $l_name
 * @property string $email
 * @property string $password
 * @property string|null $timezone
// * @property bool $admin_status
 * @property string $role
 * @property string|null $nonce
 * @property \Cake\I18n\FrozenTime $nonce_expiry
 *
 * @property \App\Model\Entity\Ticket[] $tickets
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
     * @var array<string, bool>
     */
    protected $_accessible = [
        'f_name' => true,
        'l_name' => true,
        'email' => true,
        'password' => true,
        'timezone' => true,
//        'admin_status' => true,
        'role' => true,
        'nonce' => true,
        'nonce_expiry' => true,
        'tickets' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array<string>
     */
    protected $_hidden = [
        'password',
    ];

    /**
     * Hashing password for User entity
     * @param string $password Password field
     * @return string|null hashed password
     */
    protected function _setPassword(string $password): ?string {
        if (strlen($password) > 0) {
            return (new DefaultPasswordHasher())->hash($password);
        }
        return $password;
    }

}
