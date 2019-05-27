<?php
	
use app\models\Project;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Task */

$this->title = 'Create Task';
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$listData = $projects;
?>
<div class="task-create">

    <h1><?= Html::encode($this->title) ?></h1>
	<?php $form = ActiveForm::begin([
		'id' => 'project-create-form',
		'layout' => 'horizontal',
		'fieldConfig' => [
			'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
			'labelOptions' => ['class' => 'col-lg-1 control-label'],
		],
	]); ?>
	
	<?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
 
	<?= $form->field($model, 'description')->textarea() ?>
    
    <?= $form->field($model, 'status')->dropDownList(['toDo' => 'To Do', 'inProgress' => 'In Progress', 'done' => 'Done',]) ?>
    <?= json_encode($projects) ?>
    <?= $form->field($model, 'projects')->dropDownList(ArrayHelper::map($listData, 'id', 'name'),['prompt'=>'Select...']) ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
			<?= Html::submitButton('Create', ['class' => 'btn btn-primary', 'name' => 'project-create-button']) ?>
        </div>
    </div>
	
	<?php ActiveForm::end(); ?>


</div>
