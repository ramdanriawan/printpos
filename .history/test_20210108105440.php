<?php

// require __DIR__ . '/vendor/autoload.php';

// use Mike42\Escpos\EscposImage;
// use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
// use Mike42\Escpos\Printer;

// try {
    
//     // Enter the share name for your USB printer here
//     $connector = new WindowsPrintConnector("RP58");

//     $printer = new Printer($connector);
//     $printer->setEmphasis(false);

//     $printer->setJustification(Printer::JUSTIFY_CENTER);
//     $img = EscposImage::load(__DIR__ . "/logo.png");
//     $printer->bitImageColumnFormat($img);

//     $printer->initialize();
//     $printer->setJustification(Printer::JUSTIFY_LEFT);

//     $printer->setTextSize(4, 4);
//     $printer->text("\n");
//     $printer->text("================\n");
//     $printer->text("KARTU PENGOBATAN HEWAN TERNAK\n");
//     $printer->text("================\n");
//     $printer->initialize();

//     $printer->text("Tanggal         : $_GET[tanggal]\n");
//     $printer->text("Nama Hewan      : $_GET[nama_hewan]\n");
//     $printer->text("Jenis Hewan     : $_GET[jenis_hewan]\n");
//     $printer->text("Umur            : $_GET[umur]\n");
//     $printer->text("Jenis Kelamin   : $_GET[jenis_kelamin]\n");
//     $printer->text("Ras / Breed     : $_GET[ras_bred]\n");
//     $printer->text("Warna           : $_GET[warna]\n");
//     $printer->text("Pemilik         : $_GET[pemilik]\n");
//     $printer->text("Alamat / Telp   : $_GET[alamat_telp]\n");
//     $printer->text("No. Rekam Medis : $_GET[no_rekam_medis]\n");
//     $printer->text("Total Biaya     : $_GET[total_biaya]\n");
//     $printer->text("===============================\n");
//     $printer->feed();

//     $printer->setTextSize(4, 4);
//     $printer->text("Terimakasih Atas Kunjungan Anda :)");
//     $printer->initialize();
//     $printer->text("===============================\n");

//     $printer->setJustification(Printer::JUSTIFY_CENTER);
//     // $printer->qrCode($_GET['qrCode'], Printer::QR_ECLEVEL_L, 8);
//     $printer->feed();
//     $printer->feed();
//     $printer->initialize();

//     $printer->cut();
//     $printer->close();
// } catch (\Exception $e) {

//     echo "Couldn't print to this printer: " . $e->getMessage() . "\n";
// }



$data = [
    'id_rekam_medis' => $id_rekam_medis,
    'nama_hewan' => $nama_hewan,
    'pemilik' => $pemilik,
    'info' => $info,
]


$query = http_build_query($produks);
// die($query);

$results = [];
parse_str($query, $results);
print_r($results);