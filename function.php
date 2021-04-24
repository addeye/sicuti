<?php
function tanggal_indo($tanggal)
{
    $bulan = [1 => 'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember',
    ];
    $split = explode('-', $tanggal);

    return $split[2] . ' ' . $bulan[(int) $split[1]] . ' ' . $split[0];
}

function dmy($date){
    return date('d-m-Y', strtotime($date));
}

function hari($date){
    $daftar_hari = array(
        'Sunday' => 'Minggu',
        'Monday' => 'Senin',
        'Tuesday' => 'Selasa',
        'Wednesday' => 'Rabu',
        'Thursday' => 'Kamis',
        'Friday' => 'Jumat',
        'Saturday' => 'Sabtu'
       );

    $namahari = date('l', strtotime($date));
    return $daftar_hari[$namahari];
}

function pukul($time){
    return date('H:i', strtotime($time));
}

function masakerja($tanggal_lahir){
	$birthDate = new DateTime($tanggal_lahir);
	$today = new DateTime("today");
	if ($birthDate > $today) {
	    exit("0 tahun 0 bulan 0 hari");
	}
	$y = $today->diff($birthDate)->y;
	$m = $today->diff($birthDate)->m;
	$d = $today->diff($birthDate)->d;

    $text = '';

    if($y){
        $text .= $y." tahun ";
    }
    if($m){
        $text .= $m." bulan ";
    }
    if($d){
        $text .= $d." hari";
    }

	return $text;
}

?>