<?php
/**
 * Date: 9/28/19
 * Time: 5:58 PM
 */

namespace common\components;


use yii;

class ParseActionId {

	public static function parseActionId() {
		$parse_request = Yii::$app->urlManager->parseRequest( Yii::$app->request );
		if ( strpos( $parse_request[0], "/" ) ) {
			$strpos = strpos( $parse_request[0], "/" );
		} else {
			$strpos = strlen( $parse_request[0] );
		}
		$action_id = substr( $parse_request[0], 0, $strpos );

		return $action_id;
	}


}