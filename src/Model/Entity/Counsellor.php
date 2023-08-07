<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Counsellor Entity
 *
 * @property int $id
 * @property string $f_name
 * @property string $l_name
 * @property string|null $notes
 * @property int|null $cust_id
 *
 * @property \App\Model\Entity\Customer $customer
 */
class Counsellor extends Entity
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
        'notes' => true,
        'cust_id' => true,
        'customer' => true,
    ];
}
