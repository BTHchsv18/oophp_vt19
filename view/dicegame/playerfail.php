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
            <input type="submit" name="gameaction" value="fortsätt" class="dice-submit">
        </form>
        </p>
    </div>
    <div class="dice-game-info">
        <p>
            Du slog:
        </p>
        <?php if(isset($results)) { ?>
            <p>
            <?php foreach ($results as $value) : ?>
                <i class="dice-sprite <?= $value ?>"></i>
            <?php endforeach; ?>
            </p>
        <?php } ?>
        <p>
            <?php if (isset($playerTurn)) echo $playerTurn . " slog en etta och stannade. Inga poäng inkasserade" ?>
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
