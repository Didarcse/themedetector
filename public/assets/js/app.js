/*!
 * ThemeDetectorTool v2 - Application scripts
 * Vanilla JavaScript enhancements layered on top of Bootstrap 5.
 */
(function () {
    'use strict';

    function onReady(callback) {
        if (document.readyState !== 'loading') {
            callback();
        } else {
            document.addEventListener('DOMContentLoaded', callback);
        }
    }

    function setProgressBars() {
        var bars = document.querySelectorAll('.progress-bar[data-progress]');
        Array.prototype.forEach.call(bars, function (bar) {
            var value = parseInt(bar.getAttribute('data-progress'), 10);
            if (Number.isFinite(value)) {
                bar.style.width = value + '%';
                bar.setAttribute('aria-valuenow', String(value));
            }
        });
    }

    function copyText(text) {
        if (navigator.clipboard && window.isSecureContext) {
            return navigator.clipboard.writeText(text);
        }

        return new Promise(function (resolve, reject) {
            var textarea = document.createElement('textarea');
            textarea.value = text;
            textarea.setAttribute('readonly', '');
            textarea.style.position = 'fixed';
            textarea.style.opacity = '0';
            document.body.appendChild(textarea);
            textarea.select();

            try {
                var ok = document.execCommand('copy');
                document.body.removeChild(textarea);
                if (ok) {
                    resolve();
                } else {
                    reject(new Error('Copy command failed.'));
                }
            } catch (error) {
                document.body.removeChild(textarea);
                reject(error);
            }
        });
    }

    function flashCopied(button, fallbackLabel) {
        var original = button.innerHTML;
        button.innerHTML =
            '<i class="bi bi-check2 me-1" aria-hidden="true"></i>' +
            (fallbackLabel || 'Copied!');

        window.setTimeout(function () {
            button.innerHTML = original;
        }, 2000);
    }

    function bindCopyButtons() {
        var buttons = document.querySelectorAll('[data-copy-text]');
        Array.prototype.forEach.call(buttons, function (button) {
            button.addEventListener('click', function () {
                var text = button.getAttribute('data-copy-text');
                if (!text) {
                    return;
                }

                copyText(text).then(
                    function () {
                        flashCopied(button);
                    },
                    function () {
                        flashCopied(button, 'Copy failed');
                    },
                );
            });
        });
    }

    function bindUrlValidation() {
        var forms = document.querySelectorAll('form[data-validate-url]');
        Array.prototype.forEach.call(forms, function (form) {
            var input = form.querySelector('[name="url"]');
            if (!input) {
                return;
            }

            form.addEventListener('submit', function (event) {
                if (!isValidUrl(input.value)) {
                    event.preventDefault();
                    form.classList.add('was-validated');
                    input.classList.add('is-invalid');
                } else {
                    form.classList.remove('was-validated');
                    input.classList.remove('is-invalid');
                }
            });
        });
    }

    function isValidUrl(value) {
        var trimmed = (value || '').trim();

        if (!trimmed) {
            return false;
        }

        if (!/^https?:\/\//i.test(trimmed)) {
            trimmed = 'https://' + trimmed;
        }

        try {
            var parsed = new URL(trimmed);
            if (parsed.protocol !== 'http:' && parsed.protocol !== 'https:') {
                return false;
            }

            return Boolean(parsed.hostname);
        } catch (error) {
            return false;
        }
    }

    onReady(function () {
        setProgressBars();
        bindCopyButtons();
        bindUrlValidation();
    });
})();
