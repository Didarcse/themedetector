<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\tests
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v1-enums',
   'data' => 
  array (
    'C:\\xampp\\htdocs\\themedetector\\tests\\Integration\\Core\\ApplicationBootstrapTest.php' => 
    array (
      0 => '693f7079218e9b589632774ef727e490e4ecd0efe662528ad423358fa0d3ce9a',
      1 => 
      array (
        0 => 'tests\\integration\\core\\applicationbootstraptest',
      ),
      2 => 
      array (
        0 => 'tests\\integration\\core\\test_boot_registers_container',
        1 => 'tests\\integration\\core\\test_boot_registers_http_client',
        2 => 'tests\\integration\\core\\test_boot_registers_detection_manager',
        3 => 'tests\\integration\\core\\test_boot_registers_detector_registry',
        4 => 'tests\\integration\\core\\test_boot_is_idempotent',
        5 => 'tests\\integration\\core\\test_application_container_is_singleton',
        6 => 'tests\\integration\\core\\test_http_client_is_singleton',
        7 => 'tests\\integration\\core\\test_detection_manager_is_singleton',
        8 => 'tests\\integration\\core\\test_boot_registers_detection_context_factory',
        9 => 'tests\\integration\\core\\test_boot_registers_website_detector',
        10 => 'tests\\integration\\core\\test_detection_context_factory_is_singleton',
        11 => 'tests\\integration\\core\\test_website_detector_is_singleton',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Integration\\Detection\\DetectionManagerIntegrationTest.php' => 
    array (
      0 => 'eccea2ff5f1e709d8e708702c632b7a22bd3554fb24e6ba4170464fd3c3cc4c4',
      1 => 
      array (
        0 => 'tests\\integration\\detection\\detectionmanagerintegrationtest',
      ),
      2 => 
      array (
        0 => 'tests\\integration\\detection\\createcontext',
        1 => 'tests\\integration\\detection\\createmanager',
        2 => 'tests\\integration\\detection\\test_detects_wordpress_fixture',
        3 => 'tests\\integration\\detection\\test_detects_joomla_fixture',
        4 => 'tests\\integration\\detection\\test_detects_drupal_fixture',
        5 => 'tests\\integration\\detection\\test_detects_ghost_fixture',
        6 => 'tests\\integration\\detection\\test_detects_typo3_fixture',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Integration\\Detection\\WebsiteDetectorIntegrationTest.php' => 
    array (
      0 => '5693d5d22e6a3f729f612738146005e0ebe022791ad3eeef2cc9537b9bb432c5',
      1 => 
      array (
        0 => 'tests\\integration\\detection\\fakehttpclient',
        1 => 'tests\\integration\\detection\\websitedetectorintegrationtest',
      ),
      2 => 
      array (
        0 => 'tests\\integration\\detection\\get',
        1 => 'tests\\integration\\detection\\test_detect_returns_detection_result',
        2 => 'tests\\integration\\detection\\test_detect_identifies_wordpress',
        3 => 'tests\\integration\\detection\\test_detect_reports_positive_confidence',
        4 => 'tests\\integration\\detection\\test_detect_reports_detected',
        5 => 'tests\\integration\\detection\\detectwordpress',
        6 => 'tests\\integration\\detection\\createbootedapplication',
        7 => 'tests\\integration\\detection\\createwordpressdetector',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Integration\\ThemeExtraction\\ThemeExtractionIntegrationTest.php' => 
    array (
      0 => 'd2b5f763b801c557186afdc98880d4b674e16c6c44492e92a8eb24142c0d2509',
      1 => 
      array (
        0 => 'tests\\integration\\themeextraction\\themeextractionintegrationtest',
      ),
      2 => 
      array (
        0 => 'tests\\integration\\themeextraction\\context',
        1 => 'tests\\integration\\themeextraction\\contextwithoutthemestylesheet',
        2 => 'tests\\integration\\themeextraction\\extractor',
        3 => 'tests\\integration\\themeextraction\\response',
        4 => 'tests\\integration\\themeextraction\\successfulclient',
        5 => 'tests\\integration\\themeextraction\\test_extracts_wordpress_theme_successfully',
        6 => 'tests\\integration\\themeextraction\\test_returns_failed_result_when_stylesheet_is_missing',
        7 => 'tests\\integration\\themeextraction\\test_returns_failed_result_when_stylesheet_download_fails',
        8 => 'tests\\integration\\themeextraction\\test_pipeline_is_deterministic',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\Core\\ApplicationTest.php' => 
    array (
      0 => 'ea4ee36b457f0fd5b0082267d5ab66a37c0a1ae0e9abc5327f3fbe405d5d958a',
      1 => 
      array (
        0 => 'tests\\unit\\core\\applicationtest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\core\\test_creates_container_on_construction',
        1 => 'tests\\unit\\core\\test_container_returns_same_instance',
        2 => 'tests\\unit\\core\\test_boot_registers_container_service',
        3 => 'tests\\unit\\core\\test_boot_is_idempotent',
        4 => 'tests\\unit\\core\\test_container_can_resolve_itself_after_boot',
        5 => 'tests\\unit\\core\\test_new_application_creates_new_container',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\Core\\ContainerTest.php' => 
    array (
      0 => '47d9aed4a60b2e0d96c1185b877384d518e1775ef6f0b91628d594f2f22661dd',
      1 => 
      array (
        0 => 'tests\\unit\\core\\containertest',
        1 => 'tests\\unit\\core\\dummyservice',
        2 => 'tests\\unit\\core\\anotherdummyservice',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\core\\test_registers_object_instance',
        1 => 'tests\\unit\\core\\test_registers_factory',
        2 => 'tests\\unit\\core\\test_factory_is_lazy',
        3 => 'tests\\unit\\core\\test_factory_executes_only_once',
        4 => 'tests\\unit\\core\\test_returns_same_singleton_instance',
        5 => 'tests\\unit\\core\\test_has_returns_true_for_registered_service',
        6 => 'tests\\unit\\core\\test_has_returns_false_for_unknown_service',
        7 => 'tests\\unit\\core\\test_get_throws_service_not_found_exception',
        8 => 'tests\\unit\\core\\test_factory_receives_container',
        9 => 'tests\\unit\\core\\test_object_registration_is_returned_directly',
        10 => 'tests\\unit\\core\\test_reregistering_service_replaces_previous_instance',
        11 => 'tests\\unit\\core\\test_reregistering_factory_discards_cached_instance',
        12 => 'tests\\unit\\core\\test_multiple_services_can_be_registered',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\Detection\\Core\\DetectionPipelineTest.php' => 
    array (
      0 => 'b0fe3a30f1363025638374c3c764b9f7debc8209fd217741fc97225046f6ca6c',
      1 => 
      array (
        0 => 'tests\\unit\\detection\\core\\detectionpipelinetest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\detection\\core\\createresult',
        1 => 'tests\\unit\\detection\\core\\createcontext',
        2 => 'tests\\unit\\detection\\core\\createpipeline',
        3 => 'tests\\unit\\detection\\core\\test_returns_empty_report_when_no_detector_matches',
        4 => 'tests\\unit\\detection\\core\\test_returns_primary_detection',
        5 => 'tests\\unit\\detection\\core\\test_sorts_results_by_confidence',
        6 => 'tests\\unit\\detection\\core\\test_merges_metadata',
        7 => 'tests\\unit\\detection\\core\\test_later_metadata_overwrites_previous_values',
        8 => 'tests\\unit\\detection\\core\\test_failed_detections_are_removed',
        9 => 'tests\\unit\\detection\\core\\test_highest_confidence_becomes_primary',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\Detection\\Core\\DetectionReportTest.php' => 
    array (
      0 => '23e5be3f1d4e513461446d42cfd4720910ba83176750fc559fcf0dc7a02a33e8',
      1 => 
      array (
        0 => 'tests\\unit\\detection\\core\\detectionreporttest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\detection\\core\\createresult',
        1 => 'tests\\unit\\detection\\core\\createreport',
        2 => 'tests\\unit\\detection\\core\\test_returns_empty_report',
        3 => 'tests\\unit\\detection\\core\\test_returns_primary_detection',
        4 => 'tests\\unit\\detection\\core\\test_returns_all_results',
        5 => 'tests\\unit\\detection\\core\\test_returns_technologies_in_order',
        6 => 'tests\\unit\\detection\\core\\test_returns_confidence_map',
        7 => 'tests\\unit\\detection\\core\\test_returns_metadata',
        8 => 'tests\\unit\\detection\\core\\test_returns_metadata_value',
        9 => 'tests\\unit\\detection\\core\\test_returns_detection_by_technology',
        10 => 'tests\\unit\\detection\\core\\test_handles_empty_metadata',
        11 => 'tests\\unit\\detection\\core\\test_is_immutable',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\Detection\\DetectionContextFactoryTest.php' => 
    array (
      0 => 'e1b497821e5c9c2071032095e6d3c8bd697e0fd03f0fc32d6f76bbdceabb48c9',
      1 => 
      array (
        0 => 'tests\\unit\\detection\\detectioncontextfactorytest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\detection\\createresponse',
        1 => 'tests\\unit\\detection\\test_creates_detection_context',
        2 => 'tests\\unit\\detection\\test_preserves_original_url',
        3 => 'tests\\unit\\detection\\test_preserves_final_url',
        4 => 'tests\\unit\\detection\\test_preserves_html',
        5 => 'tests\\unit\\detection\\test_preserves_status_code',
        6 => 'tests\\unit\\detection\\test_returns_new_instance_every_time',
        7 => 'tests\\unit\\detection\\test_factory_is_stateless',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\Detection\\DetectionEngineTest.php' => 
    array (
      0 => 'd16b5e9e53f03971505abfb17cd0ee48bc8b1dd874664db9f2decd8b83eb21fc',
      1 => 
      array (
        0 => 'tests\\unit\\detection\\detectionenginetest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\detection\\createcontext',
        1 => 'tests\\unit\\detection\\createresult',
        2 => 'tests\\unit\\detection\\test_executes_all_detectors',
        3 => 'tests\\unit\\detection\\test_preserves_detector_order',
        4 => 'tests\\unit\\detection\\test_returns_list_of_detection_results',
        5 => 'tests\\unit\\detection\\test_handles_empty_registry',
        6 => 'tests\\unit\\detection\\test_includes_failed_detections',
        7 => 'tests\\unit\\detection\\test_propagates_detector_exception',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\Detection\\DetectionManagerTest.php' => 
    array (
      0 => 'afefb5514f43ba4472d68876c101abfbc3237294d0d06601f78a40fef093ad33',
      1 => 
      array (
        0 => 'tests\\unit\\detection\\detectionmanagertest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\detection\\createcontext',
        1 => 'tests\\unit\\detection\\createdetector',
        2 => 'tests\\unit\\detection\\createresult',
        3 => 'tests\\unit\\detection\\test_throws_exception_when_registry_is_empty',
        4 => 'tests\\unit\\detection\\test_returns_single_detector_result',
        5 => 'tests\\unit\\detection\\test_returns_highest_confidence_result',
        6 => 'tests\\unit\\detection\\test_keeps_first_result_when_confidence_is_equal',
        7 => 'tests\\unit\\detection\\test_executes_every_detector_once',
        8 => 'tests\\unit\\detection\\test_passes_context_to_every_detector',
        9 => 'tests\\unit\\detection\\test_returns_exact_detection_result_instance',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\Detection\\DetectorRegistryTest.php' => 
    array (
      0 => '5351cbafc8cb765897b6d07874d09719022098027bb4f9d636b584b1f8b31a42',
      1 => 
      array (
        0 => 'tests\\unit\\detection\\detectorregistrytest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\detection\\createdetector',
        1 => 'tests\\unit\\detection\\test_registry_is_initially_empty',
        2 => 'tests\\unit\\detection\\test_registers_single_detector',
        3 => 'tests\\unit\\detection\\test_registers_multiple_detectors',
        4 => 'tests\\unit\\detection\\test_all_returns_registered_detectors',
        5 => 'tests\\unit\\detection\\test_accepts_generator',
        6 => 'tests\\unit\\detection\\test_count_returns_registered_detector_count',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\Detection\\Drupal\\ApiEndpointRuleTest.php' => 
    array (
      0 => '44425045ae50482517823925f4d4048eaf762338869c8f45330389b630dcbc26',
      1 => 
      array (
        0 => 'tests\\unit\\detection\\drupal\\apiendpointruletest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\detection\\drupal\\createrule',
        1 => 'tests\\unit\\detection\\drupal\\evaluate',
        2 => 'tests\\unit\\detection\\drupal\\test_detects_jsonapi_endpoint',
        3 => 'tests\\unit\\detection\\drupal\\test_detects_entity_endpoint',
        4 => 'tests\\unit\\detection\\drupal\\test_detects_node_endpoint',
        5 => 'tests\\unit\\detection\\drupal\\test_detects_user_login_endpoint',
        6 => 'tests\\unit\\detection\\drupal\\test_detects_case_insensitively',
        7 => 'tests\\unit\\detection\\drupal\\test_returns_first_matching_endpoint',
        8 => 'tests\\unit\\detection\\drupal\\test_returns_no_match_when_no_endpoint_exists',
        9 => 'tests\\unit\\detection\\drupal\\test_handles_empty_html',
        10 => 'tests\\unit\\detection\\drupal\\test_returns_expected_weight',
        11 => 'tests\\unit\\detection\\drupal\\test_returns_api_endpoint_metadata',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\Detection\\Drupal\\AssetPathRuleTest.php' => 
    array (
      0 => '9a2db254e13c2e6e12805de384e960619df779c30775d83c6169436116b61b22',
      1 => 
      array (
        0 => 'tests\\unit\\detection\\drupal\\assetpathruletest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\detection\\drupal\\createrule',
        1 => 'tests\\unit\\detection\\drupal\\evaluate',
        2 => 'tests\\unit\\detection\\drupal\\test_detects_sites_default_files_path',
        3 => 'tests\\unit\\detection\\drupal\\test_detects_core_misc_path',
        4 => 'tests\\unit\\detection\\drupal\\test_detects_core_assets_path',
        5 => 'tests\\unit\\detection\\drupal\\test_detects_modules_custom_path',
        6 => 'tests\\unit\\detection\\drupal\\test_detects_themes_custom_path',
        7 => 'tests\\unit\\detection\\drupal\\test_detects_asset_path_in_link_element',
        8 => 'tests\\unit\\detection\\drupal\\test_detects_asset_path_in_script_element',
        9 => 'tests\\unit\\detection\\drupal\\test_detects_asset_path_in_img_element',
        10 => 'tests\\unit\\detection\\drupal\\test_returns_first_matching_asset_path',
        11 => 'tests\\unit\\detection\\drupal\\test_returns_no_match_when_no_asset_path_exists',
        12 => 'tests\\unit\\detection\\drupal\\test_handles_empty_html',
        13 => 'tests\\unit\\detection\\drupal\\test_handles_malformed_html',
        14 => 'tests\\unit\\detection\\drupal\\test_returns_expected_weight',
        15 => 'tests\\unit\\detection\\drupal\\test_returns_asset_path_metadata',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\Detection\\Drupal\\ConfidenceCalculatorTest.php' => 
    array (
      0 => 'f91a65b842cd217732a5de968e6bac728338fae5c15a834db67b779ea45c4f29',
      1 => 
      array (
        0 => 'tests\\unit\\detection\\drupal\\confidencecalculatortest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\detection\\drupal\\createcalculator',
        1 => 'tests\\unit\\detection\\drupal\\createruleresult',
        2 => 'tests\\unit\\detection\\drupal\\test_returns_zero_for_empty_rule_results',
        3 => 'tests\\unit\\detection\\drupal\\test_ignores_unmatched_rules',
        4 => 'tests\\unit\\detection\\drupal\\test_returns_single_rule_weight',
        5 => 'tests\\unit\\detection\\drupal\\test_sums_multiple_matched_rules',
        6 => 'tests\\unit\\detection\\drupal\\test_ignores_unmatched_rules_when_mixed',
        7 => 'tests\\unit\\detection\\drupal\\test_caps_confidence_at_one_hundred',
        8 => 'tests\\unit\\detection\\drupal\\test_never_returns_negative_confidence',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\Detection\\Drupal\\DrupalDetectorTest.php' => 
    array (
      0 => 'c6207921c761681723391783b7089a289cf215f58d276a666ca41ae927122e89',
      1 => 
      array (
        0 => 'tests\\unit\\detection\\drupal\\drupaldetectortest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\detection\\drupal\\createcontext',
        1 => 'tests\\unit\\detection\\drupal\\createdetector',
        2 => 'tests\\unit\\detection\\drupal\\createrule',
        3 => 'tests\\unit\\detection\\drupal\\creatematchedruleresult',
        4 => 'tests\\unit\\detection\\drupal\\createunmatchedruleresult',
        5 => 'tests\\unit\\detection\\drupal\\test_returns_no_detection_when_confidence_is_zero',
        6 => 'tests\\unit\\detection\\drupal\\test_returns_detection_when_confidence_is_positive',
        7 => 'tests\\unit\\detection\\drupal\\test_executes_every_rule',
        8 => 'tests\\unit\\detection\\drupal\\test_passes_all_rule_results_to_confidence_calculator',
        9 => 'tests\\unit\\detection\\drupal\\test_merges_metadata_from_multiple_rules',
        10 => 'tests\\unit\\detection\\drupal\\test_later_metadata_overwrites_previous_values',
        11 => 'tests\\unit\\detection\\drupal\\test_collects_matched_rule_names',
        12 => 'tests\\unit\\detection\\drupal\\test_ignores_unmatched_rules',
        13 => 'tests\\unit\\detection\\drupal\\test_returns_detection_result',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\Detection\\Drupal\\HtmlSignatureRuleTest.php' => 
    array (
      0 => 'f9fd1c0187fc8a9749b235bd2b6c06a774fe809469892f1e1dc366a773a33e36',
      1 => 
      array (
        0 => 'tests\\unit\\detection\\drupal\\htmlsignatureruletest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\detection\\drupal\\createrule',
        1 => 'tests\\unit\\detection\\drupal\\evaluate',
        2 => 'tests\\unit\\detection\\drupal\\test_detects_data_drupal_selector_signature',
        3 => 'tests\\unit\\detection\\drupal\\test_detects_drupal_settings_json_signature',
        4 => 'tests\\unit\\detection\\drupal\\test_detects_js_drupal_dialog_signature',
        5 => 'tests\\unit\\detection\\drupal\\test_detects_toolbar_bar_signature',
        6 => 'tests\\unit\\detection\\drupal\\test_detects_case_insensitively',
        7 => 'tests\\unit\\detection\\drupal\\test_returns_first_matching_signature',
        8 => 'tests\\unit\\detection\\drupal\\test_returns_no_match_when_no_signature_exists',
        9 => 'tests\\unit\\detection\\drupal\\test_handles_empty_html',
        10 => 'tests\\unit\\detection\\drupal\\test_returns_expected_weight',
        11 => 'tests\\unit\\detection\\drupal\\test_returns_html_signature_metadata',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\Detection\\Drupal\\MetaGeneratorRuleTest.php' => 
    array (
      0 => '7577a9f471bc86fdcda1bdb2d5c590b8c3d7fe88afa2463324a60a231e24519d',
      1 => 
      array (
        0 => 'tests\\unit\\detection\\drupal\\metageneratorruletest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\detection\\drupal\\createrule',
        1 => 'tests\\unit\\detection\\drupal\\evaluate',
        2 => 'tests\\unit\\detection\\drupal\\test_detects_plain_drupal_generator',
        3 => 'tests\\unit\\detection\\drupal\\test_detects_drupal_ten',
        4 => 'tests\\unit\\detection\\drupal\\test_detects_drupal_eleven',
        5 => 'tests\\unit\\detection\\drupal\\test_detects_powered_by_drupal',
        6 => 'tests\\unit\\detection\\drupal\\test_detects_built_with_drupal',
        7 => 'tests\\unit\\detection\\drupal\\test_detects_generator_case_insensitively',
        8 => 'tests\\unit\\detection\\drupal\\test_ignores_non_drupal_generator',
        9 => 'tests\\unit\\detection\\drupal\\test_returns_no_match_when_generator_is_missing',
        10 => 'tests\\unit\\detection\\drupal\\test_handles_empty_html',
        11 => 'tests\\unit\\detection\\drupal\\test_handles_malformed_html',
        12 => 'tests\\unit\\detection\\drupal\\test_returns_expected_weight',
        13 => 'tests\\unit\\detection\\drupal\\test_returns_generator_metadata',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\Detection\\Drupal\\ScriptFingerprintRuleTest.php' => 
    array (
      0 => '1135c73a5e309a54e856a442a3c472dc722efe85274ae0e46192362815c1f193',
      1 => 
      array (
        0 => 'tests\\unit\\detection\\drupal\\scriptfingerprintruletest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\detection\\drupal\\createrule',
        1 => 'tests\\unit\\detection\\drupal\\evaluate',
        2 => 'tests\\unit\\detection\\drupal\\test_detects_drupal_object',
        3 => 'tests\\unit\\detection\\drupal\\test_detects_drupal_settings',
        4 => 'tests\\unit\\detection\\drupal\\test_detects_drupal_behaviors',
        5 => 'tests\\unit\\detection\\drupal\\test_detects_once_function',
        6 => 'tests\\unit\\detection\\drupal\\test_detects_case_insensitively',
        7 => 'tests\\unit\\detection\\drupal\\test_returns_first_matching_fingerprint',
        8 => 'tests\\unit\\detection\\drupal\\test_returns_no_match_when_no_fingerprint_exists',
        9 => 'tests\\unit\\detection\\drupal\\test_handles_empty_html',
        10 => 'tests\\unit\\detection\\drupal\\test_returns_expected_weight',
        11 => 'tests\\unit\\detection\\drupal\\test_returns_js_fingerprint_metadata',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\Detection\\Ghost\\ApiEndpointRuleTest.php' => 
    array (
      0 => '5c556f7b3bc0ae39ccd7ce17c1e2ab505490c7287a55cead235426432f3b2ba2',
      1 => 
      array (
        0 => 'tests\\unit\\detection\\ghost\\apiendpointruletest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\detection\\ghost\\createrule',
        1 => 'tests\\unit\\detection\\ghost\\evaluate',
        2 => 'tests\\unit\\detection\\ghost\\test_detects_ghost_api_endpoint',
        3 => 'tests\\unit\\detection\\ghost\\test_detects_ghost_api_content_endpoint',
        4 => 'tests\\unit\\detection\\ghost\\test_detects_ghost_api_admin_endpoint',
        5 => 'tests\\unit\\detection\\ghost\\test_detects_ghost_directory',
        6 => 'tests\\unit\\detection\\ghost\\test_detects_case_insensitively',
        7 => 'tests\\unit\\detection\\ghost\\test_returns_first_matching_endpoint',
        8 => 'tests\\unit\\detection\\ghost\\test_returns_no_match_when_no_endpoint_exists',
        9 => 'tests\\unit\\detection\\ghost\\test_handles_empty_html',
        10 => 'tests\\unit\\detection\\ghost\\test_returns_expected_weight',
        11 => 'tests\\unit\\detection\\ghost\\test_returns_api_endpoint_metadata',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\Detection\\Ghost\\AssetPathRuleTest.php' => 
    array (
      0 => '793707a47c4c9cb08835b1db10ca82c4f0b0b09a0b79947c5033b361053c7ad5',
      1 => 
      array (
        0 => 'tests\\unit\\detection\\ghost\\assetpathruletest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\detection\\ghost\\createrule',
        1 => 'tests\\unit\\detection\\ghost\\evaluate',
        2 => 'tests\\unit\\detection\\ghost\\test_detects_content_themes_path',
        3 => 'tests\\unit\\detection\\ghost\\test_detects_content_images_path',
        4 => 'tests\\unit\\detection\\ghost\\test_detects_assets_built_path',
        5 => 'tests\\unit\\detection\\ghost\\test_detects_asset_path_in_link_element',
        6 => 'tests\\unit\\detection\\ghost\\test_detects_asset_path_in_script_element',
        7 => 'tests\\unit\\detection\\ghost\\test_detects_asset_path_in_img_element',
        8 => 'tests\\unit\\detection\\ghost\\test_returns_first_matching_asset_path',
        9 => 'tests\\unit\\detection\\ghost\\test_returns_no_match_when_no_asset_path_exists',
        10 => 'tests\\unit\\detection\\ghost\\test_handles_empty_html',
        11 => 'tests\\unit\\detection\\ghost\\test_handles_malformed_html',
        12 => 'tests\\unit\\detection\\ghost\\test_returns_expected_weight',
        13 => 'tests\\unit\\detection\\ghost\\test_returns_asset_path_metadata',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\Detection\\Ghost\\ConfidenceCalculatorTest.php' => 
    array (
      0 => '2c0f39bd79966d7d88c070d1b122041dfbae627f4031c1a03ff248fdd4f9dec1',
      1 => 
      array (
        0 => 'tests\\unit\\detection\\ghost\\confidencecalculatortest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\detection\\ghost\\createcalculator',
        1 => 'tests\\unit\\detection\\ghost\\createruleresult',
        2 => 'tests\\unit\\detection\\ghost\\test_returns_zero_for_empty_rule_results',
        3 => 'tests\\unit\\detection\\ghost\\test_ignores_unmatched_rules',
        4 => 'tests\\unit\\detection\\ghost\\test_returns_single_rule_weight',
        5 => 'tests\\unit\\detection\\ghost\\test_sums_multiple_matched_rules',
        6 => 'tests\\unit\\detection\\ghost\\test_ignores_unmatched_rules_when_mixed',
        7 => 'tests\\unit\\detection\\ghost\\test_caps_confidence_at_one_hundred',
        8 => 'tests\\unit\\detection\\ghost\\test_never_returns_negative_confidence',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\Detection\\Ghost\\GhostDetectorTest.php' => 
    array (
      0 => '6c005b8c798243e0361d729b1eed6a29a7eb45c5910ad62a8f121b0c7d61880e',
      1 => 
      array (
        0 => 'tests\\unit\\detection\\ghost\\ghostdetectortest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\detection\\ghost\\createcontext',
        1 => 'tests\\unit\\detection\\ghost\\createdetector',
        2 => 'tests\\unit\\detection\\ghost\\createrule',
        3 => 'tests\\unit\\detection\\ghost\\creatematchedruleresult',
        4 => 'tests\\unit\\detection\\ghost\\createunmatchedruleresult',
        5 => 'tests\\unit\\detection\\ghost\\test_returns_no_detection_when_confidence_is_zero',
        6 => 'tests\\unit\\detection\\ghost\\test_returns_detection_when_confidence_is_positive',
        7 => 'tests\\unit\\detection\\ghost\\test_executes_every_rule',
        8 => 'tests\\unit\\detection\\ghost\\test_passes_all_rule_results_to_confidence_calculator',
        9 => 'tests\\unit\\detection\\ghost\\test_merges_metadata_from_multiple_rules',
        10 => 'tests\\unit\\detection\\ghost\\test_later_metadata_overwrites_previous_values',
        11 => 'tests\\unit\\detection\\ghost\\test_collects_matched_rule_names',
        12 => 'tests\\unit\\detection\\ghost\\test_ignores_unmatched_rules',
        13 => 'tests\\unit\\detection\\ghost\\test_returns_detection_result',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\Detection\\Ghost\\HtmlSignatureRuleTest.php' => 
    array (
      0 => 'c391aa8b0b2e2154a632f65bc6fcc3d928f5c4d064196c953fd1ae112ed15719',
      1 => 
      array (
        0 => 'tests\\unit\\detection\\ghost\\htmlsignatureruletest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\detection\\ghost\\createrule',
        1 => 'tests\\unit\\detection\\ghost\\evaluate',
        2 => 'tests\\unit\\detection\\ghost\\test_detects_ghost_head_signature',
        3 => 'tests\\unit\\detection\\ghost\\test_detects_kg_card_signature',
        4 => 'tests\\unit\\detection\\ghost\\test_detects_kg_width_wide_signature',
        5 => 'tests\\unit\\detection\\ghost\\test_detects_kg_width_full_signature',
        6 => 'tests\\unit\\detection\\ghost\\test_detects_case_insensitively',
        7 => 'tests\\unit\\detection\\ghost\\test_returns_first_matching_signature',
        8 => 'tests\\unit\\detection\\ghost\\test_returns_no_match_when_no_signature_exists',
        9 => 'tests\\unit\\detection\\ghost\\test_handles_empty_html',
        10 => 'tests\\unit\\detection\\ghost\\test_returns_expected_weight',
        11 => 'tests\\unit\\detection\\ghost\\test_returns_html_signature_metadata',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\Detection\\Ghost\\MetaGeneratorRuleTest.php' => 
    array (
      0 => '82fe614eb6b772fad7665cc1397401e3985ee086ac5ddd47534d469697fdc766',
      1 => 
      array (
        0 => 'tests\\unit\\detection\\ghost\\metageneratorruletest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\detection\\ghost\\createrule',
        1 => 'tests\\unit\\detection\\ghost\\evaluate',
        2 => 'tests\\unit\\detection\\ghost\\test_detects_plain_ghost_generator',
        3 => 'tests\\unit\\detection\\ghost\\test_detects_ghost_five',
        4 => 'tests\\unit\\detection\\ghost\\test_detects_ghost_six',
        5 => 'tests\\unit\\detection\\ghost\\test_detects_powered_by_ghost',
        6 => 'tests\\unit\\detection\\ghost\\test_detects_built_with_ghost',
        7 => 'tests\\unit\\detection\\ghost\\test_detects_generator_case_insensitively',
        8 => 'tests\\unit\\detection\\ghost\\test_ignores_non_ghost_generator',
        9 => 'tests\\unit\\detection\\ghost\\test_returns_no_match_when_generator_is_missing',
        10 => 'tests\\unit\\detection\\ghost\\test_handles_empty_html',
        11 => 'tests\\unit\\detection\\ghost\\test_handles_malformed_html',
        12 => 'tests\\unit\\detection\\ghost\\test_returns_expected_weight',
        13 => 'tests\\unit\\detection\\ghost\\test_returns_generator_metadata',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\Detection\\Ghost\\ScriptFingerprintRuleTest.php' => 
    array (
      0 => 'ebd22138ca686d93eb28c221ea81bc37028cdccce23a59189164e0b6f232cefd',
      1 => 
      array (
        0 => 'tests\\unit\\detection\\ghost\\scriptfingerprintruletest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\detection\\ghost\\createrule',
        1 => 'tests\\unit\\detection\\ghost\\evaluate',
        2 => 'tests\\unit\\detection\\ghost\\test_detects_window_ghost',
        3 => 'tests\\unit\\detection\\ghost\\test_detects_ghost_init',
        4 => 'tests\\unit\\detection\\ghost\\test_detects_ghost_sdk',
        5 => 'tests\\unit\\detection\\ghost\\test_detects_ghost',
        6 => 'tests\\unit\\detection\\ghost\\test_detects_case_insensitively',
        7 => 'tests\\unit\\detection\\ghost\\test_returns_first_matching_fingerprint',
        8 => 'tests\\unit\\detection\\ghost\\test_returns_no_match_when_no_fingerprint_exists',
        9 => 'tests\\unit\\detection\\ghost\\test_handles_empty_html',
        10 => 'tests\\unit\\detection\\ghost\\test_returns_expected_weight',
        11 => 'tests\\unit\\detection\\ghost\\test_returns_js_fingerprint_metadata',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\Detection\\Joomla\\ApiEndpointRuleTest.php' => 
    array (
      0 => '7239f971f75ea4de47f5d28785cbfbd269304f317fe7910e15553bda40df0ff2',
      1 => 
      array (
        0 => 'tests\\unit\\detection\\joomla\\apiendpointruletest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\detection\\joomla\\createrule',
        1 => 'tests\\unit\\detection\\joomla\\evaluate',
        2 => 'tests\\unit\\detection\\joomla\\test_detects_api_index_php',
        3 => 'tests\\unit\\detection\\joomla\\test_detects_com_api_endpoint',
        4 => 'tests\\unit\\detection\\joomla\\test_detects_api_directory',
        5 => 'tests\\unit\\detection\\joomla\\test_detects_case_insensitively',
        6 => 'tests\\unit\\detection\\joomla\\test_returns_first_matching_endpoint',
        7 => 'tests\\unit\\detection\\joomla\\test_returns_no_match_when_no_endpoint_exists',
        8 => 'tests\\unit\\detection\\joomla\\test_handles_empty_html',
        9 => 'tests\\unit\\detection\\joomla\\test_returns_expected_weight',
        10 => 'tests\\unit\\detection\\joomla\\test_returns_api_endpoint_metadata',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\Detection\\Joomla\\AssetPathRuleTest.php' => 
    array (
      0 => '7625f2c27bf5024748bef437ec9a23bc06329200c817ae34c6229b475ffb9d48',
      1 => 
      array (
        0 => 'tests\\unit\\detection\\joomla\\assetpathruletest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\detection\\joomla\\createrule',
        1 => 'tests\\unit\\detection\\joomla\\evaluate',
        2 => 'tests\\unit\\detection\\joomla\\test_detects_media_system_path',
        3 => 'tests\\unit\\detection\\joomla\\test_detects_media_jui_path',
        4 => 'tests\\unit\\detection\\joomla\\test_detects_media_com_path',
        5 => 'tests\\unit\\detection\\joomla\\test_detects_templates_path',
        6 => 'tests\\unit\\detection\\joomla\\test_detects_asset_path_in_link_element',
        7 => 'tests\\unit\\detection\\joomla\\test_detects_asset_path_in_script_element',
        8 => 'tests\\unit\\detection\\joomla\\test_detects_asset_path_in_img_element',
        9 => 'tests\\unit\\detection\\joomla\\test_returns_first_matching_asset_path',
        10 => 'tests\\unit\\detection\\joomla\\test_returns_no_match_when_no_asset_path_exists',
        11 => 'tests\\unit\\detection\\joomla\\test_handles_empty_html',
        12 => 'tests\\unit\\detection\\joomla\\test_handles_malformed_html',
        13 => 'tests\\unit\\detection\\joomla\\test_returns_expected_weight',
        14 => 'tests\\unit\\detection\\joomla\\test_returns_asset_path_metadata',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\Detection\\Joomla\\ConfidenceCalculatorTest.php' => 
    array (
      0 => '6471137cefd748e1b47a3ed61416e57347da549c56403b566eeae0cc5ca24bd2',
      1 => 
      array (
        0 => 'tests\\unit\\detection\\joomla\\confidencecalculatortest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\detection\\joomla\\createcalculator',
        1 => 'tests\\unit\\detection\\joomla\\createruleresult',
        2 => 'tests\\unit\\detection\\joomla\\test_returns_zero_for_empty_rule_results',
        3 => 'tests\\unit\\detection\\joomla\\test_ignores_unmatched_rules',
        4 => 'tests\\unit\\detection\\joomla\\test_returns_single_rule_weight',
        5 => 'tests\\unit\\detection\\joomla\\test_sums_multiple_matched_rules',
        6 => 'tests\\unit\\detection\\joomla\\test_ignores_unmatched_rules_when_mixed',
        7 => 'tests\\unit\\detection\\joomla\\test_caps_confidence_at_one_hundred',
        8 => 'tests\\unit\\detection\\joomla\\test_never_returns_negative_confidence',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\Detection\\Joomla\\HtmlSignatureRuleTest.php' => 
    array (
      0 => '6a94bf5fb987d15ecbd3b6f5de122fee6136ba77aa7589cd875beee0c40742eb',
      1 => 
      array (
        0 => 'tests\\unit\\detection\\joomla\\htmlsignatureruletest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\detection\\joomla\\createrule',
        1 => 'tests\\unit\\detection\\joomla\\evaluate',
        2 => 'tests\\unit\\detection\\joomla\\test_detects_option_com_signature',
        3 => 'tests\\unit\\detection\\joomla\\test_detects_com_content_signature',
        4 => 'tests\\unit\\detection\\joomla\\test_detects_com_users_signature',
        5 => 'tests\\unit\\detection\\joomla\\test_detects_com_contact_signature',
        6 => 'tests\\unit\\detection\\joomla\\test_detects_joomla_toolbar_button_signature',
        7 => 'tests\\unit\\detection\\joomla\\test_detects_case_insensitively',
        8 => 'tests\\unit\\detection\\joomla\\test_returns_first_matching_signature',
        9 => 'tests\\unit\\detection\\joomla\\test_returns_no_match_when_no_signature_exists',
        10 => 'tests\\unit\\detection\\joomla\\test_handles_empty_html',
        11 => 'tests\\unit\\detection\\joomla\\test_returns_expected_weight',
        12 => 'tests\\unit\\detection\\joomla\\test_returns_html_signature_metadata',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\Detection\\Joomla\\JoomlaDetectorTest.php' => 
    array (
      0 => '028e22101b0d7db23c5d853a056a6d29496431452c7c27288765e7444f8258dc',
      1 => 
      array (
        0 => 'tests\\unit\\detection\\joomla\\joomladetectortest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\detection\\joomla\\createcontext',
        1 => 'tests\\unit\\detection\\joomla\\createdetector',
        2 => 'tests\\unit\\detection\\joomla\\createrule',
        3 => 'tests\\unit\\detection\\joomla\\creatematchedruleresult',
        4 => 'tests\\unit\\detection\\joomla\\createunmatchedruleresult',
        5 => 'tests\\unit\\detection\\joomla\\test_returns_no_detection_when_confidence_is_zero',
        6 => 'tests\\unit\\detection\\joomla\\test_returns_detection_when_confidence_is_positive',
        7 => 'tests\\unit\\detection\\joomla\\test_executes_every_rule',
        8 => 'tests\\unit\\detection\\joomla\\test_passes_all_rule_results_to_confidence_calculator',
        9 => 'tests\\unit\\detection\\joomla\\test_merges_metadata_from_multiple_rules',
        10 => 'tests\\unit\\detection\\joomla\\test_later_metadata_overwrites_previous_values',
        11 => 'tests\\unit\\detection\\joomla\\test_collects_matched_rule_names',
        12 => 'tests\\unit\\detection\\joomla\\test_ignores_unmatched_rules',
        13 => 'tests\\unit\\detection\\joomla\\test_returns_detection_result',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\Detection\\Joomla\\MetaGeneratorRuleTest.php' => 
    array (
      0 => '144b0f4ba2ef3e834276bddd03cd91f73230025a10ab8daffd9a4fc9d1c870c5',
      1 => 
      array (
        0 => 'tests\\unit\\detection\\joomla\\metageneratorruletest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\detection\\joomla\\createrule',
        1 => 'tests\\unit\\detection\\joomla\\evaluate',
        2 => 'tests\\unit\\detection\\joomla\\test_detects_plain_joomla_generator',
        3 => 'tests\\unit\\detection\\joomla\\test_detects_joomla_open_source_cms',
        4 => 'tests\\unit\\detection\\joomla\\test_detects_powered_by_joomla',
        5 => 'tests\\unit\\detection\\joomla\\test_detects_built_with_joomla',
        6 => 'tests\\unit\\detection\\joomla\\test_detects_joomla_five',
        7 => 'tests\\unit\\detection\\joomla\\test_detects_joomla_four',
        8 => 'tests\\unit\\detection\\joomla\\test_detects_generator_case_insensitively',
        9 => 'tests\\unit\\detection\\joomla\\test_ignores_non_joomla_generator',
        10 => 'tests\\unit\\detection\\joomla\\test_returns_no_match_when_generator_is_missing',
        11 => 'tests\\unit\\detection\\joomla\\test_handles_empty_html',
        12 => 'tests\\unit\\detection\\joomla\\test_handles_malformed_html',
        13 => 'tests\\unit\\detection\\joomla\\test_returns_expected_weight',
        14 => 'tests\\unit\\detection\\joomla\\test_returns_generator_metadata',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\Detection\\Joomla\\ScriptFingerprintRuleTest.php' => 
    array (
      0 => '2fdcb0437f1954a9743b4d89d4f21ad43b7d6431e2caa3911410922bac583fcb',
      1 => 
      array (
        0 => 'tests\\unit\\detection\\joomla\\scriptfingerprintruletest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\detection\\joomla\\createrule',
        1 => 'tests\\unit\\detection\\joomla\\evaluate',
        2 => 'tests\\unit\\detection\\joomla\\test_detects_window_joomla',
        3 => 'tests\\unit\\detection\\joomla\\test_detects_joomla_get_options',
        4 => 'tests\\unit\\detection\\joomla\\test_detects_joomla_submitbutton',
        5 => 'tests\\unit\\detection\\joomla\\test_detects_joomla_jtext',
        6 => 'tests\\unit\\detection\\joomla\\test_detects_case_insensitively',
        7 => 'tests\\unit\\detection\\joomla\\test_returns_first_matching_fingerprint',
        8 => 'tests\\unit\\detection\\joomla\\test_returns_no_match_when_no_fingerprint_exists',
        9 => 'tests\\unit\\detection\\joomla\\test_handles_empty_html',
        10 => 'tests\\unit\\detection\\joomla\\test_returns_expected_weight',
        11 => 'tests\\unit\\detection\\joomla\\test_returns_js_fingerprint_metadata',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\Detection\\Squarespace\\AssetPathRuleTest.php' => 
    array (
      0 => '5d3cf7e2a796d22afa4e944e4b715deecb9879d1286245933c8e1a428313a8f2',
      1 => 
      array (
        0 => 'tests\\unit\\detection\\squarespace\\assetpathruletest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\detection\\squarespace\\createrule',
        1 => 'tests\\unit\\detection\\squarespace\\evaluate',
        2 => 'tests\\unit\\detection\\squarespace\\test_detects_static1_squarespace_host',
        3 => 'tests\\unit\\detection\\squarespace\\test_detects_static2_squarespace_host',
        4 => 'tests\\unit\\detection\\squarespace\\test_detects_assets_squarespace_host',
        5 => 'tests\\unit\\detection\\squarespace\\test_detects_images_squarespace_cdn_host',
        6 => 'tests\\unit\\detection\\squarespace\\test_detects_asset_host_in_link_element',
        7 => 'tests\\unit\\detection\\squarespace\\test_detects_asset_host_in_script_element',
        8 => 'tests\\unit\\detection\\squarespace\\test_detects_asset_host_in_img_element',
        9 => 'tests\\unit\\detection\\squarespace\\test_returns_first_matching_asset_host',
        10 => 'tests\\unit\\detection\\squarespace\\test_returns_no_match_when_no_asset_host_exists',
        11 => 'tests\\unit\\detection\\squarespace\\test_handles_empty_html',
        12 => 'tests\\unit\\detection\\squarespace\\test_handles_malformed_html',
        13 => 'tests\\unit\\detection\\squarespace\\test_returns_expected_weight',
        14 => 'tests\\unit\\detection\\squarespace\\test_returns_asset_host_metadata',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\Detection\\Squarespace\\CommerceRuleTest.php' => 
    array (
      0 => 'e07714c02c8a0af7792a1dcc4278fe1d0c4809d9988c10cf5fa39d325f946b78',
      1 => 
      array (
        0 => 'tests\\unit\\detection\\squarespace\\commerceruletest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\detection\\squarespace\\createrule',
        1 => 'tests\\unit\\detection\\squarespace\\evaluate',
        2 => 'tests\\unit\\detection\\squarespace\\test_detects_sqs_cart',
        3 => 'tests\\unit\\detection\\squarespace\\test_detects_sqs_commerce',
        4 => 'tests\\unit\\detection\\squarespace\\test_detects_cart_squarespace_host',
        5 => 'tests\\unit\\detection\\squarespace\\test_detects_case_insensitively',
        6 => 'tests\\unit\\detection\\squarespace\\test_returns_first_matching_fingerprint',
        7 => 'tests\\unit\\detection\\squarespace\\test_returns_no_match_when_no_fingerprint_exists',
        8 => 'tests\\unit\\detection\\squarespace\\test_handles_empty_html',
        9 => 'tests\\unit\\detection\\squarespace\\test_returns_expected_weight',
        10 => 'tests\\unit\\detection\\squarespace\\test_returns_commerce_fingerprint_metadata',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\Detection\\Squarespace\\ConfidenceCalculatorTest.php' => 
    array (
      0 => 'cddfe6e78fa1ee6e05464270b9fa9466ad1965acef73359d8e8bf1bf687d8979',
      1 => 
      array (
        0 => 'tests\\unit\\detection\\squarespace\\confidencecalculatortest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\detection\\squarespace\\createcalculator',
        1 => 'tests\\unit\\detection\\squarespace\\createruleresult',
        2 => 'tests\\unit\\detection\\squarespace\\test_returns_zero_for_empty_rule_results',
        3 => 'tests\\unit\\detection\\squarespace\\test_ignores_unmatched_rules',
        4 => 'tests\\unit\\detection\\squarespace\\test_returns_single_rule_weight',
        5 => 'tests\\unit\\detection\\squarespace\\test_sums_multiple_matched_rules',
        6 => 'tests\\unit\\detection\\squarespace\\test_ignores_unmatched_rules_when_mixed',
        7 => 'tests\\unit\\detection\\squarespace\\test_caps_confidence_at_one_hundred',
        8 => 'tests\\unit\\detection\\squarespace\\test_never_returns_negative_confidence',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\Detection\\Squarespace\\DataAttributesRuleTest.php' => 
    array (
      0 => '938853cd21024faf3db48c4c97d7da4333e4115547c1822d675d3435f83c7f4b',
      1 => 
      array (
        0 => 'tests\\unit\\detection\\squarespace\\dataattributesruletest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\detection\\squarespace\\createrule',
        1 => 'tests\\unit\\detection\\squarespace\\evaluate',
        2 => 'tests\\unit\\detection\\squarespace\\test_detects_data_animation_role_attribute',
        3 => 'tests\\unit\\detection\\squarespace\\test_detects_data_section_id_attribute',
        4 => 'tests\\unit\\detection\\squarespace\\test_detects_data_current_styles_attribute',
        5 => 'tests\\unit\\detection\\squarespace\\test_returns_first_matching_attribute',
        6 => 'tests\\unit\\detection\\squarespace\\test_returns_no_match_when_attributes_are_missing',
        7 => 'tests\\unit\\detection\\squarespace\\test_handles_empty_html',
        8 => 'tests\\unit\\detection\\squarespace\\test_handles_malformed_html',
        9 => 'tests\\unit\\detection\\squarespace\\test_returns_expected_weight',
        10 => 'tests\\unit\\detection\\squarespace\\test_returns_attribute_metadata',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\Detection\\Squarespace\\MetaGeneratorRuleTest.php' => 
    array (
      0 => 'ee4f2042161966c1417da3b171ad8aa42d3811ef614a63b0ed02d78f6f6ab532',
      1 => 
      array (
        0 => 'tests\\unit\\detection\\squarespace\\metageneratorruletest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\detection\\squarespace\\createrule',
        1 => 'tests\\unit\\detection\\squarespace\\evaluate',
        2 => 'tests\\unit\\detection\\squarespace\\test_detects_plain_squarespace_generator',
        3 => 'tests\\unit\\detection\\squarespace\\test_detects_squarespace_version',
        4 => 'tests\\unit\\detection\\squarespace\\test_detects_built_with_squarespace',
        5 => 'tests\\unit\\detection\\squarespace\\test_detects_squarespace_website_builder',
        6 => 'tests\\unit\\detection\\squarespace\\test_detects_generator_case_insensitively',
        7 => 'tests\\unit\\detection\\squarespace\\test_ignores_non_squarespace_generator',
        8 => 'tests\\unit\\detection\\squarespace\\test_returns_no_match_when_generator_is_missing',
        9 => 'tests\\unit\\detection\\squarespace\\test_handles_empty_html',
        10 => 'tests\\unit\\detection\\squarespace\\test_handles_malformed_html',
        11 => 'tests\\unit\\detection\\squarespace\\test_returns_expected_weight',
        12 => 'tests\\unit\\detection\\squarespace\\test_returns_generator_metadata',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\Detection\\Squarespace\\SquarespaceDetectorTest.php' => 
    array (
      0 => 'd951fc34e9846a3c230fa382c9eb42602f44506c7867de6957f0a83ca908fb21',
      1 => 
      array (
        0 => 'tests\\unit\\detection\\squarespace\\squarespacedetectortest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\detection\\squarespace\\createcontext',
        1 => 'tests\\unit\\detection\\squarespace\\createdetector',
        2 => 'tests\\unit\\detection\\squarespace\\createrule',
        3 => 'tests\\unit\\detection\\squarespace\\creatematchedruleresult',
        4 => 'tests\\unit\\detection\\squarespace\\createunmatchedruleresult',
        5 => 'tests\\unit\\detection\\squarespace\\test_returns_no_detection_when_confidence_is_zero',
        6 => 'tests\\unit\\detection\\squarespace\\test_returns_detection_when_confidence_is_positive',
        7 => 'tests\\unit\\detection\\squarespace\\test_executes_every_rule',
        8 => 'tests\\unit\\detection\\squarespace\\test_passes_all_rule_results_to_confidence_calculator',
        9 => 'tests\\unit\\detection\\squarespace\\test_merges_metadata_from_multiple_rules',
        10 => 'tests\\unit\\detection\\squarespace\\test_later_metadata_overwrites_previous_values',
        11 => 'tests\\unit\\detection\\squarespace\\test_collects_matched_rule_names',
        12 => 'tests\\unit\\detection\\squarespace\\test_ignores_unmatched_rules',
        13 => 'tests\\unit\\detection\\squarespace\\test_returns_detection_result',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\Detection\\Squarespace\\StaticJsRuleTest.php' => 
    array (
      0 => '55e907d794e3ac2650d4fa16db42c757c2b536b5a71e3b6f2aa91a77992b0908',
      1 => 
      array (
        0 => 'tests\\unit\\detection\\squarespace\\staticjsruletest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\detection\\squarespace\\createrule',
        1 => 'tests\\unit\\detection\\squarespace\\evaluate',
        2 => 'tests\\unit\\detection\\squarespace\\test_detects_squarespace_load',
        3 => 'tests\\unit\\detection\\squarespace\\test_detects_squarespace_initialize',
        4 => 'tests\\unit\\detection\\squarespace\\test_detects_static_squarespace_host',
        5 => 'tests\\unit\\detection\\squarespace\\test_detects_y_use',
        6 => 'tests\\unit\\detection\\squarespace\\test_detects_case_insensitively',
        7 => 'tests\\unit\\detection\\squarespace\\test_returns_first_matching_fingerprint',
        8 => 'tests\\unit\\detection\\squarespace\\test_returns_no_match_when_no_fingerprint_exists',
        9 => 'tests\\unit\\detection\\squarespace\\test_handles_empty_html',
        10 => 'tests\\unit\\detection\\squarespace\\test_returns_expected_weight',
        11 => 'tests\\unit\\detection\\squarespace\\test_returns_js_fingerprint_metadata',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\Detection\\TYPO3\\ApiEndpointRuleTest.php' => 
    array (
      0 => 'af9150748e0bf28859ae032fc4049a2d0a49be9cd1b895fd0d3580235b6ea926',
      1 => 
      array (
        0 => 'tests\\unit\\detection\\typo3\\apiendpointruletest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\detection\\typo3\\createrule',
        1 => 'tests\\unit\\detection\\typo3\\evaluate',
        2 => 'tests\\unit\\detection\\typo3\\test_detects_typo3_endpoint',
        3 => 'tests\\unit\\detection\\typo3\\test_detects_typo3_index_php_endpoint',
        4 => 'tests\\unit\\detection\\typo3\\test_detects_typo3_ajax_endpoint',
        5 => 'tests\\unit\\detection\\typo3\\test_detects_typo3_module_endpoint',
        6 => 'tests\\unit\\detection\\typo3\\test_detects_case_insensitively',
        7 => 'tests\\unit\\detection\\typo3\\test_returns_first_matching_endpoint',
        8 => 'tests\\unit\\detection\\typo3\\test_returns_no_match_when_no_endpoint_exists',
        9 => 'tests\\unit\\detection\\typo3\\test_handles_empty_html',
        10 => 'tests\\unit\\detection\\typo3\\test_returns_expected_weight',
        11 => 'tests\\unit\\detection\\typo3\\test_returns_api_endpoint_metadata',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\Detection\\TYPO3\\AssetPathRuleTest.php' => 
    array (
      0 => '4fa2a81ba1a43055309043a1c839c868525dd91bfc78f72cbe7f04400507449c',
      1 => 
      array (
        0 => 'tests\\unit\\detection\\typo3\\assetpathruletest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\detection\\typo3\\createrule',
        1 => 'tests\\unit\\detection\\typo3\\evaluate',
        2 => 'tests\\unit\\detection\\typo3\\test_detects_typo3_path',
        3 => 'tests\\unit\\detection\\typo3\\test_detects_typo3conf_path',
        4 => 'tests\\unit\\detection\\typo3\\test_detects_typo3temp_path',
        5 => 'tests\\unit\\detection\\typo3\\test_detects_fileadmin_path',
        6 => 'tests\\unit\\detection\\typo3\\test_detects_typo3_sysext_path',
        7 => 'tests\\unit\\detection\\typo3\\test_detects_asset_path_in_link_element',
        8 => 'tests\\unit\\detection\\typo3\\test_detects_asset_path_in_script_element',
        9 => 'tests\\unit\\detection\\typo3\\test_detects_asset_path_in_img_element',
        10 => 'tests\\unit\\detection\\typo3\\test_returns_first_matching_asset_path',
        11 => 'tests\\unit\\detection\\typo3\\test_returns_no_match_when_no_asset_path_exists',
        12 => 'tests\\unit\\detection\\typo3\\test_handles_empty_html',
        13 => 'tests\\unit\\detection\\typo3\\test_handles_malformed_html',
        14 => 'tests\\unit\\detection\\typo3\\test_returns_expected_weight',
        15 => 'tests\\unit\\detection\\typo3\\test_returns_asset_path_metadata',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\Detection\\TYPO3\\ConfidenceCalculatorTest.php' => 
    array (
      0 => 'ebad5e9a98ca75dbbf243668a91dad3ab0ae390443b68981f1699f144f416b0e',
      1 => 
      array (
        0 => 'tests\\unit\\detection\\typo3\\confidencecalculatortest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\detection\\typo3\\createcalculator',
        1 => 'tests\\unit\\detection\\typo3\\createruleresult',
        2 => 'tests\\unit\\detection\\typo3\\test_returns_zero_for_empty_rule_results',
        3 => 'tests\\unit\\detection\\typo3\\test_ignores_unmatched_rules',
        4 => 'tests\\unit\\detection\\typo3\\test_returns_single_rule_weight',
        5 => 'tests\\unit\\detection\\typo3\\test_sums_multiple_matched_rules',
        6 => 'tests\\unit\\detection\\typo3\\test_ignores_unmatched_rules_when_mixed',
        7 => 'tests\\unit\\detection\\typo3\\test_caps_confidence_at_one_hundred',
        8 => 'tests\\unit\\detection\\typo3\\test_never_returns_negative_confidence',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\Detection\\TYPO3\\HtmlSignatureRuleTest.php' => 
    array (
      0 => 'b6a339d96989fb7d8c4cd041b38506a8a8b9dbd36c3f4470aaeae042e2f71bc3',
      1 => 
      array (
        0 => 'tests\\unit\\detection\\typo3\\htmlsignatureruletest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\detection\\typo3\\createrule',
        1 => 'tests\\unit\\detection\\typo3\\evaluate',
        2 => 'tests\\unit\\detection\\typo3\\test_detects_data_typo3_signature',
        3 => 'tests\\unit\\detection\\typo3\\test_detects_typo3_login_signature',
        4 => 'tests\\unit\\detection\\typo3\\test_detects_typo3_backend_signature',
        5 => 'tests\\unit\\detection\\typo3\\test_detects_typo3_adminpanel_signature',
        6 => 'tests\\unit\\detection\\typo3\\test_detects_case_insensitively',
        7 => 'tests\\unit\\detection\\typo3\\test_returns_first_matching_signature',
        8 => 'tests\\unit\\detection\\typo3\\test_returns_no_match_when_no_signature_exists',
        9 => 'tests\\unit\\detection\\typo3\\test_handles_empty_html',
        10 => 'tests\\unit\\detection\\typo3\\test_returns_expected_weight',
        11 => 'tests\\unit\\detection\\typo3\\test_returns_html_signature_metadata',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\Detection\\TYPO3\\MetaGeneratorRuleTest.php' => 
    array (
      0 => '429f7cc42184475d63e67923246baf5d3cdae02e0b85c58bf7b9e4ef22faa463',
      1 => 
      array (
        0 => 'tests\\unit\\detection\\typo3\\metageneratorruletest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\detection\\typo3\\createrule',
        1 => 'tests\\unit\\detection\\typo3\\evaluate',
        2 => 'tests\\unit\\detection\\typo3\\test_detects_plain_typo3_generator',
        3 => 'tests\\unit\\detection\\typo3\\test_detects_typo3_cms',
        4 => 'tests\\unit\\detection\\typo3\\test_detects_powered_by_typo3',
        5 => 'tests\\unit\\detection\\typo3\\test_detects_built_with_typo3',
        6 => 'tests\\unit\\detection\\typo3\\test_detects_generator_case_insensitively',
        7 => 'tests\\unit\\detection\\typo3\\test_ignores_non_typo3_generator',
        8 => 'tests\\unit\\detection\\typo3\\test_returns_no_match_when_generator_is_missing',
        9 => 'tests\\unit\\detection\\typo3\\test_handles_empty_html',
        10 => 'tests\\unit\\detection\\typo3\\test_handles_malformed_html',
        11 => 'tests\\unit\\detection\\typo3\\test_returns_expected_weight',
        12 => 'tests\\unit\\detection\\typo3\\test_returns_generator_metadata',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\Detection\\TYPO3\\ScriptFingerprintRuleTest.php' => 
    array (
      0 => '4279d6e07262238e27fbd0be704c71bd6230792397814f34138c120dc75b3213',
      1 => 
      array (
        0 => 'tests\\unit\\detection\\typo3\\scriptfingerprintruletest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\detection\\typo3\\createrule',
        1 => 'tests\\unit\\detection\\typo3\\evaluate',
        2 => 'tests\\unit\\detection\\typo3\\test_detects_typo3',
        3 => 'tests\\unit\\detection\\typo3\\test_detects_typo3_settings',
        4 => 'tests\\unit\\detection\\typo3\\test_detects_typo3_lang',
        5 => 'tests\\unit\\detection\\typo3\\test_detects_typo3_configuration',
        6 => 'tests\\unit\\detection\\typo3\\test_detects_case_insensitively',
        7 => 'tests\\unit\\detection\\typo3\\test_returns_first_matching_fingerprint',
        8 => 'tests\\unit\\detection\\typo3\\test_returns_no_match_when_no_fingerprint_exists',
        9 => 'tests\\unit\\detection\\typo3\\test_handles_empty_html',
        10 => 'tests\\unit\\detection\\typo3\\test_returns_expected_weight',
        11 => 'tests\\unit\\detection\\typo3\\test_returns_js_fingerprint_metadata',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\Detection\\TYPO3\\TYPO3DetectorTest.php' => 
    array (
      0 => '158297fba9967c1d3c871e4f69a50ddca8e2592c8a64659604e2a939b12f47eb',
      1 => 
      array (
        0 => 'tests\\unit\\detection\\typo3\\typo3detectortest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\detection\\typo3\\createcontext',
        1 => 'tests\\unit\\detection\\typo3\\createdetector',
        2 => 'tests\\unit\\detection\\typo3\\createrule',
        3 => 'tests\\unit\\detection\\typo3\\creatematchedruleresult',
        4 => 'tests\\unit\\detection\\typo3\\createunmatchedruleresult',
        5 => 'tests\\unit\\detection\\typo3\\test_returns_no_detection_when_confidence_is_zero',
        6 => 'tests\\unit\\detection\\typo3\\test_returns_detection_when_confidence_is_positive',
        7 => 'tests\\unit\\detection\\typo3\\test_executes_every_rule',
        8 => 'tests\\unit\\detection\\typo3\\test_passes_all_rule_results_to_confidence_calculator',
        9 => 'tests\\unit\\detection\\typo3\\test_merges_metadata_from_multiple_rules',
        10 => 'tests\\unit\\detection\\typo3\\test_later_metadata_overwrites_previous_values',
        11 => 'tests\\unit\\detection\\typo3\\test_collects_matched_rule_names',
        12 => 'tests\\unit\\detection\\typo3\\test_ignores_unmatched_rules',
        13 => 'tests\\unit\\detection\\typo3\\test_returns_detection_result',
      ),
      3 => 
      array (
      ),
    ),
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
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\Detection\\WebsiteDetectorTest.php' => 
    array (
      0 => '293a41ff077dff384eb1dd790833a6b1d5272ae6f72e66f467ced9fa60b9f6ce',
      1 => 
      array (
        0 => 'tests\\unit\\detection\\websitedetectortest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\detection\\createresponse',
        1 => 'tests\\unit\\detection\\createcontext',
        2 => 'tests\\unit\\detection\\createresult',
        3 => 'tests\\unit\\detection\\createdetector',
        4 => 'tests\\unit\\detection\\test_requests_target_url_using_http_client',
        5 => 'tests\\unit\\detection\\test_passes_http_response_to_context_factory',
        6 => 'tests\\unit\\detection\\test_passes_context_to_detection_manager',
        7 => 'tests\\unit\\detection\\test_returns_detection_result',
        8 => 'tests\\unit\\detection\\test_detect_returns_detection_result_instance',
        9 => 'tests\\unit\\detection\\test_detect_is_stateless',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\Detection\\Wix\\AssetPathRuleTest.php' => 
    array (
      0 => 'ae68704bce3e18698393a2732b99e5b3b6d2fb98d5bd6ed094a72d0b2eab9007',
      1 => 
      array (
        0 => 'tests\\unit\\detection\\wix\\assetpathruletest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\detection\\wix\\createrule',
        1 => 'tests\\unit\\detection\\wix\\evaluate',
        2 => 'tests\\unit\\detection\\wix\\test_detects_static_wixstatic_host',
        3 => 'tests\\unit\\detection\\wix\\test_detects_static_parastorage_host',
        4 => 'tests\\unit\\detection\\wix\\test_detects_siteassets_parastorage_host',
        5 => 'tests\\unit\\detection\\wix\\test_detects_frog_wix_host',
        6 => 'tests\\unit\\detection\\wix\\test_detects_asset_host_in_link_element',
        7 => 'tests\\unit\\detection\\wix\\test_detects_asset_host_in_script_element',
        8 => 'tests\\unit\\detection\\wix\\test_detects_asset_host_in_img_element',
        9 => 'tests\\unit\\detection\\wix\\test_returns_first_matching_asset_host',
        10 => 'tests\\unit\\detection\\wix\\test_returns_no_match_when_no_asset_host_exists',
        11 => 'tests\\unit\\detection\\wix\\test_handles_empty_html',
        12 => 'tests\\unit\\detection\\wix\\test_handles_malformed_html',
        13 => 'tests\\unit\\detection\\wix\\test_returns_expected_weight',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\Detection\\Wix\\ConfidenceCalculatorTest.php' => 
    array (
      0 => 'dfc7cb2e37936ae31ee029efa98e1226b9d80009ec7c85f2b07a9c05a71d9a17',
      1 => 
      array (
        0 => 'tests\\unit\\detection\\wix\\confidencecalculatortest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\detection\\wix\\createcalculator',
        1 => 'tests\\unit\\detection\\wix\\createruleresult',
        2 => 'tests\\unit\\detection\\wix\\test_returns_zero_for_empty_rule_results',
        3 => 'tests\\unit\\detection\\wix\\test_ignores_unmatched_rules',
        4 => 'tests\\unit\\detection\\wix\\test_returns_single_rule_weight',
        5 => 'tests\\unit\\detection\\wix\\test_sums_multiple_matched_rules',
        6 => 'tests\\unit\\detection\\wix\\test_ignores_unmatched_rules_when_mixed',
        7 => 'tests\\unit\\detection\\wix\\test_caps_confidence_at_one_hundred',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\Detection\\Wix\\GlobalJsRuleTest.php' => 
    array (
      0 => '94794c9a62daa9bd49e2d1ebed3f07c49abf2c57c1a85b6363028cde2372011c',
      1 => 
      array (
        0 => 'tests\\unit\\detection\\wix\\globaljsruletest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\detection\\wix\\createrule',
        1 => 'tests\\unit\\detection\\wix\\evaluate',
        2 => 'tests\\unit\\detection\\wix\\test_detects_window_viewer_model',
        3 => 'tests\\unit\\detection\\wix\\test_detects_window_wix_bi_session',
        4 => 'tests\\unit\\detection\\wix\\test_detects_window_client_side_render',
        5 => 'tests\\unit\\detection\\wix\\test_detects_window_initial_state',
        6 => 'tests\\unit\\detection\\wix\\test_detects_window_tb',
        7 => 'tests\\unit\\detection\\wix\\test_detects_case_insensitively',
        8 => 'tests\\unit\\detection\\wix\\test_returns_first_matching_fingerprint',
        9 => 'tests\\unit\\detection\\wix\\test_returns_no_match_when_no_fingerprint_exists',
        10 => 'tests\\unit\\detection\\wix\\test_handles_empty_html',
        11 => 'tests\\unit\\detection\\wix\\test_returns_expected_weight',
        12 => 'tests\\unit\\detection\\wix\\test_returns_js_fingerprint_metadata',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\Detection\\Wix\\MetaGeneratorRuleTest.php' => 
    array (
      0 => '48589c5f731ead9f35b62fa6d8df11f10d665fbe56c600970b5d419d80e904ad',
      1 => 
      array (
        0 => 'tests\\unit\\detection\\wix\\metageneratorruletest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\detection\\wix\\createrule',
        1 => 'tests\\unit\\detection\\wix\\evaluate',
        2 => 'tests\\unit\\detection\\wix\\test_detects_wix_com_website_builder',
        3 => 'tests\\unit\\detection\\wix\\test_detects_plain_wix_generator',
        4 => 'tests\\unit\\detection\\wix\\test_detects_built_with_wix',
        5 => 'tests\\unit\\detection\\wix\\test_detects_generator_case_insensitively',
        6 => 'tests\\unit\\detection\\wix\\test_ignores_non_wix_generator',
        7 => 'tests\\unit\\detection\\wix\\test_returns_no_match_when_generator_is_missing',
        8 => 'tests\\unit\\detection\\wix\\test_handles_empty_html',
        9 => 'tests\\unit\\detection\\wix\\test_handles_malformed_html',
        10 => 'tests\\unit\\detection\\wix\\test_returns_expected_weight',
        11 => 'tests\\unit\\detection\\wix\\test_returns_generator_metadata',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\Detection\\Wix\\ThunderboltRuleTest.php' => 
    array (
      0 => '1fe7f39894c1851191d054a26fb346e867f18ddd5513cd2fd8466aab2978cd16',
      1 => 
      array (
        0 => 'tests\\unit\\detection\\wix\\thunderboltruletest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\detection\\wix\\createrule',
        1 => 'tests\\unit\\detection\\wix\\evaluate',
        2 => 'tests\\unit\\detection\\wix\\test_detects_wix_thunderbolt',
        3 => 'tests\\unit\\detection\\wix\\test_detects_tb_ready',
        4 => 'tests\\unit\\detection\\wix\\test_detects_tb_init',
        5 => 'tests\\unit\\detection\\wix\\test_detects_thunderbolt',
        6 => 'tests\\unit\\detection\\wix\\test_detects_case_insensitively',
        7 => 'tests\\unit\\detection\\wix\\test_returns_first_matching_fingerprint',
        8 => 'tests\\unit\\detection\\wix\\test_returns_no_match_when_no_fingerprint_exists',
        9 => 'tests\\unit\\detection\\wix\\test_handles_empty_html',
        10 => 'tests\\unit\\detection\\wix\\test_returns_expected_weight',
        11 => 'tests\\unit\\detection\\wix\\test_returns_thunderbolt_metadata',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\Detection\\Wix\\ViewerModelRuleTest.php' => 
    array (
      0 => '82a9313493c77336573ba91238a82fdc55968788824f5f6277c5dbfd74f02f6d',
      1 => 
      array (
        0 => 'tests\\unit\\detection\\wix\\viewermodelruletest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\detection\\wix\\createrule',
        1 => 'tests\\unit\\detection\\wix\\evaluate',
        2 => 'tests\\unit\\detection\\wix\\test_detects_viewer_model',
        3 => 'tests\\unit\\detection\\wix\\test_detects_site_features_configs',
        4 => 'tests\\unit\\detection\\wix\\test_detects_client_spec_map',
        5 => 'tests\\unit\\detection\\wix\\test_detects_fleet_config',
        6 => 'tests\\unit\\detection\\wix\\test_detects_case_insensitively',
        7 => 'tests\\unit\\detection\\wix\\test_returns_first_matching_fingerprint',
        8 => 'tests\\unit\\detection\\wix\\test_returns_no_match_when_no_fingerprint_exists',
        9 => 'tests\\unit\\detection\\wix\\test_handles_empty_html',
        10 => 'tests\\unit\\detection\\wix\\test_returns_expected_weight',
        11 => 'tests\\unit\\detection\\wix\\test_returns_viewer_model_metadata',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\Detection\\Wix\\WixDetectorTest.php' => 
    array (
      0 => '8394b060e8f80947e549476731435380ef2e06f74d5cc80b404470ca183bb061',
      1 => 
      array (
        0 => 'tests\\unit\\detection\\wix\\wixdetectortest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\detection\\wix\\createcontext',
        1 => 'tests\\unit\\detection\\wix\\createdetector',
        2 => 'tests\\unit\\detection\\wix\\createrule',
        3 => 'tests\\unit\\detection\\wix\\creatematchedruleresult',
        4 => 'tests\\unit\\detection\\wix\\createunmatchedruleresult',
        5 => 'tests\\unit\\detection\\wix\\test_returns_no_detection_when_confidence_is_zero',
        6 => 'tests\\unit\\detection\\wix\\test_returns_detection_when_confidence_is_positive',
        7 => 'tests\\unit\\detection\\wix\\test_executes_every_rule',
        8 => 'tests\\unit\\detection\\wix\\test_passes_all_rule_results_to_confidence_calculator',
        9 => 'tests\\unit\\detection\\wix\\test_merges_metadata_from_multiple_rules',
        10 => 'tests\\unit\\detection\\wix\\test_later_metadata_overwrites_previous_values',
        11 => 'tests\\unit\\detection\\wix\\test_collects_matched_rule_names',
        12 => 'tests\\unit\\detection\\wix\\test_ignores_unmatched_rules',
        13 => 'tests\\unit\\detection\\wix\\test_returns_detection_result',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\Http\\CurlHttpClientTest.php' => 
    array (
      0 => 'a8a07e01ed1e5c055e4c3c180e206ec9d4b94035765e5dba46ca8fc03f190b67',
      1 => 
      array (
        0 => 'tests\\unit\\http\\curlhttpclienttest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\http\\createadapter',
        1 => 'tests\\unit\\http\\createcurlresponse',
        2 => 'tests\\unit\\http\\makeclient',
        3 => 'tests\\unit\\http\\test_implements_http_client_interface',
        4 => 'tests\\unit\\http\\test_throws_exception_for_invalid_url',
        5 => 'tests\\unit\\http\\test_delegates_request_to_adapter',
        6 => 'tests\\unit\\http\\test_returns_http_response',
        7 => 'tests\\unit\\http\\test_copies_original_url',
        8 => 'tests\\unit\\http\\test_copies_final_url',
        9 => 'tests\\unit\\http\\test_copies_status_code',
        10 => 'tests\\unit\\http\\test_copies_body',
        11 => 'tests\\unit\\http\\test_parses_headers',
        12 => 'tests\\unit\\http\\test_preserves_duplicate_headers',
        13 => 'tests\\unit\\http\\test_propagates_adapter_exception',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\ThemeExtraction\\WordPress\\RawWordPressThemeMetadataTest.php' => 
    array (
      0 => 'f4934117c3b3f111c55e1a51d5325f0bebb0a84024289f3e4482e28cccb9ddfe',
      1 => 
      array (
        0 => 'tests\\unit\\themeextraction\\wordpress\\rawwordpressthememetadatatest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\themeextraction\\wordpress\\test_stores_raw_fields',
        1 => 'tests\\unit\\themeextraction\\wordpress\\test_returns_same_fields',
        2 => 'tests\\unit\\themeextraction\\wordpress\\test_returns_empty_array',
        3 => 'tests\\unit\\themeextraction\\wordpress\\test_multiple_instances_are_independent',
        4 => 'tests\\unit\\themeextraction\\wordpress\\test_is_immutable',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssDownloaderTest.php' => 
    array (
      0 => 'b54cfea8e725d405bcc5a843522beadf6f0b7927510da5c3a468f31fbb189f07',
      1 => 
      array (
        0 => 'tests\\unit\\themeextraction\\wordpress\\wordpressstylecssdownloadertest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\themeextraction\\wordpress\\downloader',
        1 => 'tests\\unit\\themeextraction\\wordpress\\response',
        2 => 'tests\\unit\\themeextraction\\wordpress\\test_returns_response_body_for_http_200',
        3 => 'tests\\unit\\themeextraction\\wordpress\\test_returns_null_for_http_404',
        4 => 'tests\\unit\\themeextraction\\wordpress\\test_returns_null_for_http_500',
        5 => 'tests\\unit\\themeextraction\\wordpress\\test_returns_null_when_http_client_throws_http_exception',
        6 => 'tests\\unit\\themeextraction\\wordpress\\test_passes_url_to_http_client',
        7 => 'tests\\unit\\themeextraction\\wordpress\\test_performs_exactly_one_http_request',
        8 => 'tests\\unit\\themeextraction\\wordpress\\test_download_is_deterministic',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssLocatorTest.php' => 
    array (
      0 => '5f3bb39e653aeec101c593aa991229ce34cbd2bef519f9612e3012923a3ea095',
      1 => 
      array (
        0 => 'tests\\unit\\themeextraction\\wordpress\\wordpressstylecsslocatortest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\themeextraction\\wordpress\\locator',
        1 => 'tests\\unit\\themeextraction\\wordpress\\context',
        2 => 'tests\\unit\\themeextraction\\wordpress\\document',
        3 => 'tests\\unit\\themeextraction\\wordpress\\test_finds_absolute_theme_stylesheet',
        4 => 'tests\\unit\\themeextraction\\wordpress\\test_finds_relative_theme_stylesheet',
        5 => 'tests\\unit\\themeextraction\\wordpress\\test_returns_null_when_no_theme_stylesheet_exists',
        6 => 'tests\\unit\\themeextraction\\wordpress\\test_ignores_wp_includes_stylesheets',
        7 => 'tests\\unit\\themeextraction\\wordpress\\test_ignores_plugin_stylesheets',
        8 => 'tests\\unit\\themeextraction\\wordpress\\test_ignores_google_fonts',
        9 => 'tests\\unit\\themeextraction\\wordpress\\test_ignores_external_stylesheets',
        10 => 'tests\\unit\\themeextraction\\wordpress\\test_returns_first_matching_theme_stylesheet',
        11 => 'tests\\unit\\themeextraction\\wordpress\\test_supports_child_theme_stylesheet',
        12 => 'tests\\unit\\themeextraction\\wordpress\\test_supports_malformed_html',
        13 => 'tests\\unit\\themeextraction\\wordpress\\test_falls_back_to_original_url',
        14 => 'tests\\unit\\themeextraction\\wordpress\\test_normalizes_relative_urls',
        15 => 'tests\\unit\\themeextraction\\wordpress\\test_returns_null_for_empty_html',
        16 => 'tests\\unit\\themeextraction\\wordpress\\test_locator_is_deterministic',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest.php' => 
    array (
      0 => '5f49c393ee69c20276d207f5dbb7d4aecc33b83629ba63353735c4b307e741f6',
      1 => 
      array (
        0 => 'tests\\unit\\themeextraction\\wordpress\\wordpressstylecssparsertest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\themeextraction\\wordpress\\parse',
        1 => 'tests\\unit\\themeextraction\\wordpress\\stylecss',
        2 => 'tests\\unit\\themeextraction\\wordpress\\test_parses_theme_name',
        3 => 'tests\\unit\\themeextraction\\wordpress\\test_parses_theme_uri',
        4 => 'tests\\unit\\themeextraction\\wordpress\\test_parses_author',
        5 => 'tests\\unit\\themeextraction\\wordpress\\test_parses_author_uri',
        6 => 'tests\\unit\\themeextraction\\wordpress\\test_parses_description',
        7 => 'tests\\unit\\themeextraction\\wordpress\\test_parses_version',
        8 => 'tests\\unit\\themeextraction\\wordpress\\test_parses_license',
        9 => 'tests\\unit\\themeextraction\\wordpress\\test_parses_license_uri',
        10 => 'tests\\unit\\themeextraction\\wordpress\\test_parses_tags',
        11 => 'tests\\unit\\themeextraction\\wordpress\\test_parses_text_domain',
        12 => 'tests\\unit\\themeextraction\\wordpress\\test_parses_requires_php',
        13 => 'tests\\unit\\themeextraction\\wordpress\\test_parses_requires_at_least',
        14 => 'tests\\unit\\themeextraction\\wordpress\\test_parses_tested_up_to',
        15 => 'tests\\unit\\themeextraction\\wordpress\\test_parses_template',
        16 => 'tests\\unit\\themeextraction\\wordpress\\test_returns_empty_metadata_for_empty_file',
        17 => 'tests\\unit\\themeextraction\\wordpress\\test_ignores_unknown_fields',
        18 => 'tests\\unit\\themeextraction\\wordpress\\test_ignores_css_rules',
        19 => 'tests\\unit\\themeextraction\\wordpress\\test_stops_after_header_comment',
        20 => 'tests\\unit\\themeextraction\\wordpress\\test_preserves_original_values',
        21 => 'tests\\unit\\themeextraction\\wordpress\\test_parses_windows_line_endings',
        22 => 'tests\\unit\\themeextraction\\wordpress\\test_parses_linux_line_endings',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest.php' => 
    array (
      0 => '2242d9828e26334594a6d8b6fded1a1c04aeb0316419ef9c5565bff453d62296',
      1 => 
      array (
        0 => 'tests\\unit\\themeextraction\\wordpress\\wordpressthemeextractorcomponenttest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\themeextraction\\wordpress\\extractor',
        1 => 'tests\\unit\\themeextraction\\wordpress\\locator',
        2 => 'tests\\unit\\themeextraction\\wordpress\\downloader',
        3 => 'tests\\unit\\themeextraction\\wordpress\\parser',
        4 => 'tests\\unit\\themeextraction\\wordpress\\mapper',
        5 => 'tests\\unit\\themeextraction\\wordpress\\context',
        6 => 'tests\\unit\\themeextraction\\wordpress\\contextfortheme',
        7 => 'tests\\unit\\themeextraction\\wordpress\\contextwithoutthemestylesheet',
        8 => 'tests\\unit\\themeextraction\\wordpress\\metadata',
        9 => 'tests\\unit\\themeextraction\\wordpress\\response',
        10 => 'tests\\unit\\themeextraction\\wordpress\\successfulclient',
        11 => 'tests\\unit\\themeextraction\\wordpress\\successextractor',
        12 => 'tests\\unit\\themeextraction\\wordpress\\test_extract_returns_successful_result',
        13 => 'tests\\unit\\themeextraction\\wordpress\\test_returns_failed_result_when_locator_returns_null',
        14 => 'tests\\unit\\themeextraction\\wordpress\\test_returns_failed_result_when_downloader_returns_null',
        15 => 'tests\\unit\\themeextraction\\wordpress\\test_successful_pipeline_discovers_stylesheet_url',
        16 => 'tests\\unit\\themeextraction\\wordpress\\test_calls_downloader_once',
        17 => 'tests\\unit\\themeextraction\\wordpress\\test_successful_pipeline_parses_theme_metadata',
        18 => 'tests\\unit\\themeextraction\\wordpress\\test_successful_pipeline_maps_theme_metadata',
        19 => 'tests\\unit\\themeextraction\\wordpress\\test_passes_detection_context_to_locator',
        20 => 'tests\\unit\\themeextraction\\wordpress\\test_passes_style_css_url_to_downloader',
        21 => 'tests\\unit\\themeextraction\\wordpress\\test_passes_downloaded_css_to_parser',
        22 => 'tests\\unit\\themeextraction\\wordpress\\test_passes_raw_metadata_to_mapper',
        23 => 'tests\\unit\\themeextraction\\wordpress\\test_returns_fixed_confidence',
        24 => 'tests\\unit\\themeextraction\\wordpress\\test_extractor_is_deterministic',
      ),
      3 => 
      array (
      ),
    ),
    'C:\\xampp\\htdocs\\themedetector\\tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest.php' => 
    array (
      0 => '270585b43e0e6b757eb8d61fb87e0d06efb98423a6a61496fb5414728f27f00c',
      1 => 
      array (
        0 => 'tests\\unit\\themeextraction\\wordpress\\wordpressthememetadatamappertest',
      ),
      2 => 
      array (
        0 => 'tests\\unit\\themeextraction\\wordpress\\mapper',
        1 => 'tests\\unit\\themeextraction\\wordpress\\raw',
        2 => 'tests\\unit\\themeextraction\\wordpress\\test_maps_theme_name',
        3 => 'tests\\unit\\themeextraction\\wordpress\\test_maps_theme_uri',
        4 => 'tests\\unit\\themeextraction\\wordpress\\test_maps_author',
        5 => 'tests\\unit\\themeextraction\\wordpress\\test_maps_author_uri',
        6 => 'tests\\unit\\themeextraction\\wordpress\\test_maps_description',
        7 => 'tests\\unit\\themeextraction\\wordpress\\test_maps_version',
        8 => 'tests\\unit\\themeextraction\\wordpress\\test_maps_license',
        9 => 'tests\\unit\\themeextraction\\wordpress\\test_maps_license_uri',
        10 => 'tests\\unit\\themeextraction\\wordpress\\test_maps_text_domain',
        11 => 'tests\\unit\\themeextraction\\wordpress\\test_maps_parent_theme',
        12 => 'tests\\unit\\themeextraction\\wordpress\\test_maps_requires_php',
        13 => 'tests\\unit\\themeextraction\\wordpress\\test_maps_requires_wordpress',
        14 => 'tests\\unit\\themeextraction\\wordpress\\test_maps_tags_without_splitting',
        15 => 'tests\\unit\\themeextraction\\wordpress\\test_maps_tested_up_to_into_extra',
        16 => 'tests\\unit\\themeextraction\\wordpress\\test_missing_fields_become_null',
        17 => 'tests\\unit\\themeextraction\\wordpress\\test_trims_surrounding_whitespace',
        18 => 'tests\\unit\\themeextraction\\wordpress\\test_preserves_internal_whitespace',
        19 => 'tests\\unit\\themeextraction\\wordpress\\test_returns_theme_metadata_instance',
        20 => 'tests\\unit\\themeextraction\\wordpress\\test_mapping_is_deterministic',
      ),
      3 => 
      array (
      ),
    ),
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