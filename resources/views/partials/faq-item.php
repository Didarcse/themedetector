<?php
$id = $id ?? 'faq-1';
$question = $question ?? '';
$answer = $answer ?? '';
$open = $open ?? false;
$parent = $parent ?? '#faq-accordion';
?>
<div class="accordion-item">
    <h3 class="accordion-header">
        <button
            class="accordion-button<?= $open ? '' : ' collapsed' ?>"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#<?= htmlspecialchars($id, ENT_QUOTES, 'UTF-8') ?>"
            aria-expanded="<?= $open ? 'true' : 'false' ?>"
            aria-controls="<?= htmlspecialchars($id, ENT_QUOTES, 'UTF-8') ?>"
        >
            <?= htmlspecialchars($question, ENT_QUOTES, 'UTF-8') ?>
        </button>
    </h3>
    <div
        id="<?= htmlspecialchars($id, ENT_QUOTES, 'UTF-8') ?>"
        class="accordion-collapse collapse<?= $open ? ' show' : '' ?>"
        data-bs-parent="<?= htmlspecialchars($parent, ENT_QUOTES, 'UTF-8') ?>"
    >
        <div class="accordion-body text-secondary">
            <?= htmlspecialchars($answer, ENT_QUOTES, 'UTF-8') ?>
        </div>
    </div>
</div>
