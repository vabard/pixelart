<?php

use Silex\Provider\MonologServiceProvider;
use Silex\Provider\WebProfilerServiceProvider;
use Symfony\Component\Security\Core\Encoder\PlaintextPasswordEncoder;

// include the prod configuration
require __DIR__.'/prod.php';

$app['security.default_encoder'] = function ($app) {
    // Plain text (e.g. for debugging)
    return new PlaintextPasswordEncoder();
};

// enable the debug mode
$app['debug'] = true;

$app->register(new MonologServiceProvider(), array(
    'monolog.logfile' => __DIR__.'/../var/logs/silex_dev.log',
));

$app->register(new WebProfilerServiceProvider(), array(
    'profiler.cache_dir' => __DIR__.'/../var/cache/profiler',
));

$app['twig.options'] = array('cache' => false);