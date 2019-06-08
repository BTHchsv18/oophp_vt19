<?php

namespace Chsv\Moviedb;

/**
 * Bla bla dice class
 */
class MovieList
{

    /**
     * Object properties
     */
    protected $db;

    /**
    * Constructor
    *
    * @param
    *
    * @return void
    *
    */
    public function __construct($dbObject)
    {
        $this->db = $dbObject;
    }


    /**
    * Display all movies
    *
    * @return object
    */
    public function displayCompleteList()
    {

        $sql = "SELECT * FROM movie;";
        $res = $this->db->executeFetchAll($sql);
        return $res;
    }


    /**
    * Display single movie
    *
    * @return object
    */
    public function displaySingleMovie()
    {

        $sql = "SELECT * FROM movie;";
        $res = $this->db->executeFetchAll($sql);
        return $res;
    }


    /**
    *
    *
    * @return object
    */
    public function searchMovieByTitle($title)
    {
        $title = "%".$title ."%";
        $sql = "SELECT * FROM movie WHERE title LIKE ?;";
        $res = $this->db->executeFetchAll($sql, [$title]);
        return $res;
    }

    /**
    *
    *
    * @return object
    */
    public function searchMovieByYear($year)
    {
        $year = "%".$year."%";
        $sql = "SELECT * FROM movie WHERE year LIKE ?;";
        $res = $this->db->executeFetchAll($sql, [$year]);
        return $res;
    }

    /**
    * Add Movie
    *
    * @return ??
    */
    public function addMovieToList($moviePostData)
    {
        $sql = "INSERT INTO  movie
                        (title,
                        director,
                        length,
                        year,
                        plot,
                        image,
                        subtext,
                        speech,
                        quality,
                        format)
                VALUES
                        (?,?,?,?,?,?,?,?,?,?)
                ";

        $this->movie = $this->db->execute($sql, [
            $moviePostData["movietitle"],
            $moviePostData["moviedirector"],
            $moviePostData["movielength"],
            $moviePostData["movieyear"],
            $moviePostData["movieplot"],
            $moviePostData["movieimage"],
            $moviePostData["moviesub"],
            $moviePostData["moviespeech"],
            $moviePostData["moviequality"],
            $moviePostData["movieformat"]
        ]);
    }

    /**
    * Delete movie
    *
    * @return ??
    */
    public function deleteMovieFromList($id)
    {
        $sql = "DELETE FROM movie WHERE id=?";
        $this->db->execute($sql, [$id]);
    }
}
