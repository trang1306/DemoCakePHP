<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Students Model
 *
 * @method \App\Model\Entity\Student get($primaryKey, $options = [])
 * @method \App\Model\Entity\Student newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Student[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Student|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Student saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Student patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Student[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Student findOrCreate($search, callable $callback = null, $options = [])
 */
class StudentsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('students');
        $this->setDisplayField('idSTUDENT');
        $this->setPrimaryKey('idSTUDENT');
        $this->addBehavior('Timestamp');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('idSTUDENT')
            ->allowEmptyString('idSTUDENT', null, 'create');

        $validator
            ->integer('idGENDER')
            ->allowEmptyString('idGENDER');

        $validator
            ->scalar('NAME')
            ->maxLength('NAME', 200)
            ->allowEmptyString('NAME');

        $validator
            ->dateTime('BIRTHDAY')
            ->allowEmptyDateTime('BIRTHDAY');

        $validator
            ->scalar('PHONE')
            ->maxLength('PHONE', 13)
            ->allowEmptyString('PHONE');

        $validator
            ->scalar('ADDRESS')
            ->maxLength('ADDRESS', 300)
            ->allowEmptyString('ADDRESS');

        $validator
            ->scalar('REMARK')
            ->maxLength('REMARK', 300)
            ->allowEmptyString('REMARK');

        $validator
            ->scalar('IMAGE')
            ->maxLength('IMAGE', 300)
            ->allowEmptyString('IMAGE');

        $validator
            ->dateTime('UPDATE_TIME')
            ->allowEmptyDateTime('UPDATE_TIME');

        return $validator;
    }
}
