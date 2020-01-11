<div class="item">
    <b><?= $good['name'] ?></b><br>
    <img width="150" src="/img/<?= $good['image'] ?>" alt=""></a><br>
    <b>Описание:</b><br> <?= $good['description'] ?><br>
    Цена: <?= $good['price'] ?><br>
    <button class="buy" data-id="<?= $good['id'] ?>">Купить</button>
    <hr>
</div>
