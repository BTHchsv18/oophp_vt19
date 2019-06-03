<?php

namespace Chsv\Guess;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $app if implementing the interface
 * AppInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class GuessController implements AppInjectableInterface
{
    use AppInjectableTrait;



    /**
     * @var string $db a sample member variable that gets initialised
     */
    //private $db = "not active";



    /**
     * The initialize method is optional and will always be called before the
     * target method/action. This is a convienient method where you could
     * setup internal properties that are commonly used by several methods.
     *
     * @return void
     */
    // public function initialize() : void
    // {
    //     // Use to initialise member variables.
    //     $this->db = "active";
    //
    //     // Use $this->app to access the framework services.
    // }


    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function indexAction() : string
    {
        // Deal with the action and return a response.
        return "This is index";
    }

    public function initAction() : string
    {
        $this->app->session->set("guess", new Guess());
        return $this->app->response->redirect("guess1/play");
    }

    public function playActionGet() : object
    {
        $title = "Play the game";

        $data = [
            "triesleft" => $triesleft ?? 5,
            "cheat" => $cheat ?? null,
            "number" => $number ?? null,
            "userguessvalue" => $userguessvalue ?? null,
            "result" => $result ?? null
        ];

        $this->app->page->add("guess1/play", $data);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function playActionPost() : object
    {
        $title = "Play the game";

        // initiate incoming POST-variables
        $userguessvalue = $this->app->request->getPost("userguessvalue", null);
        $makeguess = $this->app->request->getPost("makeguess", null);
        $restart = $this->app->request->getPost("restart", null);
        $cheat = $this->app->request->getPost("cheat", null);

        $number = null;

       // Check what button has been clicked
        if ($restart) {
            return $this->app->response->redirect("guess1/init");
        } elseif ($makeguess != null && is_numeric($userguessvalue)) {
            $result = $this->app->session->get("guess")->checkguess($userguessvalue);
        } else if ($cheat) {
            $number = $this->app->session->get("guess")->getnumber();
        }

        // Get number of tries left
        $triesleft = $this->app->session->get("guess")->gettriesleft();

        $data = [
            "triesleft" => $triesleft,
            "cheat" => $cheat,
            "number" => $number,
            "userguessvalue" => $userguessvalue,
            "result" => $result ?? ""
        ];

        $this->app->page->add("guess1/play", $data);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function debugAction() : string
    {
        // Deal with the action and return a response.
        return "Debug my game";
    }
}
