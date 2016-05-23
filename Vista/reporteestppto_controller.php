<?php

//coneccion y librerias
include("../Controller/Conexion.php");
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 
 */

//arreglo que guardara informacion de los filtros
$filter_data = array();

//funcion que

function create_var($var){

        if(isset($_POST[$var])){
                return $_POST[$var];
        }else{
                return null;
        }

}

	//que tipo de documento necesita
	$export=create_var('export');
	
	//PARA TESTING LIMIT
	//$filtro_limite = create_var(filtro_limite);
        
	$sql_add_constrains='';
        
function construir_filtro($filter_name,$filter_alias,
        $show_query_value,$sql_type,$sql_compare,&$save_in){

    //revisa si la variable esta en el post y continua
    if(isset($_POST[$filter_name])){

        $save_in[$filter_name]['name']=$filter_alias;
        $save_in[$filter_name]['change']=$show_query_value;
        $save_in[$filter_name]['query']=$_POST[$filter_name];
        $save_in[$filter_name]['state']=TRUE;
       

        $returnstr=' ';

        switch($sql_type){

            case '=':
                $returnstr.=' AND '.$sql_compare.' ';
                $returnstr.=' = ';
                $returnstr.=' "'.$_POST[$filter_name].'" ';
            break;
            case 'LIKE':
                $returnstr.=' AND '.$sql_compare.' ';
                $returnstr.=' LIKE ';
                $returnstr.=' "%'.$_POST[$filter_name].'%" ';
            break;
            case 'LIMIT':
                $returnstr.=' LIMIT ';
                $returnstr.=' '.$_POST[$filter_name].' ';
            break;
            case 'BETWEEN':
                $returnstr.=' AND '.$sql_compare.' ';
                $returnstr.=' BETWEEN ';
                $tempvar=explode(',', $_POST[$filter_name]);
                $returnstr.=' "'.$tempvar[0].'"';
                if(isset($tempvar[1])){
                    $returnstr.=' AND "'.$tempvar[1].'" ';
                }else{
                    $returnstr.=' AND "'.$tempvar[0].'" ';
                }
                $save_in[$filter_name]['items']=$tempvar;
            break;

        }

        return $returnstr;

    }else{

        $save_in[$filter_name]['state']=FALSE;
        return '';
    }

}
        
        
        
        //echo $tempqry;

$sql_add_constrains.=construir_filtro('filtro_ot','OT',
        FALSE,'=','ot.codigo_ot',$filter_data);

$sql_add_constrains.=construir_filtro('filtro_empresa','EMPRESA',
        TRUE,'=','e.cod_interno_empresa',$filter_data);

$sql_add_constrains.=construir_filtro('filtro_cliente','CLIENTE',
        TRUE,'=','c.codigo_interno_cliente',$filter_data);

$sql_add_constrains.=construir_filtro('filtro_producto','PRODUCTO',
        TRUE,'=','pr.id_procliente',$filter_data);;

$sql_add_constrains.=construir_filtro('filtro_director','DIRECTOR',
        TRUE,'=','dir.documento_empleado',$filter_data);

$sql_add_constrains.=construir_filtro('filtro_ejecutivo','EJECUTIVO',
        TRUE,'=','eje.documento_empleado',$filter_data);

$sql_add_constrains.=construir_filtro('filtro_referencia_ot','REFERENCIA OT',
        FALSE,'LIKE','ot.referencia',$filter_data);

$sql_add_constrains.=construir_filtro('filtro_estado_ppto','ESTADO PPTO',
        TRUE,'=','ppto.estado_presup',$filter_data);

$sql_add_constrains.=construir_filtro('filtro_fecha','FECHA',
        FALSE,'BETWEEN','DATE_FORMAT(ot.fecha_registro, "%Y-%m-%d")',$filter_data);;






//-----GET EMPRESA IMAGEN

$logo_empresa='';
$sqlempresa=mysql_query('SELECT logo FROM empresa WHERE cod_interno_empresa = '
        .$filter_data['filtro_empresa']['query'].' LIMIT 1');
