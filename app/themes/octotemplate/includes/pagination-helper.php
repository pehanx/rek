<?php
    /**
     * Пагинация
     */
    function pagination($pages = '', $range = 4)
    {
        $showitems = ($range * 2) + 1;

        global $paged;
        if (empty($paged)) $paged = 1;

        if ($pages == '') {
            global $wp_query;
            $pages = $wp_query->max_num_pages;
            if (!$pages) {
                $pages = 1;
            }
        }

        if (1 != $pages): ?>
            <div class="news__containerpaggination">
                <?php if (($paged - $showitems) > 1): ?>
                    <a href="<?= get_pagenum_link(1); ?>">...</a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $pages; $i++):
                    if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems)): ?>
                        <a href="<?= get_pagenum_link($i) ?>" class="<?= ($i == $paged) ? ' active' : ''; ?>"><span><?= $i; ?></span></a>
                    <?php endif; ?>
                <?php endfor; ?>

                <?php if (($paged + $showitems) < $pages): ?>
                    <a href="<?= get_pagenum_link($pages); ?>">...</a>
                <?php endif; ?>
            </div>
        <?php endif;
    }