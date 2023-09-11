<?php
/*
 Styles and scripts
 */
// The right way for adding styles and scripts to the
if (!function_exists('barber_setup')) {
    function barber_setup()
    {
        // Add Users logo func.
        add_theme_support('custom-logo',
            ['height' => 50,
                'width' => 130,
                'flex-width' => false,
                'flex-height' => false,
                'header-text' => '',
                'unlink-homepage-logo' => false,
            ]);
        //Dynamic title tag for header
        add_theme_support('html5', array(
            'comment-list',
            'comment-form',
            'search-form',
            'gallery',
            'caption',
            'script',
            'style',
        ));
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
    }

    add_action('after_setup_theme', 'barber_setup');

}
add_action('wp_enqueue_scripts', 'barb_scripts');
// add_action('wp_print_styles', 'theme_name_scripts'); // use can use this hook too
function barb_scripts()
{
    wp_enqueue_style('main', get_stylesheet_uri());
    // bootstrap css
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/plugins/bootstrap/css/bootstrap.css', array('main'), null);
    //icofont
    wp_enqueue_style('fontawesome_barb', get_template_directory_uri() . '/plugins/icofont/icofont.css', array('main'), null);
    //animation css
    wp_enqueue_style('animation_barb', get_template_directory_uri() . '/plugins/animate-css/animate.css', array('main'), null);
    //fontawesome
    wp_enqueue_style('icons_barb', get_template_directory_uri() . '/plugins/fontawesome/css/all.css', array('bootstrap'), null);
    wp_enqueue_style('barb-shop-style', get_template_directory_uri() . '/css/style.css', array('icons_barb'), null);
    //Styles END


    //Functions, JS/JQUERY scripts.

    //REGISTER JQUERY
    wp_deregister_script('jquery');
    wp_register_script('jquery', get_template_directory_uri() . '/plugins/jquery/jquery.min.js');
    wp_enqueue_script('jquery');


    //Bootstrap
    wp_enqueue_script('popper', get_template_directory_uri() . '/plugins/bootstrap/js/popper.min.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/plugins/bootstrap/js/bootstrap.min.js', array('jquery'), '1.0.0', true);
    //Wow Animation
    wp_enqueue_script('wow', get_template_directory_uri() . '/plugins/counterup/wow.min.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('wow_easing', get_template_directory_uri() . '/plugins/counterup/jquery.easing.1.3.js', array('jquery'), '1.0.0', true);
    //Counter
    wp_enqueue_script('counter', get_template_directory_uri() . '/plugins/counterup/jquery.waypoints.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('counter_ease', get_template_directory_uri() . '/plugins/counterup/jquery.counterup.min.js', array('jquery'), '1.0.0', true);
    //GOOGLE MAPS
    wp_enqueue_script('google_map', get_template_directory_uri() . '/plugins/google-map/gmap3.min.js', array('jquery'), '1.0.0', true);
//    //Contacts
    wp_enqueue_script('contact', get_template_directory_uri() . '/plugins/form/contact.js', array('jquery'), '1.0.0', true);
}


//menu register function
function barber_menu()
{
    $location = array(
        'header' => __('Header Menu', 'barber'),
        'footer' => __('Footer Menu', 'barber'),
    );
    //menu Display location registration variables which inside $location
    register_nav_menus($location);
}

add_action('init', 'barber_menu');

// https://gist.github.com/aislam23/7be629af6187fa074d23446d48fe0c79
class bootstrap_4_walker_nav_menu extends Walker_Nav_menu
{

    function start_lvl(&$output, $depth = 0, $args = array())
    { // ul
        $indent = str_repeat("\t", $depth); // indents the outputted HTML
        $submenu = ($depth > 0) ? ' sub-menu' : '';
        $output .= "\n$indent<ul class=\"dropdown-menu$submenu depth_$depth\">\n";
    }

    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    { // li a span

        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $li_attributes = '';
        $class_names = $value = '';

        $classes = empty($item->classes) ? array() : (array)$item->classes;

        $classes[] = ($args->walker->has_children) ? 'dropdown' : '';
        $classes[] = ($item->current || $item->current_item_anchestor) ? 'active' : '';
        $classes[] = 'nav-item';
        $classes[] = 'nav-item-' . $item->ID;
        if ($depth && $args->walker->has_children) {
            $classes[] = 'dropdown-menu';
        }

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = ' class="' . esc_attr($class_names) . '"';

        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
        $id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';

        $output .= $indent . '<li ' . $id . $value . $class_names . $li_attributes . '>';

        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

        $attributes .= ($args->walker->has_children) ? ' class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"' : ' class="nav-link"';

        $item_output = $args->before;
        $item_output .= ($depth > 0) ? '<a class="dropdown-item"' . $attributes . '>' : '<a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);


    }

}


// comments Walker


class Bootstrap_Walker_Comment extends Walker
{

    /**
     * What the class handles.
     *
     * @since 2.7.0
     * @var string
     *
     * @see Walker::$tree_type
     */
    public $tree_type = 'comment';

    /**
     * Database fields to use.
     *
     * @since 2.7.0
     * @var string[]
     *
     * @see Walker::$db_fields
     * @todo Decouple this
     */
    public $db_fields = array(
        'parent' => 'comment_parent',
        'id' => 'comment_ID',
    );

    /**
     * Starts the list before the elements are added.
     *
     * @param string $output Used to append additional content (passed by reference).
     * @param int $depth Optional. Depth of the current comment. Default 0.
     * @param array $args Optional. Uses 'style' argument for type of HTML list. Default empty array.
     * @since 2.7.0
     *
     * @see Walker::start_lvl()
     * @global int $comment_depth
     *
     */
    public function start_lvl(&$output, $depth = 0, $args = array())
    {
        $GLOBALS['comment_depth'] = $depth + 1;

        switch ($args['style']) {
            case 'div':
                break;
            case 'ol':
                $output .= '<ol class="children">' . "\n";
                break;
            case 'ul':
            default:
                $output .= '<ul class="children">' . "\n";
                break;
        }
    }

    /**
     * Ends the list of items after the elements are added.
     *
     * @param string $output Used to append additional content (passed by reference).
     * @param int $depth Optional. Depth of the current comment. Default 0.
     * @param array $args Optional. Will only append content if style argument value is 'ol' or 'ul'.
     *                       Default empty array.
     * @since 2.7.0
     *
     * @see Walker::end_lvl()
     * @global int $comment_depth
     *
     */
    public function end_lvl(&$output, $depth = 0, $args = array())
    {
        $GLOBALS['comment_depth'] = $depth + 1;

        switch ($args['style']) {
            case 'div':
                break;
            case 'ol':
                $output .= "</ol><!-- .children -->\n";
                break;
            case 'ul':
            default:
                $output .= "</ul><!-- .children -->\n";
                break;
        }
    }

    /**
     * Traverses elements to create list from elements.
     *
     * This function is designed to enhance Walker::display_element() to
     * display children of higher nesting levels than selected inline on
     * the highest depth level displayed. This prevents them being orphaned
     * at the end of the comment list.
     *
     * Example: max_depth = 2, with 5 levels of nested content.
     *     1
     *      1.1
     *        1.1.1
     *        1.1.1.1
     *        1.1.1.1.1
     *        1.1.2
     *        1.1.2.1
     *     2
     *      2.2
     *
     * @param WP_Comment $element Comment data object.
     * @param array $children_elements List of elements to continue traversing. Passed by reference.
     * @param int $max_depth Max depth to traverse.
     * @param int $depth Depth of the current element.
     * @param array $args An array of arguments.
     * @param string $output Used to append additional content. Passed by reference.
     * @since 2.7.0
     *
     * @see Walker::display_element()
     * @see wp_list_comments()
     *
     */
    public function display_element($element, &$children_elements, $max_depth, $depth, $args, &$output)
    {
        if (!$element) {
            return;
        }

        $id_field = $this->db_fields['id'];
        $id = $element->$id_field;

        parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);

        /*
         * If at the max depth, and the current element still has children, loop over those
         * and display them at this level. This is to prevent them being orphaned to the end
         * of the list.
         */
        if ($max_depth <= $depth + 1 && isset($children_elements[$id])) {
            foreach ($children_elements[$id] as $child) {
                $this->display_element($child, $children_elements, $max_depth, $depth, $args, $output);
            }

            unset($children_elements[$id]);
        }

    }

    /**
     * Starts the element output.
     *
     * @param string $output Used to append additional content. Passed by reference.
     * @param WP_Comment $data_object Comment data object.
     * @param int $depth Optional. Depth of the current comment in reference to parents. Default 0.
     * @param array $args Optional. An array of arguments. Default empty array.
     * @param int $current_object_id Optional. ID of the current comment. Default 0.
     * @since 2.7.0
     * @since 5.9.0 Renamed `$comment` to `$data_object` and `$id` to `$current_object_id`
     *              to match parent class for PHP 8 named parameter support.
     *
     * @see Walker::start_el()
     * @see wp_list_comments()
     * @global int $comment_depth
     * @global WP_Comment $comment Global comment object.
     *
     */
    public function start_el(&$output, $data_object, $depth = 0, $args = array(), $current_object_id = 0)
    {
        // Restores the more descriptive, specific name for use within this method.
        $comment = $data_object;

        $depth++;
        $GLOBALS['comment_depth'] = $depth;
        $GLOBALS['comment'] = $comment;

        if (!empty($args['callback'])) {
            ob_start();
            call_user_func($args['callback'], $comment, $args, $depth);
            $output .= ob_get_clean();
            return;
        }

        if ('comment' === $comment->comment_type) {
            add_filter('comment_text', array($this, 'filter_comment_text'), 40, 2);
        }

        if (('pingback' === $comment->comment_type || 'trackback' === $comment->comment_type) && $args['short_ping']) {
            ob_start();
            $this->ping($comment, $depth, $args);
            $output .= ob_get_clean();
        } elseif ('html5' === $args['format']) {
            ob_start();
            $this->html5_comment($comment, $depth, $args);
            $output .= ob_get_clean();
        } else {
            ob_start();
            $this->comment($comment, $depth, $args);
            $output .= ob_get_clean();
        }

        if ('comment' === $comment->comment_type) {
            remove_filter('comment_text', array($this, 'filter_comment_text'), 40);
        }
    }

    /**
     * Ends the element output, if needed.
     *
     * @param string $output Used to append additional content. Passed by reference.
     * @param WP_Comment $data_object Comment data object.
     * @param int $depth Optional. Depth of the current comment. Default 0.
     * @param array $args Optional. An array of arguments. Default empty array.
     * @since 2.7.0
     * @since 5.9.0 Renamed `$comment` to `$data_object` to match parent class for PHP 8 named parameter support.
     *
     * @see Walker::end_el()
     * @see wp_list_comments()
     *
     */
    public function end_el(&$output, $data_object, $depth = 0, $args = array())
    {
        if (!empty($args['end-callback'])) {
            ob_start();
            call_user_func(
                $args['end-callback'],
                $data_object, // The current comment object.
                $args,
                $depth
            );
            $output .= ob_get_clean();
            return;
        }
        if ('div' === $args['style']) {
            $output .= "</div><!-- #comment-## -->\n";
        } else {
            $output .= "</li><!-- #comment-## -->\n";
        }
    }

    /**
     * Outputs a pingback comment.
     *
     * @param WP_Comment $comment The comment object.
     * @param int $depth Depth of the current comment.
     * @param array $args An array of arguments.
     * @see wp_list_comments()
     *
     * @since 3.6.0
     *
     */
    protected function ping($comment, $depth, $args)
    {
        $tag = ('div' === $args['style']) ? 'div' : 'li';
        ?>
        <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class('', $comment); ?>>
        <div class="comment-body">
            <?php _e('Pingback:'); ?><?php comment_author_link($comment); ?><?php edit_comment_link(__('Edit'), '<span class="edit-link">', '</span>'); ?>
        </div>
        <?php
    }

    /**
     * Filters the comment text.
     *
     * Removes links from the pending comment's text if the commenter did not consent
     * to the comment cookies.
     *
     * @param string $comment_text Text of the current comment.
     * @param WP_Comment|null $comment The comment object. Null if not found.
     * @return string Filtered text of the current comment.
     * @since 5.4.2
     *
     */
    public function filter_comment_text($comment_text, $comment)
    {
        $commenter = wp_get_current_commenter();
        $show_pending_links = !empty($commenter['comment_author']);

        if ($comment && '0' == $comment->comment_approved && !$show_pending_links) {
            $comment_text = wp_kses($comment_text, array());
        }

        return $comment_text;
    }

    /**
     * Outputs a single comment.
     *
     * @param WP_Comment $comment Comment to display.
     * @param int $depth Depth of the current comment.
     * @param array $args An array of arguments.
     * @see wp_list_comments()
     *
     * @since 3.6.0
     *
     */
    protected function comment($comment, $depth, $args)
    {
        if ('div' === $args['style']) {
            $tag = 'div';
            $add_below = 'comment';
        } else {
            $tag = 'li';
            $add_below = 'div-comment';
        }

        $commenter = wp_get_current_commenter();
        $show_pending_links = isset($commenter['comment_author']) && $commenter['comment_author'];

        if ($commenter['comment_author_email']) {
            $moderation_note = __('Your comment is awaiting moderation.');
        } else {
            $moderation_note = __('Your comment is awaiting moderation. This is a preview; your comment will be visible after it has been approved.');
        }
        ?>
        <<?php echo $tag; ?><?php comment_class($this->has_children ? 'parent' : '', $comment); ?> id="comment-<?php comment_ID(); ?>">
        <?php if ('div' !== $args['style']) : ?>
        <div id="div-comment-<?php comment_ID(); ?>" class="media mb-4">
    <?php endif; ?>
        <div class="comment-author vcard">
            <?php
            if (0 != $args['avatar_size']) {
                echo get_avatar($comment, $args['avatar_size']);
            }
            ?>
            <?php
            $comment_author = get_comment_author_link($comment);

            if ('0' == $comment->comment_approved && !$show_pending_links) {
                $comment_author = get_comment_author($comment);
            }

            printf(
            /* translators: %s: Comment author link. */
                __('%s <span class="says">says:</span>'),
                sprintf('<cite class="fn">%s</cite>', $comment_author)
            );
            ?>
        </div>
        <?php if ('0' == $comment->comment_approved) : ?>
        <em class="comment-awaiting-moderation"><?php echo $moderation_note; ?></em>
        <br/>
    <?php endif; ?>

        <div class="comment-meta commentmetadata">
            <?php
            printf(
                '<a href="%s">%s</a>',
                esc_url(get_comment_link($comment, $args)),
                sprintf(
                /* translators: 1: Comment date, 2: Comment time. */
                    __('%1$s at %2$s'),
                    get_comment_date('', $comment),
                    get_comment_time()
                )
            );

            edit_comment_link(__('(Edit)'), ' &nbsp;&nbsp;', '');
            ?>
        </div>

        <?php
        comment_text(
            $comment,
            array_merge(
                $args,
                array(
                    'add_below' => $add_below,
                    'depth' => $depth,
                    'max_depth' => $args['max_depth'],
                )
            )
        );
        ?>

        <?php
        comment_reply_link(
            array_merge(
                $args,
                array(
                    'add_below' => $add_below,
                    'depth' => $depth,
                    'max_depth' => $args['max_depth'],
                    'before' => '<div class="reply">',
                    'after' => '</div>',
                )
            )
        );
        ?>

        <?php if ('div' !== $args['style']) : ?>
        </div>
    <?php endif; ?>
        <?php
    }

    /**
     * Outputs a comment in the HTML5 format.
     *
     * @param WP_Comment $comment Comment to display.
     * @param int $depth Depth of the current comment.
     * @param array $args An array of arguments.
     * @see wp_list_comments()
     *
     * @since 3.6.0
     *
     */
    protected function html5_comment($comment, $depth, $args)
    {
        $tag = ('div' === $args['style']) ? 'div' : 'li';

        $commenter = wp_get_current_commenter();
        $show_pending_links = !empty($commenter['comment_author']);

        if ($commenter['comment_author_email']) {
            $moderation_note = __('Your comment is awaiting moderation.');
        } else {
            $moderation_note = __('Your comment is awaiting moderation. This is a preview; your comment will be visible after it has been approved.');
        }
        ?>
        <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class($this->has_children ? 'parent' : '', $comment); ?>>
        <article id="div-comment-<?php comment_ID(); ?>" class="media mb-4">
            <?php
            if (0 != $args['avatar_size']) {
                echo get_avatar($comment, $args['avatar_size'], 'gravatar_default', '', array('class' => 'img-fluid d-flex mr-4 rounded'));
            }
            ?>
            <footer class="comment-meta">

                <?php
                $comment_author = get_comment_author_link($comment);

                if ('0' == $comment->comment_approved && !$show_pending_links) {
                    $comment_author = get_comment_author($comment);
                }

                printf(
                /* translators: %s: Comment author link. */
                    sprintf('<h5>%s</h5>', $comment_author),
                );
                ?>


                <div class="comment-metadata">
                    <?php
                    printf(
                        '<a href="%s" class="text-muted"><time datetime="%s">%s</time></a>',
                        esc_url(get_comment_link($comment, $args)),
                        get_comment_time(''),
                        sprintf(
                        /* translators: 1: Comment date, 2: Comment time. */
                            __('%1$s at %2$s'),
                            get_comment_date('j F Y', $comment),
                            get_comment_time()
                        )
                    );

                    edit_comment_link(__('Edit'), ' <span class="edit-link">', '</span>');
                    ?>
                </div><!-- .comment-metadata -->

                <?php if ('0' == $comment->comment_approved) : ?>
                    <em class="comment-awaiting-moderation"><?php echo $moderation_note; ?></em>
                <?php endif; ?>
                <div class="mt-2">
                    <?php comment_text(); ?>
                </div><!-- .comment-content -->
                <?php
                if ('1' == $comment->comment_approved || $show_pending_links) {
                    comment_reply_link(
                        array_merge(
                            $args,
                            array(
                                'add_below' => 'div-comment',
                                'depth' => $depth,
                                'max_depth' => $args['max_depth'],
                                'before' => '<div class="reply">',
                                'after' => '</div>',
                            )
                        )
                    );
                }
                ?>

            </footer><!-- .comment-meta -->
        </article><!-- .comment-body -->
        <?php
    }
}