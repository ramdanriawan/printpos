<?php
/* Change to the correct path if you copy this example! */
require __DIR__ . '/vendor/autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

/**
 * Install the printer using USB printing support, and the "Generic / Text Only" driver,
 * then share it (you can use a firewall so that it can only be seen locally).
 *
 * Use a WindowsPrintConnector with the share name to print.
 *
 * Troubleshooting: Fire up a command prompt, and ensure that (if your printer is shared as
 * "Receipt Printer), the following commands work:
 *
 *  echo "Hello World" > testfile
 *  copy testfile "\\DESKTOP-ECN9CSG\RP58 Printer(1)"
 *  del testfile
 */
try {
    // Enter the share name for your USB printer here
    // $connector = null;
    $connector = new WindowsPrintConnector("RP58");

    /* Print a "Hello world" receipt" */
    $printer = new Printer($connector);
    $printer->selectPrintMode(Printer::MODE_FONT_B);
    $printer -> text("==============================\n");
    $printer -> text("KARTU PENGOBATAN HEWAN TERNAK\n");
    $printer -> text("===============================\n");
    $printer -> text("Nama Hewan        : Brams\n");
    $printer -> text("Jenis Hewan       : Kucing\n");
    $printer -> text("Umur\n            : 15 Thn");
    $printer -> text("Jenis Kelamin     : Jantan\n");
    $printer -> text("Ras / Breed\n     : Angora");
    $printer -> text("Warna\n           : Putih");
    $printer -> text("Pemilik\n         : Ramdan");
    $printer -> text("Alamat / Telp\n   : Ibrahim");
    $printer -> cut();
    
    /* Close printer */
    $printer -> close();
} catch (Exception $e) {
    echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
}
