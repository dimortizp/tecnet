<?php
	$this->breadcrumbs=array(
		'Reportes'
	);
?>

<h1>Reporte <?php echo $type?></h1>

<?php 
	switch ($type) {
		case 'Historial':
			echo $this->renderPartial('_viewHistorial', array());
			break;
		case 'Tecnico':
			echo $this->renderPartial('_viewTecnico', array());
			break;		
		default:?>
			<h2>NO SE ENCONTRO NINGUNO</h2>
		<?php
			break;
	}
?>
