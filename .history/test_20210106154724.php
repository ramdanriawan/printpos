<?php

include __DIR__.'/vendor/autoload.php';

use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

try {
    // Enter the share name for your USB printer here
    // $connector = null;
    $computerName = getenv('COMPUTERNAME');
    $printerName = die(getenv('COMPUTERNAME'));

    $connector = new WindowsPrintConnector("\\DESKTOP-ECN9CSG/RP58 Printer(1)");

    /* Print a "Hello world" receipt" */
    $printer = new Printer($connector);
    $printer -> text("Hello World!\n");
    $printer -> cut();
    
    /* Close printer */
    $printer -> close();
} catch (Exception $e) {
    echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
}