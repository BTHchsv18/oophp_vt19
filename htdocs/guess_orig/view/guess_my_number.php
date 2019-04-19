<h1>Guess my number</h1>
<p>Guess a number between  and 100, you have <?= $triesleft ?> left.</p>

<!-- IF Button value = cheat - echo cheat -->

<form method="post">
    <input type="text" name="userguessvalue" value="" placeholder="Make guess">
    <input type="submit" name="makeguess" value="Guess number">
    <input type="submit" name="restart" value="Start over">
    <input type="submit" name="cheat" value="Cheat">
</form>

<?php if ($userguessvalue) : ?>
    <p>Your guess <?= $userguessvalue ?> is <b><?= $result ?></b></p>
<?php endif; ?>

<?php if ($cheat) : ?>
    <p>CHEAT: Current number is <b><?= $number ?></b></p>
<?php endif; ?>

<?php if ($triesleft === 0) : ?>
    <p><b>No more tries. Press startover to start new game.</b></p>
<?php endif; ?>
