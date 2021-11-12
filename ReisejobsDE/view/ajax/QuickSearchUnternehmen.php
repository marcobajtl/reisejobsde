<?php
/**
 * @var array  $arrUnternehmenList
 * @var string $strID
 *
 */
?>
<div class="">

    <?php foreach($arrUnternehmenList as $arrUnternehmen): ?>
		<a class="qs-item"
		   href="Jobs?<?= $strID ?>=<?= $arrUnternehmen[0] ?>"><?= $arrUnternehmen[0] ?></a><br>
    <?php endforeach; ?>
</div>
