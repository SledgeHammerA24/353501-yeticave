              <li class="lots__item lot">
                <div class="lot__image">
                    <img src="<?=$lot['URL_lot_pic'];?>" width="350" height="260" alt="<?=$lot['lot_name'];?>">
                </div>
                <div class="lot__info">
                    <span class="lot__category"><?=htmlspecialchars($lot['category']);?></span>
                    <h3 class="lot__title"><a class="text-link" href="lot.php?itemId=<?=$itemId;?>"><?=htmlspecialchars($lot['lot_name']);?></a></h3>
                    <div class="lot__state">
                        <div class="lot__rate">
                            <span class="lot__amount">Стартовая цена</span>
                            <span class="lot__cost"><?=$lot['lot_price'];?><b class="rub">р</b></span>
                        </div>
                        <div class="lot__timer timer">
                          <?=$lot_time_remaining;?>

                </div>
            </li>
