<?php

$base_url = 'https://api.github.com/';
$auth = [
            'type'=>'header',
            'value'=>'Authorization: token {token}'
];
$check_update = [
    'url'=>'repos/{owner}/{repo}/releases/latest',
    'methode'=>'get'
];
$output = [
    'version'=>'name',
    'url'=>'assets'
];