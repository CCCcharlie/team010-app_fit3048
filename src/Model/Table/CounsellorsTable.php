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
            ->notEmptyString('f_name')
            ->add('f_name', [
                'validCharacters' => [
                    'rule' => ['custom', '/^(?! )[a-zA-Z]+(?:[-\'\s]{1}[a-zA-Z]+)*$/'],
                    'message' => 'Please enter a valid name. Names cannot have multiple "-", or apostrophes in a row. Names cannot have numbers. Names cannot start with a space. Names must be separated with
                    a "-" instead of a space. Name cannot have trailling spaces'
                ]
            ]);

        $validator
            ->scalar('l_name')
            ->maxLength('l_name', 32)
            ->requirePresence('l_name', 'create')
            ->notEmptyString('l_name')
            ->add('l_name', [
                'validCharacters' => [
                    'rule' => ['custom', '/^(?! )[a-zA-Z]+(?:[-\'\s]{1}[a-zA-Z]+)*$/'],
                    'message' => 'Please enter a valid name. Names cannot have multiple "-", or apostrophes in a row. Names cannot have numbers. Names cannot start with a space. Names must be separated with
                    a "-" instead of a space Name cannot have trailling spaces'
                ]
            ]);

        $validator
            ->scalar('notes')
            ->maxLength('notes', 150)
            ->allowEmptyString('notes');

        $validator
            ->scalar('email')
            ->maxLength('email', 320)
            ->requirePresence('email', 'create')
            ->notEmptyString('email')
            ->add('email', [
                'validEmail' => [
                    'rule' => 'email',
                    'message' => 'Please enter a valid email address. Eg. test@holistichealings.com'
                ],
                'emailContainsAt' => [
                    'rule' => ['custom', '/@/'],
                    'message' => 'Your e-mail must contain the @ symbol.'
                ],
                'noConsecutiveDelimiters' => [
                    'rule' => ['custom', '/^(?!.*(\.\.|\@\@)).*$/'],
                    'message' => 'Your e-mail address cannot contain consecutive delimiters (e.g. ".." or "@@").'
                ],
                'noSpecialCharacters' => [
                    'rule' => ['custom', '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'],
                    'message' => 'Your e-mail address can only contain letters, digits, hyphens, underscores, dots, and at symbols.'
                ]
            ]);

        $validator
            ->scalar('phone')
            ->maxLength('phone', 20)
            ->add('phone', 'custom', [
                'rule' => ['custom', '/\(\+\d{2}\)\s?\d{3}[-\s]?\d{3}[-\s]?\d{3}/'],
                'message' => 'Only non-alphabetic characters are allowed.'
            ])
            ->allowEmptyString('phone');

        $validator
            ->integer('cust_id')
            ->allowEmptyString('cust_id');

        // Quick Custom rule to check if a string does not start with a space

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
