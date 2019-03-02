<?php
    require_once('lib/fpdf/fpdf.php');
    require_once('lib/fpdi/fpdi.php');

    /**
     * Insert images files in existing PDF file
     *
     * @param string $path
     * @param string $output
     * @param string $image
     */
    function generatePDF($path, $output, $image) {
        try {
            // initiate FPDI
            $pdf = new FPDI();
            // set the source file
            $pageCount = $pdf->setSourceFile($path);
            for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
                $templateIndex = $pdf->importPage($pageNo);
                $pdf->AddPage();
                $pdf->useTemplate($templateIndex);
                if ($pageNo === 2) {
                    $pdf->Image($image,160,130,30,10);
                }
            }
            $pdf->Output($output, 'F');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    // Call function
    generatePDF("assets/test-v1-4.pdf", "assets/output/result.pdf", "assets/obama.png");
