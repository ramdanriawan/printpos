<?php

require __DIR__ . '/vendor/autoload.php';

use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;

error_reporting(0);

try {
    
    // Enter the share name for your USB printer here
    $connector = new WindowsPrintConnector("RP58");

    $printer = new Printer($connector);
    $printer->setEmphasis(false);

    $printer->setJustification(Printer::JUSTIFY_CENTER);
    $img = EscposImage::load(__DIR__ . "/logo.png");
    $printer->bitImageColumnFormat($img);
    $printer->text($_GET['header']);

    $printer->initialize();
    $printer->setJustification(Printer::JUSTIFY_LEFT);

    $printer->text("\n");
    $printer->text("================================\n");
    $printer->text("NOTA PENGOBATAN HEWAN PELIHARAAN\n");
    $printer->text("================================\n");
    $printer->initialize();

    $printer->text("# $_GET[id_rekam_medis]\n");
    $printer->text("Tanggal         : $_GET[tanggal]\n");
    $printer->text("Nama Hewan      : $_GET[nama_hewan]\n");
    $printer->text("Pemilik         : $_GET[pemilik]\n");
    $printer->text("Info            : $_GET[info]\n");

    $printer->text("================================\n");
    $printer->text("Rincian\n");
    $printer->text("================================\n");
    
    foreach ($_GET['produks'] as $item) {
        $printer->text("($item[jumlah]) $item[keterangan]\n");
        $printer->text("Sub Total   : $item[sub_total]\n");
    }
    
    $printer->text("================================\n");
    $printer->text("Total Biaya      : $_GET[total_biaya]\n");
    $printer->text("Telah Dibayarkan : $_GET[telah_dibayarkan]\n");
    $printer->text("status           : $_GET[status]\n");

    $printer->text("===============================\n");
    $printer->text($_GET['footer'] . "\n");
    $printer->text($_GET['web'] . "\n");

    $printer->initialize();
    $printer->text("===============================\n");

    $printer->setJustification(Printer::JUSTIFY_CENTER);
    // $printer->qrCode($_GET['qrCode'], Printer::QR_ECLEVEL_L, 8);
    $printer->feed();
    $printer->feed();
    $printer->initialize();

    $printer->cut();
    $printer->close();
} catch (\Exception $e) {

    echo "Couldn't print to this printer: " . $e->getMessage() . "\n";
}

// echo "<pre>";

// print_r($_GET);

?>

<script> window.close(); </script>