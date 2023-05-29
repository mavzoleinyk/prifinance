<?php
$last_page = empty($args['last_page']) ? 1 : $args['last_page'];
$page = get_requested_page();
if ($last_page < 2) return;
?>
<div class="paginations">
  <ul class="pagination list-unstyled">
    <?php for ($loop_page = 1; $loop_page <= $last_page; $loop_page++) {
      $active = ($loop_page == $page) ? ' active' : '';
      $href = ($loop_page == $page) ? '' : ' href="' . add_query_arg(['_page' => $loop_page]) . '"';
      ?>
      <li class="<?= $active ?>">
        <a<?= $href ?>><?= $loop_page ?></a>
      </li>
    <?php } ?>
  </ul>
</div>
<?php /*?>
<div class="pagination__nav">
  <?php $disabled = ($page == 1) ? ' disabled' : ''; ?>
  <a href="<?= add_query_arg(['_page' => $page - 1]) ?>" class="pagination__prev<?= $disabled ?>"></a>
  <?php $disabled = ($page == $last_page) ? ' disabled' : ''; ?>
  <a href="<?= add_query_arg(['_page' => $page + 1]) ?>" class="pagination__next<?= $disabled ?>"></a>
</div>
<?php  */?>
