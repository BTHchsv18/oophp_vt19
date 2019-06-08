<?php

namespace Anax\View;

if (!$resultset) {
    return;
}

require "navbar.php";

?>

<table class="movie-table">
    <tr class="first">
        <th>Rad</th>
        <th>Id</th>
        <th>Bild</th>
        <th>Titel</th>
        <th>År</th>
        <th>Hantera</th>
    </tr>
<?php $id = -1; foreach ($resultset as $row) :
    $id++; ?>
    <tr>
        <td><?= $id ?></td>
        <td><?= $row->id ?></td>
        <td><img class="thumb" src="<?= url($row->image) ?>"></td>
        <td><a href="displaysinglemovie/<?= $row->id ?>"><?= $row->title ?></a></td>
        <td><?= $row->year ?></td>
        <td>
            <a href="<?= url("moviedb/editmovie/".$row->id) ?>"><i class="fas fa-edit"></i></a>
            <a href="<?= url("moviedb/deletemovie/".$row->id) ?>"><i class="fas fa-trash-alt"></i></a>
        </td>
    </tr>
<?php endforeach; ?>
</table>
