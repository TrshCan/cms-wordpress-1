<?php
/**
 * Title: List of posts, 1 column
 * Slug: twentytwentyfive/template-query-loop
 * Categories: query
 * Block Types: core/query
 * Description: A list of posts, 1 column, with featured image and post date.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Five
 * @since Twenty Twenty-Five 1.0
 */

?>
<!-- wp:query {"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true,"taxQuery":null,"parents":[]},"align":"full","layout":{"type":"default"}} -->
<div class="wp-block-query alignfull">
	<!-- wp:post-template {"align":"wide","layout":{"type":"grid","columnCount":1}} -->
	<div class="container my-4">
		<div class="row g-4">
			<div class="col-md-8 mx-auto">
				<div class="card shadow-sm overflow-hidden post-card">

					<div class="row g-0">
						<!-- Left: Featured Image -->
						<div class="col-md-5 img-container">
							<!-- wp:post-featured-image {"isLink":true,"className":"img-fluid h-100 w-100 object-fit-cover"} /-->
						</div>

						<!-- Right: Content -->
						<div class="col-md-7 p-3 d-flex flex-column justify-content-center">

							<div class=" d-flex">
								<div class="col-lg-3 mt-3 border-custom align-self-start text-center">
									<!-- Date Box -->
									<div class="d-flex align-items-center mb-2 mt-2">
										<div class="me-2 post-date-big">
											<!-- wp:post-date {"format":"d","isLink":false,"style":{"typography":{"fontSize":"2rem"}}} /-->
										</div>
										<div class="d-flex flex-column text-muted text-uppercase small">
											<div class="d-flex">
												<p class="me-1 mb-0" style="color: gray;">Tháng</p>
												<!-- wp:post-date {"format":"m", "className":"customM"} /-->
											</div>
											<!-- wp:post-date {"format":"Y"} /-->
										</div>
									</div>
								</div>

								<div class="col-lg-8 ms-3">
									<!-- Title -->
									<h6 class="card-title mb-2">
										<!-- wp:post-title {"isLink":true, "style":{"typography":{"fontSize":"1rem"}}} /-->
									</h6>

									<!-- Categories -->
									<div class="mb-2 text-muted small d-flex">
										<p class="me-2">Categories:</p>
										<!-- wp:post-terms {"term":"category"} /-->
									</div>
								</div>
							</div>

							<!-- Excerpt -->
							<!-- wp:post-excerpt {"style":{"typography":{"fontSize":"0.8rem"}}} /-->
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
	<!-- /wp:post-template -->


	<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
	<div class="wp-block-group"
		style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)">
		<!-- wp:query-no-results -->
		<!-- wp:paragraph -->
		<p><?php echo esc_html_x('Sorry, but nothing was found. Please try a search with different keywords.', 'Message explaining that there are no results returned from a search.', 'twentytwentyfive'); ?>
		</p>
		<!-- /wp:paragraph -->
		<!-- /wp:query-no-results -->
	</div>
	<!-- /wp:group -->
	<!-- wp:group {"align":"wide","layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignwide">
		<!-- wp:query-pagination {"paginationArrow":"arrow","align":"wide","layout":{"type":"flex","justifyContent":"space-between"}} -->
		<!-- wp:query-pagination-previous /-->
		<!-- wp:query-pagination-numbers /-->
		<!-- wp:query-pagination-next /-->
		<!-- /wp:query-pagination -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:query -->