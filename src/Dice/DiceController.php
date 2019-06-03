<?php

namespace Chsv\Dice;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

/**
 * Comment
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class DiceController implements AppInjectableInterface
{
    use AppInjectableTrait;

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
        return "This is index for dice controllerclass";
    }

    public function setupAction() : object
    {
        if ($this->app->session->has("dicegame")) {
            $this->app->session->delete("dicegame");
        }
        // session_destroy();
        $this->app->page->add("dicegame/setup");
        return $this->app->page->render();
    }


    public function initActionPost() : object
    {
        $req = $this->app->request;
        if ($req->getPost("playername") && $req->getPost("noofdice") && $req->getPost("noofcomp")) {
            $playerName = $req->getPost("playername");
            $noOfDice = (int)$req->getPost("noofdice");
            $noOfOpponents = (int)$req->getPost("noofcomp");
            $this->app->session->set("dicegame", new DiceGame($playerName, $noOfDice, 6, $noOfOpponents));
            return $this->app->response->redirect("dice/handleturn");
        } else {
            return $this->app->response->redirect("dice/setup");
        }
    }

    public function handleturnActionGet() : object
    {
        $this->app->session->get("dicegame")->nextPlayer();
        $currentPlayer = $this->app->session->get("dicegame")->getCurrentPlayerNo();
        if ($currentPlayer > 0) {
            return $this->app->response->redirect("dice/computersturn");
        } else {
            return $this->app->response->redirect("dice/playersturn");
        }
    }

    public function computersturnActionGet() : object
    {
        $won = $this->app->session->get("dicegame")->computerPlays();
        $data = $this->app->session->get("dicegame")->gameData();
        if ($won === true) {
            $this->app->page->add("dicegame/endgame", $data);
            $this->app->page->add("dicegame/debug");
        } else {
            $this->app->page->add("dicegame/showresult", $data);
            $this->app->page->add("dicegame/debug");
        }
        return $this->app->page->render();
    }

    public function playersturnActionGet() : object
    {
        $data = $this->app->session->get("dicegame")->gameData();
        $this->app->page->add("dicegame/playerplay", $data);
        $this->app->page->add("dicegame/debug");
        return $this->app->page->render();
    }

    public function rollActionGet() : object
    {
        $rolledOne = $this->app->session->get("dicegame")->playerPlays();
        if ($rolledOne === true) {
            $data = $this->app->session->get("dicegame")->gameData();
            $this->app->page->add("dicegame/showresult", $data);
            $this->app->page->add("dicegame/debug");
        } else {
            $data = $this->app->session->get("dicegame")->gameData();
            $this->app->page->add("dicegame/playerplay", $data);
            $this->app->page->add("dicegame/debug");
        }
        return $this->app->page->render();
    }


    public function standActionGet() : object
    {
        $won = $this->app->session->get("dicegame")->updateStandings();
        $data = $this->app->session->get("dicegame")->gameData();
        if ($won === true) {
            $this->app->page->add("dicegame/endgame", $data);
            $this->app->page->add("dicegame/debug");
        } else {
            $this->app->page->add("dicegame/showresult", $data);
            $this->app->page->add("dicegame/debug");
        }
        return $this->app->page->render();
    }


    public function debugAction() : string
    {
        // Deal with the action and return a response.
        return "Debug my game";
    }
}
