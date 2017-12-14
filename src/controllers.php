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

// route pour Galery - on affiche tous les Pictures
$app->get('/galery-pixelart', function () use ($app) {
    
    $pictures = Propel\Propel\PicturesQuery::create()
            ->joinWithUsers()
            ->joinWithCategories()
            ->orderByDateInsert('desc')
            ->paginate($page=1, $maxPerPage=3);
//            ->find();
    
    //$pictures->getNbResults()
    // on transmet à notre template les données (toujours un array!)
    return $app['twig']->render('galery-pixelart.html.twig', [
        'pictures' => $pictures,
        'paginate' => [
            'results'  => $pictures->getNbResults(),
            //'havetopaginate'  => $pictures->haveToPaginate(),
            'firstpage' => $pictures->getFirstPage(),
            'lastpage' => $pictures->getLastPage(),
            'currentpage' => $pictures->getPage(),
            'islastpage' => $pictures->isLastPage(), //return boolean true (1) if the current page is the last page
            'firstindex' => $pictures->getFirstIndex(),
            'lastindex' => $pictures->getLastIndex(), 
            'getNextPage' => $pictures->getNextPage(), 
            
        ]
    ]);
})
->bind('galery-pixelart')
;


// route pour apprendre 1 Picture
$app->get('/apprendre-pixelart/{id}', function ($id) use ($app) {
    
    $picture = Propel\Propel\PicturesQuery::create()
            ->joinWithUsers()
            ->joinWithCategories()
            ->findOneByIdPictures($id);
    
    // on transmet à notre template les données (toujours un array!)
    return $app['twig']->render('apprendre-pixelart.html.twig', [
        'picture' => $picture
    ]);

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
