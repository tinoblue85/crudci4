<?php 

namespace App\Controllers;


use \PhpOffice\PhpSpreadsheet\Spreadsheet;
use \PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Export extends BaseController
{
    //
	public function pegawai()
{
		$db      = \Config\Database::connect();
		$builder = $db->table('tbl_data_karyawan a');
		$builder->join("tbl_unit b","a.id_unit=b.id_unit");
		$builder->join("tbl_jabatan c","a.id_jabatan=c.id_jabatan");
		$builder->join("tbl_jenis_kelamin d","d.id_jenis_kelamin=a.id_jenis_kelamin");
		$builder->join("tbl_pendidikan e","e.id_pendidikan=a.id_pendidikan");
		$builder->join("tbl_status f","f.id_status=a.id_status");
    $spreadsheet = new Spreadsheet();
    // tulis header/nama kolom 
    $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A1', 'PERUSAHAAN')
                ->setCellValue('B1', 'NAMA')
                ->setCellValue('C1', 'KTP')
                ->setCellValue('D1', 'NPWP')
                ->setCellValue('E1', 'JENIS KELAMIN')
                ->setCellValue('F1', 'ALAMAT')
                ->setCellValue('G1', 'TEMPAT LAHIR')
                ->setCellValue('H1', 'TGL LAHIR')
                ->setCellValue('I1', 'TGL MULAI KERJA')
                ->setCellValue('J1', 'NAMA JABATAN')
                ->setCellValue('K1', 'STATUS')
                ->setCellValue('L1', 'PENDIDIKAN')
                ->setCellValue('M1', 'BPJS TK')
                ->setCellValue('N1', 'BPJS KESEHATAN');
    
    $column = 2;
	$dataPegawai=$builder->get()->getResultArray();
   
    foreach($dataPegawai as $data) {
        $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A' . $column, $data['nama_unit'])
                    ->setCellValue('B' . $column, $data['nama'])
                    ->setCellValue('C' . $column, " ".$data['ktp'])
                    ->setCellValue('D' . $column, " ".$data['npwp'])
                    ->setCellValue('E' . $column, $data['nama_jenis_kelamin'])
                    ->setCellValue('F' . $column, $data['alamat'])
                    ->setCellValue('G' . $column, $data['tempat_lahir'])
                    ->setCellValue('H' . $column, $data['tgl_lahir'])
                    ->setCellValue('I' . $column, $data['tgl_mulai_kerja'])
                    ->setCellValue('J' . $column, $data['nama_jabatan'])
                    ->setCellValue('K' . $column, $data['nama_status'])
                    ->setCellValue('L' . $column, $data['nama_pendidikan'])
                    ->setCellValue('M' . $column, $data['flag_bpjs_tk']==1?"Aktif":"Tidak Aktif")
                    ->setCellValue('N' . $column, $data['flag_bpjs_kes']==1?"Aktif":"Tidak Aktif");
        $column++;
    }
$spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getStyle('C1:D'.$column)->getNumberFormat()
    ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);
$styleArray = [
   
    'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
    ],
    'borders' => [
         'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            'color' => ['argb' => '000000'],
        ],
    ],
    
];

$spreadsheet->getActiveSheet()->getStyle("A2:N".$column)->applyFromArray($styleArray);
$styleJudul = [
    'font' => [
        'bold' => true,
    ],
    'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
    ],
    'borders' => [
         'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            'color' => ['argb' => '000000'],
        ],
    ],
    
];
$spreadsheet->getActiveSheet()->getStyle("A1:N1")->applyFromArray($styleJudul);
$spreadsheet->getActiveSheet()->freezePane('B3');
    // tulis dalam format .xlsx
    $writer = new Xlsx($spreadsheet);
    $fileName = 'Data Pegawai';

    // Redirect hasil generate xlsx ke web client
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename='.$fileName.'.xlsx');
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
}
}
?>