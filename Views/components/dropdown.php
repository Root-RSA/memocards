<div class="dropdown">
    <p id="dropdown" onclick="toggle_dropdown()" tabindex="0">
        <?php echo isset($current_domain) ? $current_domain : "Domains"; ?></p>
    <ul class="dropdown-content">
        <?php foreach ($domains as $domain): ?>
            <li
                class="dropdown-items"
                onclick="display(this.innerHTML); overwrite_domain(this.innerHTML); input_domain(this.innerHTML); hide_dropdown();"
            ><?= $domain ?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>