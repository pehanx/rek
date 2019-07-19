<?php
/**
 * The template for displaying the footer
 *
 * @package octotemplate
 */


get_template_part('/parts/footer', 'menu');
get_template_part('/parts/footer', 'popups');
?>

<!-- Main scripts. You can replace it, but I recommend you to leave it here     -->
<!-- <script src="	" type="text/javascript"></script> -->
<script src="<?= template(); ?>static/js/main.js"></script>
<script src="<?= template(); ?>static/js/be.js"></script>
<script src="<?= template(); ?>static/js/moment.js"></script>
<script src="<?= template(); ?>static/js/jquery.eventCalendar.js"></script>

<?php wp_footer(); ?>

</body>
</html>
