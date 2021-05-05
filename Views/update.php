<?php require "components/layout.php" ?>

<body onload="radius();">

<?php require "components/top.php" ?>

<h4>Update the card</h4>

<?php $card = $data['card'] ?: die('Not possible to update this card'); ?>

<div class="wrapper">
    <div class="form">
        <form action="<?php echo BASE.'card/update'; ?>" method="post">
            <div class="domain">
                <div id="select_domain" style="display: <?= $visibility ?>">
                    <input
                            id="selected_domain"
                            name="selected_domain"
                            value="<?= $current_domain ?>"
                            type="hidden"
                    >
                    <label for="selected_domain">Current domain or</label><br>
                    <?php
                        include "components/dropdown.php";
                    ?>
                </div>
                <div id="insert_domain">
                    <label for="new_domain">New domain</label><br>
                    <input type="text" name="new_domain" maxlength="100" placeholder="Max 100 chars" size="20">
                </div>
            </div>

            <label for="title">Title</label><br>
            <input type="text" name="title" size="20" value="<?= $card['title'] ?>" required>
            <p class="err-msg"><?php if(isset($msg)) echo $msg; ?></p><br><br>

            <label for="content">Content</label><br>
            <textarea id="mytextarea" type="text" wrap="hard" name="content" cols="40" rows="30"><?= $card['text'] ?></textarea>

            <button type="submit" formaction="<?= BASE. 'card/update' ?>">Update</button>
        </form>
    </div>
</div>
</body>
