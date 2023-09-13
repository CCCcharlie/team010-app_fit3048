<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Cb Entity
 *
 * @property string $id
 * @property string $hint
 * @property string $content_type
 * @property string $content_value
 * @property string|null $previous_value
 * @property string|null $content_description
 */
class Cb extends Entity
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
        'hint' => true,
        'content_type' => true,
        'content_value' => true,
        'previous_value' => true,
        'content_description' => true,
    ];
}
