<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Commdetail Entity
 *
 * @property string $id
 * @property string|null $type
 * @property string|null $link
 * @property int $cust_id
 *
 * @property \App\Model\Entity\Customer $customer
 */
class Commdetail extends Entity
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
        'type' => true,
        'link' => true,
        'cust_id' => true,
        'customer' => true,
    ];
}
