<?php

/**
 * Manages the compatibility with Yoast SEO
 *
 * @since 2.3
 */
class PLL_WPSEO {
	/**
	 * Translate options and add specific filters and actions
	 *
	 * @since 1.6.4
	 */
	public function init() {
		if ( PLL() instanceof PLL_Frontend ) {
			add_filter( 'option_wpseo_titles', array( $this, 'wpseo_translate_titles' ) );

			// Filters sitemap queries to remove inactive language or to get
			// one sitemap per language when using multiple domains or subdomains
			// because WPSEO does not accept several domains or subdomains in one sitemap
			add_filter( 'wpseo_posts_join', array( $this, 'wpseo_posts_join' ), 10, 2 );
			add_filter( 'wpseo_posts_where', array( $this, 'wpseo_posts_where' ), 10, 2 );
			add_filter( 'wpseo_typecount_join', array( $this, 'wpseo_posts_join' ), 10, 2 );
			add_filter( 'wpseo_typecount_where', array( $this, 'wpseo_posts_where' ), 10, 2 );

			if ( PLL()->options['force_lang'] > 1 ) {
				add_filter( 'wpseo_enable_xml_sitemap_transient_caching', '__return_false' ); // Disable cache! otherwise WPSEO keeps only one domain (thanks to Junaid Bhura)
				add_filter( 'home_url', array( $this, 'wpseo_home_url' ), 10, 2 ); // Fix home_url
			} else {
				// Get all terms in all languages when the language is set from the content or directory name
				add_filter( 'get_terms_args', array( $this, 'wpseo_remove_terms_filter' ) );
			}

			add_action( 'pre_get_posts', array( $this, 'before_sitemap' ), 0 ); // Needs to be fired before WPSEO_Sitemaps::redirect()

			add_filter( 'pll_home_url_white_list', array( $this, 'wpseo_home_url_white_list' ) );
			add_action( 'wpseo_opengraph', array( $this, 'wpseo_ogp' ), 2 );
			add_filter( 'wpseo_canonical', array( $this, 'wpseo_canonical' ) );
		} else {
			add_action( 'admin_init', array( $this, 'wpseo_register_strings' ) );

			// Primary category
			add_filter( 'pll_copy_post_metas', array( $this, 'copy_post_metas' ) );
			add_filter( 'pll_translate_post_meta', array( $this, 'translate_post_meta' ), 10, 3 );
		}
	}

	/**
	 * Registers strings for custom post types and custom taxonomies titles and meta descriptions
	 *
	 * @since 2.0
	 */
	public function wpseo_register_strings() {
		$options = get_option( 'wpseo_titles' );
		foreach ( get_post_types( array( 'public' => true, '_builtin' => false ) ) as $t ) {
			if ( pll_is_translated_post_type( $t ) ) {
				$this->_wpseo_register_strings( $options, array( 'title-' . $t, 'metadesc-' . $t ) );
			}
		}
		foreach ( get_post_types( array( 'has_archive' => true, '_builtin' => false ) ) as $t ) {
			if ( pll_is_translated_post_type( $t ) ) {
				$this->_wpseo_register_strings( $options, array( 'title-ptarchive-' . $t, 'metadesc-ptarchive-' . $t, 'bctitle-ptarchive-' . $t ) );
			}
		}
		foreach ( get_taxonomies( array( 'public' => true, '_builtin' => false ) ) as $t ) {
			if ( pll_is_translated_taxonomy( $t ) ) {
				$this->_wpseo_register_strings( $options, array( 'title-tax-' . $t, 'metadesc-tax-' . $t ) );
			}
		}
	}

	/**
	 * Helper function to translate custom post types and custom taxonomies titles and meta descriptions
	 *
	 * @since 2.1.6
	 *
	 * @param array $options
	 * @param array $titles
	 * @return array
	 */
	protected function _wpseo_translate_titles( $options, $titles ) {
		foreach ( $titles as $title ) {
			if ( ! empty( $options[ $title ] ) ) {
				$options[ $title ] = pll__( $options[ $title ] );
			}
		}
		return $options;
	}

