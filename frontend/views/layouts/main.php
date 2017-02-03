<?php

/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use kartik\sidenav\SideNav;
use kartik\icons\Icon;
Icon::map($this);

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
     <link rel="shortcut icon" href="<?php echo Yii::$app->request->baseUrl; ?>/images/favicon.ico" type="image/x-icon" /> 
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Html::img('@web/images/logo.png', ['alt'=>'myApiary']),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Zaloguj', 'url' => ['/user/security/login']];
    } else {
		$menuItems = [
			['label' => 'Home', 'url' => ['/site/index']],
		];
        $menuItems[] = [
            'label' => 'Logout (' . Yii::$app->user->identity->username . ')', 
            'url' => ['/user/security/logout'],
            'linkOptions' => ['data-method' => 'post']
        ];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
		<?php if(!Yii::$app->user->isGuest): ?>
		<?= Alert::widget() ?>
        <div class="row">
            <div class="col-md-2">
                <?php 
                if (!Yii::$app->user->isGuest) {
                 echo SideNav::widget([
                    'type' => SideNav::TYPE_DEFAULT,
                    'encodeLabels' => false,
                    'activateItems' => true,
                    'heading' => false,
                    'items' => [
                        [
                            'url' => '/',
                            'label' => 'Home',
                            'icon' => 'home',
                            'active' => Yii::$app->controller->id==='site',
                        ],
                        [
                            'url' => Url::to(['/pasieki/index']),
                            'label' => Icon::show('cubes') . 'Apiaries',
                            //'icon' => 'glyphicon glyphicon-globe',
                            'active' => Yii::$app->controller->id==='pasieki',
                        ],
                        [
                            'url' => Url::to(['/pnie/index']),
                            'label' => Icon::show('archive') . 'Beehives',
                            //'icon' => 'glyphicon glyphicon-book',
                            'active' => Yii::$app->controller->id==='pnie',
                        ],
                        [
                            'url' => Url::to(['/dokarmiania/index']),
                            'label' => Icon::show('cutlery') . 'Feeding',
                            //'icon' => 'glyphicon glyphicon-book',
                            'active' => Yii::$app->controller->id==='dokarmiania',
                        ],
                        [
                            'url' => Url::to(['/miodobrania/index']),
                            'label' => Icon::show('battery-half') . 'Honey harvests',
                            //'icon' => 'glyphicon glyphicon-book',
                            'active' => Yii::$app->controller->id==='miodobrania',
                        ],
                        [
                            'url' => Url::to(['/matki/index']),
                            'label' => Icon::show('venus-double') . 'Queen bees',
                            //'icon' => 'glyphicon glyphicon-book',
                            'active' => Yii::$app->controller->id==='matki',
                        ],
                        [
                            'url' => Url::to(['/czujniki/index']),
                            'label' => Icon::show('thermometer') . 'Sensors',
                            //'icon' => 'glyphicon glyphicon-book',
                            'active' => Yii::$app->controller->id==='Czujniki',
                        ],
                        [
                            'url' => Url::to(['/koszty/index']),
                            'label' => Icon::show('usd') . 'Costs',
                            //'icon' => 'glyphicon glyphicon-book',
                            'active' => Yii::$app->controller->id==='koszty',
                        ],
                        [
                            'url' => Url::to(['/leczenia/index']),
                            'label' => Icon::show('medkit') . 'Treatments',
                            //'icon' => ,
                            'active' => Yii::$app->controller->id==='Leczenia',
                        ],     
                        [
                            'url' => Url::to(['/ulikiweselne/index']),
                            'label' => Icon::show('venus-mars') . 'Mating boxes',
                            //'icon' => 'glyphicon glyphicon-book',
                            'active' => Yii::$app->controller->id==='Ulikiweselne',
                        ],                           
                    ],
                ]);}; ?>             
            </div>
            <div class="col-md-10">
                <?php echo Breadcrumbs::widget([
                        'homeLink' => [
                            'label' => '<i class=" glyphicon glyphicon-home"></i>',
                            'url' => Yii::$app->homeUrl,
                            'encode' => false// Requested feature
                        ],
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]); ?>
                <?= $content ?>
            </div>
        </div>
		<?php else: ?>
			<?= $content ?>
		<?php endif ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; myApiary <?= date('Y') ?></p>

    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
