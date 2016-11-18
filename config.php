<?php

$sites = [];
$sites += [
  'My Pantheon Site' => [
     'production' => [
        ['http://www.mypantheonsite.com'],
     ],
     'local' => [
        // Link to the Pantheon dashboard for this site.
        'https://dashboard.pantheon.io/sites/xxxxxxxxxxx',
        // Link to the password-protected Pantheon dev site.
        'http://user:pass@dev-mypantheonsite.pantheonsite.io/',
        // Link to a Kalabox local version of this site.
        'http://mypantheonsite.kbox.site',
     ],
   ],
];

// Detect dynamic ports for docker containers.
$matches = [];
$cmd = shell_exec('/usr/local/bin/docker ps --filter "name=mydocker_web_1" --format "{{.Ports}}" 2>&1');
preg_match('/0.0.0.0:([0-9]{5})->/', $cmd, $matches);
$web_port = $matches[1];
$matches = [];
$cmd = shell_exec('/usr/local/bin/docker ps --filter "name=mydocker_couchdb_1" --format "{{.Ports}}" 2>&1');
preg_match('/0.0.0.0:([0-9]{5})->/', $cmd, $matches);
$couch_port = $matches[1];

$sites += [
  'My Docker Site' =>  [
      'production' => [
         ['http://www.mydockersite.com'],
      ],
      'local' =>[
          // Docker container links with ports.
          ['Drupal' => 'http://localhost:' . $web_port],
          ['CouchDB' => 'http://localhost:' . $couch_port . '/_utils'],
          // Link to Github repository for this site.
          ['Github' => 'https://github.com/me/mydockersite'],
      ],
  ],
];
$sites += [
   'Sandboxes' => [
      'local' => [
         'http://mysandbox.dev:8008',
         'http://anothersandbox.dev:8008',
     ],
   ],
];
