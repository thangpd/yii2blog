<?php

namespace backend\models;

use common\abstracts\BlogModelAbtract;
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
class BlogModel extends BlogModelAbtract {


	public function postTypeName() {
		return 'blog';
	}


	public function postTypeCategory() {
		return Category::class;
		// TODO: Implement postTypeCategory() method.
	}

	public function getLabelName() {
		return 'Blog';
		// TODO: Implement getLabelName() method.
	}

	public function rules() {
		$parent = parent::rules();

		return array_merge( $parent, [
			[ [ 'category' ], 'integer' ],
			[ [ 'title' ], 'string', 'max' => 255 ],
			[ [ 'slug' ], 'string', 'max' => 100 ],
			[ [ 'image_url' ], 'file', 'extensions' => 'jpg, gif, jpeg,png' ],
		] );
	}

}
