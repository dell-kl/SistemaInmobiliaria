<?php

namespace App\Http\Controllers;

use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;
use GdImage;
use Illuminate\Http\Request;

class GenerateQRController extends Controller
{
    //

    public function __construct()
    {

    }

    public function vista()
    {
        $writer = new PngWriter();

        //vamos a generar aqui la parte del codigo qr
        $qr = new QrCode(
            data: config('app.url_api') . '/api/auth/qr',
            encoding: new Encoding('UTF-8'),
            errorCorrectionLevel: ErrorCorrectionLevel::Low,
            size: 300,
            margin: 10,
            roundBlockSizeMode: RoundBlockSizeMode::Margin,
            foregroundColor: new Color(0, 0, 0),
            backgroundColor: new Color(255, 255, 255)
        );

        $resultado = $writer->write($qr);

        return response($resultado->getString())
            ->header('Content-Type', $resultado->getMimeType());
    }

}
