<?php

        
function imprimir_html($header_data,$filter_data,$titles_data,$body_data){

    
    
    
    
    echo 	'<!DOCTYPE html>';
    echo 	'<html>';
    echo 		'<head>';
    echo 		'<title>'.$header_data['titulo'].'</title>';
    echo 		'<meta charset="UTF-8">';
    echo 		'</head>';
    echo   		'<body>';
    echo  '

            <div class="general_container">	

                    <div class="data_header">';


    echo	'<div class="header_logo header_item">';
    echo		'<div class=header_content_image>';

    echo		'</div>';
    echo	'</div>';

    echo	'<div class="header_title header_item">';
    echo 		'<div class=header_content_title>'.$header_data['titulo'].'</div>';
    echo	'</div>';

    echo	'<div class="header_info header_item">';
    echo		'<div class=header_content_info>'.$header_data['info'].'</div>';;
    echo	'</div>';


    echo'</div> <br><br>		

            <div class="data_filter">';

    foreach($filter_data as $row){

        if($row['state'] && $row['name'] != 'FECHA'&& $row['name'] != 'LIMITE'
        )
        {	
            $classfilter0=' filter_name filter_item';
            $classfilter1=' filter_value filter_item';
            $classfilter2=' filter_sample filter_item';

            $classfilter=' filter_item';
            
            echo '<div class="filter_row">';
            echo '<div class="'.$classfilter.$classfilter0.'">'.$row['name'].':</div>';

            if($row['name']== 'EJECUTIVO' OR $row['name']== 'REFERENCIA' OR $row['name']== 'DIRECTOR'){
                    echo '<div class="'.$classfilter.$classfilter1.'">'.$row['query'].'</div>';
            }else{
                    echo '<div class="'.$classfilter.$classfilter2.'">'.$row['muestra'].'</div>';
            }
            echo '</div>';
        }

    }
			
        echo	'</div> 		

                <div class="data_content">';

        echo '	<br><br><div class="data_body">';


        $runonce=TRUE;
        $valor_total=0;
        $valor_pre=0;
        foreach($body_data as $row)
            {
                

                    $class_body='item_body ';

                    echo '<div class="body_row">';
                    if($runonce){
                        $runonce=false;
                        foreach($titles_data as $key => $item){
                            $class_body='item_body ';
                            $class_body.=' item_'.$item;
                            if(!strpos($item, '__OCULTO__') !== false){
                                    
                                echo '	<div class="item_title_body '.$class_body.'" >'.clean_tags($item).'</div>';
                            }
                        }
                        echo '</div>';
                       
                        echo '<div class="body_row">';
                    }
                    
                    
                    if($row['CLIENTE']!=''){
                        
                        $begin_row=' begin_row';
                        
                    }else{
                        
                        $begin_row='';
                        
                    }
                    
                    
                    
                    foreach($row as $key => $item){

                        
                        if($key=='CLIENTE' && $item!= ''){$showvalues=TRUE;$valor_pre=0;}

                        //if($key=='VALOR_FACTURA')$valor_pre+=$item;
                        
                        //if($key=='VALOR_FACTURA')$valor_total+=$item;

                        
                        
                    }
                    
                    
                        if($showvalues && isset($totalvar)){$showvalues=false;
                        echo $totalvar;}
                    
                    foreach($row as $key => $item){
                        $class_body='item_body ';
                        $class_body.=' item_'.$key;
                        
                        $class_body.=$begin_row;
                        
                        
                        
                        if(!strpos($key, '__OCULTO__') !== false){
                            
                            
                            //if($key == 'VALOR_FACTURA'){
                            //echo '	<div class="'.$class_body.'" >'.number_format($item).'</div>';

                            //}else{
                            echo '	<div class="'.$class_body.'" >'.$item.'</div>';
                            
                            //}
                            
                        }
                        

                    }
                    
                    echo '</div>';////DELETETHIS
                    
                
                    
                    
                    
                    
                    
                        
                    
                
            }
    

        echo '	</div>';
        
        
        echo'        </div>
                


        </div>';

        echo   		'<style>';
        echo   		'

        body{
            margin:3% 5% 5% 5%;
            font-size:11px;
            font-family: Verdana, Geneva, sans-serif;
        }
        div{

        }
        .general_container{
                min-width:auto;
        }
        .data_content{
            //width:200%;
        }
        .item_title_body{
        background-color:#bbbbbb;
        text-align:center;
        color:white;
        }
        .header_item, .data_header{
            border: 1px solid black;                
        }
        .item_body,  .header_item, .data_header{
            //border-left: 1px solid black;                
            //border-right: 1px solid black;                
        }
        .item_title_body{
        border: 1px solid black;
        }
        
        .begin_row{
        border-top: 2px solid black;   
        }
        
        
        
        .data_body{
        //border-left: 1px solid black; 
        border-bottom: 2px solid black;
        border-top: 1px solid black; 
        width:1700px;
        }
        
        .body_row, .filter_row, .data_header:after{
                display:table-row;
        }
        .titles_body, .item_body, .filter_item, .header_item{   	
                display:table-cell;
                padding:10px;
        } 
        .data_header{

        }

        .header_item{
                height:100px;
                text-align:center;

        }

        .header_logo{
                width:25%;
                font-size:11px;
        }

        .header_title{
                width:50%;
                font-size:11px;
                vertical-align: middle;
        }

        .header_info{
                width:320px;
                vertical-align: middle;
                font-size:11px;
        }

        .header_content_image{
                background-image: url("'.$header_data['logo'][1].$header_data['logo'][0].'");
                background-repeat: no-repeat;
                background-position: center; 
                height:100%;
                width:100%;
                background-size:contain;
        }
        

        .body_row_total{
        float:clear;
        }
        .highlight{
        background-color:yellow;
        }
        .highlightgrey{
        background-color:#bbbbbb;
        }
        .rightalign{
        text-align:right;
        }
        .item_CLIENTE{
            border-left: 2px solid black; 

        }
        .item_ESTADO_PPTO{
            border-right: 2px solid black; 

        }

        ';
                
        $totalancho=0;

        foreach($header_data['size'] as $item){
            $totalancho+=$item;
        }
       
        $sizecounter=0;
        foreach($titles_data as $item){
            
            echo '.item_body.item_'.$item.'{
                    
                    
                    width:'.$header_data['size'][$sizecounter]*100/$totalancho.'%;
                    
            }
                    

            ';
            
            $sizecounter++;
            
        }
        

        echo'

        ////titulos de el cuerpo

        .data_titles {
                background-color:green;
        }
        
       
        ////
        ';
        echo   		'</style>';
        echo   		'</body>';
        echo  '</html>';

}//FIN IMPRIMIR HTML
	
	
?>