<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

$app->get('/loginadmin', function(Request $request) use ($app) {
    return $app['twig']->render('admin/login_admin.html.twig', array(
        'error'         => $app['security.last_error']($request),
        'last_username' => $app['session']->get('_security.last_username'),
    ));
})
->bind('loginadmin')
;
$adminGroup = $app['controllers_factory']; 

$adminGroup->get('dashboard', function() use ($app){
    return $app['twig']->render('admin/dashboard.html.twig');
})
->bind('admin_dashboard')
;

$app->mount('/admin', $adminGroup);