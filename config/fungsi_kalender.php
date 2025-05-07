<?php
function buatkalender($tanggal, $bulan, $tahun) {
    date_default_timezone_set('Asia/Jakarta'); // Pastikan zona waktu sesuai

    $hariIni = date("d");
    $bulanIni = date("n");
    $tahunIni = date("Y");

    $bulanIndo = array(1 => "Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des");

    $jmlHari = date("t", mktime(0, 0, 0, $bulan, 1, $tahun));
    $hariPertama = date("w", mktime(0, 0, 0, $bulan, 1, $tahun));

    $kalender = "<div class='table-responsive' style='max-width: 150px; font-size: 0.25rem;'>";
    $kalender .= "<table class='table table-bordered table-sm text-center' style='width: 100%; font-size: 0.60rem;'>";
    $kalender .= "<thead class='table-primary'>
                    <tr><th colspan='7' class='p-1'>{$bulanIndo[$bulan]} $tahun</th></tr>
                    <tr class='bg-light'>
                        <th class='text-danger p-1'>M</th> 
                        <th class='p-1'>S</th> <th class='p-1'>S</th> <th class='p-1'>R</th>
                        <th class='p-1'>K</th> <th class='p-1'>J</th> <th class='p-1'>S</th>
                    </tr>
                  </thead>
                  <tbody>";

    $a = 1;
    $mulaicetak = 0;
    $adabaris = true;

    while ($adabaris) {
        $kalender .= "<tr>";
        for ($i = 0; $i < 7; $i++) {
            if ($mulaicetak < $hariPertama) {
                $kalender .= "<td class='p-1'>&nbsp;</td>";
                $mulaicetak++;
            } elseif ($a <= $jmlHari) {
                $tt = $a;
                $classHari = ($i == 0) ? "text-danger" : "";
                
                // Highlight tanggal hari ini
                if ($a == (int)$hariIni && $bulan == (int)$bulanIni && $tahun == (int)$tahunIni) {
                    $tt = "<span class='fw-bold text-white bg-primary p-1'>$tt</span>";
                }
                
                $kalender .= "<td class='$classHari p-1'>$tt</td>";
                $a++;
            } else {
                $kalender .= "<td class='p-1'>&nbsp;</td>";
            }
        }
        $kalender .= "</tr>";
        $adabaris = ($a <= $jmlHari);
    }
    $kalender .= "</tbody></table></div>";

    return $kalender;
}
?>
