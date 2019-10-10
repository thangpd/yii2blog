<?php
/**
 * Date: 9/25/19
 * Time: 12:11 PM
 */
$alt = '';
if ( $index % 2 == 0 ) {
	$alt = 'alt';
}
$url_view = \yii\helpers\Url::to( [ '/blog/view', 'slug' => $model['slug'] ] );

?>
<div class="blog-card <?php echo $alt; ?>">
    <div class="meta">
        <a href="<?php echo $url_view ?>">
            <div class="photo"
                 style="background-image: url(<?php echo $model['image_url'] ?>)"></div>
        </a>
    </div>
    <div class="description">
        <h1><?php echo $model['title']; ?></h1>
        <h2><?php echo $model['description']; ?></h2>
        <p><?php echo $model['content']; ?></p>
		<?php

		if ( empty( $model['category'] ) ) {
			echo \yii\helpers\Html::a(
				'Uncategory',
				\yii\helpers\Url::to( [ 'blog/category' ] ),
				[ 'class' => 'text-info' ] );
		} else {
			echo \yii\helpers\Html::a(
				$model->categoryHasOne->name,
				\yii\helpers\Url::to( [
						'blog/category',
						'id' => $model['category'],
					]
				), [ 'class' => 'text-info' ] );
		}
		?>
        <p class="read-more">
            <a href="<?php echo $url_view ?>">Read More</a>
        </p>
    </div>
</div>






