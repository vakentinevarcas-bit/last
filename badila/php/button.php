<?php

function render_button($label, $class = 'menu-btn', $id = '', $type = 'button', $extraAttributes = []) {
    $buttonClass = trim((string) $class);
    $buttonType = htmlspecialchars((string) $type, ENT_QUOTES, 'UTF-8');
    $buttonLabel = htmlspecialchars((string) $label, ENT_QUOTES, 'UTF-8');
    $buttonId = $id !== '' ? ' id="' . htmlspecialchars((string) $id, ENT_QUOTES, 'UTF-8') . '"' : '';

    $attributes = '';
    foreach ($extraAttributes as $key => $value) {
        if ($value === null || $value === false) {
            continue;
        }

        if ($value === true) {
            $attributes .= ' ' . htmlspecialchars((string) $key, ENT_QUOTES, 'UTF-8');
            continue;
        }

        $attributes .= ' ' . htmlspecialchars((string) $key, ENT_QUOTES, 'UTF-8') . '="' . htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8') . '"';
    }

    return '<button type="' . $buttonType . '"' . $buttonId . ' class="' . htmlspecialchars($buttonClass, ENT_QUOTES, 'UTF-8') . '"' . $attributes . '>' . $buttonLabel . '</button>';
}
