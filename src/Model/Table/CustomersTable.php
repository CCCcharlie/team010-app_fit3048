<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Customers Model
 *
 * @method \App\Model\Entity\Customer newEmptyEntity()
 * @method \App\Model\Entity\Customer newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Customer[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Customer get($primaryKey, $options = [])
 * @method \App\Model\Entity\Customer findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Customer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Customer[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Customer|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Customer saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Customer[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Customer[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Customer[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Customer[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class CustomersTable extends Table
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

        $this->setTable('customers');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        //Added this cause it was lacking the association when baking it for the second time
        $this->hasMany('Tickets', [
            'foreignKey' => 'cust_id',
        ]);

        $this->hasMany('Devices', [ // Add this line for the devices association
            'foreignKey' => 'cust_id',
        ]);

        $this->hasMany('Commdetails', [ // Add this line for the commdetails association
            'foreignKey' => 'cust_id',
        ]);

        $this->hasMany('Counsellors', [ // Add this line for the commdetails association
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
            ->notEmptyString('f_name')
            ->add('f_name', [
                'validCharacters' => [
                    'rule' => ['custom', '/^[a-zA-Z]+(?:[-\'\s]{1}[a-zA-Z]+)*$/'],
                    'message' => 'Please enter a valid name. Names cannot have multiple "-", or apostrophes in a row. Names cannot have numbers. '
                ]
            ]);

            $validator
                ->scalar('l_name')
                ->maxLength('l_name', 32)
                ->requirePresence('l_name', 'create')
                ->notEmptyString('l_name')
                ->add('l_name', [
                    'validCharacters' => [
                        'rule' => ['custom', '/^[a-zA-Z]+(?:[-\'\s]{1}[a-zA-Z]+)*$/'],
                        'message' => 'Please enter a valid name. Names cannot have multiple "-", or apostrophes in a row. Names cannot have numbers. '
                    ]
                ]);


        //Age removed, validation unecessary
//        $validator
//            ->integer('age')
//            ->requirePresence('age', 'create')
//            ->notEmptyString('age');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email');

        $validator
            ->scalar('status')
            ->maxLength('status', 50)
            ->requirePresence('status', 'create')
            ->notEmptyString('status');

        $validator
            ->scalar('notes')
            ->maxLength('notes', 1000)
            ->allowEmptyString('notes');

        return $validator;
    }
}
