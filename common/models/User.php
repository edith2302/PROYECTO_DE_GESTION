<?php

namespace common\models;
use Yii;
use yii\db\ActiveRecord;

class User extends ActiveRecord /*\yii\base\BaseObject*/ implements \yii\web\IdentityInterface{ 
    
    public static function getDb()
    {
        return Yii::$app->db;
    }
    
    public static function tableName()
    {
        return 'user';
    }

    public static function isUserAdmin($id)
    {
       if (User::findOne(['id' => $id, 'activate' => '1', 'role' => 0])){
        return true;
       } else {

        return false;
       }

    }

    public static function isUserProfesorAsignatura($id)
    {
       if (User::findOne(['id' => $id, 'activate' => '1', 'role' => 1])){
       return true;
       } else {

       return false;
       }
    }

    public static function isUserEstudiante($id)
    {
        if (User::findOne(['id' => $id, 'activate' => '1', 'role' => 2])){
            return true;
        } else {

            return false;
        }

    }

    public static function isUserProfesorICINF($id)
    {
        if (User::findOne(['id' => $id, 'activate' => '1',  'role' => 3])){
            return true;
        } else {

            return false;
        }
    }
    public static function isUserComision($id)
    {
        if (User::findOne(['id' => $id, 'activate' => '1',  'role' => 4])){
            return true;
        } else {

            return false;
        }
    }

    public static function isUserProfesorGuia($id)
    {
        if (User::findOne(['id' => $id, 'activate' => '1',  'role' => 5])){
            return true;
        } else {

            return false;
        }
    }

    public static function isUserJefaturaCarrera($id)
    {
        if (User::findOne(['id' => $id, 'activate' => '1',  'role' => 6])){
            return true;
        } else {

            return false;
        }
    }
    /**
     * @inheritdoc
     */
    
    /* busca la identidad del usuario a través de su $id */

    public static function findIdentity($id)
    {
        
        $user = User::find()
                ->where("activate=:activate", [":activate" => 1])
                ->andWhere("id=:id", ["id" => $id])
                ->one();
        
        return isset($user) ? new static($user) : null;
    }

    /**
     * @inheritdoc
     */
    
    /* Busca la identidad del usuario a través de su token de acceso */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        
        $users = User::find()
                ->where("activate=:activate", [":activate" => 1])
                ->andWhere("accessToken=:accessToken", [":accessToken" => $token])
                ->all();
        
        foreach ($users as $user) {
            if ($user->accessToken === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    
    /* Busca la identidad del usuario a través del username */
    public static function findByUsername($username)
    {
        $users = User::find()
                ->where("activate=:activate", ["activate" => 1])
                ->andWhere("username=:username", [":username" => $username])
                ->all();
        
        foreach ($users as $user) {
            if (strcasecmp($user->username, $username) === 0) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    
    /* Regresa el id del usuario */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    
    /* Regresa la clave de autenticación */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    
    /* Valida la clave de autenticación */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
        //return $this->authKey === $authKey;
    }
    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        /* Valida el password */
        if (crypt($password, $this->password) == $this->password) {
            return $password === $password;
        } 
    }

    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->authKey = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }
    
    /**
     * Generates new token for email verification
     */
    public function generateEmailVerificationToken()
    {
        $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
        /* Valida el password */
        if (crypt($password, $this->password) == $this->password) {
            return $password === $password;
        }



    }
    
}