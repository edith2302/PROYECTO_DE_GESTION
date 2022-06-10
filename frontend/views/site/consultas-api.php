<?php
/** @var \yii\web\View $this */
/** @var array $obtieneAsignaturaPorCodigo */
/** @var array $todosLosUsuarios */
$this->params['breadcrumbs'][] = ['label'=>'Ejemplo Breadcrumb con URL', 'url'=>\yii\helpers\Url::to(['site/index'])];
$this->params['breadcrumbs'][] = "Consultas API";
?>

<h1>Consultas API</h1><br>
Todos los usuarios del sistema: <br><br>
<?php \common\util\Utilidades::beautifulVarDumpArray($todosLosUsuarios, false);?>
<hr>

Resultado de función obtieneAsignaturaPorCodigo($codigo_asignatura)<br><br>
<?php var_dump($obtieneAsignaturaPorCodigo); ?>
<hr>

Implementar todas las llamadas a la RESTApi que sean necesarias para su proyecto...
