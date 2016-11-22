<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $login
 * @property string $password
 * @property integer $role_id
 * @property string $first_name
 * @property string $last_name
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['login', 'password', 'role_id'], 'required'],
            [['role_id'], 'integer'],
            [['login', 'first_name', 'last_name'], 'string', 'max' => 256],
            [['password'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Login',
            'password' => 'Password',
            'role_id' => 'Role ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
        ];
    }
}
