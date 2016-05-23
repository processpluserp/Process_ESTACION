<?php
//////-------FILTROS----OBLIGATORIOS-----/////
//tipo de documento a ver
$_POST['export']='HTML';

//siempre debe haber un filtro de empresa
$_POST['filtro_empresa']=2;
//$_POST['filtro_director']='j';
//--PARA--TESTING--//

$elnuevo=true;

// limite de resultados
//$_POST['filtro_limite']=100;

$_POST['filtro_director']='CLARA JIMENA';

$_POST['filtro_ejecutivo']='LINA DAMARIS';

//$_POST['filtro_referencia']='rotu';

//$_POST['filtro_estado']=1;

//$_POST['filtro_cliente']=3;

//$_POST['filtro_producto']=2;

//en caso de no existir fecha usa la de hoy
$hoy='2016-01-12';
//$_POST['filtro_fecha']=$hoy;
//$_POST['filtro_fecha']=$hoy.','.$hoy;
$_POST['filtro_fecha']='2015-01-12,2017-01-19';



/////////------FILTROS-------//////////

//$_POST['filtro_ot']='CLP0';

if($elnuevo)
    {include 'reporteestppto_controller.php';
}
else
    {
    
    }
?>