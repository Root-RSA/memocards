<?php include "components/layout.php" ?>

<body onload="radius();">

<?php include "components/top.php" ?>

<h4>Create a card</h4>
<div class="wrapper">
    <div class="form">
        <form action="<?php echo BASE . 'card/create'; ?>" method="post">
            <div class="domain">
                <div id="select_domain" style="display: <?= $visibility ?>">
                    <input id="selected_domain" name="selected_domain" type="hidden">
                    <label for="selected_domain">Existing domain or</label><br>
                    <?php include "components/dropdown.php"; ?>
                </div>
                <div id="insert_domain">
                    <label for="new_domain">New domain</label><br>
                    <input type="text" name="new_domain" maxlength="100" placeholder="Max 100 chars" size="20">
                </div>
            </div>

            <br>

            <label for="title">Name the card</label><br>
            <input type="text" name="title" maxlength="100" placeholder="Keep it short" size="20" required>
            <p class="err-msg"><?php if(isset($msg)) echo $msg; ?></p><br>

            <label for="content">Fill the card</label><br>
            <textarea id="mytextarea" type="text" wrap="hard" name="content" placeholder="Type your card's content" cols="40" rows="30"></textarea>

            <button type="submit" <!--formaction="../card/create"-->>Create</button>
        </form>
    </div>
</div>
</body>