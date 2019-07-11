<?php
$line_in_footer = get_field('line_in_footer');
if ($line_in_footer && !$line_in_footer['hide']): ?>
    <section class="inclub">
        <div class="inclub__wrapp">
            <div class="inclub__text">
                <?= $line_in_footer['title']; ?>
            </div>
            <a href="javascript:;" class="inclub__button popupopen">
                <?= $line_in_footer['button_text']; ?>
            </a>
        </div>
    </section>
<?php endif; ?>