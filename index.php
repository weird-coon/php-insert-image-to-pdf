<?php
    /*
     * Đọc kĩ hướng dẫn trước khi dùng như dùng thuốc tránh thai:
     * Cái thư viện củ lol này chỉ đọc được pdf phiên bản 1.4 trở xuống
     * Version trên xịn quá nó ngu không đọc được
     * Về version của cái thư viện fpdi có 2 bản 1 với 2, để dễ xài dùng bản 1
     * t có tải rồi m lấy dùng thôi (nằm trong lib)
     * M có thể convert version pdf tại đây:
     * https://docupub.com/pdfconvert/
     * Tại phần Compatibility chọn ver 1.4
     * ---------------------------------------------------
     * */

    require_once('lib/fpdf/fpdf.php');
    require_once('lib/fpdi/fpdi.php');

    /**
     * Insert images files in existing PDF file
     *
     * @param string $path đường dẫn tới file cần thêm chữ kí
     * @param string $output đường dẫn tới chổ lưu (có cả tên file)
     * @param string $image đường dẫn tới hình ảnh muốn chèn (chữ kí)
     * @throws Exception
     */
    function generatePDF($path, $output, $image) {
        $pdf = new FPDI();
        $pdf->AddPage();
        $pdf->setSourceFile($path);
        // Nhúng cái trang mà chèn chữ kí
        $tppl = $pdf->importPage(2);
        $pdf->useTemplate($tppl);

        // Config hình ảnh ở đây, x, y, w, h trên hình ảnh
        // Đọc tài liệu về cách dùng image với tham số cụ thể
        // Link: http://fpdf.org/en/doc/image.htm
        $pdf->Image($image,160,130,30,10); // X start, Y start, X width, Y width in mm
        $pdf->Output($output, "F");
    }

    // Nên try catch, chạy ngon không có lỗi sẽ chạy vào try
    // Có lỗi sẽ bắt trong catch
    // Ví dụ m không muốn hiện lỗi loằng ngoằng "$e->getMessage()" thì in đại cái gì đó ra cũng được
    try {
        // Gọi hàm truyền mấy cái tham số vô
        generatePDF("assets/test-v1-4.pdf", "assets/output/updated.pdf", "assets/obama.png");
        // Notification
        echo '<script>alert("Success!")</script>';
    } catch (Exception $e) {
        echo $e->getMessage();
    }
