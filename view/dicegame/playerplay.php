<?php

namespace Anax\View;

?>
<h1>Dice 100</h1>
<div class="dice-game-container">


    <div class="dice-game-buttons">
        <p>
        <form method="post" action="roll">
            <input type="submit" name="gameaction" value="Roll" class="dice-submit">
        </form>
        </p>
        <p>
        <form method="get" action="stand">
            <input type="submit" name="gameaction" value="Stand" class="dice-submit">
        </form>
        </p>
        <p>
        <form method="get" action="setup">
            <input type="submit" name="gameaction" value="Restart" class="dice-submit">
        </form>
        </p>
    </div>
    <div class="dice-game-info">

        <?php if(isset($results)) { ?>
            <p>
                Du slog:
            </p>
            <p>
            <?php foreach ($results as $value) : ?>
                <i class="dice-sprite <?= $value ?>"></i>
            <?php endforeach; ?>
            </p>
        <?php } ?>

        <p>
            <?php if (isset($turnscore)) echo $turnscore . " poäng. Stanna?" ?>
        </p>
        <p>
            Din tur
        </p>
    </div>

    <div class="dice-game-standings">
        <p><b>Standings</b></p>
        <?php
            if(isset($standings)) {
                foreach ($standings as $row) :
        ?>
                    <p><?= $row ?></p>
        <?php
                endforeach;
            }
        ?>
    </div>
</div>
