<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Content Entity
 *
 * @property int $id
 * @property string $content
 * @property \Cake\I18n\FrozenTime $createtime
 * @property int $ticket_id
 * @property string $content_type
 *
 * @property \App\Model\Entity\Ticket $ticket
 */
class Content extends Entity
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
        'content' => true,
        'createtime' => true,
        'ticket_id' => true,
        'content_type' => true,
        'ticket' => true,
    ];
}