while($row = mysql_fetch_assoc($sqlempresa)){
        $logo_empresa = $row['logo'];
}

//-----FIN GET EMPRESA IMAGEN


//----OBTENER INFORMACION OT------

$sql=mysql_query("
SELECT
c.nombre_comercial_cliente as CLIENTE,
pr.nombre_producto as PRODUCTO,
ot.codigo_ot OT,
ot.referencia as REFERENCIA,
CAST(ot.fecha_registro as DATE) as FECHA_OT,
CAST(ot.fecha_registro as TIME) as HORA_OT,
ppto.codigo_presup NUMNUM_PPTO_INTERNO,
ppto.numero_presupuesto NUMNUM_PPTO_EXTERNO,
ppto.referencia REFERENCIA_PPTO,
ppto.estado_presup ESTADO_PPTO,


dir.nombre_empleado as DIRECTOR__OCULTO__,
eje.nombre_empleado as EJECUTIVO__OCULTO__,
e.nombre_comercial_empresa as EMPRESA__OCULTO__




FROM
empresa e,
clientes c,
producto_clientes pr,
cabot ot,
empleado eje,
usuario u1,
empleado dir,
usuario u2,


cabpresup ppto


WHERE
ot.pk_nit_empresa_ot = e.cod_interno_empresa AND
ot.producto_clientes_pk_clientes_nit_procliente = c.codigo_interno_cliente AND
ot.producto_clientes_codigo_PRC = pr.id_procliente AND
ot.ejecutivo = u1.idusuario AND
u1.pk_empleado = eje.documento_empleado AND
ot.director = u2.idusuario AND
u2.pk_empleado = dir.documento_empleado AND




ppto.ot = ot.codigo_ot


".$sql_add_constrains." 


ORDER BY CLIENTE,PRODUCTO,OT




");


//tr.otpadre = ot.codigo_ot
/*
 


ast.pk_asignado as ASIGNADO,





ast.pk_tarea = tr.cod_int_tarea




*/

//--------fin obtener ifnormacion ot


$titles_data=array();
$body_data=array();

	
function build_file(){
    global $sql,$filter_data,$now_EXCEL,$now_PDF,$objPHPExcel,$titles_data,$body_data;
        $first=TRUE;
        $first2=TRUE;
        $header_data_html='';
    while($row = mysql_fetch_assoc($sql)){
        $temp_body=array();
        if($first){
                $first=false;
                foreach($row as $key => $item){
                    array_push($titles_data,$key);
                }
        }
        foreach($row as $key =>$item){
            if($key=='ESTADO_PPTO'){
                switch($item)
                {
                    case 1;$item = '< 20 %';break;
                    case 2;$item = 'APROBADO POR SISTEMA';break;
                    case 3;$item = 'APROBADO SIN EJECUTAR';break;
                    //case 4;$item = 'FACTURADO SIN PAGAR';break;
                    case 5;$item = 'FACTURADO SIN PAGAR';break;
                    case 6;$item = 'PAGADO';break;
                    case 7;$item = 'CERRADO';break;
                }
            }//FIN IF

            if($first2){										
                switch($key){
                    case 'EMPRESA__OCULTO__': 	$filter_data['filtro_empresa']['muestra'] = $item;break;
                    case 'CLIENTE': 	$filter_data['filtro_cliente']['muestra'] = $item;break;
                    case 'PRODUCTO': 	$filter_data['filtro_producto']['muestra'] = $item;break;

                    case 'OT': 		$filter_data['filtro_ot']['muestra'] = $item;break;
                    case 'DIRECTOR__OCULTO__': 	$filter_data['filtro_director']['muestra'] = $item;break;
                    case 'EJECUTIVO__OCULTO__': 	$filter_data['filtro_ejecutivo']['muestra'] = $item;break;
                    case 'REFERENCIA': 	$filter_data['filtro_referencia_ot']['muestra'] = $item;break;

                    case 'ESTADO_PPTO': 		$filter_data['filtro_estado_ppto']['muestra'] = $item;break;
                    case 'FECHA': 		$filter_data['filtro_fecha']['muestra'] = $item;break;

                    default:break;
                }
            }//FIN IF

                $temp_body[$key]=$item;

        }//FIN FOR EACH

            array_push($body_data,$temp_body);

    }//FIN WHILE SQL

//var_dump($body_data);

}//FIN FUNCION
	
        
$header_data=array();

build_file();

$header_data['logo'] = array($logo_empresa,'../images/logos/','C:/wamp/www/npruebas/images/logos/');
$header_data['titulo'] = 'REPORTE ESTADO PRESUPUESTOS';


$header_data['info']='Periodo: '.$filter_data['filtro_fecha']['items'][0].' A '.$filter_data['filtro_fecha']['items'][1];

//$header_data['info']='Generado: '.date('Y-m-d');
$header_data['size']=array(45,30,30,50,50,30,40,40,60,45);


                 
                 
                 
                 
                 $copyBody=$body_data;
                 
                 foreach($copyBody as $keyrow => $itemrow){
                 $canprint=FALSE;
                 
                 
                 
                     $body_data[$keyrow]['REFERENCIA']=substr($body_data[$keyrow]['REFERENCIA'],0,40);
                     $body_data[$keyrow]['REFERENCIA_PPTO']=substr($body_data[$keyrow]['REFERENCIA_PPTO'],0,40);

                 
                 
                 foreach($itemrow as $key => $item){
                 

                $body_data[$keyrow][$key]=mb_convert_encoding($body_data[$keyrow][$key],"UTF-8","UTF-8");

                 
                 if(isset($lastrow))
                 {
                 switch($key){
                 case 'CLIENTE':
                 if($lastrow[$key]==$item){
                 $body_data[$keyrow][$key]='';
                 $canprint=TRUE;
                 
                 
                 }else{
                 
                 }
                 break;
                 case 'OT';
                 case 'PRODUCTO':
                 case 'REFERENCIA':
                 case 'FECHA_OT':
                 case 'HORA_OT':
                 if($lastrow[$key]==$item){
                 if($canprint){
                 $body_data[$keyrow][$key]='';
                 }
                 }
                 break;
                 }
                 }
                 }
                 $lastrow=$itemrow;
                 }
                 
                 
                 function clean_tags($palabra){
                 
                 $palabra =  str_replace ('NUMNUM','#',$palabra);
                 
                 $palabra =  str_replace ('_',' ',$palabra);
                 
                 return $palabra;
                 }
                 
                 
                 
                 

        /////FUNCIONES DE IMPESION
        /*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/

                 
                 
                 
                 
                 
                 
                 
switch($export){
    case 'HTML':
        include 'reporteestppto_print_html.php';
        imprimir_html($header_data,$filter_data,$titles_data,$body_data);
        break;
    case 'EXCEL':
        //libreria de excel
        require_once 'PHPExcel/Classes/PHPExcel.php';
        require_once 'PHPExcel/Classes/PHPExcel/IOFactory.php';
        include 'reporteestppto_print_excel.php';
        imprimir_exc($header_data,$filter_data,$titles_data,$body_data);
        break;
    case 'PDF':
        //libreria de pdf
        require('../mpdf/mpdf.php');
        include 'reporteestppto_print_pdf.php';
        imprimir_pdf($header_data,$filter_data,$titles_data,$body_data);
        break;
    //case 'DOMPDF':
        //libreria de pdf
        //require('../dompdf/dompdf.php');
        //require_once '../dompdf/autoload.inc.php';
        
        //require_once("/dompdf/dompdf_config.inc.php");

        
        //include 'reporteot_print_dompdf.php';
        //imprimir_dompdf($header_data,$filter_data,$titles_data,$body_data);
        //break;
    //default:break;
}	
?>