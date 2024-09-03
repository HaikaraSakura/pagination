# pagination

ページングUIのバックエンド処理をおこなう。

```PHP
$pagination = new Pagination(
    range: 5, // いくつページ番号を表示するか。奇数のみ指定可。
    display: 10, // 一覧の表示件数
    current: 6, // 現在のページ番号
    total: 200 // 全件数
);

$pages = $pagination->getPages();
print_r($pages);
// [4, 5, 6, 7, 8]
```

ページングUIを表示する例。

```PHP
<?php

$pagination = new Pagination(
    range: 5, // いくつページ番号を表示するか。奇数のみ指定可。
    display: 10, // 一覧の表示件数
    current: 6, // 現在のページ番号
    total: 200 // 全件数
);

?>

<p>
    <?= sprintf(
        '全%s件中%s件〜%s件',
        $pagination->getTotal(),
        $pagination->getDisplayFirst(),
        $pagination->getDisplayLast()
    ) ?>
</p>

<ul>
    <li>
        <a href="./?page=1">最初へ</a>
    </li>
    <li>
        <a href="<?= $pagination->isFirst() ? 'javascript:void(0)' : "./?page={$pagination->getPrev()}" ?>">前へ</a>
    </li>

    <?php foreach($pagination as $page) : ?>
    <li class="page-num <?= $pagination->isCurrent($page) ? '-current' : ''?>">
        <a href="./?page=<?= $page ?>">$page</a>
    </li>
    <?php endforeach; ?>

    <li>
        <a href="<?= $pagination->isLast() ? 'javascript:void(0)' : "./?page={$pagination->getNext()}" ?>">次へ</a>
    </li>
    <li>
        <a href="./?page=<?= $pagination->getLast() ?>">最後へ</a>
    </li>
</ul>
```

上述の記述で、下記のHTMLが組み立てられる。

```HTML
<p>全98件中51件〜60件</p>

<ul>
    <li>
        <a href="./?page=1">最初へ</a>
    </li>
    <li>
        <a href="./?page=5">前へ</a>
    </li>
    <li class="page-num ">
        <a href="./?page=4">4</a>
    </li>
    <li class="page-num ">
        <a href="./?page=5">5</a>
    </li>
    <li class="page-num -current">
        <a href="./?page=6">6</a>
    </li>
    <li class="page-num ">
        <a href="./?page=7">7</a>
    </li>
    <li class="page-num ">
        <a href="./?page=8">8</a>
    </li>
    <li>
        <a href="./?page=7">次へ</a>
    </li>
    <li>
        <a href="./?page=10">最後へ</a>
    </li>
</ul>
```