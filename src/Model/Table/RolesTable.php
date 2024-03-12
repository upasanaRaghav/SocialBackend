<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class RolesTable extends Table
{
    
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('roles');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
    }
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

            $validator
            ->scalar('visibility')
            ->maxLength('visibility', 100)
            ->requirePresence('visibility', 'create')
            ->notEmptyString('visibility')
            ->add('visibility', 'validVisibility', [
                'rule' => ['inList', ['public', 'private']],
                'message' => 'Please select a valid visibility option (public or private).'
            ]);
        return $validator;
    }

 
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
