<?php

namespace Anax\View;

?>
<h1>Dice 100</h1>
<div class="dice-game-container">
    <div class="dice-game-buttons">
        <p>
        <form method="get" action="setup">
            <input type="submit" name="gameaction" value="Spela igen" class="dice-submit">
        </form>
        </p>
    </div>
    <div class="dice-game-info">
        <p><?= $lastPlayer ?> vann!</p>
        <p>Klicka på Spela igen för att starta ett nytt spel</p>
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
