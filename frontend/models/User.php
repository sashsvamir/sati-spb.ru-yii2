<?php
namespace frontend\models;

use yii\base\Model;
use yii\web\IdentityInterface;

/**
 * User model
 */
class User extends Model implements IdentityInterface
{
	public static function findIdentity($id)
	{
		return null;
	}

	public static function findIdentityByAccessToken($token, $type = null)
	{
		return null;
	}

	public function getId()
	{
		return '';
	}

	public function getAuthKey()
	{
		return '';
	}

	public function validateAuthKey($authKey)
	{
		return false;
	}

}
