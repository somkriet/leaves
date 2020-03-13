<?php 
 require('application/controllers/html_table.php');
if(!defined('BASEPATH')) exit('No direct script access allowed');
Class report_time_att extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('login')){
			redirect('login');
			exit();
		}else{
			$this->load->library("fpdf/fpdf");
			$this->load->model('all_model');
			define('FPDF_FONTPATH','application/libraries/fpdf/font');
		}
	}
	public function index()
	{
		$data['user']=$this->session->userdata('login');
		// print_r($data['user']['user_ID']); exit();
		$data['nav']='';
		$data['starttime']=$this->input->post('search_start_date');
		$data['endtime']=$this->input->post('search_end_date');
		$data['user_id']=$this->input->post('txt_employee');
		$data['depart_id']=$this->input->post('txt_depart');
		$data['department'] = $this->all_model->call_all("SELECT department_ID,department_Name FROM department WHERE delete_flag = 0");
		if(isset($_POST['print_time'])){
		$data['search_time_att'] = $this->all_model->call_all("CALL mleave42_rev1(
																			".($data['user_id']==""?"NULL":"".$data['user_id']."").",
																			".($data['depart_id']==""?"NULL":"".$data['depart_id']."").",
																			'".$data['starttime']."',
																			'".$data['endtime']."')"); 
		///////////////////////////////////////////////EXCEL//////////////////////////////////////////////
		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('Score_Leave');
        // $this->excel->setActiveSheetIndex()->mergeCells('A1:'.$col_tmp.'3');
        // $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);
        $objDrawing = new PHPExcel_Worksheet_Drawing();
        $objDrawing->setName('Customer Signature');
        $objDrawing->setDescription('Customer Signature');
        //Path to signature .jpg file
        $signature = 'assets/img/logo_m.gif';    
        $objDrawing->setPath($signature);
        $objDrawing->setOffsetX(15);                     //setOffsetX works properly
        $objDrawing->setCoordinates('A1');             //set image to cell E38
        $objDrawing->setHeight(60);                     //signature height  
        $objDrawing->setWorksheet($this->excel->getActiveSheet());
        $this->excel->setActiveSheetIndex()->mergeCells('A1:C6');
        $this->excel->setActiveSheetIndex()->mergeCells('A7:A9');
        $this->excel->setActiveSheetIndex()->mergeCells('B7:B9');
        $this->excel->setActiveSheetIndex()->mergeCells('C7:C9');
        $this->excel->setActiveSheetIndex()->mergeCells('D7:D9');
        $this->excel->setActiveSheetIndex()->mergeCells('E7:E9');
	    $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(7);
	    $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(7);
	    $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(7);
	    $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
	    $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
        $this->excel->getActiveSheet()->setCellValue('D1','MEIKO TRANS(THAILAND)CO., LTD.');
        $this->excel->getActiveSheet()->setCellValue('D2','216/67 อาคาร แอล.พี.เอ็น.ทาวเวอร์ ชั้น 16 ยูนิตเอ ถนนนางลิ้นจี่ แขวงช่องนนทรี เขตยานนาวา กรุงเทพฯ 10120');
        $this->excel->getActiveSheet()->setCellValue('D3','216/67, L.P.N. Tower, 16th Floor Unit A, Nanglinchee Road, Chong Non See, Yannawa, Bangkok 10120');
        $this->excel->getActiveSheet()->setCellValue('D4','ATTENDANCE');
        $this->excel->getActiveSheet()->setCellValue('D5','Month:1-31 January 2016');
        $this->excel->getActiveSheet()->setCellValue('D6','4 = -3_<Attendance Score, 3=-4_<Attendance Score, 2=-6_<Attendance Score<-4, 1 = Attendance Score <-6(per year)');
        $this->excel->getActiveSheet()->getStyle('A7:E7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->setCellValue('A7','NO');
        $this->excel->getActiveSheet()->setCellValue('B7','DEPT');
        $this->excel->getActiveSheet()->setCellValue('C7','CODE');
        $this->excel->getActiveSheet()->setCellValue('D7','NAME');
        $this->excel->getActiveSheet()->setCellValue('E7','SURNAME');
        $data['column_ex'] = $this->all_model->call_all("SELECT * FROM score_leave Where delete_flag = 0");
        // $this->excel->getActiveSheet()->getStyle('F7')->getAlignment()->setTextRotation(90);
        $array = array('E');
		$current = 'E';
        foreach ($data['column_ex'] as $key => $value) {
			if ($current != 'ZZZ') {
				$current++;
			    $array[] = $current;
        		$this->excel->getActiveSheet()->setCellValue($current.'7',$value->th_name_score);
        		$this->excel->getActiveSheet()->getStyle($current.'7')->getAlignment()->setWrapText(true);
        		$this->excel->getActiveSheet()->getStyle($current.'7')->getAlignment()->setTextRotation(90);
        		$this->excel->getActiveSheet()->setCellValue($current.'8',$value->en_name_score);
        		$this->excel->getActiveSheet()->setCellValue($current.'9',$value->score);
			    $this->excel->getActiveSheet()->getColumnDimension($current)->setWidth(7.25);
			}
        }
        $this->excel->getActiveSheet()->getStyle('E8:'.$current.'8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        // $this->excel->getActiveSheet()->setCellValue('D4','Pcode');
        // $this->excel->getActiveSheet()->setCellValue('E4','Pname');

        $filename = "test";
        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="'.$filename.'".xls');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
        $objWriter->save('php://output');
		///////////////////////////////////////////////PDF////////////////////////////////////////////////
			$datenow = $this->DateThai(date('Y-m-d H:i:s'));
			$pdf=new PDF('P','mm','A4');
			$pdf->SetMargins( 5,10,5 );
			$pdf->AddPage();
			$pdf->AddFont('angsana','B','angsab.php');
			$pdf->AddFont('angsana','I','angsai.php');
			$pdf->AddFont('angsana','BI','angsaz.php');
			$pdf->AddFont('angsa','','angsa.php');    
			// $html='<img src="assets/img/Meiko-Japan_logo.png" width="50%" height="50%">';
			// $pdf->WriteHTML($html);
			$workid = "";
			$time_in = "";
			$time_out = "";
			foreach ($data['search_time_att']  as $key => $value) {
				if($value->time_in == ""){
					$time_in = $value->temp_time_in;
				}else{
					$time_in = $value->time_in;
				}
				if($value->time_out == ""){
					$time_out = $value->temp_time_out;
				}else{
					$time_out = $value->time_out;
				}
				$dates = $this->DateThai($value->rec_date);
				$caltime = $this->getTimeDiff($time_in,$time_out); 
				$hour = substr($caltime, 0,2);
				$minute = substr($caltime, 3,4);
					if($workid != $value->work_id){
						if($key != 0){
							$pdf->AddPage();
						}
						$pdf->SetFont('angsa','',25);
						$pdf->Cell(200,12,iconv( 'UTF-8','cp874' ,'Monthly Report'), 0,0,'C' );
						$pdf->SetFont('angsa','',16);
						$pdf->Cell(-60,-5,iconv( 'UTF-8','cp874' ,'Print : วัน'.$datenow), 0,0,'C' );
						$pdf->Cell(100,5,iconv( 'UTF-8','cp874' ,date('H:i:s')), 0,0,'C' );
						$pdf->SetFont('angsa','',18);
						$pdf->Cell(-420,28,iconv( 'UTF-8','cp874' ,$value->name_en." ".$value->surname_en), 0,0,'C' );
						$pdf->SetFont('angsa','',16);
						$pdf->Ln(20);       
				        $pdf->Cell(150,8,iconv( 'UTF-8','cp874' ,''),'1',0,'C');
				        $pdf->Cell(50,8,iconv( 'UTF-8','cp874' ,'รวมเวลา/TOTAL TIME'), '1',0,'C' );
				        $pdf->Ln(8); 
				        $pdf->Cell(80,10,iconv( 'UTF-8','cp874' ,'วันที่/DATE'),1,0,'C',0);
				        $pdf->Cell(20,10,iconv( 'UTF-8','cp874' ,'สาย/LATE'), '1',0,'C' );
				        $pdf->Cell(25,10,iconv( 'UTF-8','cp874' ,'เข้า/IN'), '1',0,'C' );
				        $pdf->Cell(25,10,iconv( 'UTF-8','cp874' ,'ออก/OUT'), '1',0,'C' );
				        $pdf->Cell(25,10,iconv( 'UTF-8','cp874' ,'ชั่วโมง/HOUR'), '1',0,'C' );
				        $pdf->Cell(25,10,iconv( 'UTF-8','cp874' ,'นาที/MINUTE'), '1',0,'C' );
					}
				$pdf->Ln(10); 
		        $pdf->Cell(80,10,iconv( 'UTF-8','cp874' ,'วัน'.$dates),1,0,'L',0);
		        if($time_in > '08:30'){
		        	$pdf->SetTextColor(255, 0, 0); 
		        	$pdf->Cell(20,10,iconv( 'UTF-8','cp874' ,'LATE'), '1',0,'C' );
		        	$pdf->SetTextColor(0, 0, 0); 
		        }else{
		        	$pdf->Cell(20,10,iconv( 'UTF-8','cp874' ,''), '1',0,'C' );
		        }
		        $pdf->Cell(25,10,iconv( 'UTF-8','cp874' ,$time_in), '1',0,'C' );
		        $pdf->Cell(25,10,iconv( 'UTF-8','cp874' ,$time_out), '1',0,'C' );
		        $pdf->Cell(25,10,iconv( 'UTF-8','cp874' ,$hour), '1',0,'C' );
		        $pdf->Cell(25,10,iconv( 'UTF-8','cp874' ,$minute), '1',0,'C' );
		        $workid = $value->work_id;
			}
		$pdf->Output();	
		
		}
		$this->load->view('template/v_header',$data);
		$this->load->view('v_report_time_att',$data);
		$this->load->view('template/v_footer');
	}
	public function run_employee(){
		$depart_id = $this->input->post("depart_id");
		$data = $this->all_model->call_all("SELECT * FROM user where department_ID = '$depart_id' AND user_status = 0");
		echo json_encode($data);
	}
	public function getTimeDiff($dtime,$atime)
	{
	 $nextDay=$dtime>$atime?1:0;
	 $dep=EXPLODE(':',$dtime);
	 $arr=EXPLODE(':',$atime);
	 $diff=ABS(MKTIME($dep[0],$dep[1],0,DATE('n'),DATE('j'),DATE('y'))-MKTIME($arr[0],$arr[1],0,DATE('n'),DATE('j')+$nextDay,DATE('y')));
	 $hours=FLOOR($diff/(60*60));
	 $mins=FLOOR(($diff-($hours*60*60))/(60));
	 // $secs=FLOOR(($diff-(($hours*60*60)+($mins*60))));
	 IF(STRLEN($hours)<2){$hours="0".$hours;}
	 IF(STRLEN($mins)<2){$mins="0".$mins;}
	 // IF(STRLEN($secs)<2){$secs="0".$secs;}
	 RETURN $hours.':'.$mins;
	}
	public function thai_date($time)
	{  
    global $thai_day_arr,$thai_month_arr;  
    $thai_date_return="วัน".$thai_day_arr[date("w",$time)];  
    $thai_date_return.= "ที่ ".date("j",$time);  
    $thai_date_return.=" เดือน".$thai_month_arr[date("n",$time)];  
    $thai_date_return.= " พ.ศ.".(date("Yํ",$time)+543);  
    $thai_date_return.= "  ".date("H:i",$time)." น.";  
    return $thai_date_return;  
	}  
	public function DateThai($strDate)

	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDaydate= date("w",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$TH_Day = array("อาทิตย์","จันทร์","อังคาร","พุธ","พฤหัสบดี","ศุกร์","เสาร์");
		$strMonthCut = array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฏาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
		$strMonthThai=$strMonthCut[$strMonth-1];
		$days = $TH_Day[$strDaydate];
		return "$days ที่ $strDay $strMonthThai $strYear";
	}
}
?>