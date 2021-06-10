<?php
/** @var $history array */
/** @var $import Import  */
$this->title = 'История импортов';
$this->params['breadcrumbs'][] = $this->title;

use app\models\Import;
use yii\bootstrap\Html; ?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <ul class="list-group">
            <?foreach ($history as $import):?>
                <li class="list-group-item">
                    <?=Html::a($import->getDateFmt('d.m.Y H:i') , ['/import/item', 'importID' => $import->id]) ?>
                </li>
            <?endforeach;?>
        </ul>
    </div>

</div>
