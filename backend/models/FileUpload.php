<?php
/**
 * Date: 9/24/19
 * Time: 1:51 PM
 */

namespace backend\models;

use yii\base\Model;
use yii\helpers\Url;
use yii\web\UploadedFile;

class FileUpload extends Model {

	public function uploadFile( $model,$attribute, $path ) {

		$file = UploadedFile::getInstance( $model, $attribute);

		if ( ! empty( $file ) ) {
			$res = $file->saveAs( $path . $file->name );
			if ( ! $res ) {
				\Yii::$app->session->addFlash( 'error', "Can't upload image" . $file->name );
			} else {
				\Yii::$app->session->addFlash( 'success', "Uploaded image succeed" );

				return Url::to( '@web/uploads/' . $file->name, true );
			}

		}

		return '';
	}


}