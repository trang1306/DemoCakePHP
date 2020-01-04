<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Student Entity
 *
 * @property int $idSTUDENT
 * @property int|null $idGENDER
 * @property string|null $NAME
 * @property \Cake\I18n\FrozenTime|null $BIRTHDAY
 * @property string|null $PHONE
 * @property string|null $ADDRESS
 * @property string|null $REMARK
 * @property string|null $IMAGE
 * @property \Cake\I18n\FrozenTime|null $UPDATE_TIME
 */
class Student extends Entity
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
        'idGENDER' => true,
        'NAME' => true,
        'BIRTHDAY' => true,
        'PHONE' => true,
        'ADDRESS' => true,
        'REMARK' => true,
        'IMAGE' => true,
        'UPDATE_TIME' => true,
    ];
}
