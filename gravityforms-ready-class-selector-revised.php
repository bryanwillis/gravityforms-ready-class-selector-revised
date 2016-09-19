<?php

/*
Plugin Name: GravityForms  Ready Class Selector Revised
Plugin URI: https://github.com/bryanwillis/gravityforms-ready-class-selector-revised/
Description: Easily select a CSS "Ready Class" for your fields within Gravity Forms
Version: 2.0
Author: Bryan Willis (originally Brad Vincent)
Author URI: https://github.com/bryanwillis
License: GPL2
*/


// if (class_exists("GFForms")) {
// if (class_exists( 'RGForms' )) {
// if (class_exists("GFCommon")) {
if (function_exists('gravity_form')) {
    add_action('gform_editor_js', 'brw_gf_ready_class_selector_revised_render_editor_js');
}

function brw_gf_ready_class_selector_revised_render_editor_js(){
      $modal_html = "
              <div id='css_ready_modal'>
                <style>#css_ready_selector,a.cssr_acc_link,a.cssr_link{text-decoration:none}#css_ready_selector{display:inline-block}#css_ready_modal h4{margin-bottom:2px}.cssr_accordian{display:-ms-flexbox;display:-webkit-box;display:flex;-ms-flex-direction:row;-webkit-box-orient:horizontal;-webkit-box-direction:normal;flex-direction:row;-ms-flex-wrap:wrap;flex-wrap:wrap;-ms-flex-pack:center;-webkit-box-pack:center;justify-content:center;-ms-flex-line-pack:justify;align-content:space-between;-ms-flex-align:center;-webkit-box-align:center;align-items:center;margin:5px 0}a.cssr_acc_link{font-weight:700;display:block;padding:5px;text-align:left;background:#888;border:1px solid #ddd;color:#fff}a.cssr_link{margin:2px;text-align:center;padding:3px;border:1px solid #aaa;background:#eee;display:inline-block;box-sizing:border-box;-ms-flex-order:0;-webkit-box-ordinal-group:1;order:0;-ms-flex:1 0 auto;-webkit-box-flex:1;flex:1 0 auto;-ms-flex-item-align:stretch;align-self:stretch}a.cssr_link:hover{background:#ddd}ul.cssr_ul{margin:0;padding:0}ul.cssr_ul li{margin:2px;padding:0}</style>              
                <strong>Select a CSS ready class</strong>
                <ul class='cssr_ul'>
                <li>
                  <a class='cssr_acc_link' href='#'>2 Columns</a>
                  <div class='cssr_accordian'>
                    <a class='cssr_link' href='#' rel='gf_left_half' title='gf_left_half'>Left Half</a>
                    <a class='cssr_link' href='#' rel='gf_right_half' title='gf_right_half'>Right Half</a>
                  </div>
                </li>
                <li>
                  <a class='cssr_acc_link' href='#'>3 Columns</a>
                  <div class='cssr_accordian'>
                    <a class='cssr_link' href='#' rel='gf_left_third' title='gf_left_third'>Left Third</a>
                    <a class='cssr_link' href='#' rel='gf_middle_third' title='gf_middle_third'>Middle Third</a>
                    <a class='cssr_link' href='#' rel='gf_right_third' title='gf_right_third'>Right Third</a>
                  </div>
                </li>
                <li>
                  <a class='cssr_acc_link' href='#'>List Layout</a>
                  <div class='cssr_accordian'>                
                    <a class='cssr_link' rel='gf_list_2col' title='gf_list_2col' href='#'>2 Column List</a>
                    <a class='cssr_link' rel='gf_list_3col' title='gf_list_3col' href='#'>3 Column List</a>
                    <a class='cssr_link' rel='gf_list_4col' title='gf_list_4col' href='#'>4 Column List</a>
                    <a class='cssr_link' rel='gf_list_5col' title='gf_list_5col' href='#'>5 Column List</a>
                    <a class='cssr_link' rel='gf_list_inline' title='gf_list_inline' href='#'>Inline List</a>
                  </div>
                </li>
                <li>
                  <a class='cssr_acc_link' href='#'>List Heights</a>
                  <div class='cssr_accordian'>                   
                    <a class='cssr_link' rel='gf_list_height_25' title='gf_list_height_25' href='#'>25px Height</a>
                    <a class='cssr_link' rel='gf_list_height_50' title='gf_list_height_50' href='#'>50px Height</a>
                    <a class='cssr_link' rel='gf_list_height_75' title='gf_list_height_75' href='#'>75px Height</a>
                    <a class='cssr_link' rel='gf_list_height_100' title='gf_list_height_100' href='#'>100px Height</a>
                    <a class='cssr_link' rel='gf_list_height_125' title='gf_list_height_125' href='#'>125px Height</a>
                    <a class='cssr_link' rel='gf_list_height_150' title='gf_list_height_150' href='#'>150px Height</a>
                  </div>
                </li>
                <li>
                  <a class='cssr_acc_link' href='#'>Others</a>
                  <div class='cssr_accordian'>                   
                    <a class='cssr_link' rel='gf_scroll_text' title='gf_scroll_text' href='#'>Scrolling Paragraph Text</a>
                    <a class='cssr_link' rel='gf_hide_ampm' title='gf_hide_ampm' href='#'>Hide Time am/pm</a>
                    <a class='cssr_link' rel='gf_hide_charleft' title='gf_hide_charleft' href='#'>Hide Character Counter</a>
                  </div>
                </li>
              </ul>
			  <p>Click on one or more CSS ready classes to add them.<br /> 
              Double-clicking adds the class and closes this popup.<br />
              For more help with CSS ready classes, refer to <a href='http://www.gravityhelp.com/css-ready-classes-for-gravity-forms/' target='_blank'>this documentation</a>.
			  </p>";
      ?>
        <script>    
          function removeTokenFromInput(input, tokenPos, seperator) {
          	var text = input.val();
          	var tokens = text.split(seperator);
          	var newText = '';
          	for (i = 0; i < tokens.length; i++) {
          		if (tokens[i].replace(' ', '').replace(seperator, '') == '') {
          			continue;
          		}
          		if (i != tokenPos) {
          			newText += (tokens[i].trim() + seperator);
          		}
          	}
          	input.val(fixTokens(newText, seperator));
          }
          function addTokenToInput(input, tokenToAdd, seperator) {
          	var text = input.val().trim();
          	if (text == '') {
          		input.val(tokenToAdd);
          	} else {
          		if (!tokenExists(input, tokenToAdd, seperator)) {
          			input.val(fixTokens(text + seperator + tokenToAdd, seperator));
          		}
          	}
          }
          function fixTokens(tokens, seperator) {
          	var text = tokens.trim();
          	var tokens = text.split(seperator);
          	var newTokens = '';
          	for (i = 0; i < tokens.length; i++) {
          		var token = tokens[i].trim().replace(seperator, '');
          		if (token == '') {
          			continue;
          		}
          		newTokens += (token + seperator);
          	}
          	return newTokens;
          }
          function tokenExists(input, tokenToCheck, seperator) {
          	var text = input.val().trim();
          	if (text == '') return false;
          	var tokens = text.split(seperator);
          	for (i = 0; i < tokens.length; i++) {
          		var token = tokens[i].trim().replace(seperator, '');
          		if (token == '') {
          			continue;
          		}
          		if (token == tokenToCheck) {
          			return true;
          		}
          	}
          	return false;
          }
          jQuery(document).bind("gform_load_field_settings", function(event, field, form) {
          	if (jQuery("#css_ready_selector").length == 0) {
          		//add some html after the CSS Class Name input
          		var $select_link = jQuery("<a id='css_ready_selector' class='thickbox' href='#TB_inline?width=500&height=550&inlineId=css_ready_modal'><span class='dashicons dashicons-text'></span></a>");
          		var $modal = jQuery("<?php echo preg_replace( '/\s*[\r\n\t]+\s*/', '', $modal_html ); ?>").hide();
          		jQuery(".css_class_setting").append($select_link).append($modal);
          		jQuery(".cssr_accordian").hide();
          		$select_link.click(function(e) {
          			e.preventDefault();
          			var $m = jQuery("#css_ready_modal");
          			$m.find(".cssr_acc_link").unbind("click").click(function(e) {
          				e.preventDefault();
          				jQuery('.cssr_accordian:visible').slideUp();
          				jQuery(this).parent("li:first").find(".cssr_accordian").slideDown();
          			});
          			var $links = $m.find(".cssr_link");
          			$links.unbind("click").click(function(e) {
          				e.preventDefault();
          				var css = jQuery(this).attr("rel");
          				addTokenToInput(jQuery("#field_css_class"), css, ' ');
          				SetFieldProperty('cssClass', jQuery("#field_css_class").val().trim());
          			});
          			$links.unbind("dblclick").dblclick(function(e) {
          				e.preventDefault();
          				var css = jQuery(this).attr("rel");
          				addTokenToInput(jQuery("#field_css_class"), css, ' ');
          				SetFieldProperty('cssClass', jQuery("#field_css_class").val().trim());
          				tb_remove();
          			});
          			tb_show('', this.href, false);
          		});
          	}
          });
        </script>
      <?php
}
