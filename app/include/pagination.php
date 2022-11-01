<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <li class="page-item">
        <a class="page-link" href="?page=1">Начало</a>
    </li>

    <?php if($page > 1): ?>
        <li class="page-item">
            <a class="page-link" href="?page=<?php echo ($page - 1); ?>">Предыдущая</a>
        </li>
    <?php endif; ?>

    <?php if($page < $total_pages): ?>
        <li class="page-item">
            <a class="page-link" href="?page=<?php echo ($page + 1); ?>">Следующая</a>
        </li>
    <?php endif; ?>

    <li class="page-item">
        <a class="page-link" href="?page=<?=$total_pages ?>">Конец</a>
    </li>
  </ul>
</nav>