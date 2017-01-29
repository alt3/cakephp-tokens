<?php
namespace Alt3\CakeTokens\Model\Table;

use Cake\Core\Exception\Exception;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use DateTimeImmutable;

/**
 * Tokens Model.
 */
class TokensTable extends Table
{
    /**
     * Initialize method.
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('alt3_cake_tokens');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->removeBehavior('Timestamp');
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
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('token', 'create')
            ->notEmpty('token')
            ->add('token', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->allowEmpty('category');

        $validator
            ->allowEmpty('foreign_alias');

        $validator
            ->allowEmpty('foreign_table');

        $validator
            ->allowEmpty('foreign_key');

        $validator
            ->allowEmpty('payload');

        $validator
            ->requirePresence('lifetime', 'create')
            ->notEmpty('lifetime');

        $validator
            ->add('use_once', 'valid', ['rule' => 'boolean'])
            ->allowEmpty('use_once');

        $validator
            ->add('status', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('status');

        $validator
            ->add('expires', 'valid', ['rule' => 'datetime'])
            ->requirePresence('expires', 'create')
            ->notEmpty('expires');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['token']));

        return $rules;
    }

    /**
     * Custom finder "validToken".
     *
     * @param \Cake\ORM\Query $query Query
     * @param array $options Options
     * @return \Cake\ORM\Query
     */
    public function findValidToken(Query $query, array $options)
    {
        $options += [
            'token' => null,
            'expires >' => new DateTimeImmutable(),
            'status' => false
        ];

        return $query->where($options);
    }

    /**
     * Set token status.
     *
     * @param int $id Token id
     * @param int $status Token status
     * @return bool|\Cake\ORM\Entity
     */
    public function setStatus($id, $status)
    {
        if (!is_numeric($status)) {
            throw new Exception('Status argument must be an integer');
        }

        $entity = $this->findById($id)->firstOrFail();
        $entity->status = $status;
        $this->save($entity);

        return $entity;
    }

    /**
     * Custom finder "allActive".
     *
     * @param \Cake\ORM\Query $query Query instance
     * @param array $options Options
     * @return \Cake\ORM\Query
     */
    public function findAllActive(Query $query, array $options)
    {
        $options += [
            'status' => false
        ];

        return $query->where($options);
    }

    /**
     * Deletes all expired tokens.
     *
     * @return bool
     */
    public function deleteAllExpired()
    {
        return $this->deleteAll([
            'expires <' => new DateTimeImmutable(),
        ]);
    }

    /**
     * Deletes all tokens that match passed status.
     *
     * @param int $status Token status
     * @return bool
     */
    public function deleteAllWithStatus($status)
    {
        if (!is_numeric($status)) {
            throw new Exception('Status argument must be an integer');
        }

        return $this->deleteAll([
            'status' => $status,
        ]);
    }
}
