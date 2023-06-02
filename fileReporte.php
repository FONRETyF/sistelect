<?php
    require '/var/www/html/sistelect/vendor/autoload.php'; //'vendor/autoload.php';
    require '/var/www/html/sistelect/config/db.php';

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    use PhpOffice\PhpSpreadsheet\IOFactory;

    $turno = $_GET["turno"];
    
    $spreadsheet = new Spreadsheet();
    $activeWorksheet = $spreadsheet->getActiveSheet();

    $nombreArchivo = "RESULTADOS TOLUCA34";

    $styleArray = [
        'borders' => [
            'top' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,],
            'bottom' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,],
            'left' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,],
            'right' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,],
        ],
    ];
    
    $activeWorksheet->setTitle("General");
    $activeWorksheet->getColumnDimension('A')->setWidth(30,'pt');
    $activeWorksheet->getColumnDimension('B')->setWidth(300,'pt');
    $activeWorksheet->getColumnDimension('C')->setWidth(90,'pt');

    $activeWorksheet->getStyle('A2')->getFont()->SetBold(true);
    $activeWorksheet->getStyle('A2')->getFont()->SetSize(14);
    $activeWorksheet->setCellValue('A2', " BASE DE DATOS GENERAL");
    $activeWorksheet->mergeCells('A2:C2')->getStyle('A2:C2')->getAlignment()->setHorizontal('center');

    $pdo = new db();
    $db=$pdo->conexion();
        
    $statement = $db->prepare("SELECT id,nomcom,estatvoto,turnvoto FROM public.padrontol order by id asc");
    $statement->execute();
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);  
            
    $activeWorksheet->setCellValue('A3',"");
    $activeWorksheet->mergeCells('A3:C3')->getStyle('A3:C3')->getAlignment()->setHorizontal('center');

    $activeWorksheet->getStyle('A5:C5')->getAlignment()->setHorizontal('center');
    $activeWorksheet->setCellValue('A5','NP');
    $activeWorksheet->setCellValue('B5','NOMBRE');
    $activeWorksheet->setCellValue('C5','TURNO DE VOTO');

    $idcheque = 1;
    $numregExcel = 6;
    foreach ($results as $row) {
                
        $activeWorksheet->setCellValue('A'. $numregExcel,$row["id"]);
        $activeWorksheet->setCellValue('B'. $numregExcel,$row["nomcom"]);
        $activeWorksheet->setCellValue('C'. $numregExcel,$row["turnvoto"]);
        switch ($row["turnvoto"]) {
            case '1':
                $color='1BA000';
                break;
            case '2':
                $color='0167DA';
                break;
            case '3':
                $color='EAF119';
                break;
            case '4':
                $color='FE1414';
                break;
            case "":
                $color='transparent';
                break;
        }
        $celfdas= "A".$numregExcel.":C".$numregExcel."";
        $activeWorksheet->getStyle("A".$numregExcel)->getAlignment()->setHorizontal('center');
        $activeWorksheet->getStyle($celfdas)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB($color);                 
        $numregExcel++;
    }

    switch ($turno) {
        case 1:
            $nombreArchivo = "RESULTADOS TOLUCA34 - TURNO 1";
            $hoja2 = $spreadsheet->createSheet();
            $hoja2->getTabColor()->setRGB('1BA000');
            $hoja2->setTitle("TURNO 1");
            $hoja2->getColumnDimension('A')->setWidth(30,'pt');
            $hoja2->getColumnDimension('B')->setWidth(300,'pt');
            $hoja2->getColumnDimension('C')->setWidth(90,'pt');
            
            $hoja2->getStyle('A2')->getFont()->SetBold(true);
            $hoja2->getStyle('A2')->getFont()->SetSize(14);
            $hoja2->setCellValue('A2', "TURNO 1 - TOLUCA");
            $hoja2->mergeCells('A2:C2')->getStyle('A2:C2')->getAlignment()->setHorizontal('center');

            $statementTurno = $db->prepare("SELECT id,nomcom,estatvoto,turnvoto FROM public.padrontol WHERE turnvoto='".$turno."' order by id asc");
            $statementTurno->execute();
            $resultsTurno = $statementTurno->fetchAll(PDO::FETCH_ASSOC);

            $hoja2->setCellValue('A3',"");
            $hoja2->mergeCells('A3:C3')->getStyle('A3:C3')->getAlignment()->setHorizontal('center');

            $hoja2->getStyle('A5:C5')->getAlignment()->setHorizontal('center');
            $hoja2->setCellValue('A5','NP');
            $hoja2->setCellValue('B5','NOMBRE');
            $hoja2->setCellValue('C5','TURNO DE VOTO');

            $numregExcel = 6;
            foreach ($resultsTurno as $row) {
                $hoja2->setCellValue('A'. $numregExcel,$row["id"]);
                $hoja2->setCellValue('B'. $numregExcel,$row["nomcom"]);
                $hoja2->setCellValue('C'. $numregExcel,$row["turnvoto"]);
                $celfdas= "A".$numregExcel.":C".$numregExcel."";
                $hoja2->getStyle("A".$numregExcel)->getAlignment()->setHorizontal('center');
                $hoja2->getStyle($celfdas)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('1BA000');                 
                $numregExcel++;
            }


            $hoja3 = $spreadsheet->createSheet();
            $hoja3->setTitle("ESTADISTICAS");
            $hoja3->getColumnDimension('A')->setWidth(75,'pt');
            $hoja3->getColumnDimension('B')->setWidth(70,'pt');
            $hoja3->getColumnDimension('C')->setWidth(70,'pt');
            $hoja3->getColumnDimension('D')->setWidth(70,'pt');
            $hoja3->getColumnDimension('E')->setWidth(70,'pt');

            $hoja3->getColumnDimension('F')->setWidth(90,'pt');
            $hoja3->getColumnDimension('G')->setWidth(90,'pt');
            
            $hoja3->getStyle('A2')->getFont()->SetBold(true);
            $hoja3->getStyle('A2')->getFont()->SetSize(14);
            $hoja3->setCellValue('A2', "ESTADISTICAS - TOLUCA");
            $hoja3->mergeCells('A2:G2')->getStyle('A2:C2')->getAlignment()->setHorizontal('center');

            $hoja3->setCellValue('A3',"");
            $hoja3->mergeCells('A3:G3')->getStyle('A3:C3')->getAlignment()->setHorizontal('center');
            $hoja3->getStyle('A5:G5')->applyFromArray($styleArray);

            $hoja3->getStyle('A5:G5')->applyFromArray($styleArray,false);
            $hoja3->getStyle('A5:G5')->getAlignment()->setHorizontal('center');
            $hoja3->getStyle('A5:G5')->getFont()->SetBold(true);
            
            $hoja3->setCellValue('A5','LUGAR');
            $hoja3->setCellValue('B5','1er TIEMPO');
            $hoja3->setCellValue('C5','2do TIEMPO');
            $hoja3->setCellValue('D5','3er TIEMPO');
            $hoja3->setCellValue('E5','4to TIEMPO');
            $hoja3->setCellValue('F5','TOTAL TIEMPO(s)');
            $hoja3->setCellValue('G5','TOTAL GENERAL');

            $hoja3->getStyle('A6:G6')->applyFromArray($styleArray,false);
            $hoja3->getStyle('A6:G6')->getAlignment()->setHorizontal('center');
            $hoja3->getStyle('A6')->getFont()->SetBold(true);
            $hoja3->setCellValue('A6','TOLUCA');
            $hoja3->setCellValue('B6',count($resultsTurno));
            $hoja3->setCellValue('C6','0');
            $hoja3->setCellValue('D6','0');
            $hoja3->setCellValue('E6','0');
            $turnoTotls = $hoja3->getCell('B6')->getValue();
            $hoja3->setCellValue('F6',$turnoTotls);
            $hoja3->setCellValue('G6',count($results));

            break;

            
        case 2:
            $nombreArchivo = "RESULTADOS TOLUCA34 - TURNO 2";
            $statementTurno = $db->prepare("SELECT id,nomcom,estatvoto,turnvoto FROM public.padrontol WHERE turnvoto='1' or turnvoto='".$turno."' order by turnvoto,id asc");
            $statementTurno->execute();
            $resultsTurno = $statementTurno->fetchAll(PDO::FETCH_ASSOC);

            $hoja2 = $spreadsheet->createSheet();
            $hoja2->getTabColor()->setRGB('1BA000');
            $hoja2->setTitle("TURNO 1");
            $hoja2->getColumnDimension('A')->setWidth(30,'pt');
            $hoja2->getColumnDimension('B')->setWidth(300,'pt');
            $hoja2->getColumnDimension('C')->setWidth(90,'pt');
            
            $hoja2->getStyle('A2')->getFont()->SetBold(true);
            $hoja2->getStyle('A2')->getFont()->SetSize(14);
            $hoja2->setCellValue('A2', "TURNO 1 - TOLUCA");
            $hoja2->mergeCells('A2:C2')->getStyle('A2:C2')->getAlignment()->setHorizontal('center');

            $hoja2->setCellValue('A3',"");
            $hoja2->mergeCells('A3:C3')->getStyle('A3:C3')->getAlignment()->setHorizontal('center');

            $hoja2->getStyle('A5:C5')->getAlignment()->setHorizontal('center');
            $hoja2->setCellValue('A5','NP');
            $hoja2->setCellValue('B5','NOMBRE');
            $hoja2->setCellValue('C5','TURNO DE VOTO');



            $hoja3 = $spreadsheet->createSheet();
            $hoja3->getTabColor()->setRGB('0167DA');
            $hoja3->setTitle("TURNO 2");
            $hoja3->getColumnDimension('A')->setWidth(30,'pt');
            $hoja3->getColumnDimension('B')->setWidth(300,'pt');
            $hoja3->getColumnDimension('C')->setWidth(90,'pt');
            
            $hoja3->getStyle('A2')->getFont()->SetBold(true);
            $hoja3->getStyle('A2')->getFont()->SetSize(14);
            $hoja3->setCellValue('A2', "TURNO 2 - TOLUCA");
            $hoja3->mergeCells('A2:C2')->getStyle('A2:C2')->getAlignment()->setHorizontal('center');

            $hoja3->setCellValue('A3',"");
            $hoja3->mergeCells('A3:C3')->getStyle('A3:C3')->getAlignment()->setHorizontal('center');

            $hoja3->getStyle('A5:C5')->getAlignment()->setHorizontal('center');
            $hoja3->setCellValue('A5','NP');
            $hoja3->setCellValue('B5','NOMBRE');
            $hoja3->setCellValue('C5','TURNO DE VOTO');

            $numregExcel = 6;
            $numregExcel2 = 6;
            $numturn1 = 0;
            $numturn2 = 0;
            foreach ($resultsTurno as $row) {
                if ($row["turnvoto"] == '1') {
                    $hoja2->setCellValue('A'. $numregExcel,$row["id"]);
                    $hoja2->setCellValue('B'. $numregExcel,$row["nomcom"]);
                    $hoja2->setCellValue('C'. $numregExcel,$row["turnvoto"]);
                    $celfdas= "A".$numregExcel.":C".$numregExcel."";
                    $hoja2->getStyle("A".$numregExcel)->getAlignment()->setHorizontal('center');
                    $hoja2->getStyle($celfdas)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('1BA000');                 
                    $numregExcel++;
                    $numturn1++;
                } elseif ($row["turnvoto"] == '2') {
                    $hoja3->setCellValue('A'. $numregExcel2,$row["id"]);
                    $hoja3->setCellValue('B'. $numregExcel2,$row["nomcom"]);
                    $hoja3->setCellValue('C'. $numregExcel2,$row["turnvoto"]);
                    $celfdas= "A".$numregExcel2.":C".$numregExcel2."";
                    $hoja3->getStyle("A".$numregExcel2)->getAlignment()->setHorizontal('center');
                    $hoja3->getStyle($celfdas)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('0167DA');                 
                    $numregExcel2++;
                    $numturn2++;
                }  
            }

            $hoja4 = $spreadsheet->createSheet();
            $hoja4->setTitle("ESTADISTICAS");
            $hoja4->getColumnDimension('A')->setWidth(75,'pt');
            $hoja4->getColumnDimension('B')->setWidth(70,'pt');
            $hoja4->getColumnDimension('C')->setWidth(70,'pt');
            $hoja4->getColumnDimension('D')->setWidth(70,'pt');
            $hoja4->getColumnDimension('E')->setWidth(70,'pt');

            $hoja4->getColumnDimension('F')->setWidth(90,'pt');
            $hoja4->getColumnDimension('G')->setWidth(90,'pt');
            
            $hoja4->getStyle('A2')->getFont()->SetBold(true);
            $hoja4->getStyle('A2')->getFont()->SetSize(14);
            $hoja4->setCellValue('A2', "ESTADISTICAS - TOLUCA");
            $hoja4->mergeCells('A2:G2')->getStyle('A2:C2')->getAlignment()->setHorizontal('center');

            $hoja4->setCellValue('A3',"");
            $hoja4->mergeCells('A3:G3')->getStyle('A3:C3')->getAlignment()->setHorizontal('center');
            $hoja4->getStyle('A5:G5')->applyFromArray($styleArray);

            $hoja4->getStyle('A5:G5')->applyFromArray($styleArray,false);
            $hoja4->getStyle('A5:G5')->getAlignment()->setHorizontal('center');
            $hoja4->getStyle('A5:G5')->getFont()->SetBold(true);
            
            $hoja4->setCellValue('A5','LUGAR');
            $hoja4->setCellValue('B5','1er TIEMPO');
            $hoja4->setCellValue('C5','2do TIEMPO');
            $hoja4->setCellValue('D5','3er TIEMPO');
            $hoja4->setCellValue('E5','4to TIEMPO');
            $hoja4->setCellValue('F5','TOTAL TIEMPO(s)');
            $hoja4->setCellValue('G5','TOTAL GENERAL');

            $hoja4->getStyle('A6:G6')->applyFromArray($styleArray,false);
            $hoja4->getStyle('A6:G6')->getAlignment()->setHorizontal('center');
            $hoja4->getStyle('A6')->getFont()->SetBold(true);
            $hoja4->setCellValue('A6','TOLUCA');
            $hoja4->setCellValue('B6',$numturn1);
            $hoja4->setCellValue('C6',$numturn2);
            $hoja4->setCellValue('D6','0');
            $hoja4->setCellValue('E6','0');
            $turnoTotls = intval($hoja4->getCell('B6')->getValue()) + intval($hoja4->getCell('C6')->getValue());
            $hoja4->setCellValue('F6',$turnoTotls);
            $hoja4->setCellValue('G6',count($results));
            break;


        case 3:
            $nombreArchivo = "RESULTADOS TOLUCA34 - TURNO 3";
            $statementTurno = $db->prepare("SELECT id,nomcom,estatvoto,turnvoto FROM public.padrontol WHERE turnvoto='1' or turnvoto='2' or turnvoto='".$turno."' order by turnvoto,id asc");
            $statementTurno->execute();
            $resultsTurno = $statementTurno->fetchAll(PDO::FETCH_ASSOC);

            $hoja2 = $spreadsheet->createSheet();
            $hoja2->getTabColor()->setRGB('1BA000');
            $hoja2->setTitle("TURNO 1");
            $hoja2->getColumnDimension('A')->setWidth(30,'pt');
            $hoja2->getColumnDimension('B')->setWidth(300,'pt');
            $hoja2->getColumnDimension('C')->setWidth(90,'pt');
            
            $hoja2->getStyle('A2')->getFont()->SetBold(true);
            $hoja2->getStyle('A2')->getFont()->SetSize(14);
            $hoja2->setCellValue('A2', "TURNO 1 - TOLUCA");
            $hoja2->mergeCells('A2:C2')->getStyle('A2:C2')->getAlignment()->setHorizontal('center');

            $hoja2->setCellValue('A3',"");
            $hoja2->mergeCells('A3:C3')->getStyle('A3:C3')->getAlignment()->setHorizontal('center');

            $hoja2->getStyle('A5:C5')->getAlignment()->setHorizontal('center');
            $hoja2->setCellValue('A5','NP');
            $hoja2->setCellValue('B5','NOMBRE');
            $hoja2->setCellValue('C5','TURNO DE VOTO');



            $hoja3 = $spreadsheet->createSheet();
            $hoja3->getTabColor()->setRGB('0167DA');
            $hoja3->setTitle("TURNO 2");
            $hoja3->getColumnDimension('A')->setWidth(30,'pt');
            $hoja3->getColumnDimension('B')->setWidth(300,'pt');
            $hoja3->getColumnDimension('C')->setWidth(90,'pt');
            
            $hoja3->getStyle('A2')->getFont()->SetBold(true);
            $hoja3->getStyle('A2')->getFont()->SetSize(14);
            $hoja3->setCellValue('A2', "TURNO 2 - TOLUCA");
            $hoja3->mergeCells('A2:C2')->getStyle('A2:C2')->getAlignment()->setHorizontal('center');

            $hoja3->setCellValue('A3',"");
            $hoja3->mergeCells('A3:C3')->getStyle('A3:C3')->getAlignment()->setHorizontal('center');

            $hoja3->getStyle('A5:C5')->getAlignment()->setHorizontal('center');
            $hoja3->setCellValue('A5','NP');
            $hoja3->setCellValue('B5','NOMBRE');
            $hoja3->setCellValue('C5','TURNO DE VOTO');



            $hoja4 = $spreadsheet->createSheet();
            $hoja4->getTabColor()->setRGB('EAF119');
            $hoja4->setTitle("TURNO 3");
            $hoja4->getColumnDimension('A')->setWidth(30,'pt');
            $hoja4->getColumnDimension('B')->setWidth(300,'pt');
            $hoja4->getColumnDimension('C')->setWidth(90,'pt');
            
            $hoja4->getStyle('A2')->getFont()->SetBold(true);
            $hoja4->getStyle('A2')->getFont()->SetSize(14);
            $hoja4->setCellValue('A2', "TURNO 3 - TOLUCA");
            $hoja4->mergeCells('A2:C2')->getStyle('A2:C2')->getAlignment()->setHorizontal('center');

            $hoja4->setCellValue('A3',"");
            $hoja4->mergeCells('A3:C3')->getStyle('A3:C3')->getAlignment()->setHorizontal('center');

            $hoja4->getStyle('A5:C5')->getAlignment()->setHorizontal('center');
            $hoja4->setCellValue('A5','NP');
            $hoja4->setCellValue('B5','NOMBRE');
            $hoja4->setCellValue('C5','TURNO DE VOTO');

            
            $numregExcel = 6;
            $numregExcel2 = 6;
            $numregExcel3 = 6;

            $numturn1=0;
            $numturn2=0;
            $numturn3=0;
            foreach ($resultsTurno as $row) {
                if ($row["turnvoto"] == '1') {
                    $hoja2->setCellValue('A'. $numregExcel,$row["id"]);
                    $hoja2->setCellValue('B'. $numregExcel,$row["nomcom"]);
                    $hoja2->setCellValue('C'. $numregExcel,$row["turnvoto"]);
                    $celfdas= "A".$numregExcel.":C".$numregExcel."";
                    $hoja2->getStyle("A".$numregExcel)->getAlignment()->setHorizontal('center');
                    $hoja2->getStyle($celfdas)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('1BA000');                 
                    $numregExcel++;
                    $numturn1++;
                } elseif ($row["turnvoto"] == '2') {
                    $hoja3->setCellValue('A'. $numregExcel2,$row["id"]);
                    $hoja3->setCellValue('B'. $numregExcel2,$row["nomcom"]);
                    $hoja3->setCellValue('C'. $numregExcel2,$row["turnvoto"]);
                    $celfdas= "A".$numregExcel2.":C".$numregExcel2."";
                    $hoja3->getStyle("A".$numregExcel2)->getAlignment()->setHorizontal('center');
                    $hoja3->getStyle($celfdas)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('0167DA');                 
                    $numregExcel2++;
                    $numturn2++;
                } elseif ($row["turnvoto"] == '3') {
                    $hoja4->setCellValue('A'. $numregExcel3,$row["id"]);
                    $hoja4->setCellValue('B'. $numregExcel3,$row["nomcom"]);
                    $hoja4->setCellValue('C'. $numregExcel3,$row["turnvoto"]);
                    $celfdas= "A".$numregExcel3.":C".$numregExcel3."";
                    $hoja4->getStyle("A".$numregExcel3)->getAlignment()->setHorizontal('center');
                    $hoja4->getStyle($celfdas)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('EAF119');                 
                    $numregExcel3++;
                    $numturn3++;
                }
            }

            $hoja5 = $spreadsheet->createSheet();
            $hoja5->setTitle("ESTADISTICAS");
            $hoja5->getColumnDimension('A')->setWidth(75,'pt');
            $hoja5->getColumnDimension('B')->setWidth(70,'pt');
            $hoja5->getColumnDimension('C')->setWidth(70,'pt');
            $hoja5->getColumnDimension('D')->setWidth(70,'pt');
            $hoja5->getColumnDimension('E')->setWidth(70,'pt');

            $hoja5->getColumnDimension('F')->setWidth(90,'pt');
            $hoja5->getColumnDimension('G')->setWidth(90,'pt');
            
            $hoja5->getStyle('A2')->getFont()->SetBold(true);
            $hoja5->getStyle('A2')->getFont()->SetSize(14);
            $hoja5->setCellValue('A2', "ESTADISTICAS - TOLUCA");
            $hoja5->mergeCells('A2:G2')->getStyle('A2:C2')->getAlignment()->setHorizontal('center');

            $hoja5->setCellValue('A3',"");
            $hoja5->mergeCells('A3:G3')->getStyle('A3:C3')->getAlignment()->setHorizontal('center');
            $hoja5->getStyle('A5:G5')->applyFromArray($styleArray);

            $hoja5->getStyle('A5:G5')->applyFromArray($styleArray,false);
            $hoja5->getStyle('A5:G5')->getAlignment()->setHorizontal('center');
            $hoja5->getStyle('A5:G5')->getFont()->SetBold(true);
            
            $hoja5->setCellValue('A5','LUGAR');
            $hoja5->setCellValue('B5','1er TIEMPO');
            $hoja5->setCellValue('C5','2do TIEMPO');
            $hoja5->setCellValue('D5','3er TIEMPO');
            $hoja5->setCellValue('E5','4to TIEMPO');
            $hoja5->setCellValue('F5','TOTAL TIEMPO(s)');
            $hoja5->setCellValue('G5','TOTAL GENERAL');

            $hoja5->getStyle('A6:G6')->applyFromArray($styleArray,false);
            $hoja5->getStyle('A6:G6')->getAlignment()->setHorizontal('center');
            $hoja5->getStyle('A6')->getFont()->SetBold(true);
            $hoja5->setCellValue('A6','TOLUCA');
            $hoja5->setCellValue('B6',$numturn1);
            $hoja5->setCellValue('C6',$numturn2);
            $hoja5->setCellValue('D6',$numturn3);
            $hoja5->setCellValue('E6','0');
            $turnoTotls = intval($hoja5->getCell('B6')->getValue()) + intval($hoja5->getCell('C6')->getValue()) + intval($hoja5->getCell('D6')->getValue());
            $hoja5->setCellValue('F6',$turnoTotls);
            $hoja5->setCellValue('G6',count($results));
            break;

        case 4:
            $nombreArchivo = "RESULTADOS TOLUCA34 - TURNO 4";
            $statementTurno = $db->prepare("SELECT id,nomcom,estatvoto,turnvoto FROM public.padrontol WHERE turnvoto='1' or turnvoto='2' or turnvoto='3' or turnvoto='".$turno."' order by turnvoto,id asc");
            $statementTurno->execute();
            $resultsTurno = $statementTurno->fetchAll(PDO::FETCH_ASSOC);

            $hoja2 = $spreadsheet->createSheet();
            $hoja2->getTabColor()->setRGB('1BA000');
            $hoja2->setTitle("TURNO 1");
            $hoja2->getColumnDimension('A')->setWidth(30,'pt');
            $hoja2->getColumnDimension('B')->setWidth(300,'pt');
            $hoja2->getColumnDimension('C')->setWidth(90,'pt');
            
            $hoja2->getStyle('A2')->getFont()->SetBold(true);
            $hoja2->getStyle('A2')->getFont()->SetSize(14);
            $hoja2->setCellValue('A2', "TURNO 1 - TOLUCA");
            $hoja2->mergeCells('A2:C2')->getStyle('A2:C2')->getAlignment()->setHorizontal('center');

            $hoja2->setCellValue('A3',"");
            $hoja2->mergeCells('A3:C3')->getStyle('A3:C3')->getAlignment()->setHorizontal('center');

            $hoja2->getStyle('A5:C5')->getAlignment()->setHorizontal('center');
            $hoja2->setCellValue('A5','NP');
            $hoja2->setCellValue('B5','NOMBRE');
            $hoja2->setCellValue('C5','TURNO DE VOTO');



            $hoja3 = $spreadsheet->createSheet();
            $hoja3->getTabColor()->setRGB('0167DA');
            $hoja3->setTitle("TURNO 2");
            $hoja3->getColumnDimension('A')->setWidth(30,'pt');
            $hoja3->getColumnDimension('B')->setWidth(300,'pt');
            $hoja3->getColumnDimension('C')->setWidth(90,'pt');
            
            $hoja3->getStyle('A2')->getFont()->SetBold(true);
            $hoja3->getStyle('A2')->getFont()->SetSize(14);
            $hoja3->setCellValue('A2', "TURNO 2 - TOLUCA");
            $hoja3->mergeCells('A2:C2')->getStyle('A2:C2')->getAlignment()->setHorizontal('center');

            $hoja3->setCellValue('A3',"");
            $hoja3->mergeCells('A3:C3')->getStyle('A3:C3')->getAlignment()->setHorizontal('center');

            $hoja3->getStyle('A5:C5')->getAlignment()->setHorizontal('center');
            $hoja3->setCellValue('A5','NP');
            $hoja3->setCellValue('B5','NOMBRE');
            $hoja3->setCellValue('C5','TURNO DE VOTO');



            $hoja4 = $spreadsheet->createSheet();
            $hoja4->getTabColor()->setRGB('EAF119');
            $hoja4->setTitle("TURNO 3");
            $hoja4->getColumnDimension('A')->setWidth(30,'pt');
            $hoja4->getColumnDimension('B')->setWidth(300,'pt');
            $hoja4->getColumnDimension('C')->setWidth(90,'pt');
            
            $hoja4->getStyle('A2')->getFont()->SetBold(true);
            $hoja4->getStyle('A2')->getFont()->SetSize(14);
            $hoja4->setCellValue('A2', "TURNO 3 - TOLUCA");
            $hoja4->mergeCells('A2:C2')->getStyle('A2:C2')->getAlignment()->setHorizontal('center');

            $hoja4->setCellValue('A3',"");
            $hoja4->mergeCells('A3:C3')->getStyle('A3:C3')->getAlignment()->setHorizontal('center');

            $hoja4->getStyle('A5:C5')->getAlignment()->setHorizontal('center');
            $hoja4->setCellValue('A5','NP');
            $hoja4->setCellValue('B5','NOMBRE');
            $hoja4->setCellValue('C5','TURNO DE VOTO');



            $hoja5 = $spreadsheet->createSheet();
            $hoja5->getTabColor()->setRGB('FE1414');
            $hoja5->setTitle("TURNO 4");
            $hoja5->getColumnDimension('A')->setWidth(30,'pt');
            $hoja5->getColumnDimension('B')->setWidth(300,'pt');
            $hoja5->getColumnDimension('C')->setWidth(90,'pt');
            
            $hoja5->getStyle('A2')->getFont()->SetBold(true);
            $hoja5->getStyle('A2')->getFont()->SetSize(14);
            $hoja5->setCellValue('A2', "TURNO 4 - TOLUCA");
            $hoja5->mergeCells('A2:C2')->getStyle('A2:C2')->getAlignment()->setHorizontal('center');

            $hoja5->setCellValue('A3',"");
            $hoja5->mergeCells('A3:C3')->getStyle('A3:C3')->getAlignment()->setHorizontal('center');

            $hoja5->getStyle('A5:C5')->getAlignment()->setHorizontal('center');
            $hoja5->setCellValue('A5','NP');
            $hoja5->setCellValue('B5','NOMBRE');
            $hoja5->setCellValue('C5','TURNO DE VOTO');
            
            $numregExcel = 6;
            $numregExcel2 = 6;
            $numregExcel3 = 6;
            $numregExcel4 = 6;
            $numturn1=0;
            $numturn2=0;
            $numturn3=0;
            $numturn4=0;
            foreach ($resultsTurno as $row) {
                if ($row["turnvoto"] == '1') {
                    $hoja2->setCellValue('A'. $numregExcel,$row["id"]);
                    $hoja2->setCellValue('B'. $numregExcel,$row["nomcom"]);
                    $hoja2->setCellValue('C'. $numregExcel,$row["turnvoto"]);
                    $celfdas= "A".$numregExcel.":C".$numregExcel."";
                    $hoja2->getStyle("A".$numregExcel)->getAlignment()->setHorizontal('center');
                    $hoja2->getStyle($celfdas)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('1BA000');                 
                    $numregExcel++;
                    $numturn1++;
                } elseif ($row["turnvoto"] == '2') {
                    $hoja3->setCellValue('A'. $numregExcel2,$row["id"]);
                    $hoja3->setCellValue('B'. $numregExcel2,$row["nomcom"]);
                    $hoja3->setCellValue('C'. $numregExcel2,$row["turnvoto"]);
                    $celfdas= "A".$numregExcel2.":C".$numregExcel2."";
                    $hoja3->getStyle("A".$numregExcel2)->getAlignment()->setHorizontal('center');
                    $hoja3->getStyle($celfdas)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('0167DA');                 
                    $numregExcel2++;
                    $numturn2++;
                } elseif ($row["turnvoto"] == '3') {
                    $hoja4->setCellValue('A'. $numregExcel3,$row["id"]);
                    $hoja4->setCellValue('B'. $numregExcel3,$row["nomcom"]);
                    $hoja4->setCellValue('C'. $numregExcel3,$row["turnvoto"]);
                    $celfdas= "A".$numregExcel3.":C".$numregExcel3."";
                    $hoja4->getStyle("A".$numregExcel3)->getAlignment()->setHorizontal('center');
                    $hoja4->getStyle($celfdas)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('EAF119');                 
                    $numregExcel3++;
                    $numturn3++;
                }elseif ($row["turnvoto"] == '4') {
                    $hoja5->setCellValue('A'. $numregExcel4,$row["id"]);
                    $hoja5->setCellValue('B'. $numregExcel4,$row["nomcom"]);
                    $hoja5->setCellValue('C'. $numregExcel4,$row["turnvoto"]);
                    $celfdas= "A".$numregExcel4.":C".$numregExcel4."";
                    $hoja5->getStyle("A".$numregExcel4)->getAlignment()->setHorizontal('center');
                    $hoja5->getStyle($celfdas)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FE1414');                 
                    $numregExcel4++;
                    $numturn4++;
                }
            }

            $hoja6 = $spreadsheet->createSheet();
            $hoja6->setTitle("ESTADISTICAS");
            $hoja6->getColumnDimension('A')->setWidth(75,'pt');
            $hoja6->getColumnDimension('B')->setWidth(70,'pt');
            $hoja6->getColumnDimension('C')->setWidth(70,'pt');
            $hoja6->getColumnDimension('D')->setWidth(70,'pt');
            $hoja6->getColumnDimension('E')->setWidth(70,'pt');

            $hoja6->getColumnDimension('F')->setWidth(90,'pt');
            $hoja6->getColumnDimension('G')->setWidth(90,'pt');
            
            $hoja6->getStyle('A2')->getFont()->SetBold(true);
            $hoja6->getStyle('A2')->getFont()->SetSize(14);
            $hoja6->setCellValue('A2', "ESTADISTICAS - TOLUCA");
            $hoja6->mergeCells('A2:G2')->getStyle('A2:C2')->getAlignment()->setHorizontal('center');

            $hoja6->setCellValue('A3',"");
            $hoja6->mergeCells('A3:G3')->getStyle('A3:C3')->getAlignment()->setHorizontal('center');
            $hoja6->getStyle('A5:G5')->applyFromArray($styleArray);

            $hoja6->getStyle('A5:G5')->applyFromArray($styleArray,false);
            $hoja6->getStyle('A5:G5')->getAlignment()->setHorizontal('center');
            $hoja6->getStyle('A5:G5')->getFont()->SetBold(true);
            
            $hoja6->setCellValue('A5','LUGAR');
            $hoja6->setCellValue('B5','1er TIEMPO');
            $hoja6->setCellValue('C5','2do TIEMPO');
            $hoja6->setCellValue('D5','3er TIEMPO');
            $hoja6->setCellValue('E5','4to TIEMPO');
            $hoja6->setCellValue('F5','TOTAL TIEMPO(s)');
            $hoja6->setCellValue('G5','TOTAL GENERAL');

            $hoja6->getStyle('A6:G6')->applyFromArray($styleArray,false);
            $hoja6->getStyle('A6:G6')->getAlignment()->setHorizontal('center');
            $hoja6->getStyle('A6')->getFont()->SetBold(true);
            $hoja6->setCellValue('A6','TOLUCA');
            $hoja6->setCellValue('B6',$numturn1);
            $hoja6->setCellValue('C6',$numturn2);
            $hoja6->setCellValue('D6',$numturn3);
            $hoja6->setCellValue('E6',$numturn4);
            $turnoTotls = intval($hoja6->getCell('B6')->getValue()) + intval($hoja6->getCell('C6')->getValue()) + intval($hoja6->getCell('D6')->getValue()) + intval($hoja6->getCell('E6')->getValue());
            $hoja6->setCellValue('F6',$turnoTotls);
            $hoja6->setCellValue('G6',count($results));
            break;
        default:
            
            break;
    }

    

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header("Content-Disposition: attachment;filename=".$nombreArchivo .".xls");
    header('Cache-Control: max-age=0');

    $writer = IOFactory::createWriter($spreadsheet, 'Xls');
    $writer->save('php://output');

    try {
        //$writer->save('hello world.xlsx');
        $writer = new Xlsx($spreadsheet);
        exit;
    } catch (\Throwable $th) {
        echo("hubiou un error");
    }

?>