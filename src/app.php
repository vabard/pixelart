<?php

use App\CustomApp;
use Propel\Propel\UsersQuery;
//use Propel\Propel\PicturesQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use Silex\Provider\AssetServiceProvider;
use Silex\Provider\FormServiceProvider;
use Silex\Provider\HttpFragmentServiceProvider;
use Silex\Provider\LocaleServiceProvider;
use Silex\Provider\SecurityServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\TranslationServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Symfony\Component\Form\Extension\HttpFoundation\HttpFoundationExtension;

$app = new CustomApp();
$app->register(new ServiceControllerServiceProvider());
$app->register(new AssetServiceProvider());
$app->register(new TwigServiceProvider());
$app->register(new HttpFragmentServiceProvider());
$app->register(new LocaleServiceProvider());
//$app->register(new UrlGeneratorServiceProvider());
$app->register(new TranslationServiceProvider(), array(
    'locale_fallbacks' => array('fr'),
    'translator.domains' => [
        'messages' => [
            'fr' => [
                'The credentials were changed from another session.' => 'Les identifiants ont été changés dans une autre session.',
                'The presented password cannot be empty.' => 'Le mot de passe ne peut pas être vide.',
                'The presented password is invalid.' => 'Le mot de passe entré est invalide.',
                'Bad credentials.' => 'Les identifiants sont incorrects'
            ]
        ]
    ]
));

$app->register(new SessionServiceProvider());
$app->register(new SecurityServiceProvider(), array(
    'security.firewalls' => [
        'admin' => array(
            'pattern' => '^/admin/',
            'http' => true,
            'anonymous' => false,
            'form' => array(
                'login_path' => '/loginadmin',
                'check_path' => '/admin/login_check',
                'always_use_default_target_path' => true,
                'default_target_path' => '/admin/dashboard'
                ),
            'logout' => array('logout_path' => '/admin/logoutadmin', 'invalidate_session' => true),
            'users' => function() use ($app) {
                return UsersQuery::create()->filterByRole('%ROLE_ADMIN%', Criteria::LIKE);
            },
        ),
        'front' => array(
            'pattern' => '^/',
            'http' => true,
            'anonymous' => true,
            'form' => array('login_path' => '/login', 'check_path' => '/login_check'),
            'logout' => array('logout_path' => '/logout', 'invalidate_session' => true),
//            'pictures' => function() use ($app) {
//               return PicturesQuery::create();
//            },
            'users' => function() use ($app) {
                return UsersQuery::create();
            }
        ),
    ]
));
        
$app->register(new FormServiceProvider());
$app->register(new ValidatorServiceProvider());

$app['twig'] = $app->extend('twig', function ($twig, $app) {
    //$twig->addExtension(new HttpFoundationExtension($app['request_stack']));

    return $twig;
});

return $app;
