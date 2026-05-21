<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function bulan()
{
    $bulan = array();
    $bulan['01'] = 'Januari';
    $bulan['02'] = 'Februari';
    $bulan['03'] = 'Maret';
    $bulan['04'] = 'April';
    $bulan['05'] = 'Mei';
    $bulan['06'] = 'Juni';
    $bulan['07'] = 'Juli';
    $bulan['08'] = 'Agustus';
    $bulan['09'] = 'September';
    $bulan['10'] = 'Oktober';
    $bulan['11'] = 'Nopember';
    $bulan['12'] = 'Desember';
    return $bulan;
}

function get_bulan($key)
{
    $bulan['01'] = 'Januari';
    $bulan['02'] = 'Februari';
    $bulan['03'] = 'Maret';
    $bulan['04'] = 'April';
    $bulan['05'] = 'Mei';
    $bulan['06'] = 'Juni';
    $bulan['07'] = 'Juli';
    $bulan['08'] = 'Agustus';
    $bulan['09'] = 'September';
    $bulan['10'] = 'Oktober';
    $bulan['11'] = 'Nopember';
    $bulan['12'] = 'Desember';
    return $bulan[$key];
}

if ( ! function_exists('encode_url'))
{
    function encode_url($key = '')
    {
        $CI =& get_instance();
        $CI->load->library('encrypt_url');
        return $CI->encrypt_url->encode($key);
    }
}

if ( ! function_exists('decode_url'))
{
    function decode_url($key = '')
    {
        $CI =& get_instance();
        $CI->load->library('encrypt_url');
        return $CI->encrypt_url->decode($key);
    }
}

if ( ! function_exists('alert'))
{
    function alert($type, $content, $validation_errors = FALSE)
    {
        $alert = '';
        $icon  = '';

        if ($type == 'error')
        {
            $alert = '<div class="alert alert-danger alert-dismissable">';
            $icon  = '<i class="icon-remove-sign"></i> ';
        }
        elseif ($type == 'success')
        {
            $alert = '<div class="alert alert-success alert-dismissable">';
            $icon  = '<i class="icon-ok-sign"></i> ';
        }
        elseif ($type == 'warning')
        {
            $alert = '<div class="alert alert-warning alert-dismissable">';
            $icon  = '<i class="icon-info-sign"></i> ';
        }
        elseif ($type == 'info')
        {
            $alert = '<div class="alert alert-info alert-dismissable">';
            $icon  = '<i class="icon-info-sign"></i> ';
        }

        $message  = $alert;
        
        $message .= '<button data-dismiss="alert" class="close" type="button">×</button>';
        
        if ($validation_errors == TRUE)
        {
            $message .= $content;
        }
        else
        {
            $message .= $icon . $content;
        }
                
        $message .= '</div>';
        
        return $message;
    }
}

if ( ! function_exists('indo_date'))
{
    function indo_date($date)
    {           
        $pecah  = explode("-", $date);       
        $year   = $pecah[0];
        $monthh = $pecah[1];
        $day    = $pecah[2];
        
        $bulan  = ''; 
        switch($monthh)
        {
            case '01':
                 $bulan = 'Januari';
                 break;
            case '02':
                 $bulan = 'Februari';
                 break;
            case '03':
                 $bulan = 'Maret';
                 break;
            case '04':
                 $bulan = 'April';
                 break;
            case '05':
                 $bulan = 'Mei';
                 break;
            case '06':
                 $bulan = 'Juni';
                 break;
            case '07':
                 $bulan = 'Juli';
                 break;
            case '08':
                 $bulan = 'Agustus';
                 break;
            case '09':
                 $bulan = 'September';
                 break;
            case '10':
                 $bulan = 'Oktober';
                 break;
            case '11':
                 $bulan = 'Nopember';
                 break;
            case '12':
                 $bulan = 'Desember';
                 break;
         }    
         
         $result = $day.' '.$bulan.' '.$year;
         return $result;
    }
}

if ( ! function_exists('rupiah'))
{
    function rupiah($value)
    {
        if($value < 0)
        {
             return number_format(abs($value), 0, '', '.');
        }
        else
        {
             return number_format($value, 0, '', '.');
        }
    }
}

