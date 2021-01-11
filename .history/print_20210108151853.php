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

//     $printer->text("\n");
//     $printer->text("================================\n");
//     $printer->text("KARTU PENGOBATAN HEWAN TERNAK\n");
//     $printer->text("================================\n");
//     $printer->initialize();

//     $printer->text("No. Rekam Medis : $_GET[no_rekam_medis]\n");
//     $printer->text("Tanggal         : $_GET[tanggal]\n");
//     $printer->text("Nama Hewan      : $_GET[nama_hewan]\n");
//     $printer->text("Pemilik         : $_GET[pemilik]\n");
//     $printer->text("Info            : $_GET[info]\n");

//     $printer->text("================================\n");
//     $printer->text("Rincian\n");
//     $printer->text("================================\n");
    
//     foreach ($_GET['produks'] as $item) {
//         $printer->text("Keterangan  : $item[keterangan]\n");
//         $printer->text("Jumlah      : $item[jumlah]\n");
//         $printer->text("Biaya       : $item[biaya]\n");
//         $printer->text("Sub Total   : $item[sub_total]\n");

//         $printer->text("------------------------------\n");
//     }
    
//     $printer->text("================================\n");
//     $printer->text("Total Biaya      : $_GET[total_biaya]\n");
//     $printer->text("Telah Dibayarkan : $_GET[telah_dibayarkan]\n");
//     $printer->text("status           : $_GET[status]\n");

//     $printer->text("===============================\n");
//     $printer->feed();

//     $printer->text("TERIMAKASIH ATAS KUNJUNGAN ANDA :)");
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

// echo "<pre>";
// print_r($_GET);

// $results = [];
// parse_str($_GET, $results);
// print_r($results);

$mask = "|%5.5s |%-30.30s | x |\n";
printf($mask, 'Num', 'Title');
printf($mask, '1', 'A value that fits the cell');
printf($mask, '2', 'A too long value the end of which will be cut off');