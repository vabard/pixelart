<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Propel\Propel\Base\UsersQuery;
use Propel\Propel\Base\PicturesQuery;
use Propel\Propel\Base\CategoriesQuery;
use Propel\Propel\Categories;

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
    $user = UsersQuery::create()->findOneByIdUsers($id);
    
    $form = $app['form.factory']->createBuilder(\FormType\UserType::class, $user)
            ->remove('password')
            ->add('submit', SubmitType::class, [
                'label' => 'Modifier'
            ])
            ->getForm();
    
    $form->handleRequest($request);
    
    if($form->isValid()){
        $user->save();
        return $app->redirect($app['url_generator']->generate('admin_userlist'));
    }
     
    $formView = $form->createView();
    
    return $app['twig']->render('/admin/useredit.html.twig', ['form' => $formView]);
    
})
->method('GET|POST')
->bind('admin_useredit')
;
$adminGroup->get('pictureslist', function () use ($app) {
    
    $pictures = Propel\Propel\PicturesQuery::create()
            ->joinWithUsers()
            ->joinWithCategories()
            ->orderByState()
            ->orderByDateInsert('desc')
            ->find();
    
    $categories = Propel\Propel\CategoriesQuery::create()
            ->orderByTitle('asc')
            ->find();
    
    // on transmet à notre template les données (toujours un array!)
    return $app['twig']->render('admin/pictureslist.html.twig', [
        'pictures' => $pictures,
        'categories' => $categories
    ]);
})
->bind('admin_pictureslist')
;
$adminGroup->get('validate/{id}', function ($id) use ($app) {
    PicturesQuery::create()
            ->filterByIdPictures($id)
            ->update(array('State' => '2'));
    return $app->redirect($app['url_generator']->generate('admin_pictureslist'));
    
})
->bind('admin_validate')
;
$adminGroup->get('deletepicture/{id}', function ($id) use ($app) {
    PicturesQuery::create()->filterByIdPictures($id)->delete();
    return $app->redirect($app['url_generator']->generate('admin_pictureslist'));
})
->bind('admin_deletepicture')
;
$adminGroup->get('categorieslist', function() use ($app){
    $categories = CategoriesQuery::create()->find();
    return $app['twig']->render('admin/categorieslist.html.twig', [
        'categories' => $categories
    ]);
})
->bind('admin_categorieslist')
;
$adminGroup->get('deletecategorie/{id}', function ($id) use ($app) {
    CategoriesQuery::create()->filterByIdCategories($id)->delete();
    return $app->redirect($app['url_generator']->generate('admin_categorieslist'));
})
->bind('admin_deletecategorie')
;
$adminGroup->post('newcategory', function (Request $request) use ($app) {
    $title = $request->request->get('title');
    //var_dump($title);
    $categorie = new Categories();
    $categorie->setTitle($title);
    $categorie->save();
    return $app->redirect($app['url_generator']->generate('admin_categorieslist'));
       
})
->bind('newcategory');

$app->mount('/admin', $adminGroup);