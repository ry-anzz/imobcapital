<?php
$path = __DIR__ . '/bootstrap/cache';

if (!is_dir($path)) {
    echo "❌ Pasta não existe\n";
} elseif (!is_writable($path)) {
    echo "❌ Pasta existe, mas não tem permissão de escrita\n";
} else {
    echo "✅ Pasta existe e tem permissão de escrita\n";
}
