<?php

class qa_tag_descriptions_widget {
	
	function allow_template($template)
	{
		return ($template=='tag');
	}

	function allow_region($region)
	{
		return true;
	}
	
	function output_widget($region, $place, $themeobject, $template, $request, $qa_content)
	{
		require_once QA_INCLUDE_DIR.'qa-db-metas.php';
		
		$parts=explode('/', $request);
		$tag=$parts[1];
		
		$description=qa_db_tagmeta_get($tag, 'description');
		$editurlhtml=qa_path_html('tag-edit/'.$tag);
		
		$allowediting=!qa_user_permit_error('plugin_tag_desc_permit_edit');
		
		if (strlen($description)) {
			echo '<SPAN STYLE="font-size:'.(int)qa_opt('plugin_tag_desc_font_size').'px;">';
			echo $description;
			echo '</SPAN>';
			if ($allowediting)
				echo ' - <A HREF="'.$editurlhtml.'">edit</A>';

		} elseif ($allowediting){
			echo '<A HREF="'.$editurlhtml.'">'.qa_lang_html('plugin_tag_desc/create_desc_link').'</A>';
		} else{
			echo '<SPAN STYLE="font-size:'.(int)qa_opt('plugin_tag_desc_font_size').'px;">';
			echo str_replace('[baseurl]',qa_opt('site_url'), str_replace('^', qa_html($tag), qa_lang('plugin_tag_desc/no_desc')));
			echo '</SPAN>';
		}
		if((int)qa_opt('enable_ask_with_tags')){
			echo '<DIV STYLE="font-size:'.(int)qa_opt('plugin_tag_desc_font_size').'px;">';
			echo str_replace('[baseurl]',qa_opt('site_url'), str_replace('^', qa_html($tag), qa_lang('plugin_tag_desc/ask_with_tag')));
			echo '</DIV>';
		}
			//qa_lang_html_sub('plugin_tag_desc/no_desc', qa_html($tag));
	}

	function option_default($option)
	{
		if ($option=='plugin_tag_desc_max_len')
			return 250;
		
		if ($option=='plugin_tag_desc_font_size')
			return 18;
			
		if ($option=='plugin_tag_desc_permit_edit') {
			require_once QA_INCLUDE_DIR.'qa-app-options.php';
			return QA_PERMIT_EXPERTS;
		}

		return null;
	}

	function admin_form(&$qa_content)
	{
		require_once QA_INCLUDE_DIR.'qa-app-admin.php';
		require_once QA_INCLUDE_DIR.'qa-app-options.php';

		$permitoptions=qa_admin_permit_options(QA_PERMIT_USERS, QA_PERMIT_SUPERS, false, false);

		$saved=false;
		
		if (qa_clicked('plugin_tag_desc_save_button')) {
			qa_opt('plugin_tag_desc_max_len', (int)qa_post_text('plugin_tag_desc_ml_field'));
			qa_opt('plugin_tag_desc_font_size', (int)qa_post_text('plugin_tag_desc_fs_field'));
			qa_opt('plugin_tag_desc_permit_edit', (int)qa_post_text('plugin_tag_desc_pe_field'));
			qa_opt('enable_ask_with_tags',(int)qa_post_text('enable_ask_with_tags_cb'));
			$saved=true;
		}
		
		return array(
			'ok' => $saved ? 'Tag descriptions settings saved' : null,
			
			'fields' => array(
				array(
					'label' => 'Maximum length of tooltips:',
					'type' => 'number',
					'value' => (int)qa_opt('plugin_tag_desc_max_len'),
					'suffix' => 'characters',
					'tags' => 'NAME="plugin_tag_desc_ml_field"',
				),

				array(
					'label' => 'Starting font size:',
					'type' => 'number',
					'value' => (int)qa_opt('plugin_tag_desc_font_size'),
					'suffix' => 'pixels',
					'tags' => 'NAME="plugin_tag_desc_fs_field"',
				),

				array(
					'label' => 'Allow editing:',
					'type' => 'select',
					'value' => @$permitoptions[qa_opt('plugin_tag_desc_permit_edit')],
					'options' => $permitoptions,
					'tags' => 'NAME="plugin_tag_desc_pe_field"',
				),

				array(
					'label' => 'Show "Ask with the tag" link. Needs <a href="https://github.com/PublicityPort/q2a-ask-with-tags-list">Ask with tags plugin</a>:',
					'type' => 'checkbox',
					'value' => (int)qa_opt('enable_ask_with_tags'),
					'tags' => 'NAME="enable_ask_with_tags_cb"',
				),
			),
			
			'buttons' => array(
				array(
					'label' => 'Save Changes',
					'tags' => 'NAME="plugin_tag_desc_save_button"',
				),
			),
		);
	}

}
