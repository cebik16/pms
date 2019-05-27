<?php
	
	use mdm\admin\components\Configs;
	use yii\helpers\ArrayHelper;
	use yii\helpers\Html;
use yii\grid\GridView;
use mdm\admin\components\Helper;
	use yii\helpers\VarDumper;
	
	/* @var $this yii\web\View */
/* @var $searchModel mdm\admin\models\searchs\User */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('rbac-admin', 'Users');
$this->params['breadcrumbs'][] = $this->title;
    $roles = function (){
        $rolex = [];
	    foreach (Configs::authManager()->getRoles() as $role){
		    $rolex[] = $role->name;
        }
	    return $rolex;
    };

//	var_dump($roles()/*,Configs::authManager()->getRoles(), ArrayHelper::map(Configs::authManager()->getRoles(), 'name', 'name')*/);
?>
<div class="user-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php $array = [
	    'dataProvider' => $dataProvider,
	    'filterModel' => $searchModel,
	    'columns' => [
		    ['class' => 'yii\grid\SerialColumn'],
		    'username',
		    'email:email',
		    [
			    'attribute' => 'status',
			    'value' => function($model) {
				    return $model->status == 0 ? 'Inactive' : 'Active';
			    },
			    'filter' => [
                    0 => 'Inactive',
                    10 => 'Active'
                ]
		    ],
		    [
			    'attribute' => 'roles',
			    'value' => function($model) {
				    return  array_keys(Yii::$app->authManager->getRolesByUser($model->id))[0];
			    },
			    'filter' => $roles()
		    ],
		    [
			    'class' => 'yii\grid\ActionColumn',
			    'template' => Helper::filterActionColumn(['view', 'activate', 'delete']),
			    'buttons' => [
				    'activate' => function($url, $model) {
					    if ($model->status == 10) {
						    return '';
					    }
					    $options = [
						    'title' => Yii::t('rbac-admin', 'Activate'),
						    'aria-label' => Yii::t('rbac-admin', 'Activate'),
						    'data-confirm' => Yii::t('rbac-admin', 'Are you sure you want to activate this user?'),
						    'data-method' => 'post',
						    'data-pjax' => '0',
					    ];
					    return Html::a('<span class="glyphicon glyphicon-ok"></span>', $url, $options);
				    }
			    ]
		    ],
	    ],
    ];
    ?>
<!--    <pre>--><?//=var_dump($array['columns'][3])?><!--</pre>-->
    <?=
    GridView::widget($array);
        ?>
</div>
