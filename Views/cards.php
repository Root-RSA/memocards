<?php require "components/layout.php" ?>

<body>

<div class="container">

    <?php require "components/top.php" ?>

    <div class="title">
        <h2>Your cards</h2>
        <p id="test"></p>
        <br><br>
    </div>
    <div id="main" class="main">
        <?php
        if(!empty($list)){
            foreach ($list as $card){
                $cards[] = array('title'=>$card['title'], 'id'=>$card['id']);
            }
        }
        if(isset($cards)): foreach ($cards as $card):
            ?>
        <div class="card" onclick="on(); getCard(this.innerHTML)">
            <div class="card_content">
                <b id="content"><?= $card['title']; ?></b>
                <span id="identifier"><?= $card['id'] ?></span>
            </div>
        </div>
        <?php endforeach; else: ?>
            <p><?= 'You haven\'t created any card yet'; ?></p>
        <?php endif; ?>
    </div>
</div>

<?php require "components/overlay.php" ; ?>


</body>