<?php
	
	use yii\helpers\Html;
	use yii\bootstrap\ActiveForm;
	use kartik\date\DatePicker;
	
	/* @var $this yii\web\View */
	/* @var $model app\models\Project */
	
	$this->title = 'Create Project';
	$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
	$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-create">

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
	
	<?= $form->field($model, 'startDate')->widget(DatePicker::class,
		[
			'name' => 'startDate',
			'options' => ['placeholder' => 'Select issue date ...'],
			'pluginOptions' => [
				'format' => 'yyyy-mm-dd',
				'todayHighlight' => true
			]
		]
	) ?>
	
	<?= $form->field($model, 'duration')->textInput() ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
			<?= Html::submitButton('Create', ['class' => 'btn btn-primary', 'name' => 'project-create-button']) ?>
        </div>
    </div>
	
	<?php ActiveForm::end(); ?>


</div>
