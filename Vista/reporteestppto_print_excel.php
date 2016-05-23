<?php

function imprimir_exc($header_data,$filter_data,$titles_data,$body_data){

    

    //$data=enco($header_data['logo']['1']);

    $objPHPExcel = new PHPExcel();

    //header('Content-Type: text/html; charset=UTF-8');
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="REPORTE_ESTADO_PRESUPUESTO_'.date('Y-m-d_h:i:s').'.xls"');
    header('Cache-Control: max-age=0');


    //configuracion general
    $objPHPExcel->
    getProperties()
            ->setCreator('Pprocess Plus')
            ->setLastModifiedBy('Process Plus')
            ->setTitle('Reporte OTS Process Plus')
            ->setSubject('Reporte')
            ->setDescription('Informe con info de ots obtenida de Process Plus')
            ->setKeywords('reporte orden trabajo')
            ->setCategory('reportes');

    $objPHPExcel->getActiveSheet()->setTitle('REPORTE');
    $sheet = $objPHPExcel->setActiveSheetIndex(0);
    $letras=array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');


    //devuelve tetra segun numero
    function indice($letra,$numero){
            $letras=array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
            return $letras[$letra].($numero+1);
    }


    //guarda un valor en coordenadas x y
    function guardar($obj,$x,$y,$valor){
            $obj->setActiveSheetIndex(0)->setCellValue(indice($x,$y),$valor);
            
    }



    //INDICES DE INICIO DE IMPRESION CONTENIDO

    $yC=3;
    $xStart=0;


    //DEFINIR ANCHO CELDAS
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth($header_data['size'][0]);

    for($i = 0 ; $i < count($header_data['size']); $i++){
        $objPHPExcel->getActiveSheet()->getColumnDimension($letras[$i+$xStart])->setWidth($header_data['size'][$i]);
    }


    //DEFINIR ALTURA CELDAS
    $objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(50);

    //$objPHPExcel->getActiveSheet()->getRowDimension(2)->setRowHeight(50);


    //arreglos de estilo
    $styleCenter = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );
    $styleAlignLeft = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
            )
        );
    
    $styleAlignRight = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
            )
        );
    $styleColor = array(
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => '00FF00')
        )
    );
    $styleColorY = array(
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'FFFF00')
        )
    );
    $styleColorGrey = array(
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'BBBBBB')
        )
    );
    $styleBorderThin = array(
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN
            )
        )
    );

    $styleCenterH = array(
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            )
        );

    $styleBorderSides = array(
        'borders'=> array(
            'left' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN,
            ),'right' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN,
            )
            )
        );

    $styleBorderSideRight = array(
        'borders'=> array(
            'right' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN,
            )
            )
        );

    $styleBorderSideLeft = array(
        'borders'=> array(
            'left' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN,
            )
            )
        );

    $styleBorderSidesE = array(
        'borders'=> array(
            'left' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN,
            ),'right' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN,
            ),'bottom' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN,
            )
            )
        );
    
    $styleBorderTop = array(
        'borders'=> array(
            'top' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN,
            )
            )
        );
    
    $styleBorderSideBot = array(
        'borders'=> array(
            'bottom' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN,
            )
            )
        );



    function apply_style($sheet,$array,$coord){
    $sheet->getStyle($coord)->applyFromArray($array);
    }

    //pintar cabecera                



    apply_style($sheet,$styleBorderThin,'A1:I1');
    apply_style($sheet,$styleCenterH,'A1:C1');


    guardar($objPHPExcel,3,0,$header_data['titulo']);
    apply_style($sheet,$styleCenter,indice(3,0));
    apply_style($sheet,$styleCenterH,indice(3,0));


    guardar($objPHPExcel,6,0,$header_data['info']);
    apply_style($sheet,$styleCenter,indice(6,0));
    apply_style($sheet,$styleCenterH,indice(6,0));

    //MERGE CELLSS

    $sheet->mergeCells(indice(0,0).':'.indice(2,0));
    $sheet->mergeCells(indice(3,0).':'.indice(5,0));
    $sheet->mergeCells(indice(6,0).':'.indice(8,0));



    //PINTAR FILTROS
    $xC=$xStart;
    foreach($filter_data as $row){

        if(!($row['name']=='LIMITE' OR $row['name']=='FECHA' OR $row['state']==FALSE)){
            guardar($objPHPExcel,$xC,$yC,$row['name'].':');
                apply_style($sheet,$styleBorderThin,indice($xC,$yC));
            $xC++;

            if($row['change']){
                guardar($objPHPExcel,$xC,$yC,$row['muestra']);
                apply_style($sheet,$styleBorderThin,indice($xC,$yC));
                $xC++;
            }else{
                guardar($objPHPExcel,$xC,$yC,$row['query']);
                apply_style($sheet,$styleBorderThin,indice($xC,$yC));
                $xC++;

            }

            $yC++;
            $xC=$xStart;

        }

    }

    $yC++;
    $yC++;

    //TITULOS

    $hidden=9999;
    
    
    
    
    $xC=$xStart;
    foreach($titles_data as $item){

        if(!strpos($item, '__OCULTO__') !== false){

            
            guardar($objPHPExcel,$xC,$yC,clean_tags($item)); 
            apply_style($sheet,$styleColorGrey,indice($xC,$yC));
            apply_style($sheet,$styleBorderThin,indice($xC,$yC));
            apply_style($sheet,$styleCenter,indice($xC,$yC));
            $xC++;
        
        }
        else{
            
            $hidden=$xC;
            
        }
    }
    $yC++;

    //CUERPO
    
    //$valor_total=0;
    
    
