<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Exception;

use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    public function pdfview(){
        return view('myPDF');
    }
    public function generatePDF()
    {
        try {
            $users = User::get();
            $data = [
                'title' => 'Welcome to Webappfix',
                'date' => date('m/d/y'),
                'users' => $users,
            ];

            $pdf =PDF::loadView('myPDF', $data);

            // Check if the PDF was generated successfully
            if (!$pdf) {
                throw new Exception('PDF generation failed.');
            }

            return $pdf->download('webappfix.pdf');
        } catch (Exception $e) {
            // If PDF generation fails, handle the error gracefully
            return "PDF generation error: " . $e->getMessage();
        }
    }
}


