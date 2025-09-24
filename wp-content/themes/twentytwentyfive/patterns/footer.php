<?php
/**
 * Title: Footer
 * Slug: twentytwentyfive/footer
 * Categories: footer
 * Block Types: core/template-part/footer
 * Description: Footer columns with logo, title, tagline and links.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Five
 * @since Twenty Twenty-Five 1.0
 */

?>
<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"
	style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--50)">
	<!-- wp:group {"align":"wide","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide">
		<!-- wp:site-logo /-->

		<!-- wp:group {"align":"full","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"top"}} -->
		<div class="wp-block-group alignfull">
			<!-- wp:columns -->
			<div class="wp-block-columns">
				<!-- wp:column {"width":"100%"} -->
				<div class="wp-block-column" style="flex-basis:100%"><!-- wp:site-title {"level":2} /-->

					<!-- wp:site-tagline /-->
				</div>
				<!-- /wp:column -->

				<!-- wp:column {"width":""} -->
				<div class="wp-block-column">
					<!-- wp:spacer {"height":"var:preset|spacing|40","width":"0px"} -->
					<div style="height:var(--wp--preset--spacing--40);width:0px" aria-hidden="true"
						class="wp-block-spacer"></div>
					<!-- /wp:spacer -->
				</div>
				<!-- /wp:column -->
			</div>
			<!-- /wp:columns -->

			<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|80"}},"layout":{"type":"flex","flexWrap":"wrap","verticalAlignment":"top","justifyContent":"space-between"}} -->
			<div class="wp-block-group">
				<!-- wp:navigation {"overlayMenu":"never","layout":{"type":"flex","orientation":"vertical"}} -->
				<!-- wp:navigation-link {"label":"<?php esc_html_e('Blog', 'twentytwentyfive'); ?>","url":"#"} /-->

				<!-- wp:navigation-link {"label":"<?php esc_html_e('About', 'twentytwentyfive'); ?>","url":"#"} /-->

				<!-- wp:navigation-link {"label":"<?php esc_html_e('FAQs', 'twentytwentyfive'); ?>","url":"#"} /-->

				<!-- wp:navigation-link {"label":"<?php esc_html_e('Authors', 'twentytwentyfive'); ?>","url":"#"} /-->
				<!-- /wp:navigation -->

				<!-- wp:navigation {"overlayMenu":"never","layout":{"type":"flex","orientation":"vertical"}} -->
				<!-- wp:navigation-link {"label":"<?php esc_html_e('Events', 'twentytwentyfive'); ?>","url":"#"} /-->

				<!-- wp:navigation-link {"label":"<?php esc_html_e('Shop', 'twentytwentyfive'); ?>","url":"#"} /-->

				<!-- wp:navigation-link {"label":"<?php esc_html_e('Patterns', 'twentytwentyfive'); ?>","url":"#"} /-->

				<!-- wp:navigation-link {"label":"<?php esc_html_e('Themes', 'twentytwentyfive'); ?>","url":"#"} /-->
				<!-- /wp:navigation -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->

		<!-- wp:spacer {"height":"var:preset|spacing|70"} -->
		<div style="height:var(--wp--preset--spacing--70)" aria-hidden="true" class="wp-block-spacer"></div>
		<!-- /wp:spacer -->

		<!-- wp:group {"align":"full","style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
		<div class="wp-block-group alignfull">
			<!-- wp:paragraph {"fontSize":"small"} -->
			<p class="has-small-font-size"><?php esc_html_e('Twenty Twenty-Five', 'twentytwentyfive'); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:paragraph {"fontSize":"small"} -->
			<p class="has-small-font-size">
				<?php
				printf(
					/* translators: Designed with WordPress. %s: WordPress link. */
					esc_html__('Designed with %s', 'twentytwentyfive'),
					'<a href="' . esc_url(__('https://wordpress.org', 'twentytwentyfive')) . '" rel="nofollow">WordPress</a>'
				);
				?>
			</p>
			<!-- /wp:paragraph -->
		</div>


		<!-- Custom Footer -->
		<!-- wp:group {"tagName":"footer","align":"full","className":"bg-dark text-white pt-4","layout":{"inherit":true}} -->
		<section id="footer" class="bg-success text-white py-5">
			<div class="container">
				<div class="row justify-content-center text-center text-sm-start mb-4">
					<!-- Column 1 -->
					<div class="col-12 col-sm-3 mb-3">
						<h5 class="border-start border-3 ps-2">Quick links</h5>
						<ul class="list-unstyled quick-links">
							<li><a href="#" class="text-white" style="text-decoration: none"><i class="fa fa-angle-double-right"></i> Home</a></li>
							<li><a href="#" class="text-white" style="text-decoration: none"><i class="fa fa-angle-double-right"></i> About</a></li>
							<li><a href="#" class="text-white" style="text-decoration: none"><i class="fa fa-angle-double-right"></i> FAQ</a></li>
							<li><a href="#" class="text-white" style="text-decoration: none"><i class="fa fa-angle-double-right"></i> Get Started</a></li>
							<li><a href="#" class="text-white" style="text-decoration: none"><i class="fa fa-angle-double-right"></i> Videos</a></li>
						</ul>
					</div>

					<!-- Column 2 -->
					<div class="col-12 col-sm-3 mb-3">
						<h5 class="border-start border-3 ps-2">Quick links</h5>
						<ul class="list-unstyled quick-links">
							<li><a href="#" class="text-white" style="text-decoration: none"><i class="fa fa-angle-double-right"></i> Home</a></li>
							<li><a href="#" class="text-white" style="text-decoration: none"><i class="fa fa-angle-double-right"></i> About</a></li>
							<li><a href="#" class="text-white" style="text-decoration: none"><i class="fa fa-angle-double-right"></i> FAQ</a></li>
							<li><a href="#" class="text-white" style="text-decoration: none"><i class="fa fa-angle-double-right"></i> Get Started</a></li>
							<li><a href="#" class="text-white" style="text-decoration: none"><i class="fa fa-angle-double-right"></i> Videos</a></li>
						</ul>
					</div>

					<!-- Column 3 -->
					<div class="col-12 col-sm-3 mb-3">
						<h5 class="border-start border-3 ps-2">Quick links</h5>
						<ul class="list-unstyled quick-links text-white">
							<li><a href="#" class="text-white" style="text-decoration: none"><i class="fa fa-angle-double-right"></i> Home</a></li>
							<li><a href="#" class="text-white" style="text-decoration: none"><i class="fa fa-angle-double-right"></i> About</a></li>
							<li><a href="#" class="text-white" style="text-decoration: none"><i class="fa fa-angle-double-right"></i> FAQ</a></li>
							<li><a href="#" class="text-white" style="text-decoration: none"><i class="fa fa-angle-double-right"></i> Get Started</a></li>
							<li><a href="#" class="text-white" style="text-decoration: none"><i class="fa fa-angle-double-right"></i> Imprint</a></li>
						</ul>
					</div>
				</div>


				<div class="bg-success text-white pt-4 pb-3 w-100">
					<div class="container-fluid"> <!-- full width -->

						<!-- Social Icons -->
						<div class="row">
							<div class="col-12 mt-3">
								<ul class="list-inline d-flex justify-content-center mb-3">
									<li class="list-inline-item mx-2">
										<a href="https://www.fiverr.com/share/qb8D02" class="text-white fs-4">
											<i class="fa fa-facebook"></i>
										</a>
									</li>
									<li class="list-inline-item mx-2">
										<a href="https://www.fiverr.com/share/qb8D02" class="text-white fs-4">
											<i class="fa fa-twitter"></i>
										</a>
									</li>
									<li class="list-inline-item mx-2">
										<a href="https://www.fiverr.com/share/qb8D02" class="text-white fs-4">
											<i class="fa fa-instagram"></i>
										</a>
									</li>
									<li class="list-inline-item mx-2">
										<a href="https://www.fiverr.com/share/qb8D02" class="text-white fs-4">
											<i class="fa fa-google-plus"></i>
										</a>
									</li>
									<li class="list-inline-item mx-2">
										<a href="https://www.fiverr.com/share/qb8D02" target="_blank"
											class="text-white fs-4">
											<i class="fa fa-envelope"></i>
										</a>
									</li>
								</ul>
							</div>
						</div>

						<!-- Info Text -->
						<div class="row">
							<div class="col-12 text-center">
								<p>
									<u><a href="https://www.nationaltransaction.com/" class="text-white">National
											Transaction
											Corporation</a></u>
									is a Registered MSP/ISO of Elavon, Inc. Georgia [a wholly owned subsidiary of U.S.
									Bancorp,
									Minneapolis, MN]
								</p>
								<p class="h6">
									©
									<script>document.write(new Date().getUTCFullYear());</script> All rights reserved.
									<a class="text-light fw-bold ms-2" href="https://www.sunlimetech.com"
										target="_blank">Sunlimetech</a>
								</p>
							</div>
						</div>

					</div>
				</div>
			</div>
		</section>



		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->