<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

require __DIR__.'/controllers_admin.php';

//Request::setTrustedProxies(array('127.0.0.1'));
$app->before(function() use ($app) {
    
    $token = $app['security.token_storage']->getToken();
    
    if($token){
        //var_dump($token);
        $user = $token->getUser();
    } else {
        $user = null;
    }
    if(is_string($user)){
        $user = null;
    }
    $app['user'] = $user;
    
});


$app->get('/', function () use ($app) {
    return $app['twig']->render('index.html.twig', array());
})
->bind('homepage')
;


$app->get('/login', function(Request $request) use ($app) {
    return $app['twig']->render('login.html.twig', array(
        'error'         => $app['security.last_error']($request),
        'last_username' => $app['session']->get('_security.last_username'),
    ));
})
->bind('login')
;

// route pour apprendre 1 picture
$app->get('/apprendre-pixelart', function () use ($app) {
    
    $picture = Propel\Propel\PicturesQuery::create()->findOneByIdPictures(1);
    
    // on transmet à notre template les données de $users (toujours un array!)
    return $app['twig']->render('apprendre-pixelart.html.twig', [
        'picture' => $picture
    ]);
    
    
    //return $app['twig']->render('apprendre-pixelart.html.twig', array());
})
->bind('apprendre-pixelart')
;




$app->error(function (\Exception $e, Request $request, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    // 404.html, or 40x.html, or 4xx.html, or error.html
    $templates = array(
        'errors/'.$code.'.html.twig',
        'errors/'.substr($code, 0, 2).'x.html.twig',
        'errors/'.substr($code, 0, 1).'xx.html.twig',
        'errors/default.html.twig',
    );

    return new Response($app['twig']->resolveTemplate($templates)->render(array('code' => $code)), $code);
});
