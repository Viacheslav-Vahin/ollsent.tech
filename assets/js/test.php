<?php
// data from form
$project1 = $_POST['proj'];
$task1 = $_POST['taskName'];

// обработка данных
$project1 = htmlspecialchars($project1);
$task1 = htmlspecialchars($task1);

$project1 = urldecode($project1);
$task1 = urldecode($task1);

$project1 = trim($project1);
$task1 = trim($task1);

// отправляем данные
if (mail("8bondar.ruslan@gmail.com",
    "Новое задание с Ollsent-hire",
    "Проект: " .$project1."\n".
    "Задание: " .$task1,
    "From: no-reply@oiisent.com \r\n"
)) {
    echo ('Уведомление успешно отправлено');
} else {
    echo ('Есть ошибки, проверьте данные');
}


if (is_user_logged_in() && current_user_can('publish_clients')) {
                ?>
    <a href="<?php echo esc_url(site_url('/cabinet'))  ?>"><span <?php if (is_page('cabinet')) echo 'class = "menu_act"'; ?>>Кабинет2</span></a>
<?php  }
?>
<html>
<?php
function runMyFunction() {
    echo 'I just ran a php function';
}

if (isset($_GET['hello'])) {
    runMyFunction();
}
?>

Hello there!
<a href='index.php?hello=true'>Run PHP Function</a>
</html>
<?php
//$sql = 'UPDATE yjh_kalendar SET title="' . $title . '", start="' . $start . '", end="' . $end . '"
// , url="' . $url . '", sotr="' . $sotr . '"
// WHERE id = "' . $id . '"';
?>
