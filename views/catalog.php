<h2>Каталог товаров</h2>
<div class="catalog">
	<? foreach ($goods as $good): ?>
      <div class="item">
          <a href="/api/catalogItem/">
              <b class="nameItem" id="<?= $good['id'] ?>"><?= $good['name'] ?></b><br>
              <img id="<?= $good['id'] ?>" width="150" src="/img/<?= $good['image'] ?>"
                   class="imgItem" alt=""></a><br>
          Цена: <?= $good['price'] ?><br>
          <button class="buy" id="<?= $good['id'] ?>">Купить</button>
      </div>
	<? endforeach; ?>
</div>
<div class="modalWindow"></div>
