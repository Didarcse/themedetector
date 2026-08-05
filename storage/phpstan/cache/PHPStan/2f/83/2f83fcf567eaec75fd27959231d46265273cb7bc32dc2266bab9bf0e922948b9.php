<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\tests\Unit\PluginDetection
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v1-enums',
   'data' => 
  array (
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\PluginDetection\\WordPress\\RawPluginMetadataTest.php' => 
    array (
      0 => 'b63cdef1862b08dba943837eae0d0dc80b9a004787449ccd5f872fd1d1e6dac2',
      1 => 
      array (
        0 => 'tests\\unit\\plugindetection\\wordpress\\rawpluginmetadatatest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\plugindetection\\wordpress\\test_stores_slug',
        1 => 'tests\\unit\\plugindetection\\wordpress\\test_stores_confidence',
        2 => 'tests\\unit\\plugindetection\\wordpress\\test_stores_extra_metadata',
        3 => 'tests\\unit\\plugindetection\\wordpress\\test_returns_supplied_slug',
        4 => 'tests\\unit\\plugindetection\\wordpress\\test_returns_supplied_confidence',
        5 => 'tests\\unit\\plugindetection\\wordpress\\test_returns_extra_metadata_unchanged',
        6 => 'tests\\unit\\plugindetection\\wordpress\\test_returns_empty_extra_array',
        7 => 'tests\\unit\\plugindetection\\wordpress\\test_multiple_instances_are_independent',
        8 => 'tests\\unit\\plugindetection\\wordpress\\test_is_immutable',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\PluginDetection\\WordPress\\PluginSlugExtractorTest.php' => 
    array (
      0 => 'd1cfb4d4d865a5bbaa65688c78a42d3a963a1c396a4cded264bb44c8c894c4e7',
      1 => 
      array (
        0 => 'tests\\unit\\plugindetection\\wordpress\\pluginslugextractortest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\plugindetection\\wordpress\\extract',
        1 => 'tests\\unit\\plugindetection\\wordpress\\ruleresult',
        2 => 'tests\\unit\\plugindetection\\wordpress\\test_returns_raw_plugin_metadata_when_rule_matches',
        3 => 'tests\\unit\\plugindetection\\wordpress\\test_returns_null_when_rule_does_not_match',
        4 => 'tests\\unit\\plugindetection\\wordpress\\test_returns_null_when_metadata_has_no_plugins_key',
        5 => 'tests\\unit\\plugindetection\\wordpress\\test_returns_null_when_plugins_is_not_an_array',
        6 => 'tests\\unit\\plugindetection\\wordpress\\test_returns_null_when_plugins_array_is_empty',
        7 => 'tests\\unit\\plugindetection\\wordpress\\test_ignores_non_string_plugin_entries',
        8 => 'tests\\unit\\plugindetection\\wordpress\\test_uses_first_detected_slug_exactly_as_supplied',
        9 => 'tests\\unit\\plugindetection\\wordpress\\test_preserves_confidence_score',
        10 => 'tests\\unit\\plugindetection\\wordpress\\test_preserves_metadata_unchanged_in_extra',
        11 => 'tests\\unit\\plugindetection\\wordpress\\test_does_not_modify_supplied_rule_result',
        12 => 'tests\\unit\\plugindetection\\wordpress\\test_extraction_is_deterministic',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\PluginDetection\\WordPress\\PluginMetadataMapperTest.php' => 
    array (
      0 => '1d62e4b8a4eed0ec115c962e8f18299593cd7eec0e245a9b9b86a9730c2f068f',
      1 => 
      array (
        0 => 'tests\\unit\\plugindetection\\wordpress\\pluginmetadatamappertest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\plugindetection\\wordpress\\map',
        1 => 'tests\\unit\\plugindetection\\wordpress\\raw',
        2 => 'tests\\unit\\plugindetection\\wordpress\\test_returns_plugin_metadata_instance',
        3 => 'tests\\unit\\plugindetection\\wordpress\\test_maps_slug_to_plugin_slug',
        4 => 'tests\\unit\\plugindetection\\wordpress\\test_maps_slug_to_plugin_name',
        5 => 'tests\\unit\\plugindetection\\wordpress\\test_preserves_extra_metadata',
        6 => 'tests\\unit\\plugindetection\\wordpress\\test_missing_extra_metadata_becomes_empty_array',
        7 => 'tests\\unit\\plugindetection\\wordpress\\test_empty_slug_maps_to_empty_name_and_null_slug',
        8 => 'tests\\unit\\plugindetection\\wordpress\\test_does_not_modify_raw_plugin_metadata',
        9 => 'tests\\unit\\plugindetection\\wordpress\\test_mapping_is_deterministic',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest.php' => 
    array (
      0 => '055e869abd889b2f652dfee9bd91a3247b2bbf476704ab65cf56a91764c23286',
      1 => 
      array (
        0 => 'tests\\unit\\plugindetection\\wordpress\\wordpressplugindetectorcomponenttest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\plugindetection\\wordpress\\detector',
        1 => 'tests\\unit\\plugindetection\\wordpress\\htmlwithplugins',
        2 => 'tests\\unit\\plugindetection\\wordpress\\contextwithplugins',
        3 => 'tests\\unit\\plugindetection\\wordpress\\context',
        4 => 'tests\\unit\\plugindetection\\wordpress\\contextwithoutplugins',
        5 => 'tests\\unit\\plugindetection\\wordpress\\contextforurl',
        6 => 'tests\\unit\\plugindetection\\wordpress\\test_supports_returns_true_when_plugin_detected',
        7 => 'tests\\unit\\plugindetection\\wordpress\\test_supports_returns_false_when_no_plugin_detected',
        8 => 'tests\\unit\\plugindetection\\wordpress\\test_supports_derives_result_from_plugin_path_rule',
        9 => 'tests\\unit\\plugindetection\\wordpress\\test_supports_consumes_context_html',
        10 => 'tests\\unit\\plugindetection\\wordpress\\test_supports_handles_varying_context_final_urls',
        11 => 'tests\\unit\\plugindetection\\wordpress\\test_detect_returns_successful_result',
        12 => 'tests\\unit\\plugindetection\\wordpress\\test_detect_returns_detected_false_when_no_plugin_detected',
        13 => 'tests\\unit\\plugindetection\\wordpress\\test_detect_returns_plugin_null_when_detection_fails',
        14 => 'tests\\unit\\plugindetection\\wordpress\\test_detect_returns_rule_confidence_unchanged',
        15 => 'tests\\unit\\plugindetection\\wordpress\\test_detect_assembles_normalized_plugin_metadata',
        16 => 'tests\\unit\\plugindetection\\wordpress\\test_detect_reports_single_primary_plugin_for_multiple_references',
        17 => 'tests\\unit\\plugindetection\\wordpress\\test_supports_and_detect_agree',
        18 => 'tests\\unit\\plugindetection\\wordpress\\test_detect_never_modifies_detection_context',
        19 => 'tests\\unit\\plugindetection\\wordpress\\test_detect_produces_deterministic_results',
      ),
      3 => 
      array (
      ),
    ),
  ),
));