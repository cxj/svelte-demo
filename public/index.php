<?php
/**
 * Front controller.
 */
declare(strict_types=1);
namespace Cxj;

use Radar\Adr\Boot;
use Radar\Adr\Responder\Responder;
use Relay\Middleware\ExceptionHandler;
use Relay\Middleware\ResponseSender;
use Zend\Diactoros\Response as Response;
use Zend\Diactoros\ServerRequestFactory as ServerRequestFactory;


/**
 * Bootstrapping
 */
// require_once dirname(__DIR__) . '/vendor/autoload.php';
require '../vendor/autoload.php';

/**
 * @var \Radar\Adr\Adr $adr - the actual ADR instance.
 */
$boot = new Boot();
$adr  = $boot->adr();

/**
 * Middleware
 */
$adr->middle(new ResponseSender());
$adr->middle(new ExceptionHandler(new Response()));
$adr->middle('Radar\Adr\Handler\RoutingHandler');
$adr->middle('Radar\Adr\Handler\ActionHandler');


$adr->responder(Responder::class);

/**
 * Routes
 */
$adr->get('/get-logos', '/get-logos', AllLogos::class);

/**
 * Run
 */
$adr->run(ServerRequestFactory::fromGlobals(), new Response());

