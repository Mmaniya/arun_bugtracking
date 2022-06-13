<?php
use Zxing\QrReader;
require __DIR__ . "/vendor/autoload.php";
$qrcode = new QrReader('../QRcode/'. $filename);
$isbn = $qrcode->text();

// https://www.the-qrcode-generator.com/