<?php

require __DIR__ . '/vendor/autoload.php';

use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;

try {
    
    // Enter the share name for your USB printer here
    $connector = new WindowsPrintConnector("RP58");

    $printer = new Printer($connector);
    $printer->setEmphasis(false);

    $printer->setJustification(Printer::JUSTIFY_CENTER);
    $img = EscposImage::load(__DIR__ . "/logo.png");
    $printer->bitImageColumnFormat($img);

    $printer->initialize();
    $printer->setJustification(Printer::JUSTIFY_LEFT);

    $printer->setTextSize(4, 4);
    $printer->text("\n");
    $printer->text("================\n");
    $printer->text("KARTU PENGOBATAN HEWAN TERNAK\n");
    $printer->text("================\n");
    $printer->initialize();

    $printer->text("Tanggal         : Ibrahim\n");
    $printer->text("Nama Hewan      : Brams\n");
    $printer->text("Jenis Hewan     : Kucing\n");
    $printer->text("Umur            : 15 Thn\n");
    $printer->text("Jenis Kelamin   : Jantan\n");
    $printer->text("Ras / Breed     : Angora\n");
    $printer->text("Warna           : Putih\n");
    $printer->text("Pemilik         : Ramdan\n");
    $printer->text("Alamat / Telp   : Ibrahim\n");
    $printer->text("No. Rekam Medis : xxxxx\n");
    $printer->text("Total Biaya     : Rp5000\n");
    $printer->text("===============================\n");
    $printer->feed();

    $printer->setTextSize(4, 4);
    $printer->text("Terimakasih Atas Kunjungan Anda :)");
    $printer->initialize();
    $printer->text("===============================\n");

    $printer->setJustification(Printer::JUSTIFY_CENTER);
    $printer->qrCode('TRS00000000001', Printer::QR_ECLEVEL_L, 8);
    $printer->feed();
    $printer->feed();
    $printer->initialize();

    $printer->cut();
    $printer->close();
} catch (\Exception $e) {

    echo "Couldn't print to this printer: " . $e->getMessage() . "\n";
}
