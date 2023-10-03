<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Commdetails Model
 *
 * @property \App\Model\Table\CustomersTable&\Cake\ORM\Association\BelongsTo $Customers
 *
 * @method \App\Model\Entity\Commdetail newEmptyEntity()
 * @method \App\Model\Entity\Commdetail newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Commdetail[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Commdetail get($primaryKey, $options = [])
 * @method \App\Model\Entity\Commdetail findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Commdetail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Commdetail[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Commdetail|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Commdetail saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Commdetail[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Commdetail[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Commdetail[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Commdetail[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class CommdetailsTable extends Table
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

        $this->setTable('commdetails');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
        $this->belongsTo('Customers', [
            'foreignKey' => 'cust_id',
            'joinType' => 'INNER',
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
            ->scalar('type')
            ->maxLength('type', 100)
            ->allowEmptyString('type');

        $validator
            ->scalar('link')
            ->maxLength('link', 500)
            ->allowEmptyString('link');

        $validator
            ->integer('cust_id')
            ->notEmptyString('cust_id');

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
