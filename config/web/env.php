<?php
return [
    'backend' => [
        'frontName' => 'admin'
    ],
    'remote_storage' => [
        'driver' => 'file'
    ],
    'queue' => [
        'consumers_wait_for_messages' => 1
    ],
    'db' => [
        'connection' => [
            'default' => [
                'host' => 'mysql',
                'dbname' => 'magento',
                'username' => 'root',
                'password' => 'root',
                'model' => 'mysql4',
                'engine' => 'innodb',
                'initStatements' => 'SET NAMES utf8;',
                'active' => '1',
                'driver_options' => [
                    1014 => false
                ]
            ]
        ],
        'table_prefix' => ''
    ],
    'crypt' => [
        'key' => '1a2f574b9fa432a37246d0d9ee363c1b'
    ],
    'resource' => [
        'default_setup' => [
            'connection' => 'default'
        ]
    ],
    'x-frame-options' => 'SAMEORIGIN',
    'MAGE_MODE' => 'default',
    'session' => [
        'save' => 'redis',
        'redis' => [
            'host' => 'redis',
            'port' => '6379',
            'password' => '',
            'timeout' => '2.5',
            'persistent_identifier' => '',
            'database' => '3',
            'compression_threshold' => '2048',
            'compression_library' => 'gzip',
            'log_level' => '1',
            'max_concurrency' => '25',
            'break_after_frontend' => '5',
            'break_after_adminhtml' => '30',
            'first_lifetime' => '600',
            'bot_first_lifetime' => '60',
            'bot_lifetime' => '7200',
            'disable_locking' => '0',
            'min_lifetime' => '60',
            'max_lifetime' => '2592000'
        ]
    ],
    'cache' => [
        'frontend' => [
            'default' => [
                'backend' => 'Cm_Cache_Backend_Redis',
                'backend_options' => [
                    'server' => 'redis',
                    'database' => '1',
                    'port' => '6379',
                    'compress_data' => '1',
                    'password' => ''
                ],
                'id_prefix' => ''
            ],
            'page_cache' => [
                'backend' => 'Magento\\Framework\\Cache\\Backend\\Redis',
                'backend_options' => [
                    'server' => 'redis',
                    'port' => '6379',
                    'database' => '2',
                    'compress_data' => '0',
                    'password' => ''
                ],
                'id_prefix' => ''
            ]
        ],
        'allow_parallel_generation' => false
    ],
    'lock' => [
        'provider' => 'db',
        'config' => [
            'prefix' => null
        ]
    ],
    'directories' => [
        'document_root_is_pub' => true
    ],
    'cache_types' => [
        'config' => 1,
        'layout' => 1,
        'block_html' => 1,
        'collections' => 1,
        'reflection' => 1,
        'db_ddl' => 1,
        'compiled_config' => 1,
        'eav' => 1,
        'customer_notification' => 1,
        'config_integration' => 1,
        'config_integration_api' => 1,
        'full_page' => 1,
        'target_rule' => 1,
        'config_webservice' => 1,
        'translate' => 1,
        'vertex' => 1
    ],
    'downloadable_domains' => [
        'geutebrueck.local'
    ],
    'install' => [
        'date' => 'Wed, 22 Sep 2021 06:54:56 +0000'
    ],
    'modules' => [
        'Magento_TwoFactorAuth' => 0,
    ],
    'MAGE_INDEXER_THREADS_COUNT' => 1,
    'system' => [
        'default' => [
            'dev' => [
                'static' => [
                    'sign' => '1'
                ],
                'debug' => [
                    'debug_logging' => 1
                ],
                'grid' => [
                    'async_indexing' => 0
                ],
                'template' => [
                    'allow_symlink' => 0,
                    'minify_html' => 0
                ],
                'js' => [
                    'enable_js_bundling' => 0,
                    'merge_files' => 0,
                    'minify_files' => 0,
                    'move_script_to_bottom' => 0
                ],
                'css' => [
                    'minify_files' => 0,
                    'use_css_critical_path' => 0,
                    'merge_css_files' => 0
                ]
            ],
            'catalog' => [
                'search' => [
                    'engine' => 'elasticsearch7',
                    'elasticsearch7_server_hostname' => 'elasticsearch',
                    'elasticsearch7_server_port' => 9200,
                    'elasticsearch7_index_prefix' => 'magento'
                ]
            ],
            'admin' => [
                'url' => [
                    'use_custom' => 1,
                    'custom' => 'http://geutebrueck.local/'
                ]
            ],
            'web' => [
                'unsecure' => [
                    'base_url' => 'http://geutebrueck.local/',
                    'base_link_url' => '{{unsecure_base_url}}',
                    'base_static_url' => null,
                    'base_media_url' => null
                ],
                'secure' => [
                    'base_url' => 'http://geutebrueck.local/',
                    'base_link_url' => '{{secure_base_url}}',
                    'base_static_url' => null,
                    'base_media_url' => null,
                    'use_in_frontend' => 0,
                    'use_in_adminhtml' => 0
                ]
            ]
        ]
    ]
];
