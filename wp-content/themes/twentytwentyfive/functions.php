<?php
/**
 * Twenty Twenty-Five functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Five
 * @since Twenty Twenty-Five 1.0
 */


/**
 * Shortcode: [my_post_comments count="3"]
 * Works inside Query Loop — shows each post’s comments + nested replies.
 */
function my_post_comments_shortcode($atts) {
    global $post, $block;

    $atts = shortcode_atts(['count' => 5], $atts, 'my_post_comments');

    $post_id = $block->context['postId'] ?? $post->ID ?? null;
    if (!$post_id) return '';

    $comments = get_comments([
        'post_id' => $post_id,
        'status'  => 'approve',
        'order'   => 'ASC',
    ]);

    if (empty($comments)) return '<p>No comments yet.</p>';

    // 1) build node map
    $nodes = [];
    foreach ($comments as $c) {
        $nodes[ (int)$c->comment_ID ] = [
            'comment' => $c,
            'children' => []
        ];
    }

    // 2) attach children to parents when parent exists in map
    foreach ($nodes as $id => $node) {
        $parent_id = (int)$node['comment']->comment_parent;
        if ($parent_id && isset($nodes[$parent_id])) {
            $nodes[$parent_id]['children'][] = &$nodes[$id];
        }
    }
    unset($node, $id); // clean reference

    // 3) collect top-level roots (parent missing or parent not in fetched set)
    $roots = [];
    foreach ($nodes as $id => $node) {
        $parent_id = (int)$node['comment']->comment_parent;
        if (!$parent_id || !isset($nodes[$parent_id])) {
            $roots[] = &$nodes[$id];
        }
    }

    // recursive renderer that accepts node structure (comment + children)
    $render_node = function($node, $depth = 0) use (&$render_node) {
        $comment = $node['comment'];
        $author = esc_html(get_comment_author($comment));
        $avatar = get_avatar($comment, 48, '', '', ['class' => 'my-comment-avatar-img']);
        $content = wp_kses_post($comment->comment_content); // allow basic HTML if present

        ob_start(); ?>
        <div class="my-comment-row" data-depth="<?php echo (int)$depth; ?>">
            <div class="my-comment-avatar"><?php echo $avatar; ?></div>
            <div class="my-comment-bubble">
                <div class="my-comment-author"><?php echo $author; ?></div>
                <div class="my-comment-text"><?php echo $content; ?></div>
            </div>
        </div>
        <?php
        if (!empty($node['children'])): ?>
            <div class="my-comment-replies">
                <?php foreach ($node['children'] as $childNode) {
                    echo $render_node($childNode, $depth + 1);
                } ?>
            </div>
        <?php endif;

        return ob_get_clean();
    };

    ob_start();
    echo '<div class="my-comments-block">';
    foreach ($roots as $root) {
        echo $render_node($root, 0);
    }
    echo '</div>';

    return ob_get_clean();
}
add_shortcode('my_post_comments', 'my_post_comments_shortcode');




/* Shortcode: [latest_comments count="3" title="Latest Comments"] */

