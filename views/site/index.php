<?= $this->render('@app/views/sections/_best3month', ['best3month' => $best3month]) ?>
<?= $this->render('@app/views/sections/_best3games', compact('top10games')) ?>
<?= $this->render('@app/views/sections/_top10portal', [
    'top10games' => $top10games,
    'top10users' => $top10users,
    'top10devs' => $top10devs,
]) ?>
<?= $this->render('@app/views/sections/_lastaddgames', compact('lastaddgames')) ?>
<?= $this->render('@app/views/sections/_endblock', [
    'categories' => $categories,
    'count_cat' => $count_cat,
    'stat' => $stat,
]) ?>


