<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());


?>
<h1>Dice 100</h1>
<div class="dice-game-container">
    <div class="dice-game-buttons">
        <p>
        <form method="get" action="handleturn">
            <input type="submit" name="gameaction" value="Fortsätt" class="dice-submit">
        </form>
        </p>
        <p>
        <form method="get" action="setup">
            <input type="submit" name="gameaction" value="Restart" class="dice-submit">
        </form>
        </p>
    </div>
    <div class="dice-game-info">
        <p>
            <?php if(isset($results)) { ?>
                <?php foreach ($results as $row) : ?>
                    <p><?php if (isset($playerTurn)) echo $playerTurn . " slog:"?></p>
                    <?php foreach ($row as $value) : ?>
                    <i class="dice-sprite <?= $value ?>"></i>
                    <?php endforeach; ?>
            <?php endforeach; ?>
            <p>och stannade med <?= $turnscore ?> poäng.</p>
            <?php } ?>
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
