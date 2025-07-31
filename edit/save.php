<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $yaml = $_POST['config'] ?? '';
  if (!empty($yaml)) {
    $backup = '/var/www/homer/assets/config.yml.bak.' . date('Ymd-His');
    copy('/var/www/homer/assets/config.yml', $backup);
    file_put_contents('/var/www/homer/assets/config.yml', $yaml);
  }
  header('Location: /edit/?saved=1');
  exit;
}
?>
