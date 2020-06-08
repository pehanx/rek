<?php
/**
 * The template for displaying the footer
 *
 * @package octotemplate
 */


get_template_part('/parts/footer', 'menu');
get_template_part('/parts/footer', 'popups');
get_template_part('/parts/footer', 'mailing');
get_template_part('/parts/footer', 'updatesite');
get_template_part('/parts/footer', 'forms');
?>

<!-- Main scripts. You can replace it, but I recommend you to leave it here     -->
<!-- <script src="	" type="text/javascript"></script> -->

<script src="<?= template(); ?>static/js/main.js"></script>
<script src="<?= template(); ?>static/js/select2.min.js"></script>



<!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script> -->



<script src="<?= template(); ?>static/js/be.js"></script>

    

<script src="<?= template(); ?>static/js/jquery.eventCalendar.js"></script>
<script src="<?= template(); ?>static/js/moment.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.12.0/moment.js"></script> -->
<script src="<?= template(); ?>static/js/jquery.cookie.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<?php wp_footer(); ?>

</body>
</html>
