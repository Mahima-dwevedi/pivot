<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;

?>
<div class="container">
    <div class="row">
		<?php foreach ($varPageData

		as $data): ?>
        <div class="page_title col-lg-12"><?php echo $data->pageTitle; ?></div>
        <div class="col-lg-8 content_wrap">
			<?= Html::decode("{$data ->pageContent}") ?>
			<?php endforeach; ?>
        </div>
    </div>
</div>
