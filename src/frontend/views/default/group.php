<?php
use yii\widgets\LinkPager;
use luya\admin\filters\MediumCrop;

/* @var $this \luya\web\View */
/* @var $provider \yii\data\ActiveDataProvider */
?>
<?php foreach($provider->models as $item): ?>
    <?php /** @var \vavepl\portfolio\models\Item $item */ ?>
    <h2><?= $item->name; ?></h2>
    <?php if ($item->main_img !== false): ?>
    <div class="row">
    	<div class="col-md-3">
    		<img src="<?= $item->main_img->applyFilter(MediumCrop::identifier())->source; ?>" class="img-responsive img-rounded" />
    	</div>
    </div>
    <?php endif; ?>
    <p style="margin-top:15px;">
        <a class="btn btn-primary" href="<?= $item->viewUrl; ?>">Voir plus</a>
    </p>
<?php endforeach; ?>

<?= LinkPager::widget(['pagination' => $provider->pagination]); ?>