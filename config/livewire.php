<?php
return [
    'temporary_file_upload' => [
        // Gunakan disk 'local' untuk temporary upload (lebih aman)
        'disk' => 'local',
        'directory' => 'livewire-tmp',
        'middleware' => null,
        'preview_mimes' => [
            'png', 'gif', 'bmp', 'svg', 'wav', 'mp4',
            'mov', 'avi', 'wmv', 'mp3', 'm4a',
            'jpg', 'jpeg', 'mpo', 'webp', 'avif'
        ],
        'max_upload_time' => 10,
    ],
];