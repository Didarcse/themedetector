<?php
$faqs = $faqs ?? [];

if ($faqs === []) {
    return;
}

$items = array_map(
    static fn (array $faq): array => [
        '@type' => 'Question',
        'name' => (string) $faq['question'],
        'acceptedAnswer' => [
            '@type' => 'Answer',
            'text' => (string) $faq['answer'],
        ],
    ],
    $faqs,
);

$json = json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'FAQPage',
    'mainEntity' => $items,
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

if (is_string($json)): ?>
<script type="application/ld+json"><?= $json ?></script>
<?php endif; ?>
