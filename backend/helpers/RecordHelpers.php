<?php
namespace app\helpers;
use yii;

class RecordHelpers
{
	public static function userHas($model_name)
	{
		$connection = \Yii::$app->db;
		$userid = \Yii::$app->user->identity->id;
		$sql = "SELECT ID_STAFF FROM $model_name WHERE user_id=:userid";
		$command = $connection->createCommand($sql);
		$command->bindValue(":userid", $userid);
		$result = $command->queryOne();
		if ($result == null) {
			return false;
		} else {
			return $result['ID_STAFF'];
		}
	}

	public static function userHasStaff($user_id)
	{
		$connection = \Yii::$app->db;
		$sql = "SELECT ID_STAFF FROM staff WHERE user_id=:userid";
		$command = $connection->createCommand($sql);
		$command->bindValue(":userid", $user_id);
		$result = $command->queryOne();
		if ($result == null) {
			return false;
		} else {
			return $result['ID_STAFF'];
		}
	}

	public static function userMustBeOwner($model_name, $model_id)
	{
		$connection = \Yii::$app->db;
		$userid = \Yii::$app->user->identity->id;
		$sql = "SELECT ID_STAFF FROM $model_name WHERE user_id=:userid AND ID_STAFF=:model_id";
		$command = $connection->createCommand($sql);
		$command->bindValue(":userid", $userid);
		$command->bindValue(":model_id", $model_id);
		if($result = $command->queryOne()) {
			return true;
		} else {
			return false;
		}
	}
}