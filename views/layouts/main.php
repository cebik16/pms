<?php
	
	/* @var $this \yii\web\View */
	
	/* @var $content string */
	
	use app\widgets\Alert;
	use yii\helpers\Html;
	use yii\bootstrap\Nav;
	use yii\bootstrap\NavBar;
	use yii\widgets\Breadcrumbs;
	use app\assets\AppAsset;
	use yii\widgets\Menu;
	
	AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
	<?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
	<?php
		NavBar::begin([
			'brandLabel' => Yii::$app->name,
			'brandUrl' => Yii::$app->homeUrl,
			'options' => [
				'class' => 'navbar-inverse navbar-fixed-top',
			],
		]);
		//    var_dump(Yii::$app->user);exit;
		
		
		$items = [
			['label' => 'Home', 'url' => ['/site/index']],
		];
		
		if (Yii::$app->user->can('admin') || Yii::$app->user->identity && Yii::$app->user->identity->username == 'admin') {
			$items[] = ['label' => 'Admin', 'url' => ['/admin']];
		}
		
		if (Yii::$app->user->can('task')) {
			$items[] = [
				'label' => 'Tasks',
				'items' => [
					['label' => 'Tasks List', 'url' => ['/task/index']],
					['label' => 'Create Task', 'url' => ['/task/create']],
					'<li class="divider"></li>',
					'<li class="dropdown-header">Dropdown Header</li>',
				],
			];
		}
		
		if (Yii::$app->user->can('project')) {
			$items[] = [
				'label' => 'Projects',
				'items' => [
					['label' => 'Projects List', 'url' => ['/project/index']],
					['label' => 'Create Project', 'url' => ['/project/create']],
					'<li class="divider"></li>',
					'<li class="dropdown-header">Dropdown Header</li>',
				],
			];
		}
		
		if (Yii::$app->user->isGuest) {
			$items[] = ['label' => 'Login', 'url' => ['/site/login']];
			$items[] = ['label' => 'Signup', 'url' => ['/site/signup']];
		} else {
			$items[] = '<li>'
				. Html::beginForm(['/site/logout'], 'post')
				. Html::submitButton(
					'Logout (' . Yii::$app->user->identity->username . ')',
					['class' => 'btn btn-link logout']
				)
				. Html::endForm()
				. '</li>';
		}
		
		echo $nav = Nav::widget([
			'options' => ['class' => 'navbar-nav navbar-right'],
			'items' => $items,
		]);
		
		NavBar::end();
	?>
    <!--    <pre>--><? //= var_dump($items, $add_items); ?><!--</pre>-->

    <div class="container">
		<?= Breadcrumbs::widget([
			'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
		]) ?>
		<?= Alert::widget() ?>
		<?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Cebik <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
