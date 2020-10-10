<?php
Class ReportDataKaryawan extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        $this->load->library('pdf');
    }
    
    function index(){
        $pdf = new FPDF('L','mm','legal');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->setTopMargin(22);
        $pdf->setLeftMargin(5);
        
        // Logo
        $pdf->Image(base_url('img/Logo-UBM.png'),10,15,55);
        $pdf->Cell(80);
        $pdf->SetTextColor(0,0,128);
        $pdf->SetFont('Times','B',20);
        $pdf->Cell(420,7,'UNIVERSITAS BUNDA MULIA',0,1,'C');
        $pdf->Cell(10,7,'',0,1);
        $pdf->SetFont('Times','',12);
        $pdf->Cell(345,7,'Kampus Ancol',0,1,'R');
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(345,7,'Jl. Lodan Raya No. 2, Ancol, Jakarta Utara 14430',0,1,'R');
        $pdf->SetTextColor(0,0,128);
        $pdf->Cell(345,7,'Kampus Serpong',0,1,'R');
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(345,7,'Jl. Jalur Sutera Barat Kav. 7-9, Alam Sutera, Tangerang 15143',0,1,'R');
        $pdf->Cell(345,7,'(021) 692 9090 | www.ubm.ac.id',0,1,'R');
        $pdf->Ln(15);

        // mencetak string 
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Times','B',18);
        $pdf->Cell(350,7,'DAFTAR KARYAWAN',0,1,'C');
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,7,'',0,1);
        $pdf->SetFont('Times','B',11);
        $pdf->Cell(21,6,'NIK',1,0,'C');
        $pdf->Cell(55,6,'FULLNAME',1,0,'C');
        $pdf->Cell(25,6,'GENDER',1,0,'C');
        $pdf->Cell(25,6,'RELIGION',1,0,'C');
        $pdf->Cell(55,6,'ADDRESS',1,0,'C');
        $pdf->Cell(50,6,'EMAIL',1,0,'C');
        $pdf->Cell(28,6,'PHONE',1,0,'C');
        $pdf->Cell(35,6,'DEPARTMENT',1,0,'C');
        $pdf->Cell(35,6,'POSITION',1,0,'C');
        $pdf->Cell(16,6,'ACTIVE',1,1,'C');
        
        $pdf->SetFont('Times','',11);
        $data_karyawan = $this->db->get('dt_karyawan')->result();
        foreach ($data_karyawan as $row){
            $pdf->Cell(21,6,$row->nik,1,0);
            $pdf->Cell(55,6,$row->fullname,1,0);
            $pdf->Cell(25,6,$row->gender,1,0);
            $pdf->Cell(25,6,$row->religion,1,0);
            $pdf->Cell(55,6,$row->address,1,0);
            $pdf->Cell(50,6,$row->email,1,0);
            $pdf->Cell(28,6,$row->phone,1,0);
            $pdf->Cell(35,6,$row->department,1,0);
            $pdf->Cell(35,6,$row->position,1,0);
            $pdf->Cell(16,6,$row->active,1,1,'C');
        }
        $pdf->Output('daftar_karyawan','I');
    }
}