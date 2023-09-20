<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Cb Model
 *
 * @method \App\Model\Entity\Cb newEmptyEntity()
 * @method \App\Model\Entity\Cb newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Cb[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Cb get($primaryKey, $options = [])
 * @method \App\Model\Entity\Cb findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Cb patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Cb[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Cb|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Cb saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Cb[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Cb[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Cb[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Cb[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class CbTable extends Table
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

        $this->setTable('cb');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
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
            ->scalar('hint')
            ->maxLength('hint', 128)
            ->requirePresence('hint', 'create')
            ->notEmptyString('hint');

        $validator
            ->scalar('content_type')
            ->maxLength('content_type', 32)
            ->requirePresence('content_type', 'create')
            ->notEmptyString('content_type');

        $validator
            ->scalar('content_value')
            ->requirePresence('content_value', 'create')
            ->notEmptyString('content_value');

        $validator
            //Validation for adding images in content blocks
            //Add validation; image cannot be empty, and the file can only be jpg, png, jpeg.
            ->notEmptyFile('content_image')
            ->add( 'content_image', [
                'mimeType' => [
                    'rule' => [ 'mimeType', [ 'image/jpg', 'image/png', 'image/jpeg' ] ],
                    'message' => 'Please upload only JPG, PNG, JPEG.',
                ],
                //Filesize is a rule that apparently exists, ensures an upper limit to how much data can be uploaded
                'fileSize' => [
                    'rule' => ['uploadedFile', ['maxSize' => '2MB']], // Adjust the size limit as needed
                    'message' => 'Image size must be 2MB or less.', // Change the message as needed
                ],
            ] );

        $validator
            ->scalar('previous_value')
            ->allowEmptyString('previous_value');

        $validator
            ->scalar('content_description')
            ->maxLength('content_description', 500)
            ->allowEmptyString('content_description');

        return $validator;
    }
}
