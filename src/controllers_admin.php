<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

$adminGroup = $app['controllers_factory']; 

$adminGroup->get('dashboard', function() use ($app){
    return $app['twig']->render('admin/dashboard.html.twig');
})
->bind('admin_dashboard')
;

$app->mount('/admin', $adminGroup);