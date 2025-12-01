<?php
// app/Helpers/ForensikHelper.php

namespace App\Helpers;

class ForensikHelper
{
    public static function getStatusColor($status)
    {
        $colors = [
            'Reported' => 'secondary',
            'Triage' => 'info',
            'In Investigation' => 'warning',
            'Resolved' => 'success',
            'Closed' => 'dark'
        ];

        return $colors[$status] ?? 'secondary';
    }

    public static function formatDate($date)
    {
        return $date->format('d M Y, H:i');
    }
}

// Tambahkan di composer.json dalam section "autoload" -> "classmap":
/*
"autoload": {
    "psr-4": {
        "App\\": "app/",
        "Database\\Factories\\": "database/factories/",
        "Database\\Seeders\\": "database/seeders/"
    },
    "files": [
        "app/Helpers/ForensikHelper.php"
    ]
},
*/

