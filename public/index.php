<?php
/**
 * Front controller.
 */
declare(strict_types=1);
namespace Cxj;

use Aura\Payload_Interface\PayloadStatus;
use Radar\Adr\Adr;
use Radar\Adr\Boot;
use Radar\Adr\Responder\Responder;
use Relay\Middleware\ExceptionHandler;
use Relay\Middleware\ResponseSender;
use Zend\Diactoros\Response as Response;
use Zend\Diactoros\ServerRequestFactory as ServerRequestFactory;


error_log("\n -->  error_log Startup for Request: {$_SERVER['REQUEST_URI']}\n");

/*
 * Bootstrapping
 */
// require_once dirname(__DIR__) . '/vendor/autoload.php';
require '../vendor/autoload.php';


/**
 * @var Adr $adr - the actual ADR instance.
 */
$boot = new Boot();
$adr  = $boot->adr();

/*
 * Middleware
 */
$adr->middle(new ResponseSender());
$adr->middle(new ExceptionHandler(new Response()));
$adr->middle('Radar\Adr\Handler\RoutingHandler');
$adr->middle('Radar\Adr\Handler\ActionHandler');

$adr->input(Input::class);
$adr->responder(Responder::class);

/*
 * Routes
 */

// Application redirect for Svelte app.
$adr->get('root', '/', function (array $input) {
    header('Location: /index.html');
    exit;
});

// RESTful routes.
// Note subdirectory with logo image files is named "logos"!

// Retrieve all of the logo meta data.  Images are fetched directly via URL.
$adr->get('get-logos', '/mylogos', AllLogos::class);
// Create (save) a new logo, uploads image file and creates meta data for it.
$adr->post('save-logo', '/mylogos', CreateLogo::class);
// Delete a logo.  Client needs to refresh own data.
$adr->delete('delete', '/mylogos/{id}', DeleteLogo::class);

/*
 * Run
 */
$adr->run(ServerRequestFactory::fromGlobals(), new Response());