if ( ! function_exists('icon'))
{
    function icon($icon = '', $labels = FALSE)
    {
        if ($icon == '')
        {
            return '';
        }
        else
        {
            $button = '';
            $label  = '';

            switch($icon)
            {
                case 'c' : $button = '<i class="glyphicon glyphicon-plus-sign"></i>';
                           $label  = 'TAMBAH';
                           break;
                case 'r' : $button = '<i class="glyphicon glyphicon-th-list"></i>';
                           $label  = 'TAMPIL';
                           break;
                case 'u' : $button = '<i class="glyphicon glyphicon-edit"></i>';
                           $label  = 'SIMPAN PERUBAHAN';
                           break;
                case 'd' : $button = '<i class="glyphicon glyphicon-trash"></i>';
                           $label  = 'HAPUS';  
                           break;
                case 's' : $button = '<i class="fa fa-save"></i>';
                           $label  = 'SIMPAN';
                           break;
                case 'b' : $button = '<i class="fa fa-undo"></i>';
                           $label  = 'KEMBALI';
                           break;
                case 'z' : $button = '<i class="glyphicon glyphicon-zoom-in"></i>';
                           $label  = 'TAMPILKAN';
                           break;
                case 'p' : $button = '<i class="glyphicon glyphicon-print"></i>';
                           $label  = 'CETAK';
                           break;
                case 'l' : $button = '<i class="glyphicon glyphicon-th-list"></i>';
                           $label  = 'LIST';
                           break;
                case 'i' : $button = '<i class="glyphicon glyphicon-retweet"></i>';
                           $label  = 'IMPORT';
                           break;
            }

            return $labels == FALSE ? $button : $button . ' ' . $label;
        }
    }
}

if ( ! function_exists('status'))
{
    function status($key = '')
    {
        $message = '';

        switch ($key)
        {
            case 'created':
                 $message = 'Data sudah tersimpan !';
                 break;
            case 'not_created':
                 $message = 'Data tidak tersimpan !';
                 break;
            case 'updated':
                 $message = 'Data sudah diperbaharui !';
                 break;
            case '404':
                 $message = 'Halaman tidak ditemukan !';
                 break;
            case 'deleted':
                 $message = 'Data sudah dihapus !';
                 break;
            case 'not_deleted':
                 $message = 'Data tidak terhapus !';
                 break;
            case 'not_selected':
                 $message = 'Tidak ada data yang terpilih !';
                 break;
            case 'activated':
                 $message = 'Tahun Akademik sudah diaktifkan !';
                 break;
            case 'not_activated':
                 $message = 'Data tidak bisa diaktifkan !';
                 break;
            case 'existed':
                 $message = 'Data sudah ada !';
                 break;
            case 'is_used':
                 $message = 'Data tidak bisa dihapus karena sudah digunakan pada tabel lain !';
                 break;
            case 'empty_matkul':
                 $message = '<strong>Belum ada mata kuliah yang digelar!</strong><br>Silahkan lakukan pengaturan Mata Kuliah yang akan digelar terlebih dahulu !';
                 break;
        }

        return $message;
    }
}

if ( ! function_exists('terbilang'))
{
    function terbilang($value)
    {
        if ( ! is_numeric($value))
        {
            return 'Parameter bukan tipe numeric!';
        }

        $huruf = array ("","Satu","Dua","Tiga","Empat","Lima","Enam","Tujuh","Delapan","Sembilan","Sepuluh","Sebelas");

        if ($value < 0)
            return 'Negatif ' . terbilang($value);
        if ($value < 12) 
            return $huruf[$value];
        if ($value < 20) 
            return terbilang($value - 10) . " Belas";
        if ($value < 100) 
            return terbilang($value / 10) . " Puluh " . terbilang($value % 10);
        if ($value < 200) 
            return "Seratus " . terbilang($value - 100);
        if ($value < 1000)
            return terbilang($value / 100) . " Ratus " . terbilang($value % 100);
        if ($value < 2000)
            return " Seribu " . terbilang($value - 1000);
        if ($value < 1000000)
            return terbilang($value / 1000) . " Ribu " . terbilang($value % 1000);
        if ($value < 1000000000)
            return terbilang($value / 1000000) . " Juta " . terbilang($value % 1000000);
        if ($value < 1000000000000)
            return terbilang($value / 1000000000) . " Miliyar " . terbilang(fmod ($value , 1000000000));
        if ($value < 1000000000000000)
            return terbilang($value / 1000000000000) . " Triliyun " . terbilang(fmod ($value , 1000000000000));
        if ($value > 999999999999999)
            return "Tidak Terhingga";
    }
}