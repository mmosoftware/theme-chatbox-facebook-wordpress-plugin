<?php
/*
Plugin Name: Chatbox Messenger fb
Description: Thêm khung chatbox Messenger fb vào websitte.
Version: 1.0
Author: MMO SOFTWARE
*/

// Enqueue styles and scripts
function custom_chatbox_enqueue_scripts() {
    wp_enqueue_style('custom-chatbox-style', plugins_url('/css/styles.css', __FILE__));
}
add_action('wp_enqueue_scripts', 'custom_chatbox_enqueue_scripts');

// Add custom chatbox HTML
function custom_chatbox_html() {
    // Get custom fields
    $chatbox_image_url = get_option('chatbox_image_url', '');
    $chatbox_description = get_option('chatbox_description', '');
    $messenger_link = get_option('messenger_link', '');
	$chatbox_title = get_option('chatbox_title', '');
    $html = '<div class="chatboxfb">
                <div class="welcome-page-modal-sheet-content" id="chatBox">
                    <div style="float:right; cursor:pointer;color: #393636;" onclick="toggleChatBox()">X</div>
                    <div class="welcome-page-modal-sheet-header">
                        <img class="welcome-page-modal-sheet-image" src="' . esc_url($chatbox_image_url) . '" alt="">
                        <div class="clearfix"></div>
                    </div>
                    <div class="welcome-page-modal-sheet-title">
                        <span class="welcome-page-modal-sheet-title-text">Chat với ' . esc_html($chatbox_title) . '</span>
                    </div>
                    <div class="welcome-page-modal-sheet-description">
                        <span class="welcome-page-modal-sheet-description-text">' . esc_html($chatbox_description) . '</span>
                    </div>
                    <div class="welcome-page-modal-sheet-action">
                        <button class="welcome-page-modal-sheet-action-button"><a href="' . esc_url($messenger_link) . '" target="_blank">Bắt đầu chat</a></button>
                    </div>
                    <div class="powered-by-text">
                        <span class="powered-by-text-content"><a href="https://mmo.software" target="_blank">Do MMO SOFTWARE cung cấp</a></span>
                        <i class="powered-by-text-icon"></i>
                    </div>
                </div>
                <div class="button-fb" onclick="toggleChatBox()">
                    <div class="icon-fb">
                        <svg width="24" height="24" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M0.75 11.9125C0.75 5.6422 5.66254 1 12 1C18.3375 1 23.25 5.6422 23.25 11.9125C23.25 18.1828 18.3375 22.825 12 22.825C10.8617 22.825 9.76958 22.6746 8.74346 22.3925C8.544 22.3376 8.33188 22.3532 8.1426 22.4368L5.90964 23.4224C5.32554 23.6803 4.66618 23.2648 4.64661 22.6267L4.58535 20.6253C4.57781 20.3789 4.46689 20.1483 4.28312 19.9839C2.09415 18.0264 0.75 15.1923 0.75 11.9125ZM8.54913 9.86084L5.24444 15.1038C4.92731 15.6069 5.54578 16.1739 6.01957 15.8144L9.56934 13.1204C9.80947 12.9381 10.1413 12.9371 10.3824 13.118L13.0109 15.0893C13.7996 15.6809 14.9252 15.4732 15.451 14.6392L18.7556 9.39616C19.0727 8.893 18.4543 8.326 17.9805 8.68555L14.4307 11.3796C14.1906 11.5618 13.8587 11.5628 13.6176 11.3819L10.9892 9.41061C10.2005 8.81909 9.07479 9.02676 8.54913 9.86084Z" fill="white"></path></svg>
                    </div>
                    <div class="text-fb">Hỏi chúng tôi</div>
                </div>
            </div>
            <script>
                // JavaScript để xử lý toggle chat box và lưu trạng thái
                setTimeout(function() {
                    toggleChatBox();
                }, 2000);

                function toggleChatBox() {
                    var chatBox = document.getElementById(\'chatBox\');
                    chatBox.classList.toggle(\'active\');
                }
            </script>';
    
    echo $html;
}
add_action('wp_footer', 'custom_chatbox_html');

// Register custom fields
function custom_chatbox_register_settings() {
    register_setting('custom-chatbox-settings-group', 'chatbox_image_url');
    register_setting('custom-chatbox-settings-group', 'chatbox_description');
    register_setting('custom-chatbox-settings-group', 'messenger_link');
	register_setting('custom-chatbox-settings-group', 'chatbox_title');
}
add_action('admin_init', 'custom_chatbox_register_settings');

// Add settings page
function custom_chatbox_settings_page() {
    add_options_page('Custom Chatbox Settings', 'Custom Chatbox', 'manage_options', 'custom-chatbox-settings', 'custom_chatbox_settings_page_content');
}
add_action('admin_menu', 'custom_chatbox_settings_page');

// Settings page content
// Settings page content
function custom_chatbox_settings_page_content() {
    ?>
    <div class="wrap">
        <h2>Custom Chatbox Settings</h2>
        <form method="post" action="options.php">
            <?php settings_fields('custom-chatbox-settings-group'); ?>
            <?php do_settings_sections('custom-chatbox-settings-group'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Chatbox Title:</th>
                    <td><input type="text" name="chatbox_title" value="<?php echo esc_attr(get_option('chatbox_title', '')); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Chatbox Image URL:</th>
                    <td><input type="text" name="chatbox_image_url" value="<?php echo esc_attr(get_option('chatbox_image_url', '')); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Chatbox Description:</th>
                    <td><input type="text" name="chatbox_description" value="<?php echo esc_attr(get_option('chatbox_description', '')); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Messenger Link:</th>
                    <td><input type="text" name="messenger_link" value="<?php echo esc_attr(get_option('messenger_link', '')); ?>" /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

