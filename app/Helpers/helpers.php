<?php
// app/Helpers/helpers.php (BUAT FILE BARU)

if (!function_exists('getStatusColor')) {
    function getStatusColor($status = 'Reported') {
        $status = trim((string)$status);
        
        $colors = [
            'Reported' => 'secondary',
            'Triage' => 'info',
            'In Investigation' => 'warning',
            'Resolved' => 'success',
            'Closed' => 'dark'
        ];

        return $colors[$status] ?? 'secondary';
    }
}
