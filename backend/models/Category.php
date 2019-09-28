<?php

namespace backend\models;

use common\interfaces\PostTypeInterface;
use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property int $parent
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class Category extends \yii\db\ActiveRecord implements PostTypeInterface {

	public function postTypeName() {
		// TODO: Implement postTypeName() method.
		return 'blog';
	}
}
