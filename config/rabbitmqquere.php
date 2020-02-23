<?php
return [
    'queue_dayly' => [
        'queue_name' => env('QUEUE_NAME', 'queue-backup-dayly'),
        'exchange' => env('EXCHANGE', 'backup.direct'),
        'routing_key' => env('ROUTING_KEY', 'backup-dayly'),
        'vhost' => env('VHOT', 'samacom'),
    ]
];