	/**
	 * Translates strings for custom post types and custom taxonomies titles and meta descriptions
	 *
	 * @since 2.0
	 *
	 * @param array $options
	 * @return array
	 */
	public function wpseo_translate_titles( $options ) {
		if ( PLL() instanceof PLL_Frontend ) {
			foreach ( get_post_types( array( 'public' => true, '_builtin' => false ) ) as $t ) {
				if ( pll_is_translated_post_type( $t ) ) {
					$options = $this->_wpseo_translate_titles( $options, array( 'title-' . $t, 'metadesc-' . $t ) );
				}
			}
			foreach ( get_post_types( array( 'has_archive' => true, '_builtin' => false ) ) as $t ) {
				if ( pll_is_translated_post_type( $t ) ) {
					$options = $this->_wpseo_translate_titles( $options, array( 'title-ptarchive-' . $t, 'metadesc-ptarchive-' . $t, 'bctitle-ptarchive-' . $t ) );
				}
			}
			foreach ( get_taxonomies( array( 'public' => true, '_builtin' => false ) ) as $t ) {
				if ( pll_is_translated_taxonomy( $t ) ) {
					$options = $this->_wpseo_translate_titles( $options, array( 'title-tax-' . $t, 'metadesc-tax-' . $t ) );
				}
			}
		}
		return $options;
	}

	/**
	 * Fixes the home url as well as the stylesheet url
	 * Only when using multiple domains or subdomains
	 *
	 * @since 1.6.4
	 *
	 * @param string $url
	 * @param string $path
	 * @return $url
	 */
	public function wpseo_home_url( $url, $path ) {
		if ( empty( $path ) ) {
			$path = ltrim( wp_parse_url( pll_get_requested_url(), PHP_URL_PATH ), '/' );
		}

		if ( 'sitemap_index.xml' === $path || preg_match( '#([^/]+?)-sitemap([0-9]+)?\.xml|([a-z]+)?-?sitemap\.xsl#', $path ) ) {
			$url = PLL()->links_model->switch_language_in_link( $url, PLL()->curlang );
		}

		return $url;
	}

	/**
	 * Get active languages for the sitemaps
	 *
	 * @since 2.0
	 *
	 * @return array list of active language slugs, empty if all languages are active
	 */
	protected function wpseo_get_active_languages() {
		$languages = PLL()->model->get_languages_list();
		if ( wp_list_filter( $languages, array( 'active' => false ) ) ) {
			return wp_list_pluck( wp_list_filter( $languages, array( 'active' => false ), 'NOT' ), 'slug' );
		}
		return array();
	}

	/**
	 * Modifies the sql request for posts sitemaps
	 * Only when using multiple domains or subdomains or if some languages are not active
	 *
	 * @since 1.6.4
	 *
	 * @param string $sql       JOIN clause
	 * @param string $post_type
	 * @return string
	 */
	public function wpseo_posts_join( $sql, $post_type ) {
		return pll_is_translated_post_type( $post_type ) && ( PLL()->options['force_lang'] > 1 || $this->wpseo_get_active_languages() ) ? $sql . PLL()->model->post->join_clause() : $sql;
	}

	/**
	 * Modifies the sql request for posts sitemaps
	 * Only when using multiple domains or subdomains or if some languages are not active
	 *
	 * @since 1.6.4
	 *
	 * @param string $sql       WHERE clause
	 * @param string $post_type
	 * @return string
	 */
	public function wpseo_posts_where( $sql, $post_type ) {
		if ( pll_is_translated_post_type( $post_type ) ) {
			if ( PLL()->options['force_lang'] > 1 ) {
				return $sql . PLL()->model->post->where_clause( PLL()->curlang );
			}

			if ( $languages = $this->wpseo_get_active_languages() ) {
				return $sql . PLL()->model->post->where_clause( $languages );
			}
		}
		return $sql;
	}

	/**
	 * Removes the language filter (and remove inactive languages) for the taxonomy sitemaps
	 * Only when the language is set from the content or directory name
	 *
	 * @since 1.0.3
	 *
	 * @param array $args get_terms arguments
	 * @return array modified list of arguments
	 */
	public function wpseo_remove_terms_filter( $args ) {
		if ( isset( $GLOBALS['wp_query']->query['sitemap'] ) ) {
			$args['lang'] = implode( ',', $this->wpseo_get_active_languages() );
		}
		return $args;
	}

	/**
	 * Add filters before the sitemap is evaluated and outputed
	 *
	 * @since 2.6
	 */
	public function before_sitemap() {
		$type = get_query_var( 'sitemap' );

		// Add the post post type archives in all languages to the sitemap
		// Add the homepages for all languages to the sitemap when the front page displays posts
		if ( $type && pll_is_translated_post_type( $type ) && ( 'post' !== $type || ( PLL()->options['force_lang'] < 2 && ! get_option( 'page_on_front' ) ) ) ) {
			add_filter( "wpseo_sitemap_{$type}_content", array( $this, 'add_post_type_archive' ) );
		}
	}

