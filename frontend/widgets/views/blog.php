<?php
/**
 * Date: 9/24/19
 * Time: 4:29 PM
 */

foreach ( $model as $i => $item ):
	$atl = '';
	if ( $i % 2 == 0 ) {
		$atl = 'alt';
	}
	$url_view = \yii\helpers\Url::to( [ '/blog/view', 'slug' => $item['slug'] ] );
	?>
    <div class="blog-card <?php echo $atl; ?>">
        <div class="meta">
            <a href="<?php echo $url_view ?>">
                <div class="photo"
                     style="background-image: url(<?php echo $item['image_url'] ?>)"></div>
            </a>
        </div>
        <div class="description">
            <h1><?php echo $item['title']; ?></h1>
            <h2><?php echo $item['description']; ?></h2>
            <p><?php echo $item['content']; ?></p>
			<?php

			if ( empty( $item['category'] ) ) {
				echo \yii\helpers\Html::a(
					'Uncategory',
					\yii\helpers\Url::to( [ 'blog/category' ] ),
					[ 'class' => 'text-info' ] );
			} else {
				echo \yii\helpers\Html::a(
					$item->categoryHasOne->name,
					\yii\helpers\Url::to( [
							'blog/category',
							'id' => $item['category'],
						]
					), [ 'class' => 'text-info' ] );
			}
			?>
            <p class="read-more">
                <a href="<?php echo $url_view ?>">Read More</a>
            </p>
        </div>
    </div>

<?php
endforeach;

?>


