<?php

namespace Chsv\Moviedb;

/**
 * Bla bla
 */
class Movie
{

    /**
     * Object properties
     */
    protected $db;
    protected $movie;

    /**
    * Constructor
    *
    * @param
    *
    * @return void
    *
    */
    public function __construct($dbObject, $id)
    {
        $this->db = $dbObject;
        $sql = "SELECT * FROM movie where id = ?";
        $this->movie = $this->db->executeFetch($sql, [$id]);
    }


    /**
    * Displlay single movie
    *
    * @return object
    */
    public function getCurrentMovie()
    {
        return $this->movie;
    }


    /**
    * Update Movie
    *
    * @return ??
    */
    public function updateMovie($moviePostData)
    {
        $sql = "UPDATE  movie
                SET
                        title = ?,
                        director = ?,
                        length = ?,
                        year = ?,
                        plot = ?,
                        image = ?,
                        subtext = ?,
                        speech = ?,
                        quality = ?,
                        format = ?
                WHERE   id = ?
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
            $moviePostData["movieformat"],
            $moviePostData["id"]
        ]);
    }
}
