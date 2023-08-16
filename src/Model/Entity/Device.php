<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Device Entity
 *
 * @property int $id
 * @property string $transactionid
 * @property string|null $device_model
 * @property string|null $session_id
 * @property string|null $technical_details
 * @property string|null $platform
 * @property string|null $gamblock_ver
 * @property int $cust_id
 *
 * @property \App\Model\Entity\Customer $customer
 */
class Device extends Entity
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
        'transactionid' => true,
        'device_model' => true,
        'session_id' => true,
        'technical_details' => true,
        'platform' => true,
        'gamblock_ver' => true,
        'cust_id' => true,
        'customer' => true,
    ];
}
