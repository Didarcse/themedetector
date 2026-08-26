<?php
$title = $title ?? 'Report';
$items = $items ?? [];
?>
<div class="card border-0 shadow-sm mb-4 h-100">
    <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
        <h2 class="h5 fw-bold mb-0"><?= htmlspecialchars((string) $title, ENT_QUOTES, 'UTF-8') ?></h2>
    </div>
    <div class="card-body px-4 pb-4 pt-3">
        <?php if ($items === []): ?>
            <p class="text-secondary mb-0">No information available.</p>
        <?php else: ?>
            <dl class="row mb-0">
                <?php foreach ($items as $item): ?>
                    <dt class="col-sm-4 fw-normal text-secondary mb-2">
                        <?= htmlspecialchars((string) $item['label'], ENT_QUOTES, 'UTF-8') ?>
                    </dt>
                    <dd class="col-sm-8 mb-2 text-break">
                        <?php if (isset($item['link']) && (string) $item['link'] !== '' && safe_href((string) $item['link']) !== ''): ?>
                            <a
                                href="<?= htmlspecialchars(safe_href((string) $item['link']), ENT_QUOTES, 'UTF-8') ?>"
                                target="_blank"
                                rel="noopener"
                            ><?= htmlspecialchars((string) $item['value'], ENT_QUOTES, 'UTF-8') ?></a>
                        <?php else: ?>
                            <?= htmlspecialchars((string) $item['value'], ENT_QUOTES, 'UTF-8') ?>
                        <?php endif; ?>
                        <?php if (isset($item['badge']) && (string) $item['badge'] !== ''): ?>
                            <span class="badge rounded-pill text-bg-success ms-1">
                                <?= htmlspecialchars((string) $item['badge'], ENT_QUOTES, 'UTF-8') ?>
                            </span>
                        <?php endif; ?>
                    </dd>
                <?php endforeach; ?>
            </dl>
        <?php endif; ?>
    </div>
</div>
