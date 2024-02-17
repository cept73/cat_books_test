<?php
$backLinkAttributes = isset($backUrl) ? "href='$backUrl'" : 'href="#" onclick="javascript: history.go(-1); return false"'
?>

<a class="btn btn-outline-secondary" <?= $backLinkAttributes ?>>
     <?= Yii::t('app', 'Назад') ?>
</a>
