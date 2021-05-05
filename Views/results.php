<?php require "components/layout.php" ?>

<body>
<div class="container">
    <?php require "components/top.php" ?>
    <p>Search results for: "<?= $searched;?>"</p>
    <div class="main">
        <p class="fallback">
            <?php
            $cards = !empty($found) ? $found : die("Nothing has been found");
            ?>
        </p>
        <?php foreach ($cards as $card): ?>

        <div id="card" class="card" onclick="on(); getCard(this.innerHTML)">
            <div class="card_content">
                <b id="content"><?= $card['title']; ?></b>
                <span id="identifier"><?= $card['id'] ?></span>
            </div>
        </div>
        <div class="excerpt"><i><?= $card['excerpt']; ?> ...</i></div><br>

        <?php endforeach; ?>

    </div>
</div>
<?php require "components/overlay.php" ; ?>
</body>
</html>
