<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Ticket Entity
 *
 * @property string $id
 * @property string $title
 * @property string $type
 * @property \Cake\I18n\FrozenTime $createtime
 * @property \Cake\I18n\FrozenTime|null $closetime
 * @property bool $closed
 * @property int $cust_id
 * @property int $staff_id
 *
 * @property \App\Model\Entity\Customer $customer
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Content[] $contents
 */
class Ticket extends Entity
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
        'title' => true,
        'type' => true,
        'createtime' => true,
        'closetime' => true,
        'closed' => true,
        'cust_id' => true,
        'staff_id' => true,
        'customer' => true,
        'user' => true,
        'contents' => true,
    ];
}
