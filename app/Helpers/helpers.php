<?php

if (!function_exists('getStatusColor')) {
    function getStatusColor($status)
    {
        return match ($status) {
            'Baru'      => 'primary',
            'Proses'    => 'warning',
            'Selesai'   => 'success',
            'Ditolak'  => 'danger',
            default    => 'secondary',
        };
    }
}
