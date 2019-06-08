<?php
/**
 * General functions.
 */

/**
 * Some useful function.
 *
 * @return
 */
function checkPostData($req)
{

    $moviePostData["id"] = $req->getPost("id");
    $moviePostData["movietitle"] = $req->getPost("movietitle");
    $moviePostData["moviedirector"]  = $req->getPost("moviedirector");
    $moviePostData["movielength"] = $req->getPost("movielength");
    $moviePostData["movieyear"] = $req->getPost("movieyear");
    $moviePostData["movieplot"]  = $req->getPost("movieplot");
    $moviePostData["movieimage"] = $req->getPost("movieimage");
    $moviePostData["moviesub"] = $req->getPost("moviesub");
    $moviePostData["moviespeech"]  = $req->getPost("moviespeech");
    $moviePostData["moviequality"] = $req->getPost("moviequality");
    $moviePostData["movieformat"] = $req->getPost("movieformat");

    return $moviePostData;
}




function resetDatabase($db)
{

    $sql = "DROP TABLE IF EXISTS `movie`;";
    $db->execute($sql);

    $sql = "CREATE TABLE `movie`
    (
        `id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
        `title` VARCHAR(100) NOT NULL,
        `director` VARCHAR(100),
        `length` INT DEFAULT NULL,            -- Length in minutes
        `year` INT NOT NULL DEFAULT 1900,
        `plot` TEXT,                          -- Short intro to the movie
        `image` VARCHAR(100) DEFAULT NULL,    -- Link to an image
        `subtext` CHAR(3) DEFAULT NULL,       -- swe, fin, en, etc
        `speech` CHAR(3) DEFAULT NULL,        -- swe, fin, en, etc
        `quality` CHAR(3) DEFAULT NULL,
        `format` CHAR(3) DEFAULT NULL         -- mp4, divx, etc
    ) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;";

    $db->execute($sql);

    $sql = "DELETE FROM `movie`;";
    $db->execute($sql);

    $sql = "INSERT INTO `movie` (`title`, `year`, `image`) VALUES
        ('Pulp fiction', 1994, 'img/pulp-fiction.jpg'),
        ('American Pie', 1999, 'img/american-pie.jpg'),
        ('Pokémon The Movie 2000', 1999, 'img/pokemon.jpg'),
        ('Kopps', 2003, 'img/kopps.jpg'),
        ('From Dusk Till Dawn', 1996, 'img/from-dusk-till-dawn.jpg')
    ;";
    $db->execute($sql);
}
