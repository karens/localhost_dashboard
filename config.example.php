<?php
require_once __DIR__.'/vendor/autoload.php';
use Symfony\Component\Yaml\Yaml;
$yaml = Yaml::parse(file_get_contents('config.yml'));
$sites = $yaml['sites'];

// Detect dynamic ports for docker containers.
$docker_site = 'My Docker Site';
$drupal_container_name = 'web_1';
$couchdb_container_name = 'couchdb_1';

$matches = [];
$cmd = shell_exec('/usr/local/bin/docker ps --filter "name=' / $drupal_container_name . '" --format "{{.Ports}}" 2>&1');
if (preg_match('/0.0.0.0:([0-9]{5})->/', $cmd, $matches)) {
  $lb_port = $matches[1];
  $matches = [];
  $cmd = shell_exec('/usr/local/bin/docker ps --filter "name=' . $counchdb_container_name . '" --format "{{.Ports}}" 2>&1');
  preg_match('/0.0.0.0:([0-9]{5})->/', $cmd, $matches);
  $couch_port = $matches[1];
  $sites[$docker_site]['local']['Drupal'] .= $lb_port;
  $sites[$docker_site]['local']['CouchDB'] .= $couch_port . '/_utils';
}
