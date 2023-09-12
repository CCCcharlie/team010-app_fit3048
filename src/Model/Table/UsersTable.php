<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @method \App\Model\Entity\User newEmptyEntity()
 * @method \App\Model\Entity\User newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class UsersTable extends Table
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

        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        //Added this cause it was lacking the association when baking it for the second time
        $this->hasMany('Tickets', [
            'foreignKey' => 'staff_id',
        ]);

        //Part of authentication
        $this->addBehavior('CanAuthenticate');
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

//        $validator
//            ->integer('age')
//            ->requirePresence('age', 'create')
//            ->notEmptyString('age');

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
            ->scalar('role')
            ->requirePresence('role', 'create')
            ->notEmptyString('role')
            ->add('role', 'inList', [
                'rule' => ['inList', ['root', 'admin', 'staff', 'user']],
                'message' => 'Please select a valid role.'
            ]);

        $validator
            ->scalar('password')
            ->maxLength('password', 124)
            ->requirePresence('password', 'create')
            ->notEmptyString('password')
            ->add('password', 'custom', [
                'rule' => function ($value, $context) {
                    // Check if the password has at least 8 characters and contains at least one number
                    return (strlen($value) >= 8) && preg_match('/\d/', $value);
                },
                'message' => 'Password must be at least 8 characters long and contain at least one number'
            ]);

        $validator
            ->scalar('timezone')
            ->maxLength('timezone', 50)
            ->allowEmptyString('timezone');

//        $validator
//            ->boolean('admin_status')
//            ->requirePresence('admin_status', 'create')
//            ->notEmptyString('admin_status');

        $validator
            ->scalar('nonce')
            ->maxLength('nonce', 128)
            ->allowEmptyString('nonce');

        $validator
            ->dateTime('nonce_expiry')
            ->notEmptyDateTime('nonce_expiry');

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
        $rules->add($rules->isUnique(['email']), ['errorField' => 'email']);

        return $rules;
    }
}
