<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PersonSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Expenses of People';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="person-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create expense for Person', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'person_id',
            'income',
            'expense',
            'total_balance',
            'details:ntext',
            'date_capture',
            //'user_id',

            ['label'=>'User Name',
                'attribute'=>'user_id',
                'value'=>function($model){
                            $backend_user=\app\models\BackendUser::find()->where(['id'=>$model->user_id])->one();
                            return $backend_user->username;
                }

            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
