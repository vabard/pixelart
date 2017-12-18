<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Propel\Propel\Base\UsersQuery;

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

$adminGroup->get('userlist', function() use ($app){
    $users = UsersQuery::create()->find();
    return $app['twig']->render('admin/userlist.html.twig', [
        'users' => $users
    ]);
})
->bind('admin_userlist')
;

$adminGroup->get('/userdelete/{id}', function ($id) use ($app) {
    UsersQuery::create()->filterByIdUsers($id)->delete();
    return $app->redirect($app['url_generator']->generate('admin_userlist'));
})
->bind('admin_userdelete')
;

$adminGroup->match('/useredit/{id}', function ($id, Request $request) use ($app){
    $user = UsersQuery::create()->findByIdUsers($id);
    
    $form = $app['form.factory']->createBuilder(\FormType\UserType::class, $user)
            ->remove('password')
            ->add('submit', SubmitType::class, [
                'label' => 'Modifier'
            ])
            ->getForm();
    
    $form->handleRequest($request);
    
    if($form->isValid()){

        $user = new Users();
        // On doit mettre les setters ?
        $user->save();
        return $app->redirect($app['url_generator']->generate('admin_userlist'));
    }
     
    $formView = $form->createView();
    
    return $app['twig']->render('/admin/useredit.html.twig', ['form' => $formView]);
    
})
->method('GET|POST')
->bind('admin_useredit')
;

$app->mount('/admin', $adminGroup);