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

	private $path;

	public function __construct() {
		$this->path = \Yii::$app->basePath;
	}

	public function uploadFile( $model, $attribute, $path = '/web/uploads/' ) {

		$file = UploadedFile::getInstance( $model, $attribute );

		if ( ! empty( $file ) ) {
			$file->name = str_replace( ' ', '_', $file->name );
			$file->name = $this->uniqueFileName( $file->name );

			if ( ! empty( $file->name ) ) {
				$res = $file->saveAs( $this->path . $path . $file->name );
				if ( ! $res ) {
					\Yii::$app->session->addFlash( 'error', "Can't upload image" . $file->name );
				} else {
					\Yii::$app->session->addFlash( 'success', "Uploaded image succeed" );

					return Url::to( '@web/uploads/' . $file->name, true );
				}

			}
		}

		return '';
	}

	/**
	 * Check if file name exists and add more suffix number
	 *
	 */

	public function uniqueFileName( &$file_name, $path = '/web/uploads/', $level = 1 ) {

		$checkPath = $this->path . $path;
		if ( file_exists( $checkPath . $file_name ) ) {
			$tmp = $file_name;
			$tmp = preg_replace( '#(.*?)\.#', '${1}_' . $level . '.', $tmp );
			if ( file_exists( $checkPath . $tmp ) ) {
				$this->uniqueFileName( $file_name, $path, $level + 1 );
			} else {
				$file_name = $tmp;

				return $file_name;
			}
		}

		return $file_name;
	}

	/**
	 * Delete image when blog is deleted or updated image
	 *
	 * @param integer $id
	 *
	 * @return boolean
	 */
	public static function deleteFile( $model, $attribute, $path = '@web/uploads/' ) {


		return false;
	}


}