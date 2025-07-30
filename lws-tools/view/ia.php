
<div class="lws_tk_div_title_plugins">
    <h3 class="lws_tk_title_plugins"> <?php esc_html_e('AI Management', 'lws-tools'); ?></h3>
    <p class="lws_tk_text_base" style="margin-bottom: 0;">
        <?php esc_html_e('Ethan is your own virtual assistant, here to help you out while building your website. Ask him anything you want his help with, from creating a post to troubleshooting issues.', 'lws-tools'); ?>
    </p>
</div>
<div class="lws_tk_tab_line lws_tk_tab_border lws_tk_tab_border_blue">
    <div class="lws_tk_tab" style="width: 100%;">
        <label class="lws_tk_ia_label" for=''>
            <div>
                <span><?php esc_html_e('Activate Ethan, the AI assistant', 'lws-tools'); ?></span>
            </div>
            <label class="mab_mml_ttbt_td_switch">
                <input class="mab_mml_ttbt_input" name="ia_chatbot_state" id="ia_chatbot_state" type="checkbox" <?php echo (get_option('lws_tk_ia_chatbot_state', false) ? '' : 'checked'); ?>>
                <span class="mab_mml_ttbt_td_s_slider round"></span>
            </label>
        </label>
    </div>
</div>

<script>
    document.getElementById('ia_chatbot_state').addEventListener('change', function() {
        var isChecked = this.checked;

        let ajaxRequest = jQuery.ajax({
                url: ajaxurl,
                type: "POST",
                timeout: 120000,
                context: document.body,
                data: {
                    _ajax_nonce: "<?php echo esc_html(wp_create_nonce("ia_chatbot_nonce")); ?>",
                    action: 'update_ia_chatbot_state',
                    state: isChecked ? 1 : 0,
                },

                success: function(data) {
                    if (data === null || typeof data != 'string') {
                        return 0;
                    }

                    try {
                        var returnData = JSON.parse(data);
                    } catch (e) {
                        console.log(e);
                        returnData = {
                            'code': "NOT_JSON",
                            'data': "FAIL"
                        };
                    }

                    switch (returnData['code']) {
                        case 'SUCCESS':
                            callPopup('success', '<?php echo esc_html__('IA Chatbot state updated successfully.', 'lws-tools'); ?>');
                            break;
                        default:
                            callPopup('error', '<?php echo esc_html__('Error updating IA Chatbot state.', 'lws-tools'); ?>');
                            break;
                    }
                },
                error: function(error) {
                    callPopup('error', '<?php echo esc_html__('Unknown error while updating IA Chatbot state.', 'lws-tools'); ?>');
                    console.log(error);
                    return 1;
                }
            });
    });
</script>