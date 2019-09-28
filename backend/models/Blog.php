<?php

namespace backend\models;

use common\abstracts\BlogAbtract;
use common\interfaces\PostTypeInterface;
use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "blog".
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property string $content
 * @property string $image_url
 * @property int $created_at
 * @property int $updated_at
 */
class Blog extends BlogAbtract {


	public function postTypeName() {
		return 'blog';
	}


}