$justone=false;

    $xC=$xStart;
    foreach($body_data as $row){
        
        
        
    
     if($row['CLIENTE']!=''){
                        
            $begin_row=true;

        }else{

            $begin_row=false;

        }
        


        
        if($begin_row){
            $yC++;
            if($justone){
                $yC++;
            }else{
                $justone=true;
            }
        }
        
        
        
        
        if($increaserow){
                     $yC++;
                                 $increaserow=false;

                 }
        
        foreach($row as $key => $item){
            
            
            
            if($xC<$hidden){
                
                if($begin_row){
                
                apply_style($sheet,$styleBorderTop,indice($xC,$yC-1));
                    apply_style($sheet,$styleBorderSideLeft,indice(0,$yC-2));
                    apply_style($sheet,$styleBorderSideRight,indice(9,$yC-2));


                
                if($key=='CLIENTE')apply_style($sheet,$styleBorderSideLeft,indice($xC,$yC-1));
                if($key=='ESTADO_PPTO')apply_style($sheet,$styleBorderSideRight,indice($xC,$yC-1));

                 }
                
                guardar($objPHPExcel,$xC,$yC,  $item);
                
                
                apply_style($sheet,$styleAlignLeft,indice($xC,$yC));

                if($key=='CLIENTE')apply_style($sheet,$styleBorderSideLeft,indice($xC,$yC));
                if($key=='ESTADO_PPTO')apply_style($sheet,$styleBorderSideRight,indice($xC,$yC));
                $xC++;
            }
        }
        $yC++;
        $xC=$xStart;
    }
    
    
                /*
                
    apply_style($sheet,$styleBorderSideLeft,indice(0,$yC));
        apply_style($sheet,$styleBorderSideBot,indice(0,$yC));

    apply_style($sheet,$styleBorderSideBot,indice(1,$yC));
    apply_style($sheet,$styleBorderSideBot,indice(2,$yC));
    apply_style($sheet,$styleBorderSideBot,indice(3,$yC));
    apply_style($sheet,$styleBorderSideBot,indice(4,$yC));
    apply_style($sheet,$styleBorderSideBot,indice(5,$yC));
    apply_style($sheet,$styleBorderSideBot,indice(6,$yC));
    apply_style($sheet,$styleBorderSideBot,indice(7,$yC));
    apply_style($sheet,$styleBorderSideBot,indice(8,$yC));
    apply_style($sheet,$styleBorderSideBot,indice(9,$yC));
    apply_style($sheet,$styleBorderSideBot,indice(10,$yC));
    apply_style($sheet,$styleBorderSideBot,indice(11,$yC));
        apply_style($sheet,$styleBorderSideBot,indice(12,$yC));

    apply_style($sheet,$styleBorderSideRight,indice(12,$yC));
    
    guardar($objPHPExcel,11,$yC,"TOTAL:");
    apply_style($sheet,$styleAlignRight,indice(11,$yC));
    $objPHPExcel->getActiveSheet()->getStyle(indice(12,$yC))->getNumberFormat()->setFormatCode('#,##0');

    guardar($objPHPExcel,12,$yC,$valor_pre);
    
    apply_style($sheet,$styleAlignLeft,indice(12,$yC));                

    $objPHPExcel->getActiveSheet()->getStyle(indice(11,$yC))->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle(indice(12,$yC))->getFont()->setBold(true);
    apply_style($sheet,$styleColorY,indice(11,$yC));
    apply_style($sheet,$styleColorY,indice(12,$yC));

    $yC++;
                 
                 
     
    
    guardar($objPHPExcel,11,$yC,"TOTAL GENERAL:");
    apply_style($sheet,$styleAlignRight,indice(11,$yC));
    guardar($objPHPExcel,12,$yC,$valor_total);
    
                                    apply_style($sheet,$styleAlignLeft,indice(12,$yC));                

    $objPHPExcel->getActiveSheet()->getStyle(indice(12,$yC))->getNumberFormat()->setFormatCode('#,##0');
    $objPHPExcel->getActiveSheet()->getStyle(indice(11,$yC))->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle(indice(12,$yC))->getFont()->setBold(true);
    apply_style($sheet,$styleColorGrey,indice(11,$yC));
    apply_style($sheet,$styleColorGrey,indice(12,$yC));
*/
    apply_style($sheet,$styleBorderSideBot,indice(0,$yC));
    apply_style($sheet,$styleBorderSideBot,indice(1,$yC));
    apply_style($sheet,$styleBorderSideBot,indice(2,$yC));
    apply_style($sheet,$styleBorderSideBot,indice(3,$yC));
    apply_style($sheet,$styleBorderSideBot,indice(4,$yC));
    apply_style($sheet,$styleBorderSideBot,indice(5,$yC));
    apply_style($sheet,$styleBorderSideBot,indice(6,$yC));
    apply_style($sheet,$styleBorderSideBot,indice(7,$yC));
    apply_style($sheet,$styleBorderSideBot,indice(8,$yC));
    apply_style($sheet,$styleBorderSideBot,indice(9,$yC));
    
    
    apply_style($sheet,$styleBorderSideLeft,indice(0,$yC));
    apply_style($sheet,$styleBorderSideRight,indice(9,$yC));
    

    $objDrawing = new PHPExcel_Worksheet_Drawing();
    $objDrawing->setName('Logo');
    $objDrawing->setDescription('Logo');

    //cargar url logo
    $logo=$header_data['logo'][1].$header_data['logo'][0];

    //dimenciones de la imagen
    $tam = getimagesize($logo);


    //dibujar logo en coordenada
    $objDrawing->setPath($logo);
    //$objDrawing->setOffsetX(20);    // setOffsetX works properly
    //$objDrawing->setOffsetY(20);  //setOffsetY has no effect
    $objDrawing->setCoordinates('A1');

    if($tam[0]>$tam[1])
    {
        $objDrawing->setWidth(300);
    }else {
        $objDrawing->setHeight(60);
    }		// logo height

    $objDrawing->setWorksheet($sheet); 

    //header('Content-Type: application/vnd.ms-excel');
    //header('Content-Disposition: attachment;filename="informe.xls"');
    //header('Cache-Control: max-age=0');

    $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
    $objWriter->save('php://output');

}//FIN IMPRIMIR EXCEL
	
?>