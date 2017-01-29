<?php
namespace Alt3\CakeTokens\Model\Entity;

use Cake\ORM\Entity;

/**
 * Token Entity.
 *
 * @property int $id
 * @property string $token
 * @property string $category
 * @property string $foreign_alias
 * @property string $foreign_table
 * @property string $foreign_key
 * @property string $payload
 * @property string $lifetime
 * @property bool $use_once
 * @property int $status
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property \Cake\I18n\Time $expires
 */
class Token extends Entity
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
        '*' => true,
        'id' => false,
    ];

    /**
     * Fields that are excluded from JSON an array versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'token'
    ];
}
