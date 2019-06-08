<?php

namespace Chsv\Moviedb;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

class MoviedbController implements AppInjectableInterface
{
    use AppInjectableTrait;

    /**
     * @var string $db a sample member variable that gets initialised
     */
    private $db = "not active";


    /**
     * The initialize method is optional and will always be called before the
     * target method/action. This is a convienient method where you could
     * setup internal properties that are commonly used by several methods.
     *
     * @return void
     */
    public function initialize() : void
    {
        $this->app->db->connect();
        $this->db = $this->app->db;
        // // Use $this->app to access the framework services.
    }


    /**
     * This is the index method action,
     * @return string
     */
    public function indexAction() : object
    {
        return $this->app->response->redirect("movie/index");
    }

    /**
     * This is the index method action,
     * @return string
     */
    public function displaymoviesAction() : object
    {
        $title = "Movie database | movie";
        $movies = new MovieList($this->db);
        $res = $movies->displayCompleteList();
        $this->app->page->add("movie/index", [
            "resultset" => $res,
        ]);
        return $this->app->page->render([
            "title" => $title,
        ]);
    }


    /**
     * This is the index method action,
     * @return string
     */
    public function displaysinglemovieActionGet($id) : object
    {
        $title = "Movie database | index";
        $movie = new Movie($this->db, $id);
        $res = $movie->getCurrentMovie();
        $this->app->page->add("movie/displaysinglemovie", [
            "resultset" => $res,
            "mess" => "Test get"
        ]);
        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    /**
     * Search
     * @return string
     */
    public function searchtitleActionGet() : object
    {
        $title = "Movie database | index";

        $this->app->page->add("movie/searchform", [
            "type" => "searchtitle"
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    /**
     * Search
     * @return string
     */
    public function searchyearActionGet() : object
    {
        $title = "Movie database | index";

        $this->app->page->add("movie/searchform", [
            "type" => "searchyear"
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }


    /**
     * Search
     * @return string
     */
    public function searchtitleActionPost() : object
    {
        $req = $this->app->request;
        $movietitle = $req->getPost("movietitle");
        $title = "Movie database | movie";
        $movies = new MovieList($this->db);
        $res = $movies->searchMovieByTitle($movietitle);
        $this->app->page->add("movie/index", [
            "resultset" => $res,
        ]);
        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    /**
     * Search
     * @return string
     */
    public function searchyearActionPost() : object
    {
        $title = "Movie database | movie";
        $req = $this->app->request;
        $movieyear = $req->getPost("movieyear");
        $movies = new MovieList($this->db);
        $res = $movies->searchMovieByYear($movieyear);
        $this->app->page->add("movie/index", [
            "resultset" => $res,
        ]);
        return $this->app->page->render([
            "title" => $title,
        ]);
    }


    public function editmovieActionGet($id) : object
    {
        $title = "Movie database | edit movie";
        $movie = new Movie($this->db, $id);
        $res = $movie->getCurrentMovie();

        $this->app->page->add("movie/edit", [
            "resultset" => $res,
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function editmovieActionPost()
    {
        $req = $this->app->request;
        $moviePostData = checkPostData($req);

        if (!isset($moviePostData["id"]) || $moviePostData["id"] === "") {
            return $this->app->response->redirect("movie/index");
        } else {
            $title = "Movie database | edit movie";
            $movie = new Movie($this->db, $moviePostData["id"]);
            $movie->updateMovie($moviePostData);

            $movie = new Movie($this->db, $moviePostData["id"]);
            $res = $movie->getCurrentMovie();
            $this->app->page->add("movie/displaysinglemovie", [
                "resultset" => $res,
                "mess" => "Film uppdaterad"
            ]);

            return $this->app->page->render([
                "title" => $title,
            ]);
        }
    }

    public function addmovieActionGet() : object
    {
        $title = "Movie database | add movie";

        $this->app->page->add("movie/add");

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function addmovieActionPost()
    {
        $req = $this->app->request;
        $moviePostData = checkPostData($req);
        $movies = new MovieList($this->db, $moviePostData["id"]);
        $movies->addMovieToList($moviePostData);
        return $this->app->response->redirect("movie/index");
    }

    public function deletemovieActionGet($id)
    {
        $title = "Movie database | edit movie";
        $movie = new Movie($this->db, $id);
        $res = $movie->getCurrentMovie();
        $this->app->page->add("movie/confirmdelete", [
            "resultset" => $res
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function deletemovieActionPost()
    {
        $req = $this->app->request;
        $id = $req->getPost("id");

        $movies = new MovieList($this->db);
        $movies->deleteMovieFromList($id);

        return $this->app->response->redirect("movie/index");
    }


    public function resetdbActionGet() : object
    {
        resetDatabase($this->db);

        return $this->app->response->redirect("movie/index");
    }
}
