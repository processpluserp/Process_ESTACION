<?php

function imprimir_pdf($header_data,$filter_data,$titles_data,$body_data){


    
    
    
        $use_divs=false;

        $prehtml.= 	'<!DOCTYPE html>';
        $prehtml.= 	'<html>';
        $prehtml.= 		'<head>';
        $prehtml.= 		'<title>REPORTE DE OTS</title>';
        $prehtml.= 		'<meta charset="UTF-8">';
        $prehtml.= 		'</head>';
        $prehtml.=   		'<body>';
        $prehtml.=  '



        <div class="general_container">	';

$headerhtml.=		'<div class="data_header">';


$headerhtml.=	'<div class="header_logo header_item">';
$headerhtml.=		'<div class=header_content_image>';

$headerhtml.=		'</div>';
$headerhtml.=	'</div>';

$headerhtml.=	'<div class="header_title header_item">';
$headerhtml.= 		'<div class=header_content_title><br><br><br>'.$header_data['titulo'].'</div>';
$headerhtml.=	'</div>';

$headerhtml.=	'<div class="header_info header_item">';
$headerhtml.=		'<div class=header_content_info><br><br><br>'.$header_data['info'].'</div>';;
$html.=	'</div>';


        $html.='</div> <br><br>		

                <div class="data_filter">';

        foreach($filter_data as $row){

                if($row['state'] &&
                 $row['name'] != 'FECHA'&& $row['name'] != 'LIMITE'
                )
                {	
                        $classfilter0=' filter_name filter_item';
                        $classfilter1=' filter_value filter_item';
                        $classfilter2=' filter_sample filter_item';

                        $classfilter=' filter_item';
                        $html.= '<div class="filter_row">';
                        $html.= '<div class="'.$classfilter.$classfilter0.'">'.$row['name'].' : ';

                        if($row['name']== 'EJECUTIVO' OR $row['name']== 'REFERENCIA' OR $row['name']== 'DIRECTOR'){
                                //$html.= '<div class="'.$classfilter.$classfilter1.'">'.$row['query'].'</div>';
                                $html.= $row['query'].'</div>';
                        }else{
                                //$html.= '<div class="'.$classfilter.$classfilter2.'">'.$row['muestra'].'</div>';
                                $html.= $row['muestra'].'</div>';
                        }
                        $html.= '</div>';
                }

        }

        if($use_divs){
            
            
        $div_or_table='div';
        $div_or_tr='div';
        $div_or_td='div';
        
        
        }else{
            
        $div_or_table='table';
        $div_or_tr='tr';
        $div_or_td='td';
        
        
            
        }
        
        $html.=	'</div> <br><br>		
                <div class="data_content">';
        $html.= '	<'.$div_or_table.' class="data_body">';


        $runonce=TRUE;
        
        $valor_total=0;

        foreach($body_data as $row){
                $class_body='item_body ';

                $html.= '<'.$div_or_tr.' class="body_row">';
                
                if($runonce){
                    
                    $runonce=false;
                    foreach($titles_data as $key => $item){
                     $class_body='item_body ';

                    $class_body.=' item_'.$item;
                    
                    
                        if(!strpos($item, '__OCULTO__') !== false){
                            $html.= '	<'.$div_or_td.' class="item_title_body '.$class_body.'" >'.clean_tags($item).'</'.$div_or_td.'>';
                        }
                    
                    }
                    $html.= '</'.$div_or_tr.'><'.$div_or_tr.' class="body_row">';
                }
                
                
                if($row['CLIENTE']!=''){
                        
                        $begin_row=' begin_row';
                        
                    }else{
                        
                        $begin_row='';
                        
                    }
                    
                    
                    foreach($row as $key => $item){

                        
                        if($key=='CLIENTE' && $item!= ''){$showvalues=TRUE;$valor_pre=0;}


                        
                        
                    }
                    
                    
                        if($showvalues && isset($totalvar)){$showvalues=false;
                        $html.= $totalvar;}
                    
                
                foreach($row as $key => $item){
                    $class_body='item_body ';
                    $class_body.=' item_'.$key;
                    $class_body.=$begin_row;
                    
                    if($key=='CLIENTE'){
                        $class_body.=' border_left';
                    }
                    
                    if($key=='ESTADO_PPTO'){
                        $class_body.=' border_right';
                    }
                    
                    
                    if(!strpos($key, '__OCULTO__') !== false){
                        if($key=='VALOR_FACTURA'){   
                        $html.= '	<'.$div_or_td.' class="'.$class_body.'" >'.number_format($item).'</'.$div_or_td.'>';
                        }else{
                        $html.= '	<'.$div_or_td.' class="'.$class_body.'" >'.($item).'</'.$div_or_td.'>';

                        }
                    }
                }
                $html.= '</'.$div_or_tr.'>';
                
                
            
                
        }
    
        


        $html.= '	</'.$div_or_table.'>';
        $html.=        '</div>';
        

        $html.='</div>';


        $html.=   '<style>';
        $html.=    '
        body{
            //font-size:11px;
            //font-family: Verdana, Geneva, sans-serif;
        }

        table{ border-collapse: collapse;}
        
        
        
        ///ITEMS DE LA CABEZERA

         .header_item{
        border: 1px solid black;                
        }
        
        .header_logo{
                width:25%;
                font-size:11px;
        }

        .header_title{
                width:45%;
                font-size:11px;
                vertical-align: middle;
                
        }

        .header_info{
                vertical-align: middle;
                font-size:11px;
        }
        
        .data_header{
        
                border: 1px solid black;

        }

        .header_item{
                float:left;
                height:110px;
                text-align:center;
                border: 1px solid black;
                padding:10px

        }

        .header_content_image{
                background-image: url("'.$header_data['logo'][1].$header_data['logo'][0].'");
                background-repeat: no-repeat;
                background-position: center; 
                height:100px;
                //width:350px;
                background-size:contain;
        }
        

        //ESTILOS DEL CUERPO

        .data_body {
            display:block;
           //border: 1px solid black;   

        }
        
        .begin_row{
        border-top: 2px solid black;   
        }


        .item_body{
            float:left;
            padding:4px;
            vertical-align:middle;
            height:auto;
            
        }
        .border_left{
            border-left:1px solid black;
        }
        .border_right{
            border-right:1px solid black;
        }


        .item_bodytotal{
            padding:4px;
            vertical-align:middle;
            height:auto;
            
        }
        .begin_row{
            border-top:1px solid black;
        }
        
        .data_content{
            border-bottom:1px solid black;
        }

        .body_row{
            display:inline;
        }
        
        /*
        .data_body {
           border: 1px solid black;   

        }*/

        .item_title_body{
        border: 1px solid black;   
        background-color:#bbbbbb;
        color:white;
        text-align:center;
        }

        .body_row_total{
        }
        .highlight{
        background-color:yellow;
        }.highlightgrey{
        background-color:#bbbbbb;
        }
        .rightalign{
        text-align:right;
        }

        ';
        
        
        
                
        $totalancho=0;

        foreach($header_data['size'] as $item){
            $totalancho+=$item;
        }
       
        $sizecounter=0;
        foreach($titles_data as $item){
            
            
            if($use_divs){
                $varnum=0.855;
            }
            else{
                $varnum=1;
            }
            $html.= ' .item_'.$item.'{
                    
                    
                    width:'.floor($header_data['size'][$sizecounter]*1000*$varnum /$totalancho).'px;
                    
            }
                    

            ';
            
            $sizecounter++;
            
        }
        
        $html.='

        ';
        $html.=   		'</style>';
        $poshtml.=   		'</body>';
        $poshtml.=  '</html>';

        ////LEL
        //$html='CUERPO';
                $pdf = new mPDF('utf-8', array(279,210), '7', 'Arial', '15','15','50','20','10','15');

                $pdf->SetHTMLHeader($headerhtml);
                
                $pdf->SetHTMLFooter('<div style=text-align:right;>{PAGENO}</div>');

                $pdf->WriteHTML($prehtml.$html.$poshtml);
                $pdf->Output('REPORTE_ESTADO_PRESUPUESTOS_'.date('Y-m-d_h-m-s').'.pdf','I');	
                //$pdf->Output('informe.pdf', 'D');	



}//FIN IMPRIMIR PDF

?>