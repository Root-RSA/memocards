<div class="top">
    <div class="left">
        <div class="search">
            <form action="<?php echo BASE . 'cards/search'; ?>">
                <input type="text" name="search" placeholder="search..." required>
                <button class="search_btn" type="submit"><i class="search_icn"></i></button>
            </form>
        </div>
        <div class="top_btns">
            <?php
                if (isset($dropdown) && $dropdown === true) {
                    include "dropdown.php";
                }
            ?>
            <a
                class="create_card"
                href="<?= BASE. 'views/create' ?>"
                style="display: <?= $create_card ?>"
            >
                <button>Create card</button></a>
            <a
                class="allcards"
                href="<?= BASE. 'views/allcards' ?>"
                style="display: <?= $allcards ?>"
            >
                <button>Your cards</button>
            </a>
        </div>
    </div>
    <div class="right">
        <a class="sign_out" href="<?php echo BASE . 'login/logout'; ?>"><img src="../img/logout.webp" width="30" height="30"></a>
    </div>
    <p id="test"></p>
</div>