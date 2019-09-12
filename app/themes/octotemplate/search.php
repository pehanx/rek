<?php
/**
 * The template for displaying search results pages
 *
 * @package octotemplate
 */

get_header();
?>

<section class="result__title">
	<span><?= pll__('Результаты поиска'); ?></span>
	<div><?= get_search_query(); ?></div>
</section>
<?php if ( have_posts() ) : ?>
	<section class="result__main">
		<div class="result be-ajax-loadmore-container">
			<?php while ( have_posts() ) {
			    the_post();
                get_template_part('parts/list_element', 'post');
            } ?>
		</div>


        <?php
        global $wp_query;
        if ($wp_query->max_num_pages > 1) : ?>
            <script>
                var action = 'loadmore';
                var ajaxurl = '<?= site_url() ?>/wp-admin/admin-ajax.php';
                var loadmore_posts = '<?= addcslashes(serialize($wp_query->query_vars), "'"); ?>';
                var current_page = <?= (get_query_var('paged')) ? get_query_var('paged') : 1; ?>;
                var max_pages = '<?= $wp_query->max_num_pages; ?>';
            </script>

            <a href="javascript:;" id="loadmore" class="more-material result__button">Показать еще</a>

        <?php endif; ?>

	</section>
<?php else: ?>
	<section class="notresult">
		<p class="notresult__text"><?= pll__('Ничего не найдено :('); ?></p>
		<div class="notresult__img">
			<svg viewBox="0 0 538 541" fill="none" xmlns="http://www.w3.org/2000/svg" id="el_2ZOfUf3Si">
				<style>
					@-webkit-keyframes kf_el_PAWVLhpzRp_an_N8menQalu{50%{-webkit-transform: translate(270.1687774658203px, 241.3521270751953px) scale(0, 0) translate(-270.1687774658203px, -241.3521270751953px);transform: translate(270.1687774658203px, 241.3521270751953px) scale(0, 0) translate(-270.1687774658203px, -241.3521270751953px);}66.67%{-webkit-transform: translate(270.1687774658203px, 241.3521270751953px) scale(1, 1) translate(-270.1687774658203px, -241.3521270751953px);transform: translate(270.1687774658203px, 241.3521270751953px) scale(1, 1) translate(-270.1687774658203px, -241.3521270751953px);}83.33%{-webkit-transform: translate(270.1687774658203px, 241.3521270751953px) scale(1, 1) translate(-270.1687774658203px, -241.3521270751953px);transform: translate(270.1687774658203px, 241.3521270751953px) scale(1, 1) translate(-270.1687774658203px, -241.3521270751953px);}100%{-webkit-transform: translate(270.1687774658203px, 241.3521270751953px) scale(0, 0) translate(-270.1687774658203px, -241.3521270751953px);transform: translate(270.1687774658203px, 241.3521270751953px) scale(0, 0) translate(-270.1687774658203px, -241.3521270751953px);}0%{-webkit-transform: translate(270.1687774658203px, 241.3521270751953px) scale(0, 0) translate(-270.1687774658203px, -241.3521270751953px);transform: translate(270.1687774658203px, 241.3521270751953px) scale(0, 0) translate(-270.1687774658203px, -241.3521270751953px);}}@keyframes kf_el_PAWVLhpzRp_an_N8menQalu{50%{-webkit-transform: translate(270.1687774658203px, 241.3521270751953px) scale(0, 0) translate(-270.1687774658203px, -241.3521270751953px);transform: translate(270.1687774658203px, 241.3521270751953px) scale(0, 0) translate(-270.1687774658203px, -241.3521270751953px);}66.67%{-webkit-transform: translate(270.1687774658203px, 241.3521270751953px) scale(1, 1) translate(-270.1687774658203px, -241.3521270751953px);transform: translate(270.1687774658203px, 241.3521270751953px) scale(1, 1) translate(-270.1687774658203px, -241.3521270751953px);}83.33%{-webkit-transform: translate(270.1687774658203px, 241.3521270751953px) scale(1, 1) translate(-270.1687774658203px, -241.3521270751953px);transform: translate(270.1687774658203px, 241.3521270751953px) scale(1, 1) translate(-270.1687774658203px, -241.3521270751953px);}100%{-webkit-transform: translate(270.1687774658203px, 241.3521270751953px) scale(0, 0) translate(-270.1687774658203px, -241.3521270751953px);transform: translate(270.1687774658203px, 241.3521270751953px) scale(0, 0) translate(-270.1687774658203px, -241.3521270751953px);}0%{-webkit-transform: translate(270.1687774658203px, 241.3521270751953px) scale(0, 0) translate(-270.1687774658203px, -241.3521270751953px);transform: translate(270.1687774658203px, 241.3521270751953px) scale(0, 0) translate(-270.1687774658203px, -241.3521270751953px);}}@-webkit-keyframes kf_el_AJkhi4ZuDA_an_CVA--Svxg{0%{-webkit-transform: translate(326.4720764160156px, 166.4935302734375px) translate(-326.4720764160156px, -166.4935302734375px) translate(0px, 0px);transform: translate(326.4720764160156px, 166.4935302734375px) translate(-326.4720764160156px, -166.4935302734375px) translate(0px, 0px);}16.67%{-webkit-transform: translate(326.4720764160156px, 166.4935302734375px) translate(-326.4720764160156px, -166.4935302734375px) translate(0px, -80px);transform: translate(326.4720764160156px, 166.4935302734375px) translate(-326.4720764160156px, -166.4935302734375px) translate(0px, -80px);}33.33%{-webkit-transform: translate(326.4720764160156px, 166.4935302734375px) translate(-326.4720764160156px, -166.4935302734375px) translate(100px, 20px);transform: translate(326.4720764160156px, 166.4935302734375px) translate(-326.4720764160156px, -166.4935302734375px) translate(100px, 20px);}50%{-webkit-transform: translate(326.4720764160156px, 166.4935302734375px) translate(-326.4720764160156px, -166.4935302734375px) translate(0px, 0px);transform: translate(326.4720764160156px, 166.4935302734375px) translate(-326.4720764160156px, -166.4935302734375px) translate(0px, 0px);}100%{-webkit-transform: translate(326.4720764160156px, 166.4935302734375px) translate(-326.4720764160156px, -166.4935302734375px) translate(0px, 0px);transform: translate(326.4720764160156px, 166.4935302734375px) translate(-326.4720764160156px, -166.4935302734375px) translate(0px, 0px);}}@keyframes kf_el_AJkhi4ZuDA_an_CVA--Svxg{0%{-webkit-transform: translate(326.4720764160156px, 166.4935302734375px) translate(-326.4720764160156px, -166.4935302734375px) translate(0px, 0px);transform: translate(326.4720764160156px, 166.4935302734375px) translate(-326.4720764160156px, -166.4935302734375px) translate(0px, 0px);}16.67%{-webkit-transform: translate(326.4720764160156px, 166.4935302734375px) translate(-326.4720764160156px, -166.4935302734375px) translate(0px, -80px);transform: translate(326.4720764160156px, 166.4935302734375px) translate(-326.4720764160156px, -166.4935302734375px) translate(0px, -80px);}33.33%{-webkit-transform: translate(326.4720764160156px, 166.4935302734375px) translate(-326.4720764160156px, -166.4935302734375px) translate(100px, 20px);transform: translate(326.4720764160156px, 166.4935302734375px) translate(-326.4720764160156px, -166.4935302734375px) translate(100px, 20px);}50%{-webkit-transform: translate(326.4720764160156px, 166.4935302734375px) translate(-326.4720764160156px, -166.4935302734375px) translate(0px, 0px);transform: translate(326.4720764160156px, 166.4935302734375px) translate(-326.4720764160156px, -166.4935302734375px) translate(0px, 0px);}100%{-webkit-transform: translate(326.4720764160156px, 166.4935302734375px) translate(-326.4720764160156px, -166.4935302734375px) translate(0px, 0px);transform: translate(326.4720764160156px, 166.4935302734375px) translate(-326.4720764160156px, -166.4935302734375px) translate(0px, 0px);}}@-webkit-keyframes kf_el_Ftw1QI4T-t_an_nKvIyJwov{16.67%{-webkit-transform: translate(89.4843978881836px, 499.15399169921875px) translate(-89.4843978881836px, -499.15399169921875px) translate(0px, 0px);transform: translate(89.4843978881836px, 499.15399169921875px) translate(-89.4843978881836px, -499.15399169921875px) translate(0px, 0px);}33.33%{-webkit-transform: translate(89.4843978881836px, 499.15399169921875px) translate(-89.4843978881836px, -499.15399169921875px) translate(100px, 0px);transform: translate(89.4843978881836px, 499.15399169921875px) translate(-89.4843978881836px, -499.15399169921875px) translate(100px, 0px);}50%{-webkit-transform: translate(89.4843978881836px, 499.15399169921875px) translate(-89.4843978881836px, -499.15399169921875px) translate(0px, 0px);transform: translate(89.4843978881836px, 499.15399169921875px) translate(-89.4843978881836px, -499.15399169921875px) translate(0px, 0px);}0%{-webkit-transform: translate(89.4843978881836px, 499.15399169921875px) translate(-89.4843978881836px, -499.15399169921875px) translate(0px, 0px);transform: translate(89.4843978881836px, 499.15399169921875px) translate(-89.4843978881836px, -499.15399169921875px) translate(0px, 0px);}100%{-webkit-transform: translate(89.4843978881836px, 499.15399169921875px) translate(-89.4843978881836px, -499.15399169921875px) translate(0px, 0px);transform: translate(89.4843978881836px, 499.15399169921875px) translate(-89.4843978881836px, -499.15399169921875px) translate(0px, 0px);}}@keyframes kf_el_Ftw1QI4T-t_an_nKvIyJwov{16.67%{-webkit-transform: translate(89.4843978881836px, 499.15399169921875px) translate(-89.4843978881836px, -499.15399169921875px) translate(0px, 0px);transform: translate(89.4843978881836px, 499.15399169921875px) translate(-89.4843978881836px, -499.15399169921875px) translate(0px, 0px);}33.33%{-webkit-transform: translate(89.4843978881836px, 499.15399169921875px) translate(-89.4843978881836px, -499.15399169921875px) translate(100px, 0px);transform: translate(89.4843978881836px, 499.15399169921875px) translate(-89.4843978881836px, -499.15399169921875px) translate(100px, 0px);}50%{-webkit-transform: translate(89.4843978881836px, 499.15399169921875px) translate(-89.4843978881836px, -499.15399169921875px) translate(0px, 0px);transform: translate(89.4843978881836px, 499.15399169921875px) translate(-89.4843978881836px, -499.15399169921875px) translate(0px, 0px);}0%{-webkit-transform: translate(89.4843978881836px, 499.15399169921875px) translate(-89.4843978881836px, -499.15399169921875px) translate(0px, 0px);transform: translate(89.4843978881836px, 499.15399169921875px) translate(-89.4843978881836px, -499.15399169921875px) translate(0px, 0px);}100%{-webkit-transform: translate(89.4843978881836px, 499.15399169921875px) translate(-89.4843978881836px, -499.15399169921875px) translate(0px, 0px);transform: translate(89.4843978881836px, 499.15399169921875px) translate(-89.4843978881836px, -499.15399169921875px) translate(0px, 0px);}}@-webkit-keyframes kf_el_Ff_0fpCSAn_an_5JVxWi-Ds{0%{-webkit-transform: translate(9.060737609863281px, 88.65380096435547px) translate(-9.060737609863281px, -88.65380096435547px) translate(0px, 0px);transform: translate(9.060737609863281px, 88.65380096435547px) translate(-9.060737609863281px, -88.65380096435547px) translate(0px, 0px);}16.67%{-webkit-transform: translate(9.060737609863281px, 88.65380096435547px) translate(-9.060737609863281px, -88.65380096435547px) translate(0px, -80px);transform: translate(9.060737609863281px, 88.65380096435547px) translate(-9.060737609863281px, -88.65380096435547px) translate(0px, -80px);}33.33%{-webkit-transform: translate(9.060737609863281px, 88.65380096435547px) translate(-9.060737609863281px, -88.65380096435547px) translate(100px, 20px);transform: translate(9.060737609863281px, 88.65380096435547px) translate(-9.060737609863281px, -88.65380096435547px) translate(100px, 20px);}50%{-webkit-transform: translate(9.060737609863281px, 88.65380096435547px) translate(-9.060737609863281px, -88.65380096435547px) translate(0px, 0px);transform: translate(9.060737609863281px, 88.65380096435547px) translate(-9.060737609863281px, -88.65380096435547px) translate(0px, 0px);}100%{-webkit-transform: translate(9.060737609863281px, 88.65380096435547px) translate(-9.060737609863281px, -88.65380096435547px) translate(0px, 0px);transform: translate(9.060737609863281px, 88.65380096435547px) translate(-9.060737609863281px, -88.65380096435547px) translate(0px, 0px);}}@keyframes kf_el_Ff_0fpCSAn_an_5JVxWi-Ds{0%{-webkit-transform: translate(9.060737609863281px, 88.65380096435547px) translate(-9.060737609863281px, -88.65380096435547px) translate(0px, 0px);transform: translate(9.060737609863281px, 88.65380096435547px) translate(-9.060737609863281px, -88.65380096435547px) translate(0px, 0px);}16.67%{-webkit-transform: translate(9.060737609863281px, 88.65380096435547px) translate(-9.060737609863281px, -88.65380096435547px) translate(0px, -80px);transform: translate(9.060737609863281px, 88.65380096435547px) translate(-9.060737609863281px, -88.65380096435547px) translate(0px, -80px);}33.33%{-webkit-transform: translate(9.060737609863281px, 88.65380096435547px) translate(-9.060737609863281px, -88.65380096435547px) translate(100px, 20px);transform: translate(9.060737609863281px, 88.65380096435547px) translate(-9.060737609863281px, -88.65380096435547px) translate(100px, 20px);}50%{-webkit-transform: translate(9.060737609863281px, 88.65380096435547px) translate(-9.060737609863281px, -88.65380096435547px) translate(0px, 0px);transform: translate(9.060737609863281px, 88.65380096435547px) translate(-9.060737609863281px, -88.65380096435547px) translate(0px, 0px);}100%{-webkit-transform: translate(9.060737609863281px, 88.65380096435547px) translate(-9.060737609863281px, -88.65380096435547px) translate(0px, 0px);transform: translate(9.060737609863281px, 88.65380096435547px) translate(-9.060737609863281px, -88.65380096435547px) translate(0px, 0px);}}#el_2ZOfUf3Si *{-webkit-animation-duration: 6s;animation-duration: 6s;-webkit-animation-iteration-count: infinite;animation-iteration-count: infinite;-webkit-animation-timing-function: cubic-bezier(0, 0, 1, 1);animation-timing-function: cubic-bezier(0, 0, 1, 1);}#el_K7bseXqSEK{fill: #E6F4FF;}#el_LxcyONqDvC{fill: #E6F4FF;}#el_HByp9BexfK{fill: #E6F4FF;}#el_Ftw1QI4T-t{fill: #BCE2FF;}#el_NytO36A1JH{fill: #0B43A4;}#el_V3L8oW4Dmp{fill: #0056EC;}#el_hGOFe-yH9f{fill: #5193F4;}#el_rbY5SbTrcg{fill: #BCE2FF;}#el_PAWVLhpzRp{fill: #E24434;}#el_-XRcbexKkc{opacity: 0.2;fill: #BCE2FF;}#el_Qe8UFxqSRv{fill: #0056EC;}#el_AJkhi4ZuDA{opacity: 0.7;}#el_VAITinWCbg{opacity: 0.7;fill: white;}#el_Ff_0fpCSAn_an_5JVxWi-Ds{-webkit-animation-fill-mode: backwards;animation-fill-mode: backwards;-webkit-transform: translate(9.060737609863281px, 88.65380096435547px) translate(-9.060737609863281px, -88.65380096435547px) translate(0px, 0px);transform: translate(9.060737609863281px, 88.65380096435547px) translate(-9.060737609863281px, -88.65380096435547px) translate(0px, 0px);-webkit-animation-name: kf_el_Ff_0fpCSAn_an_5JVxWi-Ds;animation-name: kf_el_Ff_0fpCSAn_an_5JVxWi-Ds;-webkit-animation-timing-function: cubic-bezier(0.42, 0, 0.58, 1);animation-timing-function: cubic-bezier(0.42, 0, 0.58, 1);}#el_Ftw1QI4T-t_an_nKvIyJwov{-webkit-animation-fill-mode: backwards;animation-fill-mode: backwards;-webkit-transform: translate(89.4843978881836px, 499.15399169921875px) translate(-89.4843978881836px, -499.15399169921875px) translate(0px, 0px);transform: translate(89.4843978881836px, 499.15399169921875px) translate(-89.4843978881836px, -499.15399169921875px) translate(0px, 0px);-webkit-animation-name: kf_el_Ftw1QI4T-t_an_nKvIyJwov;animation-name: kf_el_Ftw1QI4T-t_an_nKvIyJwov;-webkit-animation-timing-function: cubic-bezier(0.42, 0, 0.58, 1);animation-timing-function: cubic-bezier(0.42, 0, 0.58, 1);}#el_AJkhi4ZuDA_an_CVA--Svxg{-webkit-animation-fill-mode: backwards;animation-fill-mode: backwards;-webkit-transform: translate(326.4720764160156px, 166.4935302734375px) translate(-326.4720764160156px, -166.4935302734375px) translate(0px, 0px);transform: translate(326.4720764160156px, 166.4935302734375px) translate(-326.4720764160156px, -166.4935302734375px) translate(0px, 0px);-webkit-animation-name: kf_el_AJkhi4ZuDA_an_CVA--Svxg;animation-name: kf_el_AJkhi4ZuDA_an_CVA--Svxg;-webkit-animation-timing-function: cubic-bezier(0.42, 0, 0.58, 1);animation-timing-function: cubic-bezier(0.42, 0, 0.58, 1);}#el_PAWVLhpzRp_an_N8menQalu{-webkit-animation-fill-mode: backwards;animation-fill-mode: backwards;-webkit-transform: translate(270.1687774658203px, 241.3521270751953px) scale(0, 0) translate(-270.1687774658203px, -241.3521270751953px);transform: translate(270.1687774658203px, 241.3521270751953px) scale(0, 0) translate(-270.1687774658203px, -241.3521270751953px);-webkit-animation-name: kf_el_PAWVLhpzRp_an_N8menQalu;animation-name: kf_el_PAWVLhpzRp_an_N8menQalu;-webkit-animation-timing-function: cubic-bezier(0.42, 0, 0.58, 1);animation-timing-function: cubic-bezier(0.42, 0, 0.58, 1);}
				</style>
				<g id="el_nPIeCsMl8G">
					<path d="M80.7085 250.528C87.9685 215.284 49.1604 210.796 45.7284 231.256C41.1084 258.184 74.6365 280.096 80.7085 250.528Z" id="el_K7bseXqSEK" />
					<path d="M70.2797 280.36C56.0237 284.452 64.9997 299.764 73.1837 297.124C83.8757 293.56 82.2917 276.928 70.2797 280.36Z" id="el_LxcyONqDvC" />
					<path d="M329.021 441.078C213.562 495.908 14.7823 447.145 73.8402 359.778C119.593 292.082 95.9029 210.724 73.8405 176.93C22.2302 66.2355 196.335 -13.0783 319.858 2.09489C477.102 14.509 592.489 149.77 509.287 245.636C404.752 350.134 447.412 378.317 329.021 441.078Z"
						  id="el_HByp9BexfK" />
				</g>
				<g id="el_Ftw1QI4T-t_an_nKvIyJwov" data-animator-group="true" data-animator-type="0">
					<path d="M437.303 519.823C437.303 531.328 359.324 540.493 263.394 540.493C167.271 540.493 89.4844 531.133 89.4844 519.823C89.4844 508.319 167.464 499.154 263.394 499.154C359.517 499.154 437.303 508.319 437.303 519.823Z" id="el_Ftw1QI4T-t"
					/>
				</g>
				<g id="el_Ff_0fpCSAn_an_5JVxWi-Ds" data-animator-group="true" data-animator-type="0">
					<g id="el_Ff_0fpCSAn">
						<path d="M174.788 329.563L139.32 365.031L150.894 376.605L186.362 341.136L174.788 329.563Z" id="el_NytO36A1JH" />
						<path d="M120.106 368.021L14.8213 473.306C7.14055 480.986 7.14055 493.439 14.8213 501.12C22.5021 508.801 34.9551 508.801 42.6358 501.12L147.92 395.836C155.601 388.155 155.601 375.702 147.92 368.021C140.239 360.341 127.786 360.341 120.106 368.021Z" id="el_V3L8oW4Dmp"
						/>
						<path d="M132.529 355.597L126.117 362.009C125.336 362.79 125.336 364.056 126.117 364.837L151.103 389.823C151.884 390.604 153.151 390.604 153.932 389.823L160.344 383.411C161.125 382.63 161.125 381.364 160.344 380.583L135.358 355.597C134.577 354.816 133.31 354.816 132.529 355.597Z"
							  id="el_hGOFe-yH9f" />
						<ellipse cx="273.729" cy="238.646" rx="124.374" ry="124.374" id="el_rbY5SbTrcg" />
						<g id="el_PAWVLhpzRp_an_N8menQalu" data-animator-group="true" data-animator-type="2">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M298.093 285.199C301.999 289.104 308.33 289.104 312.236 285.199C316.141 281.294 316.141 274.962 312.236 271.057L284.361 243.182L315.676 212.896C319.646 209.056 319.752 202.725 315.913 198.755C312.073 194.786 305.742 194.68 301.773 198.519L270.217 229.038L238.684 197.506C234.779 193.6 228.447 193.6 224.542 197.506C220.637 201.411 220.637 207.742 224.542 211.648L255.838 242.944L227.003 270.832C223.033 274.671 222.927 281.002 226.767 284.972C230.606 288.942 236.937 289.048 240.907 285.208L269.982 257.088L298.093 285.199Z"
								  id="el_PAWVLhpzRp" />
						</g>
						<ellipse cx="273.729" cy="238.646" rx="124.374" ry="124.374" id="el_-XRcbexKkc" />
						<path d="M274.346 88.6538C191.186 88.6538 123.734 156.106 123.734 239.266C123.734 322.426 191.186 389.878 274.346 389.878C357.506 389.878 424.958 322.426 424.958 239.266C424.958 156.106 357.506 88.6538 274.346 88.6538ZM274.346 362.29C206.366 362.29 151.322 307.246 151.322 239.266C151.322 171.286 206.366 116.242 274.346 116.242C342.326 116.242 397.37 171.286 397.37 239.266C397.37 307.246 342.194 362.29 274.346 362.29Z"
							  id="el_Qe8UFxqSRv" />
					</g>
				</g>
				<g id="el_AJkhi4ZuDA_an_CVA--Svxg" data-animator-group="true" data-animator-type="0">
					<g id="el_AJkhi4ZuDA">
						<path d="M351.29 198.584C342.108 179.654 320.485 172.524 328.048 167.693C335.611 162.861 356.56 172.968 365.61 191.891C374.792 210.821 370.717 233.369 361.102 236.317C351.486 239.264 360.472 217.514 351.29 198.584Z" id="el_VAITinWCbg" />
					</g>
				</g>

			</svg>
		</div>
	</section>
<?php endif; ?>

<?php
get_footer();