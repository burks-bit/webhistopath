<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

use Mpdf\Mpdf;

class PdfService
{
    public function generatePDF($htmlContent, $fileName)
    {
        Log::inf('generatedPDF');
        Log::info('Generating PDF with content: ' . $htmlContent);

        try {
            // Initialize mPDF
            $mpdf = new Mpdf();

            // Write HTML content to the PDF
            $mpdf->WriteHTML($htmlContent);

            // Output the PDF for download
            return response($mpdf->Output($fileName, \Mpdf\Output\Destination::STRING_RETURN), 200)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');
        } catch (\Exception $e) {
            \Log::error('Error generating PDF: ' . $e->getMessage());
            return response()->json(['error' => 'PDF generation failed'], 500);
        }
    }
}
