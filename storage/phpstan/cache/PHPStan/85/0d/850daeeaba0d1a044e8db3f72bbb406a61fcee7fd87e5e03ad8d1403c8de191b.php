<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\tests\Unit\Detection\Webflow
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v1-enums',
   'data' => 
  array (
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\Detection\\Webflow\\AssetPathRuleTest.php' => 
    array (
      0 => '7b8ddd0f24e9044fc4027cde156d4b42d76cb551a1c589c0d40268172dc5c8a8',
      1 => 
      array (
        0 => 'tests\\unit\\detection\\webflow\\assetpathruletest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\detection\\webflow\\createrule',
        1 => 'tests\\unit\\detection\\webflow\\evaluate',
        2 => 'tests\\unit\\detection\\webflow\\test_detects_assets_website_files_host',
        3 => 'tests\\unit\\detection\\webflow\\test_detects_cdn_prod_website_files_host',
        4 => 'tests\\unit\\detection\\webflow\\test_detects_uploads_ssl_webflow_host',
        5 => 'tests\\unit\\detection\\webflow\\test_detects_asset_host_in_link_element',
        6 => 'tests\\unit\\detection\\webflow\\test_detects_asset_host_in_script_element',
        7 => 'tests\\unit\\detection\\webflow\\test_detects_asset_host_in_img_element',
        8 => 'tests\\unit\\detection\\webflow\\test_returns_first_matching_asset_host',
        9 => 'tests\\unit\\detection\\webflow\\test_returns_no_match_when_no_asset_host_exists',
        10 => 'tests\\unit\\detection\\webflow\\test_handles_empty_html',
        11 => 'tests\\unit\\detection\\webflow\\test_handles_malformed_html',
        12 => 'tests\\unit\\detection\\webflow\\test_returns_expected_confidence',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\Detection\\Webflow\\ConfidenceCalculatorTest.php' => 
    array (
      0 => '64402813d0cbd2be62dd0900234791764335359a25085cfbdfba12f0f0a17877',
      1 => 
      array (
        0 => 'tests\\unit\\detection\\webflow\\confidencecalculatortest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\detection\\webflow\\createcalculator',
        1 => 'tests\\unit\\detection\\webflow\\createruleresult',
        2 => 'tests\\unit\\detection\\webflow\\test_returns_zero_for_empty_rule_results',
        3 => 'tests\\unit\\detection\\webflow\\test_ignores_unmatched_rules',
        4 => 'tests\\unit\\detection\\webflow\\test_returns_single_rule_confidence',
        5 => 'tests\\unit\\detection\\webflow\\test_sums_multiple_matched_rules',
        6 => 'tests\\unit\\detection\\webflow\\test_ignores_unmatched_rules_when_mixed',
        7 => 'tests\\unit\\detection\\webflow\\test_caps_confidence_at_one_hundred',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\Detection\\Webflow\\DataAttributesRuleTest.php' => 
    array (
      0 => '79fda57f7f3f6bf1fc66cf5c656c3169ab4f1767ba8013ead0ee8d7cdc2899f7',
      1 => 
      array (
        0 => 'tests\\unit\\detection\\webflow\\dataattributesruletest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\detection\\webflow\\createrule',
        1 => 'tests\\unit\\detection\\webflow\\evaluate',
        2 => 'tests\\unit\\detection\\webflow\\test_detects_data_wf_page_attribute',
        3 => 'tests\\unit\\detection\\webflow\\test_detects_data_wf_site_attribute',
        4 => 'tests\\unit\\detection\\webflow\\test_returns_first_matching_attribute',
        5 => 'tests\\unit\\detection\\webflow\\test_returns_no_match_when_attributes_are_missing',
        6 => 'tests\\unit\\detection\\webflow\\test_handles_empty_html',
        7 => 'tests\\unit\\detection\\webflow\\test_handles_malformed_html',
        8 => 'tests\\unit\\detection\\webflow\\test_returns_expected_confidence',
        9 => 'tests\\unit\\detection\\webflow\\test_returns_attribute_metadata',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\Detection\\Webflow\\GlobalJsRuleTest.php' => 
    array (
      0 => 'ca45010ef6c710b47227ce5c1dfe74f32e329275401ae6c38e00303abcf4e174',
      1 => 
      array (
        0 => 'tests\\unit\\detection\\webflow\\globaljsruletest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\detection\\webflow\\createrule',
        1 => 'tests\\unit\\detection\\webflow\\evaluate',
        2 => 'tests\\unit\\detection\\webflow\\test_detects_webflow_js_file',
        3 => 'tests\\unit\\detection\\webflow\\test_detects_window_webflow',
        4 => 'tests\\unit\\detection\\webflow\\test_detects_webflow_require',
        5 => 'tests\\unit\\detection\\webflow\\test_detects_webflow_push',
        6 => 'tests\\unit\\detection\\webflow\\test_detects_case_insensitively',
        7 => 'tests\\unit\\detection\\webflow\\test_returns_first_matching_fingerprint',
        8 => 'tests\\unit\\detection\\webflow\\test_returns_no_match_when_no_fingerprint_exists',
        9 => 'tests\\unit\\detection\\webflow\\test_handles_empty_html',
        10 => 'tests\\unit\\detection\\webflow\\test_returns_expected_confidence',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\Detection\\Webflow\\MetaGeneratorRuleTest.php' => 
    array (
      0 => '10f85ea324ed007536b21266e81ff24136698fc423a137cd04c7a25ca5d5292b',
      1 => 
      array (
        0 => 'tests\\unit\\detection\\webflow\\metageneratorruletest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\detection\\webflow\\createrule',
        1 => 'tests\\unit\\detection\\webflow\\evaluate',
        2 => 'tests\\unit\\detection\\webflow\\test_detects_webflow_generator',
        3 => 'tests\\unit\\detection\\webflow\\test_detects_generator_case_insensitively',
        4 => 'tests\\unit\\detection\\webflow\\test_ignores_non_webflow_generator',
        5 => 'tests\\unit\\detection\\webflow\\test_returns_no_match_when_generator_is_missing',
        6 => 'tests\\unit\\detection\\webflow\\test_handles_empty_html',
        7 => 'tests\\unit\\detection\\webflow\\test_handles_malformed_html',
        8 => 'tests\\unit\\detection\\webflow\\test_returns_expected_confidence',
        9 => 'tests\\unit\\detection\\webflow\\test_returns_generator_metadata',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\Detection\\Webflow\\WebflowBadgeRuleTest.php' => 
    array (
      0 => '9934596b3a5986d6901af803783fe52fb7ab025c817349ed5218703ced13ebf9',
      1 => 
      array (
        0 => 'tests\\unit\\detection\\webflow\\webflowbadgeruletest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\detection\\webflow\\createrule',
        1 => 'tests\\unit\\detection\\webflow\\evaluate',
        2 => 'tests\\unit\\detection\\webflow\\test_detects_webflow_dot_com_href',
        3 => 'tests\\unit\\detection\\webflow\\test_detects_webflow_badge_class',
        4 => 'tests\\unit\\detection\\webflow\\test_detects_w_webflow_badge_class',
        5 => 'tests\\unit\\detection\\webflow\\test_detects_made_in_webflow_text',
        6 => 'tests\\unit\\detection\\webflow\\test_returns_first_matching_indicator',
        7 => 'tests\\unit\\detection\\webflow\\test_returns_no_match_when_badge_is_missing',
        8 => 'tests\\unit\\detection\\webflow\\test_handles_empty_html',
        9 => 'tests\\unit\\detection\\webflow\\test_handles_malformed_html',
        10 => 'tests\\unit\\detection\\webflow\\test_returns_expected_confidence',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\Detection\\Webflow\\WebflowDetectorTest.php' => 
    array (
      0 => '95cf5def91d85a7f25caa2443004db71dbc6388e89c387a4be1e27ead10e226e',
      1 => 
      array (
        0 => 'tests\\unit\\detection\\webflow\\webflowdetectortest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\detection\\webflow\\createcontext',
        1 => 'tests\\unit\\detection\\webflow\\createdetector',
        2 => 'tests\\unit\\detection\\webflow\\createrule',
        3 => 'tests\\unit\\detection\\webflow\\creatematchedruleresult',
        4 => 'tests\\unit\\detection\\webflow\\createunmatchedruleresult',
        5 => 'tests\\unit\\detection\\webflow\\test_returns_no_detection_when_confidence_is_zero',
        6 => 'tests\\unit\\detection\\webflow\\test_returns_detection_when_confidence_is_positive',
        7 => 'tests\\unit\\detection\\webflow\\test_executes_every_rule',
        8 => 'tests\\unit\\detection\\webflow\\test_passes_all_rule_results_to_confidence_calculator',
        9 => 'tests\\unit\\detection\\webflow\\test_merges_metadata_from_multiple_rules',
        10 => 'tests\\unit\\detection\\webflow\\test_later_metadata_overwrites_previous_values',
        11 => 'tests\\unit\\detection\\webflow\\test_collects_matched_rule_names',
        12 => 'tests\\unit\\detection\\webflow\\test_ignores_unmatched_rules',
        13 => 'tests\\unit\\detection\\webflow\\test_returns_detection_result',
      ),
      3 => 
      array (
      ),
    ),
  ),
));