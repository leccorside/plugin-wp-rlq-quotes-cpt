<?php
/**
 * Register Meta Boxes.
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add Meta Boxes.
 */
function rlq_add_meta_boxes()
{
    add_meta_box(
        'rlq_quote_details',
        __('Detalhes do Quote', 'rlq-quotes-cpt'),
        'rlq_quote_details_callback',
        'rlq_quote',
        'normal',
        'high'
    );

    add_meta_box(
        'rlq_quote_ratings',
        __('Avaliações e Métricas', 'rlq-quotes-cpt'),
        'rlq_quote_ratings_callback',
        'rlq_quote',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'rlq_add_meta_boxes');

/**
 * Meta Box Callback: Detalhes do Quote
 */
function rlq_quote_details_callback($post)
{
    wp_nonce_field('rlq_save_quote_data', 'rlq_quote_nonce');

    $values = get_post_custom($post->ID);

    // Recuperar valores
    $logo_id = isset($values['rlq_logo_id']) ? esc_attr($values['rlq_logo_id'][0]) : '';
    $short_desc = isset($values['rlq_short_desc']) ? $values['rlq_short_desc'][0] : '';
    $highlight_phrase = isset($values['rlq_highlight_phrase']) ? $values['rlq_highlight_phrase'][0] : '';
    $age_range = isset($values['rlq_age_range']) ? esc_attr($values['rlq_age_range'][0]) : '';
    $order = isset($values['rlq_order']) ? esc_attr($values['rlq_order'][0]) : '';
    $pros = isset($values['rlq_pros']) ? $values['rlq_pros'][0] : '';
    $cons = isset($values['rlq_cons']) ? $values['rlq_cons'][0] : '';

    // Checkbox Destaque
    $is_featured = isset($values['rlq_is_featured']) && $values['rlq_is_featured'][0] === 'yes' ? 'yes' : 'no';

    // Image Upload
    $logo_url = '';
    if ($logo_id) {
        $logo_img = wp_get_attachment_image_src($logo_id, 'medium');
        $logo_url = $logo_img ? $logo_img[0] : '';
    }

    // Campos Agrupados (Cobertura, Custo, Processo, Suporte)
    $groups = ['coverage', 'cost', 'process', 'support'];
    $group_labels = [
        'coverage' => 'Cobertura',
        'cost' => 'Custo',
        'process' => 'Processo',
        'support' => 'Suporte'
    ];

    ?>
    <div class="rlq-meta-box">
        <!-- Logo -->
        <div class="rlq-field-group">
            <label for="rlq_logo"><strong>
                    <?php _e('Logo da Empresa', 'rlq-quotes-cpt'); ?>
                </strong></label>
            <div class="rlq-image-preview-wrapper">
                <img id="rlq-logo-preview" src="<?php echo esc_url($logo_url); ?>"
                    style="max-width: 150px; display: <?php echo $logo_url ? 'block' : 'none'; ?>;" />
            </div>
            <input type="hidden" name="rlq_logo_id" id="rlq_logo_id" value="<?php echo $logo_id; ?>" />
            <button type="button" class="button rlq-upload-logo-btn">
                <?php _e('Selecionar Logo', 'rlq-quotes-cpt'); ?>
            </button>
            <button type="button" class="button rlq-remove-logo-btn"
                style="display: <?php echo $logo_url ? 'inline-block' : 'none'; ?>;">
                <?php _e('Remover Logo', 'rlq-quotes-cpt'); ?>
            </button>
        </div>

        <!-- Destaque -->
        <div class="rlq-field-group">
            <label for="rlq_is_featured"><strong>
                    <?php _e('Destaque?', 'rlq-quotes-cpt'); ?>
                </strong></label>
            <input type="checkbox" name="rlq_is_featured" id="rlq_is_featured" value="yes" <?php checked($is_featured, 'yes'); ?> />
            <span class="description">
                <?php _e('Marque para exibir este quote como destaque.', 'rlq-quotes-cpt'); ?>
            </span>
        </div>

        <!-- Faixa Etária -->
        <div class="rlq-field-group">
            <label for="rlq_age_range"><strong>
                    <?php _e('Faixa Etária', 'rlq-quotes-cpt'); ?>
                </strong></label>
            <select name="rlq_age_range" id="rlq_age_range">
                <option value="18-34" <?php selected($age_range, '18-34'); ?>>18-34</option>
                <option value="35-44" <?php selected($age_range, '35-44'); ?>>35-44</option>
                <option value="45-54" <?php selected($age_range, '45-54'); ?>>45-54</option>
                <option value="55+" <?php selected($age_range, '55+'); ?>>55+</option>
            </select>
        </div>

        <!-- Ordem -->
        <div class="rlq-field-group">
            <label for="rlq_order"><strong>
                    <?php _e('Ordem (1-10)', 'rlq-quotes-cpt'); ?>
                </strong></label>
            <input type="number" name="rlq_order" id="rlq_order" value="<?php echo $order; ?>" min="1" max="10" />
        </div>

        <!-- Descrição Curta -->
        <div class="rlq-field-group">
            <label><strong>
                    <?php _e('Descrição Curta', 'rlq-quotes-cpt'); ?>
                </strong></label>
            <?php wp_editor($short_desc, 'rlq_short_desc', array('textarea_rows' => 5, 'media_buttons' => false)); ?>
        </div>

        <!-- Frase de Destaque -->
        <div class="rlq-field-group">
            <label><strong>
                    <?php _e('Frase de Destaque', 'rlq-quotes-cpt'); ?>
                </strong></label>
            <?php wp_editor($highlight_phrase, 'rlq_highlight_phrase', array('textarea_rows' => 3, 'media_buttons' => false, 'quicktags' => false)); ?>
        </div>

        <!-- Pontos Positivos -->
        <div class="rlq-field-group half-width">
            <label><strong>
                    <?php _e('Pontos Positivos', 'rlq-quotes-cpt'); ?>
                </strong></label>
            <?php wp_editor($pros, 'rlq_pros', array('textarea_rows' => 6, 'media_buttons' => false, 'teeny' => true)); ?>
        </div>

        <!-- Pontos Negativos -->
        <div class="rlq-field-group half-width">
            <label><strong>
                    <?php _e('Pontos Negativos', 'rlq-quotes-cpt'); ?>
                </strong></label>
            <?php wp_editor($cons, 'rlq_cons', array('textarea_rows' => 6, 'media_buttons' => false, 'teeny' => true)); ?>
        </div>
        <div style="clear:both;"></div>

        <hr>

        <h3>
            <?php _e('Detalhes Específicos', 'rlq-quotes-cpt'); ?>
        </h3>

        <?php foreach ($groups as $group):
            $title_val = isset($values["rlq_{$group}_title"]) ? esc_attr($values["rlq_{$group}_title"][0]) : '';
            $desc_val = isset($values["rlq_{$group}_desc"]) ? $values["rlq_{$group}_desc"][0] : '';
            $rating_val = isset($values["rlq_{$group}_rating"]) ? esc_attr($values["rlq_{$group}_rating"][0]) : '';
            ?>
            <div class="rlq-group-wrapper">
                <h4>
                    <?php echo $group_labels[$group]; ?>
                </h4>
                <div class="rlq-sub-field">
                    <label>
                        <?php _e('Título:', 'rlq-quotes-cpt'); ?>
                    </label>
                    <input type="text" name="rlq_<?php echo $group; ?>_title" value="<?php echo $title_val; ?>"
                        class="widefat" />
                </div>
                <div class="rlq-sub-field">
                    <label>
                        <?php _e('Avaliação (1.0 - 10):', 'rlq-quotes-cpt'); ?>
                    </label>
                    <input type="number" name="rlq_<?php echo $group; ?>_rating" value="<?php echo $rating_val; ?>" step="0.1"
                        min="1" max="10" />
                </div>
                <div class="rlq-sub-field">
                    <label>
                        <?php _e('Descrição:', 'rlq-quotes-cpt'); ?>
                    </label>
                    <?php
                    // Usando um ID único para cada editor
                    wp_editor($desc_val, "rlq_{$group}_desc", array(
                        'textarea_rows' => 4,
                        'media_buttons' => false,
                        'teeny' => true,
                        'quicktags' => false
                    ));
                    ?>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
    <?php
}

/**
 * Meta Box Callback: Avaliações e Métricas (Side)
 */
function rlq_quote_ratings_callback($post)
{
    $values = get_post_custom($post->ID);

    $rating = isset($values['rlq_rating']) ? esc_attr($values['rlq_rating'][0]) : '';
    $reviews = isset($values['rlq_reviews_count']) ? esc_attr($values['rlq_reviews_count'][0]) : '';
    $visitors = isset($values['rlq_visitors_month']) ? esc_attr($values['rlq_visitors_month'][0]) : '';

    ?>
    <div class="rlq-side-fields">
        <!-- Nota -->
        <div class="rlq-field-group">
            <label for="rlq_rating"><strong>
                    <?php _e('Nota Geral (1.0 - 10)', 'rlq-quotes-cpt'); ?>
                </strong></label>
            <input type="number" name="rlq_rating" id="rlq_rating" value="<?php echo $rating; ?>" step="0.1" min="1"
                max="10" style="width: 100%;" />
        </div>

        <!-- Reviews -->
        <div class="rlq-field-group">
            <label for="rlq_reviews_count"><strong>
                    <?php _e('Nº de Reviews', 'rlq-quotes-cpt'); ?>
                </strong></label>
            <input type="number" name="rlq_reviews_count" id="rlq_reviews_count" value="<?php echo $reviews; ?>"
                style="width: 100%;" />
        </div>

        <!-- Visitantes -->
        <div class="rlq-field-group">
            <label for="rlq_visitors_month"><strong>
                    <?php _e('Visitantes no Mês', 'rlq-quotes-cpt'); ?>
                </strong></label>
            <input type="number" name="rlq_visitors_month" id="rlq_visitors_month" value="<?php echo $visitors; ?>"
                style="width: 100%;" />
        </div>
    </div>
    <?php
}

/**
 * Save Meta Box Data.
 */
function rlq_save_quote_meta($post_id)
{
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;
    if (!isset($_POST['rlq_quote_nonce']) || !wp_verify_nonce($_POST['rlq_quote_nonce'], 'rlq_save_quote_data'))
        return;
    if (!current_user_can('edit_post', $post_id))
        return;

    // Campos simples
    $fields = [
        'rlq_logo_id',
        'rlq_age_range',
        'rlq_order',
        'rlq_is_featured',
        'rlq_rating',
        'rlq_reviews_count',
        'rlq_visitors_month'
    ];

    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
        } else {
            // Checkboxes não enviados devem ser deletados ou setados como 'no'
            if ($field === 'rlq_is_featured') {
                update_post_meta($post_id, $field, 'no');
            } else {
                delete_post_meta($post_id, $field);
            }
        }
    }

    // Campos de Editor (HTML)
    $editor_fields = [
        'rlq_short_desc',
        'rlq_highlight_phrase',
        'rlq_pros',
        'rlq_cons',
        'rlq_coverage_desc',
        'rlq_cost_desc',
        'rlq_process_desc',
        'rlq_support_desc'
    ];

    foreach ($editor_fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $field, wp_kses_post($_POST[$field]));
        }
    }

    // Campos de Sub-grupos (Texto simples)
    $group_text_fields = [
        'rlq_coverage_title',
        'rlq_coverage_rating',
        'rlq_cost_title',
        'rlq_cost_rating',
        'rlq_process_title',
        'rlq_process_rating',
        'rlq_support_title',
        'rlq_support_rating'
    ];

    foreach ($group_text_fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
        }
    }
}
add_action('save_post', 'rlq_save_quote_meta');
