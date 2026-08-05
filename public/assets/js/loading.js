/*!
 * ThemeDetectorTool v2 - Detection flow scripts
 * Drives the loading screen between the homepage and the detection report.
 *
 * The progress bar and status messages are visual only and never fake a
 * backend result. The detection request is forwarded to the existing report
 * endpoint; on success the returned report document replaces this page.
 */
(function () {
    'use strict';

    var ROOT = document.querySelector('[data-loading-url]');

    if (!ROOT) {
        return;
    }

    var PROGRESS_TARGET = 80;
    var PROGRESS_DURATION = 4200;
    var TIMEOUT_MS = 60000;

    var url = ROOT.getAttribute('data-loading-url') || '';
    var invalid = ROOT.getAttribute('data-loading-invalid') === '1';
    var steps = parseSteps(ROOT.getAttribute('data-loading-steps'));

    var loadingState = ROOT.querySelector('[data-loading-state="loading"]');
    var errorState = ROOT.querySelector('[data-loading-state="error"]');
    var statusEl = ROOT.querySelector('[data-loading-status]');
    var progressBar = ROOT.querySelector('[data-loading-progress]');
    var progressWrap = progressBar ? progressBar.closest('.progress') : null;
    var errorTitle = ROOT.querySelector('[data-loading-error-title]');
    var errorMessage = ROOT.querySelector('[data-loading-error-message]');
    var retryButton = ROOT.querySelector('[data-loading-retry]');

    var frameId = null;
    var startedAt = null;
    var statusTimer = null;
    var timeoutTimer = null;

    function parseSteps(raw) {
        var list = [];

        try {
            var parsed = JSON.parse(raw || '[]');
            if (Array.isArray(parsed)) {
                list = parsed.filter(function (step) {
                    return typeof step === 'string';
                });
            }
        } catch (error) {
            list = [];
        }

        return list;
    }

    function setProgress(value) {
        if (progressBar) {
            progressBar.style.width = value + '%';
        }

        if (progressWrap) {
            progressWrap.setAttribute('aria-valuenow', String(Math.round(value)));
        }
    }

    function setStatus(text) {
        if (statusEl) {
            statusEl.textContent = text;
        }
    }

    function showState(name) {
        var showLoading = name === 'loading';

        if (loadingState) {
            loadingState.classList.toggle('d-none', !showLoading);
        }

        if (errorState) {
            errorState.classList.toggle('d-none', showLoading);
        }
    }

    function showError(title, message) {
        stopProgress();

        if (errorTitle) {
            errorTitle.textContent = title;
        }

        if (errorMessage) {
            errorMessage.textContent = message;
        }

        setProgress(0);
        showState('error');
    }

    function animateProgress() {
        startedAt = performance.now();

        function step(timestamp) {
            var elapsed = timestamp - startedAt;
            var ratio = Math.min(elapsed / PROGRESS_DURATION, 1);
            var eased = 1 - Math.pow(1 - ratio, 3);
            setProgress(Math.min(eased * PROGRESS_TARGET, PROGRESS_TARGET));
            frameId = requestAnimationFrame(step);
        }

        frameId = requestAnimationFrame(step);
    }

    function stopProgress() {
        if (frameId !== null) {
            cancelAnimationFrame(frameId);
            frameId = null;
        }

        if (statusTimer !== null) {
            window.clearInterval(statusTimer);
            statusTimer = null;
        }

        if (timeoutTimer !== null) {
            window.clearTimeout(timeoutTimer);
            timeoutTimer = null;
        }
    }

    function normalizeUrl(value) {
        var trimmed = (value || '').trim();

        if (!trimmed) {
            return null;
        }

        if (!/^https?:\/\//i.test(trimmed)) {
            trimmed = 'https://' + trimmed;
        }

        try {
            var parsed = new URL(trimmed);
            if (parsed.protocol !== 'http:' && parsed.protocol !== 'https:') {
                return null;
            }

            return parsed.hostname ? parsed.href : null;
        } catch (error) {
            return null;
        }
    }

    function runDetection() {
        var params = new URLSearchParams();
        params.set('url', url);

        var controller = new AbortController();
        timeoutTimer = window.setTimeout(function () {
            controller.abort();
        }, TIMEOUT_MS);

        return fetch('/report', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
                'Accept': 'text/html',
            },
            body: params.toString(),
            redirect: 'follow',
            signal: controller.signal,
        }).then(function (response) {
            if (!response.ok) {
                throw new Error('The detection service is unavailable. Please try again.');
            }

            return response.text();
        }).then(function (html) {
            if (html.indexOf('id="detection-failed"') !== -1) {
                var match = html.match(/data-detection-error="([^"]*)"/);
                var message = match ? decodeEntities(match[1]) : '';
                throw new Error(message || 'The website could not be analyzed. Please try again.');
            }

            if (html.indexOf('<!DOCTYPE') === -1) {
                throw new Error('The detection service returned an unexpected response. Please try again.');
            }

            return html;
        });
    }

    function decodeEntities(value) {
        var textarea = document.createElement('textarea');
        textarea.innerHTML = value;

        return textarea.value;
    }

    function finishSuccess(html) {
        stopProgress();
        setProgress(100);

        try {
            history.replaceState({}, '', '/report?url=' + encodeURIComponent(url));
        } catch (error) {
            /* Keep the current URL when replaceState is unavailable. */
        }

        document.open();
        document.write(html);
        document.close();
    }

    function start() {
        if (invalid) {
            showError(
                'Invalid URL',
                'Please enter a valid website URL, for example https://example.com.'
            );
            return;
        }

        if (!normalizeUrl(url)) {
            showError(
                'Invalid URL',
                'Please enter a valid website URL, for example https://example.com.'
            );
            return;
        }

        stopProgress();
        showState('loading');
        setProgress(0);
        setStatus(steps.length > 0 ? steps[0] : 'Analyzing website...');

        var stepIndex = 0;
        var interval = steps.length > 0 ? PROGRESS_DURATION / steps.length : PROGRESS_DURATION;
        statusTimer = window.setInterval(function () {
            stepIndex = Math.min(stepIndex + 1, steps.length - 1);
            setStatus(steps[stepIndex]);
        }, interval);

        animateProgress();

        runDetection().then(function (html) {
            finishSuccess(html);
        }).catch(function (error) {
            if (error && error.name === 'AbortError') {
                showError(
                    'Detection timed out',
                    'The detection took too long to complete. Please try again.'
                );
                return;
            }

            showError(
                'Detection failed',
                (error && error.message) || 'The website could not be analyzed. Please try again.'
            );
        });
    }

    if (retryButton) {
        retryButton.addEventListener('click', start);
    }

    start();
})();
