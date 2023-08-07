<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Counsellors Model
 *
 * @property \App\Model\Table\CustomersTable&\Cake\ORM\Association\BelongsTo $Customers
 *
 * @method \App\Model\Entity\Counsellor newEmptyEntity()
 * @method \App\Model\Entity\Counsellor newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Counsellor[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Counsellor get($primaryKey, $options = [])
 * @method \App\Model\Entity\Counsellor findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Counsellor patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Counsellor[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Counsellor|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Counsellor saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Counsellor[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Counsellor[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Counsellor[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Counsellor[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class CounsellorsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('counsellors');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Customers', [
            'foreignKey' => 'cust_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('f_name')
            ->maxLength('f_name', 32)
            ->requirePresence('f_name', 'create')
            ->notEmptyString('f_name');

        $validator
            ->scalar('l_name')
            ->maxLength('l_name', 32)
            ->requirePresence('l_name', 'create')
            ->notEmptyString('l_name');

        $validator
            ->scalar('notes')
            ->maxLength('notes', 150)
            ->allowEmptyString('notes');

        $validator
            ->integer('cust_id')
            ->allowEmptyString('cust_id');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('cust_id', 'Customers'), ['errorField' => 'cust_id']);

        return $rules;
    }
}
