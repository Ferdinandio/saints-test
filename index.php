<?php

include 'auth.php';

$connection = mysqli_connect($host, $user, $password, $db);

if (!$connection)
{
    mysqli_error($connection);
}

$prices_table = mysqli_query($connection, "SELECT * FROM `promo_prices`");

mysqli_close($connection);

$prices_array = array();

while ($prices = mysqli_fetch_array($prices_table)) {
    $prices_array[] = $prices;
}

usort($prices_array, function ($a, $b) {
    return $b['order'] < $a['order'];
});


?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="./css/normalize.css">
    <link rel="stylesheet" href="./css/colors.css">
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/fonts.css">
    <title>saints-test</title>
</head>
<body>

    <main>

        <section class="sc-1">

            <img class="granos-1" src="./assets/images/head/granos-1.png">
            <img class="granos-2" src="./assets/images/head/granos-2.png">
            <picture>
                <img class="man" src="./assets/images/head/man.png" srcset="assets/images/head/man@2x.png 2x">
            </picture>

            <div class="wrapper wrapper-head">
                <img class="head-logo" src="./assets/images/logo/head-logo.svg">
                <h2 class="head-text">Вкладывайте незначительные<br>деньги каждый день в копилку<br>своих знаний.</h2>
                <h3 class="head-text">Следующий курс для вас будет стоить всего <b>178 рублей в день</b></h3>
                <div class="dates">
                    <div class="date">
                        <div class="date__num">01</div>
                        <div class="date__right">
                            <div class="date__month">Ноября</div>
                            <div class="date__term">Ближайший старт</div>
                        </div>
                    </div>
                    <div class="date">
                        <div class="date__num">21</div>
                        <div class="date__right">
                            <div class="date__month">Октября</div>
                            <div class="date__term">Конец акции</div>
                        </div>
                    </div>
                </div>
                <div class="buttons">
                    <button class="_scroll-to-prices head-btn">Узнать подробнее</button>
                    <button class="_scroll-to-form head-btn head-btn--transparent">Бесплатная консультация</button>
                </div>
            </div>
        </section>

        <section class="_sc-2 sc-2">
            <div class="wrapper wrapper-sc-2">

                <h2 class="h2">Выберите свой вариант обучения</h2>

                <div class="cards">
                    <? foreach ($prices_array as $price) { ?>
                        <div class="card">
                            <div class="card__title"><?=$price['title']?></div>
                            <div>
                                <div class="card__price">
                                    <span class="_strInt-to-format"><?=$price['price']?></span> ₽
                                    <?
                                        $sale = 100 - ($price['price']*100/$price['oldprice'])
                                    ?>
                                    <div class="card__discount">-<?=ceil($sale)?>%</div>
                                </div>
                            </div>
                            <div class="card__old-price">
                                <span class="_strInt-to-format"><?=$price['oldprice']?></span> ₽
                                <div class="card__across-line"></div>
                            </div>
                            <ul class="card__points">
                                <li class="card__point">
                                    <svg class="card__point-check" xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 10 10" fill="none">
                                        <path d="M1 4.06383L4.11111 9L9 1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <div class="card__point-text"><?=$price['months']?> месяца обучения</div>
                                </li>
                                <li class="card__point">
                                    <svg class="card__point-check" xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 10 10" fill="none">
                                        <path d="M1 4.06383L4.11111 9L9 1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <div class="card__point-text">Грамматическая выжимка</div>
                                </li>
                                <li class="card__point">
                                    <svg class="card__point-check" xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 10 10" fill="none">
                                        <path d="M1 4.06383L4.11111 9L9 1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <div class="card__point-text">Разговорный тренажёр</div>
                                </li>
                                <li class="card__point">
                                    <svg class="card__point-check" xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 10 10" fill="none">
                                        <path d="M1 4.06383L4.11111 9L9 1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <div class="card__point-text">Слова с ассоциациями</div>
                                </li>
                                <li class="card__point">
                                    <svg class="card__point-check" xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 10 10" fill="none">
                                        <path d="M1 4.06383L4.11111 9L9 1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <div class="card__point-text">Регулярные мини-задания</div>
                                </li>
                                <li class="card__point">
                                    <svg class="card__point-check" xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 10 10" fill="none">
                                        <path d="M1 4.06383L4.11111 9L9 1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <div class="card__point-text">Персональный куратор</div>
                                </li>
                                <li class="card__point">
                                    <svg class="card__point-check" xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 10 10" fill="none">
                                        <path d="M1 4.06383L4.11111 9L9 1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <div class="card__point-text">Сертификат об обучении</div>
                                </li>
                                <li class="card__point">
                                    <svg class="card__point-check" xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 10 10" fill="none">
                                        <path d="M1 4.06383L4.11111 9L9 1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <div class="card__point-text">Best Teachers</div>
                                </li>
                                <li class="card__point">
                                    <svg class="card__point-check" xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 10 10" fill="none">
                                        <path d="M1 4.06383L4.11111 9L9 1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <div class="card__point-text">Звонки от Second Teacher</div>
                                </li>
                            </ul>
                            <div class="card__prepay">Предоплата</div>
                            <div class="card__prepay-num">
                                <span class="_strInt-to-format"><?=$price['prepay']?></span> ₽
                            </div>
                            <a href="<?=$price['link_ru']?>" class="card__prepay-link">внести предоплату<br>из рф</a>
                            <a href="<?=$price['link_en']?>" class="card__prepay-link">внести предоплату<br>из-за границы</a>
                        </div>
                    <? } ?>
                </div>

                <div class="present">
                    <picture>
                        <img class="present__image" src="./assets/images/prices/present.jpg" srcset="./assets/images/prices/present@2x.jpg 2x">
                    </picture>
                    <div class="present__courses">
                        <div class="present__course"><b>Спецкурс</b> "Английский для эмиграции"</div>
                        <div class="present__course"><b>Спецкурс</b> "Как преодолеть языковой барьер"</div>
                    </div>
                </div>
            </div>
        </section>

        <section class="_sc-3 sc-3">
            <div class="wrapper wrapper-sc-3">

                <h3 class="h3">Еще думаете?</h3>
                
                <p class="welcome-text">Записывайтесь на бесплатный урок и попробуйте сами, это поможет принять решение</p>

                <div class="form-wrapper">
                    <form class="_form-appearance sign-up-form" action="">
                        <input class="sign-up-form__input" id="name" type="text" placeholder="Введите ваше имя">
                        <input class="sign-up-form__input" id="phone" type="tel" placeholder="Введите ваш телефон">
                        <input class="sign-up-form__input" id="email" type="email" placeholder="Введите ваш email">
                        <button class="sign-up-form__btn" id="submitBtn" type="button">записаться</button>
                    </form>
                </div>

                <div class="policy-tip">Нажимая на кнопку, вы даете согласие на обработку персональных данных и соглашаетесь с политикой конфиденциальности</div>

            </div>
        </section>

    </main>

    <footer>

        <div class="wrapper wrapper-footer">
            <img class="foot-logo" src="./assets/images/logo/foot-logo.svg">
            <div class="policy-agreement">
                <div>2015 - 2021 © English. Все права защищены. Политика конфиденциальности</div>
                <div>Соглашение об обработке персональных данных</div>
            </div>
            <div class="address">
                <div>ООО "Инглиш", юридический адрес: 000000, Санкт-Петербург, ул. Улица, д. 0/00 лит. 0, пом. 0</div>
                <div>ОГРН: 000000000000 | ИНН: 000000000 | КПП: 000000000</div>
            </div>
            <div class="social-links">
                <a href="#">
                    <img class="social-links__img" src="./assets/images/footer/vk-link.svg">
                </a>
                <a href="#">
                    <img class="social-links__img" src="./assets/images/footer/telegram-link.svg">
                </a>
            </div>
        </div>

    </footer>

    <script src="./js/main.js"></script>
</body>
</html>
