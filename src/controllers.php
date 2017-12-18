<?php

use FormType\UserType;
use Propel\Propel\Users;
use Propel\Propel\Pictures;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

//Request::setTrustedProxies(array('127.0.0.1'));
// generate a link to the stylesheets in /css/styles.css
//$request->getBasePath().'/css/styles.css';

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

require __DIR__.'/controllers_admin.php';

$app->get('/', function (Request $request) use ($app) {
    return $app['twig']->render('index.html.twig', array(
        //$app['request'] => $request
    ));
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

$app->match('/register', function(Request $request) use ($app) {
    
    $user = new Users();
    
    $form = $app['form.factory']->createBuilder(UserType::class, $user, [
        'validation_groups' => ['registration']
            ])
            ->remove('role')
            ->add('submit', SubmitType::class, [
                'label' => 'Inscription'
            ])
            ->getForm();
    
    $form->handleRequest($request);
    
    if($form->isValid()){
        $user->setRole('ROLE_USER');
        $salt = md5(time());
        $user->setSalt($salt);
        $encodedPassword = $app['security.encoder_factory']
                ->getEncoder($user)
                ->encodePassword($user->getPassword(), $user->getSalt());
        
        $user->setPassword($encodedPassword);
        $user->save();
        return $app->redirect($app['url_generator']->generate('login'));
    }
     
    $formView = $form->createView();
    
    return $app['twig']->render('register.html.twig', ['form' => $formView]);
    
})
->method('GET|POST')
->bind('register')
;

// route pour Galery - on affiche tous les Pictures
$app->get('/galery-pixelart/{p}', function ($p) use ($app) {
    
    $pictures = Propel\Propel\PicturesQuery::create()
            ->joinWithUsers()
            ->joinWithCategories()
            ->filterByState('2')
            ->orderByDateInsert('desc')
            ->paginate($page=$p, $maxPerPage=3);
    
    // on transmet à notre template les données (toujours un array!)
    return $app['twig']->render('galery-pixelart.html.twig', [
        'pictures' => $pictures,
        'paginate' => [
            'results'  => $pictures->getNbResults(),
            'firstpage' => $pictures->getFirstPage(),
            'lastpage' => $pictures->getLastPage(),
            'currentpage' => $pictures->getPage(),
            'islastpage' => $pictures->isLastPage(), //return boolean true (1) if the current page is the last page
            'firstindex' => $pictures->getFirstIndex(),
            'lastindex' => $pictures->getLastIndex(), 
            'getNextPage' => $pictures->getNextPage()   
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

$app->get('/creation/{id}', function ($id) use ($app) {
    
    $picture = Propel\Propel\PicturesQuery::create()
            ->findOneByIdPictures($id);
    
    // on transmet à notre template les données (toujours un array!)
    return $app['twig']->render('creation.html.twig', [
        'picture'=>$picture
    ]);
})
->bind('creation/{id}')
;

$app->get('/mes-pixelarts', function () use ($app) {
    $brouillons = Propel\Propel\PicturesQuery::create()
            ->filterByState('0')
            ->findByIdUsers($app['user']->getIdUsers());
            ;
            //->find();
     $envoyes = Propel\Propel\PicturesQuery::create()
            ->filterByState('1')
            ->findByIdUsers($app['user']->getIdUsers());
           // ->find();
    
    
    
            //->joinWithCategories()
            //->filterByState('2')
            //->orderByDateInsert('desc')
            //->find();
   return $app['twig']->render('space-member.html.twig',['brouillons'=>$brouillons,'envoyes'=>$envoyes]);

})
->bind('mes-pixelarts')
;

$app->get('/view-pixelart/{id}', function ($id) use ($app) {
    $picture = Propel\Propel\PicturesQuery::create()
            ->findOneByIdPictures($id);
            ;
            //->find();
     
           // ->find();
    
    
    
            //->joinWithCategories()
            //->filterByState('2')
            //->orderByDateInsert('desc')
            //->find();
   return $app['twig']->render('view-pixelart.html.twig',['picture'=>$picture]);

})
->bind('view-pixelart')
;


// API : get all Pictures -TESTS AJAX
$app->get('/api/pictures', function() use ($app) {
    $pictures = Propel\Propel\PicturesQuery::create()
            ->joinWithUsers()
            ->joinWithCategories()
            ->filterByState('2')
            ->orderByDateInsert('desc')
            ->find();
    
    // Convert an array of objects ($pictures) into an array of associative arrays ($responseData)
    $responseData = array();
    foreach ($pictures as $picture) {
        $responseData[] = array(
            'id' => $picture->getIdPictures(),
            'title' => $picture->getTitle(),
            'canvas' => $picture->getCanvas()
            );
    }
    // Create and return a JSON response
    return $app->json($responseData);
})->bind('api_pictures');

// API : get an picture -TESTS AJAX
$app->get('/api/picture/{id}', function($id) use ($app) {
    $picture = Propel\Propel\PicturesQuery::create()
            ->joinWithUsers()
            ->joinWithCategories()
            ->findOneByIdPictures($id);
    // Convert an object ($picture) into an associative array ($responseData)
    $responseData = array(
        'id' => $picture->getIdPictures(),
        'title' => $picture->getTitle(),
        'canvas' => $picture->getCanvas()
        );
    // Create and return a JSON response
    return $app->json($responseData);
})->bind('api_picture');



$app->get('/qui-sommes-nous', function () use ($app) {
    return $app['twig']->render('quisommesnous.html.twig', array());
})
->bind('qui-sommes-nous')
;

$app->get('/creation', function () use ($app) {
    return $app['twig']->render('creation.html.twig', array());
})
->bind('creation')
;

$app->match('/register_picture', function (Request $request) use ($app){
    
    $title = $request->request->get('title');
    $state = $request->request->get('state');
    $canvas = $request->request->get('canvas');
    $id_categories = $request->request->get('id_categories');
    
    var_dump($title);
    var_dump($canvas);
    //$app['post.titre'] = $_POST['titre'];
    //$app['post.dessin'] = $_POST['dessin'];
    $pictures = Propel\Propel\PicturesQuery::create();
    
          //  ->findByIdUsers($app['user']->getIdUsers());
           // ->findByTitle($title);
          //  if ($pictures!=''){
          //      $picture = new Pictures(); 
          //      $picture->setCanvas($canvas);}
           // else {
                $picture = new Pictures();
                $picture->setTitle($title); 
                $picture->setIdCategories($id_categories);
                $picture->setCanvas($canvas);
                $picture->setState($state);
                $picture->setThumb($thumb);
                $picture->setIdUsers($app['user']->getIdUsers());
                $picture->save();
                
                //}
        return $app['twig']->render('creation.html.twig', array(
            //'pictures' => $pictures,
            //'aperçu' => $pictures->getThumbs()
        ));
})
->method('GET|POST')
->bind('register_picture')
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
