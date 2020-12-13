<?php

class Idcd_Posts extends \Elementor\Widget_Base {

	public function get_name() {
		return 'idcd-posts';
	}

	public function get_title() {
		return __( 'Posts', 'idcd-elements' );
	}

	public function get_icon() {
		return 'fa fa-code';
	}

	public function get_categories() {
		return [ 'idcd-elements' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'idcd-elements' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$postCategories = [];
		$categories  = get_categories( 'hide_empty=0' );
		if ( $categories ) {
			foreach ( $categories as $category ) {
				$postCategories[ $category->term_id ] = $category->name;
			}
		}
		$this->add_control(
			'category',
			[
				'label' => __( 'Post Category', 'idcd-elements' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'label_block' => true,
				'options' => $postCategories,
			]
		);

		$this->add_control(
			'posts_to_show',
			[
				'label' => __( 'Posts To Show', 'idcd-elements' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 4,
				'options' => [
					'2' => __('2', 'idcd-elements'),
					'3' => __('3', 'idcd-elements'),
					'4' => __('4', 'idcd-elements'),
				],
			]
		);

		$this->add_control(
			'show_shadow',
			[
				'label' => __( 'Show Box Shadow', 'idcd-elements' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'idcd-elements' ),
				'label_off' => __( 'Hide', 'idcd-elements' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings_for_display();

		$category = $settings['category'];
		$postsToShow = $settings['posts_to_show'];
		$showShadow = $settings['show_shadow'];

		$query_args = [
			'post_type' => 'post',
			'posts_per_page' => $postsToShow,
			'orderby' => 'date',
			'order' => 'DESC',
		];

		if ( $category !== '' && $category !== null ) {
			$query_args = wp_parse_args( $query_args, [
				'cat' => $category,
			] );
		}

		$posts = new WP_Query( $query_args );

		if ( $posts->have_posts() ) :
			?>
			<div class="idcd-posts">
				<?php while ( $posts->have_posts() ) : $posts->the_post(); ?>
					<div class="idcd-posts-items">
						<div class="idcd-posts-items-container <?php echo $showShadow === 'yes' ? "idcd-posts-items-shadow" : "" ?>">
							<div class="idcd-posts-items-thumb">
								<?php if ( has_post_thumbnail() ) : ?>
									<a href="<?php echo get_the_permalink(); ?>">
										<img class="idcd-posts-items-img" src="<?php echo get_the_post_thumbnail_url(); ?>" />
									</a>
								<?php endif; ?>
							</div>
							<div class="idcd-posts-items-title">
								<a href="<?php echo get_the_permalink(); ?>">
									<?php the_title(); ?>
								</a>
							</div>
							<div class="idcd-posts-items-date">
								<?php the_date(); ?>
							</div>
						</div>
					</div>
				<?php endwhile; ?>

				<?php wp_reset_postdata(); ?>
			</div>
			<?php
		endif;
	}

}