<?php
/* @var $this ServicioController */
/* @var $model Servicio */

$this->breadcrumbs = array(
    'Servicios' => array('index'),
    'Manage',
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#servicio-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php 
Yii::app()->getClientScript()->registerCssFile(Yii::app()->request->baseUrl.'/css/fancybox/jquery.fancybox.css?v=2.1.5');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/libs/jquery.fancybox.js?v=2.1.5', CClientScript::POS_HEAD);
Yii::app()->getClientScript()->registerCssFile(Yii::app()->request->baseUrl.'/css/ui.jqgrid.css');
Yii::app()->getClientScript()->registerCssFile('http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css');
Yii::app()->clientScript->registerScriptFile('http://code.jquery.com/ui/1.10.3/jquery-ui.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/libs/grid.locale-es.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/libs/jquery.jqGrid.src.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScript('helloscript',"init();",CClientScript::POS_READY);
?>

<h1>Manage Servicios</h1>

<p>
    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'servicio-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'k_idServicio',
        'n_nomServicio',
        'v_costoServicio',
        array(
            'class' => 'CButtonColumn',
            'template' => '{view} {update} {delete} {asign}',
            'buttons' => array
                (
                'asign' => array
                    (
                    'label' => 'asignar/desasignar',
                    'imageUrl' => Yii::app()->getBaseUrl(true) . "/images/calificar.png",
                    'url' => '"#servicio_".$data->k_idServicio',
                    'htmlOptions' => 'width:16px, heigth:16px',
                    //'click'=>'js:function(){fancy("'.Yii::app()->createUrl("producto/AsignaServicio").'/'..'");return false;}',
                    'options' => array(
                        'class' => 'assing',
                    ),
                ),
            ),
        ),
    ),
));
?>

<script type="text/javascript">
init=function() {
    $("a.assing").fancybox({
		'transitionIn'	:	'elastic',
		'transitionOut'	:	'elastic',
		'speedIn'		:	600, 
		'speedOut'		:	200, 
		'overlayShow'	:	false
	});
} 
</script>
<?php
$servicios = Servicio::model()->findAll();
foreach ($servicios as $val){
    echo $this->renderPartial('asigna', array('model'=>$val));
}
?>


