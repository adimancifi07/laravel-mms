<?php

if (!function_exists('_dd')) {
    function _dd(...$vars)
    {
        // Mengambil nilai parameter terakhir untuk menentukan status die
        // Default-nya true jika tidak didefinisikan secara eksplisit di paling akhir
        $die = true;
        if (count($vars) > 1 && is_bool(end($vars))) {
            $die = array_pop($vars); // Mengambil nilai boolean paling belakang dan menghapusnya dari daftar dump
        }

        $bt = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1);
        $caller = array_shift($bt);
        $location = isset($caller['file']) ? $caller['file'] . ' (Line: ' . $caller['line'] . ')' : 'Unknown';

        echo '<!-- Safe GitHub Light Mode xdump -->';
        echo '<div style="background-color: #f6f8fa; color: #24292e; padding: 16px; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Helvetica, Arial, sans-serif; border: 1px solid #d1d5da; border-radius: 6px; margin: 16px 0; font-size: 13px; line-height: 1.5; box-shadow: 0 1px 3px rgba(0,0,0,0.05); text-align: left; max-width: 100%; overflow-x: auto;">';

        // Header Lokasi File Pemanggil
        echo '<div style="font-family: ui-monospace, SFMono-Regular, monospace; font-size: 11px; color: #586069; font-weight: 600; margin-bottom: 12px; border-bottom: 1px solid #e1e4e8; padding-bottom: 8px;">';
        echo '<span style="background-color: #2188ff; color: #ffffff; padding: 2px 6px; border-radius: 3px; font-weight: bold; margin-right: 8px; font-size: 10px;">XDUMP</span>';
        echo htmlspecialchars($location);
        echo '</div>';

        // Fungsi render yang aman dari memory leak / infinite loop
        $renderSafe = function ($data, $maxDepth = 5, $currentDepth = 0) use (&$renderSafe) {
            if ($currentDepth >= $maxDepth) {
                return '<span style="color: #888; font-style: italic;">[Maksimal Kedalaman Data Tercapai]</span>';
            }

            if (!is_array($data) && !is_object($data)) {
                if (is_bool($data)) return '<span style="color: #22863a; font-weight: bold;">' . ($data ? 'true' : 'false') . '</span> <span style="color: #6a737d; font-size: 11px;">(bool)</span>';
                if (is_null($data)) return '<span style="color: #6a737d; font-weight: bold;">null</span>';
                if (is_string($data)) return '<span style="color: #032f62;">"' . htmlspecialchars($data) . '"</span> <span style="color: #6a737d; font-size: 11px;">(str:' . strlen($data) . ')</span>';
                return '<span style="color: #005cc5;">' . htmlspecialchars($data) . '</span> <span style="color: #6a737d; font-size: 11px;">(' . gettype($data) . ')</span>';
            }

            $is_obj = is_object($data);
            $items = $is_obj ? (array)$data : $data;
            $count = count($items);
            $typeLabel = $is_obj ? 'object(' . get_class($data) . ')' : 'array';

            if ($count === 0) {
                return '<span style="color: #005cc5;">' . $typeLabel . '</span> <span style="color: #6a737d;">[0]</span>';
            }

            // Menggunakan tag HTML <details> untuk fitur buka tutup otomatis tanpa JS berat
            $output = '<details style="display: block; margin: 2px 0;">';
            $output .= '<summary style="cursor: pointer; color: #005cc5; font-weight: bold; user-select: none; outline: none; list-style-position: inside;">';
            $output .= ' <span style="color: #24292e;">' . $typeLabel . '</span> <span style="color: #6a737d; font-size:11px;">[' . $count . ' item]</span>';
            $output .= '</summary>';

            $output .= '<div style="margin-left: 12px; padding-left: 8px; border-left: 1px dashed #e1e4e8; margin-top: 4px;">';
            foreach ($items as $key => $value) {
                // Menghindari rekursi tak terbatas pada circular object (seperti DB Object / Framework Request)
                if ($value === $data) {
                    $output .= '<div><strong>[' . htmlspecialchars($key) . ']</strong> => <span style="color:red;">*RECURSION DETECTED*</span></div>';
                    continue;
                }

                $output .= '<div style="margin: 4px 0; font-family: ui-monospace, SFMono-Regular, monospace;">';
                $output .= '<strong style="color: #24292e;">[' . htmlspecialchars($key) . ']</strong> => ' . $renderSafe($value, $maxDepth, $currentDepth + 1);
                $output .= '</div>';
            }
            $output .= '</div>';
            $output .= '</details>';

            return $output;
        };

        // Render data utama
        foreach ($vars as $index => $var) {
            if (count($vars) > 1) {
                echo '<div style="font-size: 11px; font-weight: bold; color: #0366d6; margin-top: 14px; font-family: monospace;">[Argument ' . ($index + 1) . ']</div>';
            }
            echo '<div style="background: #ffffff; padding: 12px; border: 1px solid #e1e4e8; border-radius: 4px; margin-top: 6px; overflow-x: auto;">';
            echo $renderSafe($var);
            echo '</div>';
        }

        echo '</div>';

        // Logika pengkondisian die()
        if ($die) {
            die();
        }
    }
} else {die('Oups! Function _dd() is already exists.');}


if (!function_exists('internet_status')) {
    function internet_status()
    {
        $connected = @fsockopen("www.google.com", 80);
        //website, port  (try 80 or 443)
        if ($connected) {
            $is_conn = true;
            fclose($connected);
        } else {
            $is_conn = false;
        }
        return $is_conn;
    }
} else {die('Oups! Function _dd() is already exists.');}


