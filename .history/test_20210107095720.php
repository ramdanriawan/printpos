<?php
// /* Change to the correct path if you copy this example! */
// require __DIR__ . '/vendor/autoload.php';
// use Mike42\Escpos\Printer;
// use Mike42\Escpos\EscposImage;
// use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

// /**
//  * Install the printer using USB printing support, and the "Generic / Text Only" driver,
//  * then share it (you can use a firewall so that it can only be seen locally).
//  *
//  * Use a WindowsPrintConnector with the share name to print.
//  *
//  * Troubleshooting: Fire up a command prompt, and ensure that (if your printer is shared as
//  * "Receipt Printer), the following commands work:
//  *
//  *  echo "Hello World" > testfile
//  *  copy testfile "\\DESKTOP-ECN9CSG\RP58 Printer(1)"
//  *  del testfile
//  */
// try {
//     // die(__DIR__ . "\\logo.png");
//     // Enter the share name for your USB printer here
//     // $connector = null;
//     $connector = new WindowsPrintConnector("RP58");

//     /* Print a "Hello world" receipt" */
//     $printer = new Printer($connector);

//     $img = EscposImage::load(__DIR__ . "/logo2.png");
//     $printer->setJustification(Printer::JUSTIFY_CENTER);
//     $printer -> bitImageColumnFormat($img);
    
//     $printer -> text("\n");
//     $printer -> text("==============================\n");
//     $printer -> text("KARTU PENGOBATAN HEWAN TERNAK\n");
//     $printer -> text("===============================\n");
//     $printer -> text("Tanggal   : Ibrahim\n");
//     $printer -> text("Nama Hewan      : Brams\n");
//     $printer -> text("Jenis Hewan     : Kucing\n");
//     $printer -> text("Umur            : 15 Thn\n");
//     $printer -> text("Jenis Kelamin   : Jantan\n");
//     $printer -> text("Ras / Breed     : Angora\n");
//     $printer -> text("Warna           : Putih\n");
//     $printer -> text("Pemilik         : Ramdan\n");
//     $printer -> text("Alamat / Telp   : Ibrahim\n");
//     $printer -> text("Total Biaya     : Ibrahim\n");
//     $printer -> text("No. Rekam Medis     : Ibrahim\n");
//     $printer -> text("===============================\n");
//     $printer -> text("===============================\n");
//     $printer -> cut();
    
//     /* Close printer */
//     $printer -> close();
// } catch (\Exception $e) {
//     echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
// }


/* Print-outs using the newer graphics print command */

// require __DIR__ . '/vendor/autoload.php';
// use Mike42\Escpos\Printer;
// use Mike42\Escpos\EscposImage;
// use Mike42\Escpos\PrintConnectors\FilePrintConnector;
// use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
// $connector = new WindowsPrintConnector("RP58");
// $printer = new Printer($connector);
// try {
//     $tux = EscposImage::load("logo2.png", false);
//     $printer->graphics($tux);
//     $printer->text("Regular Tux.\n");
//     $printer->feed();
//     $printer->graphics($tux, Printer::IMG_DOUBLE_WIDTH);
//     $printer->text("Wide Tux.\n");
//     $printer->feed();
//     $printer->graphics($tux, Printer::IMG_DOUBLE_HEIGHT);
//     $printer->text("Tall Tux.\n");
//     $printer->feed();
//     $printer->graphics($tux, Printer::IMG_DOUBLE_WIDTH | Printer::IMG_DOUBLE_HEIGHT);
//     $printer->text("Large Tux in correct proportion.\n");
//     $printer->cut();
// } catch (Exception $e) {
//     /* Images not supported on your PHP, or image file not found */
//     $printer->text($e->getMessage() . "\n");
// }
// $printer->close();

require __DIR__ . '/vendor/autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

/* Open the printer; this will change depending on how it is connected */
$connector = new WindowsPrintConnector("RP58");
$printer = new Printer($connector);

/* Information for the receipt */
$items = array(
    new item("Example item #1", "4.00"),
    new item("Another thing", "3.50"),
    new item("Something else", "1.00"),
    new item("A final item", "4.45"),
);
$subtotal = new item('Subtotal', '12.95');
$tax = new item('A local tax', '1.30');
$total = new item('Total', '14.25', true);
/* Date is kept the same for testing */
// $date = date('l jS \of F Y h:i:s A');
$date = "Monday 6th of April 2015 02:56:25 PM";

/* Start the printer */
$logo = EscposImage::load("logo2.png", false);
$printer = new Printer($connector);

/* Print top logo */
$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer -> graphics($logo);

/* Name of shop */
$printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
$printer -> text("ExampleMart Ltd.\n");
$printer -> selectPrintMode();
$printer -> text("Shop No. 42.\n");
$printer -> feed();

/* Title of receipt */
$printer -> setEmphasis(true);
$printer -> text("SALES INVOICE\n");
$printer -> setEmphasis(false);

/* Items */
$printer -> setJustification(Printer::JUSTIFY_LEFT);
$printer -> setEmphasis(true);
$printer -> text(new item('', '$'));
$printer -> setEmphasis(false);
foreach ($items as $item) {
    $printer -> text($item);
}
$printer -> setEmphasis(true);
$printer -> text($subtotal);
$printer -> setEmphasis(false);
$printer -> feed();

/* Tax and total */
$printer -> text($tax);
$printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
$printer -> text($total);
$printer -> selectPrintMode();

/* Footer */
$printer -> feed(2);
$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer -> text("Thank you for shopping at ExampleMart\n");
$printer -> text("For trading hours, please visit example.com\n");
$printer -> feed(2);
$printer -> text($date . "\n");

/* Cut the receipt and open the cash drawer */
$printer -> cut();
$printer -> pulse();

$printer -> close();

/* A wrapper to do organise item names & prices into columns */
class item
{
    private $name;
    private $price;
    private $dollarSign;

    public function __construct($name = '', $price = '', $dollarSign = false)
    {
        $this -> name = $name;
        $this -> price = $price;
        $this -> dollarSign = $dollarSign;
    }

    public function __toString()
    {
        $rightCols = 10;
        $leftCols = 38;
        if ($this -> dollarSign) {
            $leftCols = $leftCols / 2 - $rightCols / 2;
        }
        $left = str_pad($this -> name, $leftCols) ;

        $sign = ($this -> dollarSign ? '$ ' : '');
        $right = str_pad($sign . $this -> price, $rightCols, ' ', STR_PAD_LEFT);
        return "$left$right\n";
    }
}