	/**
	 * Adds the home and post type archives urls for all (active) languages to the sitemap
	 *
	 * @since 2.6
	 *
	 * @param string $str additional urls to sitemap post
	 * @return string
	 */
	public function add_post_type_archive( $str ) {
		global $wpseo_sitemaps;

		$post_type = substr( substr( current_filter(), 14 ), 0, -8 );

		$languages = wp_list_filter( PLL()->model->get_languages_list(), array( 'active' => false ), 'NOT' );

		if ( 'post' !== $post_type ) {
			// The post type archive in the current language is already added by WPSEO
			$languages = wp_list_filter( PLL()->model->get_languages_list(), array( 'slug' => pll_current_language() ), 'NOT' );
		} elseif ( ! empty( PLL()->options['hide_default'] ) ) {
			// The home url is of course already added by WPSEO
			$languages = wp_list_filter( PLL()->model->get_languages_list(), array( 'slug' => pll_default_language() ), 'NOT' );
		}

		foreach ( $languages as $lang ) {
			$link = 'post' === $post_type ? pll_home_url( $lang->slug ) : PLL()->links_model->switch_language_in_link( get_post_type_archive_link( $post_type ), $lang );
			$str .= $wpseo_sitemaps->renderer->sitemap_url(
				array(
					'loc' => $link,
					'mod' => WPSEO_Sitemaps::get_last_modified_gmt( $post_type ),
					'pri' => 1,
					'chf' => 'daily',
				)
			);
		}

		return $str;
	}

	/**
	 * Filters home url
	 *
	 * @since 1.1.2
	 *
	 * @param array $arr
	 * @return array
	 */
	public function wpseo_home_url_white_list( $arr ) {
		return array_merge( $arr, array( array( 'file' => 'wordpress-seo' ) ) );
	}

	/**
	 * Adds opengraph support for translations
	 *
	 * @since 1.6
	 */
	public function wpseo_ogp() {
		global $wpseo_og;

		// WPSEO already deals with the locale
		if ( did_action( 'pll_init' ) && method_exists( $wpseo_og, 'og_tag' ) ) {
			$alternates = array();

			foreach ( PLL()->model->get_languages_list() as $language ) {
				if ( PLL()->curlang->slug !== $language->slug && PLL()->links->get_translation_url( $language ) && isset( $language->facebook ) ) {
					$alternates[] = $language->facebook;
				}
			}

			// There is a risk that 2 languages have the same Facebook locale. So let's make sure to output each locale only once.
			$alternates = array_unique( $alternates );

			foreach ( $alternates as $lang ) {
				$wpseo_og->og_tag( 'og:locale:alternate', $lang );
			}
		}
	}

	/**
	 * Fixes the canonical front page url as unlike WP, WPSEO does not add a trailing slash to the canonical front page url
	 *
	 * @since 1.7.10
	 *
	 * @param string $url
	 * @return $url
	 */
	public function wpseo_canonical( $url ) {
		return is_front_page( $url ) && get_option( 'permalink_structure' ) ? trailingslashit( $url ) : $url;
	}

	/**
	 * Helper function to register strings for custom post types and custom taxonomies titles and meta descriptions
	 *
	 * @since 2.1.6
	 *
	 * @param array $options
	 * @param array $titles
	 * @return array
	 */
	protected function _wpseo_register_strings( $options, $titles ) {
		foreach ( $titles as $title ) {
			if ( ! empty( $options[ $title ] ) ) {
				pll_register_string( $title, $options[ $title ], 'wordpress-seo' );
			}
		}
		return $options;
	}

	/**
	 * Synchronize the primary term
	 *
	 * @since 2.3.3
	 *
	 * @param array $keys List of custom fields names.
	 * @return array
	 */
	public function copy_post_metas( $keys ) {
		$taxonomies = get_taxonomies(
			array(
				'hierarchical' => true,
				'public'       => true,
			)
		);

		foreach ( $taxonomies as $taxonomy ) {
			$keys[] = '_yoast_wpseo_primary_' . $taxonomy;
		}

		return $keys;
	}

	/**
	 * Translate the primary term during the synchronization process
	 *
	 * @since 2.3.3
	 *
	 * @param int    $value Meta value.
	 * @param string $key   Meta key.
	 * @param string $lang  Language of target.
	 * @return int
	 */
	public function translate_post_meta( $value, $key, $lang ) {
		if ( false !== strpos( $key, '_yoast_wpseo_primary_' ) ) {
			$value = pll_get_term( $value, $lang );
		}
		return $value;
	}
}
