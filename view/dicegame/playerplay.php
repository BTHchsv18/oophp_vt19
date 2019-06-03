<?php

namespace Anax\View;

?>
<h1>Dice 100</h1>
<div class="dice-game-container">


    <div class="dice-game-buttons">
        <p>
        <form method="get" action="roll">
            <input type="submit" name="gameaction" value="Kasta tärningar" class="dice-submit">
        </form>
        </p>
        <p>
        <form method="get" action="stand">
            <input type="submit" name="gameaction" value="Stanna" class="dice-submit">
        </form>
        </p>
        <p>
        <form method="get" action="setup">
            <input type="submit" name="gameaction" value="Starta om" class="dice-submit">
        </form>
        </p>
    </div>
    <div class="dice-game-info">

        <?php if (isset($lastTurnResults) && count($lastTurnResults) != 0) { ?>
            <?php $lastTurnResults = $lastTurnResults[max(array_keys($lastTurnResults))]; ?>
            <p>Du slog:</p>
            <p>
                <?php foreach ($lastTurnResults as $value) : ?>
                    <i class="dice-sprite <?= $value ?>"></i>
                <?php endforeach; ?>
            </p>
        <?php } ?>

        <p>Din tur</p>
        <p>Stanna eller kasta tärningar?</p>
    </div>

    <div class="dice-game-standings">
        <p><b>Standings</b></p>
        <?php
        if (isset($standings)) {
            foreach ($standings as $row) :
                ?>
                <p><?= $row ?></p>
                <?php
            endforeach;
        }
        ?>
        <p><b>Game stats</b></p>
        <?php
        $counter = 1;
        foreach ($histoGramStats as $row) :
            echo $counter . ":";
            for ($i=0; $i<$row; $i++) {
                echo "*";
            }
            ?>
        <br>
            <?php
            $counter++;
        endforeach;
        ?>
    </div>
</div>
