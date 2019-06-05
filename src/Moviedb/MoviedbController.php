<?php

namespace Chsv\Moviedb;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

/**
 * Comment
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class MoviedbController implements AppInjectableInterface
{
    use AppInjectableTrait;

    /**
     * This is the index method action,
     * @return string
     */
    public function indexAction() : object
    {
        $title = "Movie database | oophp";
        $this->app->db->connect();
        $sql = "SELECT * FROM movie;";
        $res = $this->app->db->executeFetchAll($sql);

        $this->app->page->add("movie/index", [
            "resultset" => $res,
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    /**
     * This is an example post action method
     *
     * @return string
     */
    public function somethingActionPost() : object
    {
    }
    /**
     * This is an example get action method
     *
     * @return string
     */
    public function somethingActionGet() : object
    {
    }

    public function debugAction() : string
    {
        // Deal with the action and return a response.
        return "Debug my game";
    }
}
