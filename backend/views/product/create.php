<?php
/**
 * Date: 9/28/19
 * Time: 10:54 AM
 */


echo '<pre>';
print_r( $model->attributes() );
echo '</pre>';

echo $this->render( '_form', [ 'model' => $model, 'category' => $category ] );


