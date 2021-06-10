<?php

use app\models\Importitem;
use kartik\grid\GridView;
use yii\bootstrap\Html;
use kartik\export\ExportMenu;
use yii\data\ActiveDataProvider;

$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],
    'city',
    'latitude',
    'longitude',
    'lighting',
    'size',
    'sideType',
    'side',
    'priceType',
    'placementPrice',
    'ndsType',
    'period',
    'impressionsPerDay',
];
/** @var string $title */
/** @var  ActiveDataProvider $dataProvider */
$this->title = $title;
?>

<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns
    ]);?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
    ])
    ?>
</div>
