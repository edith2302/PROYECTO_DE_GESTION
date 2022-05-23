<?php
/** @var \yii\web\View $this */
/** @var array $obtieneAsignaturaPorCodigo */
/** @var array $todosLosUsuarios */

echo 'Todos los usuarios del sistema: '."<br><br>";
\common\util\Utilidades::beautifulVarDumpArray($todosLosUsuarios, false);
echo "<hr>";

echo 'Resultado de función obtieneAsignaturaPorCodigo($codigo_asignatura)'."<br><br>";
var_dump($obtieneAsignaturaPorCodigo);
echo "<hr>";

echo "Implementar todas las llamadas a la RESTApi que sean necesarias para su proyecto..."

?>