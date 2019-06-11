<?php

namespace Anax\View;

if (!$resultset) {
    return;
}
?>

<h2>Filters</h2>
<?php require "navbar.php"; ?>


<h2>Using filter: <?= $filter ?></h2>
<h3>Origin text</h3>
<p>
    <?= $origin ?>
</p>
<h3>Filtered text</h3>
<p>
    <?= $resultset ?>
</p>
