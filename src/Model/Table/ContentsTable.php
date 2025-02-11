<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Contents Model
 *
 * @property \App\Model\Table\TicketsTable&\Cake\ORM\Association\BelongsTo $Tickets
 *
 * @method \App\Model\Entity\Content newEmptyEntity()
 * @method \App\Model\Entity\Content newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Content[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Content get($primaryKey, $options = [])
 * @method \App\Model\Entity\Content findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Content patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Content[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Content|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Content saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Content[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Content[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Content[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Content[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ContentsTable extends Table
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

        $this->setTable('contents');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Tickets', [
            'foreignKey' => 'ticket_id',
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
            ->scalar('content')
            ->maxLength('content', 500)
            ->notEmptyString('content');

        $validator
            ->dateTime('createtime')
            ->notEmptyDateTime('createtime');

        $validator
            ->integer('ticket_id')
            ->notEmptyString('ticket_id');

        $validator
            ->scalar('content_type')
            ->maxLength('content_type', 10)
            ->requirePresence('content_type', 'create')
            ->notEmptyString('content_type');

        $validator
            //Validation for adding images in Content
            //Add validation; image cannot be empty, and the file can only be jpg, png, jpeg.
            ->notEmptyFile('image')
            ->add( 'image', [
                'mimeType' => [
                    'rule' => [ 'mimeType', [ 'image/jpg', 'image/png', 'image/jpeg' ] ],
                    'message' => 'Please upload only jpg and png.',
                ],
                //Filesize is a rule that apparently exists, ensures an upper limit to how much data can be uploaded
                'fileSize' => [
                    'rule' => ['uploadedFile', ['maxSize' => '2MB']], // Adjust the size limit as needed
                    'message' => 'Image size must be 2MB or less.', // Change the message as needed
                ],
            ] );

        $validator
            //Validation for adding files in Content
            //Add validation; file cannot be empty, and the file can only be PDF, DOCX, TXT.
            ->notEmptyFile('file')
            ->add( 'file', [
                'mimeType' => [
                    'rule' => [ 'mimeType', [ 'application/pdf', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'text/plain' ] ],
                    'message' => 'Please upload only PDF, DOCX, or TXT files',
                ],
                //Filesize is a rule that apparently exists, ensures an upper limit to how much data can be uploaded
                'fileSize' => [
                    'rule' => ['uploadedFile', ['maxSize' => '100MB']], // Adjust the size limit as needed
                    'message' => 'File size must be 100MB or less.', // Change the message as needed
                ],
            ] );

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
        $rules->add($rules->existsIn('ticket_id', 'Tickets'), ['errorField' => 'ticket_id']);

        return $rules;
    }
}