function tt_latest_comments_sc($atts = []) {
    $atts = shortcode_atts([
        'count' => 3,
        'title' => 'Comments',
    ], $atts, 'latest_comments');

    $comments = get_comments([
        'number' => (int) $atts['count'],
        'status' => 'approve',
        'type' => 'comment',
    ]);

    if (empty($comments)) return '';

    ob_start(); ?>
    <div class="simple-comments-block">
        <h3 class="simple-comments-title"><?php echo esc_html($atts['title']); ?></h3>
        <ul class="simple-comments-list">
            <?php foreach ($comments as $comment): ?>
                <li class="simple-comment-item">
                    <a href="<?php echo esc_url(get_comment_link($comment)); ?>" class="simple-comment-link">
                        <?php echo esc_html(wp_trim_words(strip_tags($comment->comment_content), 12, '...')); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('latest_comments', 'tt_latest_comments_sc');


/* Shortcode: [latest_pages count="3" title="Trang mới nhất"] */
function tt_latest_pages_sc($atts = [])
{
    $atts = shortcode_atts([
        'count' => 3,
        'title' => 'Trang mới nhất',
    ], $atts, 'latest_pages');

    $pages = get_pages([
        'sort_column' => 'post_date',
        'sort_order' => 'desc',
        'number' => (int) $atts['count'],
    ]);

    if (!$pages)
        return '';

    ob_start(); ?>
    <div class="latest-pages-block">
        <h3 class="latest-pages-title"><?php echo esc_html($atts['title']); ?></h3>
        <div class="latest-pages-list">
            <?php foreach ($pages as $page):
                $link = get_permalink($page);
                $title = get_the_title($page);
                $img = get_the_post_thumbnail_url($page->ID, 'large');
                $excerpt = wp_trim_words(strip_tags($page->post_content), 25, '...');
                ?>
                <div class="latest-page-item">
                    <?php if ($img): ?>
                        <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr($title); ?>" class="latest-page-thumb">
                    <?php endif; ?>
                    <h4 class="latest-page-name"><?php echo esc_html($title); ?></h4>
                    <p class="latest-page-excerpt"><?php echo esc_html($excerpt); ?></p>
                    <a href="<?php echo esc_url($link); ?>" class="latest-page-link">Xem thêm →</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('latest_pages', 'tt_latest_pages_sc');
add_action('wp_head', function () { ?>
    <style>
        .latest-pages-block {
            background: #fff;
            padding: 30px 40px;
            border-radius: 6px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, .05);
            margin-bottom: 30px;
        }

        .latest-pages-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 20px;
            color: #333;
        }

        .latest-pages-list {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .latest-page-item {
            display: flex;
            flex-direction: column;
            gap: 12px;
            border-bottom: 1px solid #eaeaea;
            padding-bottom: 24px;
        }

        .latest-page-thumb {
            width: 100%;
            height: auto;
            border-radius: 6px;
            object-fit: cover;
        }

        .latest-page-name {
            font-size: 18px;
            font-weight: 600;
            color: #2b6cb0;
            margin: 0;
        }

        .latest-page-excerpt {
            font-size: 15px;
            color: #555;
            line-height: 1.6;
            margin: 0;
        }

        .latest-page-link {
            color: #1a5fd8;
            text-decoration: none;
            font-weight: 600;
        }

        .latest-page-link:hover {
            text-decoration: underline;
        }
    </style>
<?php });


/* Shortcode: [latest_timeline count="3" title="Latest News"]
   - count: số bài (mặc định 3)
   - title: tiêu đề (mặc định "Latest News")
*/
function tt_latest_timeline_sc($atts = [])
{
    $atts = shortcode_atts([
        'count' => 3,
        'title' => 'Latest News',
    ], $atts, 'latest_timeline');

    $posts = get_posts([
        'numberposts' => (int) $atts['count'],
        'post_status' => 'publish',
    ]);
    if (!$posts)
        return '';

    ob_start(); ?>
    <div class="latepost-main">
        <div class="timeline-wrapper">
            <h3 class="timeline-title"><?php echo esc_html($atts['title']); ?></h3>
            <ul class="timeline-list">
                <?php foreach ($posts as $p):
                    $link = get_permalink($p);
                    $title = get_the_title($p);
                    $date = get_the_date('j F, Y', $p);
                    $excerpt = wp_trim_words(strip_tags(get_the_excerpt($p) ?: get_the_content(null, false, $p)), 20, '...');
                    ?>
                    <li class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <div class="timeline-header">
                                <a class="timeline-link"
                                    href="<?php echo esc_url($link); ?>"><?php echo esc_html($title); ?></a>
                                <span class="timeline-date"><?php echo esc_html($date); ?></span>
                            </div>
                            <p class="timeline-excerpt"><?php echo esc_html($excerpt); ?></p>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('latest_timeline', 'tt_latest_timeline_sc');

/* CSS cho timeline */
add_action('wp_head', function () { ?>
    <style>
        .latepost-main {
            background: #fff !important;
            padding: 30px 40px !important;
            border-radius: 6px !important;
            box-shadow: 0 2px 6px rgba(0, 0, 0, .05) !important;
        }

        .latepost-main .timeline-title {
            font-size: 24px !important;
            font-weight: 700 !important;
            color: #333 !important;
            margin: 0 0 20px !important;
        }

        .latepost-main .timeline-list {
            position: relative;
            list-style: none;
            margin: 0;
            padding: 0px;
            border-left: 2px solid #cfe8f7;
        }

        .latepost-main .timeline-item {
            position: relative;
            padding: 0 0 28px 25px;
        }

        /* make sure dots line up perfectly */
        .latepost-main .timeline-dot {
            position: absolute !important;
            left: -8px !important;
            top: 6px !important;
            transform: translateY(0) !important;
            /* fine-tune vertical alignment */
            width: 14px !important;
            height: 14px !important;
            background: #fff;
            border: 3px solid #2b6cb0;
            border-radius: 50%;
            box-sizing: border-box;
        }

        .latepost-main .timeline-content {
            margin-left: 0 !important;
            padding-top: 2px !important;
        }

        .latepost-main .timeline-header {
            display: flex !important;
            justify-content: space-between !important;
            align-items: baseline !important;
            gap: 12px !important;
            flex-wrap: wrap !important;
        }

        .latepost-main .timeline-link {
            font-weight: 600;
            color: #2b6cb0;
            text-decoration: none;
            line-height: 1.4;
        }

        .latepost-main .timeline-link:hover {
            color: #1a5fd8;
            text-decoration: underline;
        }

        .latepost-main .timeline-date {
            font-size: 14px;
            color: #1a5fd8;
            white-space: nowrap;
        }

        .latepost-main .timeline-excerpt {
            margin: 6px 0 0;
            font-size: 15px;
            color: #555;
            line-height: 1.6;
        }
    </style>
<?php });

function mytheme_enqueue_custom_scripts()
{
    // Register & enqueue your JS file
    wp_enqueue_script(
        'mytheme-custom-js',
        get_template_directory_uri() . '/custom.js',
        array('jquery'), // dependencies (optional)
        '1.0',
        true // load in footer
    );
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_custom_scripts');


add_theme_support('block-templates');
add_theme_support('block-template-parts');

add_filter('wp_trim_excerpt', function ($text) {
    $max_length = 200;
    if (strlen($text) > $max_length) {
        $text = substr($text, 0, $max_length);
        $text = substr($text, 0, strrpos($text, ' ')) . '...';
    }
    return $text;
});

function ttfive_child_enqueue_styles()
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
}
add_action('wp_enqueue_scripts', 'ttfive_child_enqueue_styles');


function mytheme_register_menus()
{
    register_nav_menus(array(
        'footer-1' => __('Footer Column 1'),
        'footer-2' => __('Footer Column 2'),
        'footer-3' => __('Footer Column 3'),
        'social-menu' => __('Social Media Icons'), // <-- ADD THIS LINE
    ));
}
add_action('init', 'mytheme_register_menus');


function my_theme_enqueue_dosis_font()
{
    // 1. Define the URL for the Dosis font
    // This example requests weights 400 (Regular) and 700 (Bold)
    $fonts_url = 'https://fonts.googleapis.com/css2?family=Dosis:wght@400;700&display=swap';

    // 2. Register the stylesheet
    wp_register_style(
        'my-dosis-font',    // A unique name for your stylesheet
        $fonts_url,         // The Dosis URL
        array(),            // Dependencies
        null                // Version number
    );

    // 3. Enqueue (load) the stylesheet on the front-end
    wp_enqueue_style('my-dosis-font');
}

// 4. Hook the function into the WordPress initialization action
add_action('wp_enqueue_scripts', 'my_theme_enqueue_dosis_font');


function add_bootstrap()
{
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css');
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'add_bootstrap');

function mytheme_enqueue_assets()
{
    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css',
        array(),
        '6.4.2'
    );
    wp_enqueue_style(
        'font-awesome-v4-shims',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/v4-shims.min.css',
        array('font-awesome'),
        '6.4.2'
    );
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_assets');


// Adds theme support for post formats.
if (!function_exists('twentytwentyfive_post_format_setup')):
    /**
     * Adds theme support for post formats.
     *
     * @since Twenty Twenty-Five 1.0
     *
     * @return void
     */
    function twentytwentyfive_post_format_setup()
    {
        add_theme_support('post-formats', array('aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video'));
    }
endif;
add_action('after_setup_theme', 'twentytwentyfive_post_format_setup');

// Enqueues editor-style.css in the editors.
if (!function_exists('twentytwentyfive_editor_style')):
    /**
     * Enqueues editor-style.css in the editors.
     *
     * @since Twenty Twenty-Five 1.0
     *
     * @return void
     */
    function twentytwentyfive_editor_style()
    {
        add_editor_style('assets/css/editor-style.css');
    }
endif;
add_action('after_setup_theme', 'twentytwentyfive_editor_style');

// Enqueues style.css on the front.
if (!function_exists('twentytwentyfive_enqueue_styles')):
    /**
     * Enqueues style.css and custom stylesheets on the front.
     *
     * @since Twenty Twenty-Five 1.0
     *
     * @return void
     */
    function twentytwentyfive_enqueue_styles()
    {
        // 1. Enqueue the main theme style.css
        wp_enqueue_style(
            'twentytwentyfive-style',
            get_parent_theme_file_uri('style.css'),
            array(),
            wp_get_theme()->get('Version')
        );

        // Define the dependency array for all custom styles
        $deps = array('twentytwentyfive-style');
        $style_dir_uri = get_stylesheet_directory_uri();
        $style_dir = get_stylesheet_directory();

        // 2. Enqueue custom styles individually

        // a. Post-related styles
        wp_enqueue_style(
            'my-custom-post-style',
            $style_dir_uri . '/assets/css/post.css',
            $deps,
            filemtime($style_dir . '/assets/css/post.css')
        );

        // b. Header styles
        wp_enqueue_style(
            'my-custom-header-style',
            $style_dir_uri . '/assets/css/header.css',
            $deps,
            filemtime($style_dir . '/assets/css/header.css')
        );

        // c. Footer styles
        wp_enqueue_style(
            'my-custom-footer-style',
            $style_dir_uri . '/assets/css/footer.css',
            $deps,
            filemtime($style_dir . '/assets/css/footer.css')
        );

        // d. Search styles
        wp_enqueue_style(
            'my-custom-search-style',
            $style_dir_uri . '/assets/css/search.css',
            $deps,
            filemtime($style_dir . '/assets/css/search.css')
        );

        wp_enqueue_style(
            'my-custom-postdetail-style',
            $style_dir_uri . '/assets/css/post-detail.css',
            $deps,
            filemtime($style_dir . '/assets/css/post-detail.css')
        );

        wp_enqueue_style(
            'my-custom-categories-style',
            $style_dir_uri . '/assets/css/categories.css',
            $deps,
            filemtime($style_dir . '/assets/css/categories.css')
        );

        wp_enqueue_style(
            'my-custom-archives-style',
            $style_dir_uri . '/assets/css/archives.css',
            $deps,
            filemtime($style_dir . '/assets/css/archives.css')
        );

        wp_enqueue_style(
            'my-custom-comment-search-result-style',
            $style_dir_uri . '/assets/css/comment-search-result.css',
            $deps,
            filemtime($style_dir . '/assets/css/comment-search-result.css')
        );

        wp_enqueue_style(
            'my-custom-comment-index-style',
            $style_dir_uri . '/assets/css/comment-index.css',
            $deps,
            filemtime($style_dir . '/assets/css/comment-search-result.css')
        );
    }

endif;
add_action('wp_enqueue_scripts', 'twentytwentyfive_enqueue_styles');

// Registers custom block styles.
if (!function_exists('twentytwentyfive_block_styles')):
    /**
     * Registers custom block styles.
     *
     * @since Twenty Twenty-Five 1.0
     *
     * @return void
     */
    function twentytwentyfive_block_styles()
    {
        register_block_style(
            'core/list',
            array(
                'name' => 'checkmark-list',
                'label' => __('Checkmark', 'twentytwentyfive'),
                'inline_style' => '
				ul.is-style-checkmark-list {
					list-style-type: "\2713";
				}

				ul.is-style-checkmark-list li {
					padding-inline-start: 1ch;
				}',
            )
        );
    }
endif;
add_action('init', 'twentytwentyfive_block_styles');

// Registers pattern categories.
if (!function_exists('twentytwentyfive_pattern_categories')):
    /**
     * Registers pattern categories.
     *
     * @since Twenty Twenty-Five 1.0
     *
     * @return void
     */
    function twentytwentyfive_pattern_categories()
    {

        register_block_pattern_category(
            'twentytwentyfive_page',
            array(
                'label' => __('Pages', 'twentytwentyfive'),
                'description' => __('A collection of full page layouts.', 'twentytwentyfive'),
            )
        );

        register_block_pattern_category(
            'twentytwentyfive_post-format',
            array(
                'label' => __('Post formats', 'twentytwentyfive'),
                'description' => __('A collection of post format patterns.', 'twentytwentyfive'),
            )
        );
    }
endif;
add_action('init', 'twentytwentyfive_pattern_categories');

// Registers block binding sources.
if (!function_exists('twentytwentyfive_register_block_bindings')):
    /**
     * Registers the post format block binding source.
     *
     * @since Twenty Twenty-Five 1.0
     *
     * @return void
     */
    function twentytwentyfive_register_block_bindings()
    {
        register_block_bindings_source(
            'twentytwentyfive/format',
            array(
                'label' => _x('Post format name', 'Label for the block binding placeholder in the editor', 'twentytwentyfive'),
                'get_value_callback' => 'twentytwentyfive_format_binding',
            )
        );
    }
endif;
add_action('init', 'twentytwentyfive_register_block_bindings');

// Registers block binding callback function for the post format name.
if (!function_exists('twentytwentyfive_format_binding')):
    /**
     * Callback function for the post format name block binding source.
     *
     * @since Twenty Twenty-Five 1.0
     *
     * @return string|void Post format name, or nothing if the format is 'standard'.
     */
    function twentytwentyfive_format_binding()
    {
        $post_format_slug = get_post_format();

        if ($post_format_slug && 'standard' !== $post_format_slug) {
            return get_post_format_string($post_format_slug);
        }
    }
endif;
