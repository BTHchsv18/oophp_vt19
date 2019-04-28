<?php

namespace Anax\View;

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
            <input type="submit" name="gameaction" value="Starta om" class="dice-submit">
        </form>
        </p>
    </div>
    <div class="dice-game-info">
            <?php if(isset($lastTurnResults)  && count($lastTurnResults) != 0) { ?>
                <p>
                    <?= $lastPlayer ?> slog följande <?= count($lastTurnResults) ?> händer
                    och stannade med <?= $lastTurnScore ?> poäng.
                </p>
                <?php foreach ($lastTurnResults as $row) : ?>
                    <p>------------------------------</p>
                    <p>
                    <?php foreach ($row as $value) : ?>
                        <i class="dice-sprite <?= $value ?>"></i>
                    <?php endforeach; ?>
                    </p>
            <?php endforeach; ?>
        <?php } else { ?>
            <p>Du slog inga tärningar och fick därför inga poäng.</p>
        <?php } ?>
        <p>Klicka på Fortsätt för att låta nästa spelare kasta.</p>
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
