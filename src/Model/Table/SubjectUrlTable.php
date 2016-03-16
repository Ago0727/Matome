<?php
namespace App\Model\Table;

use App\Model\Entity\SubjectUrl;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SubjectUrl Model
 *
 */
class SubjectUrlTable extends Table
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

        $this->table('subject_url');
        $this->displayField('id');
        $this->primaryKey('id');
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
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('subject_name', 'create')
            ->notEmpty('subject_name');

        $validator
            ->requirePresence('subject_url', 'create')
            ->notEmpty('subject_url');

        $validator
            ->requirePresence('dat_data', 'create')
            ->notEmpty('dat_data');

        return $validator;
    }
}
