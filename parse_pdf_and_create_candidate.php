<?php
define('WP_USE_THEMES', false);
require_once 'vendor/autoload.php';
require_once '../../../wp-load.php';

use NlpTools\Tokenizers\WhitespaceTokenizer;
use NlpTools\NamedEntityRecognition\Ner;

function parse_and_create_candidate($pdf_path) {
    // Зчитування PDF-файлу
    $parser = new \Smalot\PdfParser\Parser();
    $pdf = $parser->parseFile($pdf_path);

    // Отримання тексту з PDF-файлу
    $text = $pdf->getText();

    $tokenizer = new WhitespaceTokenizer();
    $tokens = $tokenizer->tokenize($text);

    $ner = new Ner();
    $entities = $ner->getEntities($tokens);

    // Знайдіть імена та прізвища з отриманих сутностей
    $names = [];
    foreach ($entities as $entity) {
        if ($entity['class'] == 'PERSON') {
            $names[] = $entity['value'];
        }
    }

    // Припустимо, що перше ім'я - це ім'я, а друге - прізвище
    $imya = $names[0] ?? '';
    $familiya = $names[1] ?? '';


    // Використовуйте функцію wp_insert_post() для створення нового посту:
    $new_post = array(
        'post_type'    => 'candidate',
        'post_title'   => $imya . ' ' . $familiya,
        'post_status'  => 'publish'
    );
    $new_post_id = wp_insert_post($new_post);

    // Збереження додаткових полів ACF
    update_field('field_616eb10fa30c0', $imya, $new_post_id);
    update_field('field_616eecd3f4115', $familiya, $new_post_id);
    update_field('field_64199a44ba4b7', $email, $new_post_id); // Зберігаємо поле "Email"
}

// шлях до папки з PDF-файлами
$folder_path = 'candidate_pdf';

// Сканування папки та отримання масиву з іменами файлів
$pdf_files = array_diff(scandir($folder_path), array('..', '.'));

// Обробка кожного PDF-файлу
foreach ($pdf_files as $file) {
    if (strtolower(pathinfo($file, PATHINFO_EXTENSION)) == 'pdf') {
        parse_and_create_candidate($folder_path . '/' . $file);
    }
}

echo "Обробка PDF-файлів завершена.";