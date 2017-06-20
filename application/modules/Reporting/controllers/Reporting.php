<?php 

class Reporting extends MY_Controller{
	
	function __construct(){
		parent:: __construct();
		$this->load->model(['M_Reporting']);
		$this->load->module('Templates');
	}

	function case_report($id){    		
    			
    	$case = $this->M_Reporting->get_case_by_caseid($id);
        if (count($case) >= 0){
        	foreach ($case as $key => $value) {
        		$stud_name = $value->name;
                $sdc_no = $value->sdc_no;
                $matric_no = $value->matric_no;
                $image = base_url().ltrim($value->picture, '.');
        	}
        }else{
            $stud_name = "";
            $sdc_no = "";
            $matric_no = "";
            $image = "";
        }

    	require('./fpdf/fpdf.php');
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',12);
        $pdf->Image('./assets/bu logo2.jpg', 10, 6);
        $pdf->SetY(7);
        $pdf->SetX(27);
        $pdf->Cell(0, 5, "Babcock University", 0, 1, 30);
        $pdf->SetFont('Arial','',10);
        $pdf->SetX(27);
        $pdf->Cell(0, 2, "Student Development Services", 0, 1, "L");
        $pdf->SetFont('Arial','',10);
        $pdf->SetX(27);
        $pdf->Cell(0, 5, "Student Disciplinary Case Management", 0, 1, "L");
        $pdf->SetFont('Arial','B',12);
        $pdf->SetY(30);
        //$pdf->SetX(80);
        $pdf->Cell(0, 5, "Student Name: $stud_name", 0, 1, "L");
        $pdf->SetFont('Arial','B',12);
         $pdf->Cell(0, 5, "Matric Number: $matric_no", 0, 1, "L");
        //$pdf->SetX(80);
        $pdf->Image($image, 165, 20);
        $pdf->SetFont('Arial','B',10);
        //$pdf->SetX(85);
        $pdf->Cell(0, 5, "SDC Number: $sdc_no", 0, 1, "L");

        // Colors, line width and bold font
        $pdf->SetFont('','B');
        $pdf->SetY(43);
        // Header
        $pdf->Ln();

    	if (count($case) >= 0) {
    		
    		foreach ($case as $key => $value) {
                $pdf->SetFont('Arial','B',10);
                $pdf->Cell(0, 10, "Infraction:", 0, 1, "L");
                $pdf->SetFont('Arial','',10);
                $pdf->Cell(0, 5, $value->infraction, 0, 1, "L");
                $pdf->SetFont('Arial','B',10);
                $pdf->Cell(0, 10, "Infraction Detail:", 0, 1, "L");
                $pdf->SetFont('Arial','',10);
    			$pdf->MultiCell(0, 4, $value->infraction_detail);
                $pdf->SetFont('Arial','B',10);
                $pdf->Cell(0, 10, "Panel Recommendation:", 0, 1, "L");
                $pdf->SetFont('Arial','',10);
                $pdf->Cell(0, 5, $value->panel_recom, 0, 1, "L");
                $pdf->SetFont('Arial','B',10);
                $pdf->Cell(0, 10, "Recommendation Details:", 0, 1, "L");
                $pdf->SetFont('Arial','',10);
                $pdf->MultiCell(0, 4, $value->panel_recom_det);
                $pdf->Cell(0, 10, "Date: $value->date", 0, 1, "L");

                $pdf->Ln();
    		}
        }else{
            $pdf->Cell(0, 10, "No Case to Display", 0, 1, "C");
        }

    	$pdf->Ln();
    	$pdf->SetFont('Arial','',12);
        $pdf->Cell(0, 20, "SDC Coordinator: Mrs. Afolayan, G. O                                    Signature/Date_________________", 0, 1, "L");
        $pdf->SetY(-35);
        $pdf->Cell(0,10,'Page '.$pdf->PageNo(),0,0,'C');
        $pdf->Output();
    }
}