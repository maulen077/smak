<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
    <title>Главная</title>
    <!--
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css?_v=20250320171057"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.5/swiper-bundle.css?_v=20250320171057">
    <link rel="stylesheet" href="css/style.css?_v=20250320171057">
</head>

<body>
<header class="header way way-header">
    <div class="container">
        <div class="header__container">
            <a href="#" class="header__logo">
                <img src="img/h-logo.png" alt="Смак">
            </a>
            <div class="header__lang">
                <a href="{{ route('lang.switch', 'ru') }}" class="header__lang-item {{ app()->getLocale() == 'ru' ? 'active' : '' }}">РУС</a>
                <a href="{{ route('lang.switch', 'kk') }}" class="header__lang-item {{ app()->getLocale() == 'kk' ? 'active' : '' }}">ҚАЗ</a>
                <a href="{{ route('lang.switch', 'en') }}" class="header__lang-item {{ app()->getLocale() == 'en' ? 'active' : '' }}">ENG</a>
            </div>
        </div>
    </div>
</header>
<div class="header-space"></div>


<main>
    <section class="image">
        <img src="img/contacts.jpg" alt="">
    </section>
    <section class="contacts">
        <div class="container">
            <div class="contacts__container content">
                <ul class="contacts__list">
                    <li class="contacts__list-item">
                        <div class="contacts__list-img">
                            <img src="img/phone.png" alt="">
                        </div>
                        <div class="contacts__list-info">
                            <div class="contacts__list-title">{{ __('menu.contact') }}</div>
                            <a href="tel:+7 747 123 45 67" class="contacts__list-link">+7 747 123 45 67</a>
                            <a href="tel:+7 747 123 45 67" class="contacts__list-link">+7 747 123 45 67</a>
                        </div>
                    </li>
                    <li class="contacts__list-item">
                        <div class="contacts__list-img">
                            <img src="img/insta.png" alt="">
                        </div>
                        <div class="contacts__list-info">
                            <a href="#" target="_blank" class="contacts__list-title">smak.group</a>
                        </div>
                    </li>
                </ul>
                <h2 class="contacts__title title">{{ __('menu.offers') }}</h2>
                <form action="">
                    <div class="contacts__form">
                        <input type="email" placeholder="Email">
                        <button type="submit">{{ __('menu.submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>
<!-- loader form -->
<footer class="footer">
    <div class="container">
        <div class="footer__container">
            <a href="{{ route('index') }}" class="footer__item active">
                <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <mask id="mask0_0_4053" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="36" height="36">
                        <rect width="36" height="36" fill="white"/>
                    </mask>
                    <g mask="url(#mask0_0_4053)">
                        <path d="M20.5004 6.8429C19.7984 6.29676 18.9344 6.00024 18.0449 6.00024C17.1555 6.00024 16.2914 6.29676 15.5894 6.8429L7.58842 13.0649C7.10759 13.4388 6.71856 13.9177 6.45106 14.4649C6.18355 15.0122 6.04463 15.6133 6.04492 16.2224V27.0224C6.04492 27.8181 6.36099 28.5811 6.9236 29.1437C7.48621 29.7063 8.24927 30.0224 9.04492 30.0224H27.0449C27.8406 30.0224 28.6036 29.7063 29.1662 29.1437C29.7289 28.5811 30.0449 27.8181 30.0449 27.0224V16.2224C30.0449 14.9879 29.4749 13.8224 28.4999 13.0649L20.5004 6.8429Z" fill="#D8D8D8"/>
                        <path d="M24 22.5C20.685 24.4995 15.312 24.4995 12 22.5" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </g>
                </svg>
                <span>{{ __('menu.main') }}</span>
            </a>
            <a href="{{ route('menu') }}" class="footer__item">
                <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <mask id="mask0_0_3084" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="36" height="36">
                        <rect width="36" height="36" fill="white"/>
                    </mask>
                    <g mask="url(#mask0_0_3084)">
                        <path d="M20.687 7.70365C19.0171 6.76545 16.9829 6.76545 15.313 7.70365L9.1216 11.1822C7.62613 12.0224 7.62613 14.1839 9.1216 15.0241L15.313 18.5026C16.9829 19.4408 19.0171 19.4408 20.687 18.5026L26.8783 15.0241C28.3738 14.1839 28.3738 12.0224 26.8783 11.1822L20.687 7.70365Z" fill="#D8D8D8"/>
                        <path d="M8.74376 21.4481C7.63903 22.4122 7.76496 24.2617 9.1216 25.024L15.313 28.5024C16.9829 29.4407 19.0171 29.4407 20.687 28.5024L26.8783 25.024C28.2351 24.2617 28.361 22.4122 27.2562 21.4481L21.4405 24.7155C19.3027 25.9167 16.6973 25.9167 14.5594 24.7155L8.74376 21.4481Z" fill="#D8D8D8"/>
                        <path d="M8.57659 16.4827C7.65608 17.4796 7.83774 19.1747 9.1216 19.896L15.313 23.3746C16.9829 24.3127 19.0171 24.3127 20.687 23.3746L26.8783 19.896C28.1622 19.1747 28.3439 17.4796 27.4234 16.4827L21.4405 19.844C19.3027 21.0451 16.6973 21.0451 14.5594 19.844L8.57659 16.4827Z" fill="#D8D8D8"/>
                    </g>
                </svg>
                <span>{{ __('menu.menu') }}</span>
            </a>
            <a href="{{ route('contact') }}" class="footer__item">
                <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M27.2799 29.0051C24.5689 31.716 17.6266 29.1688 11.7736 23.3158C5.92065 17.4629 3.37347 10.5205 6.08431 7.80961L7.8692 6.02473C9.10141 4.79251 11.1318 4.82508 12.4042 6.09748L15.1688 8.86211C16.4412 10.1345 16.4737 12.1649 15.2416 13.3971L14.8582 13.7805C14.1929 14.4458 14.1278 15.519 14.746 16.268C15.3423 16.9907 15.9851 17.7103 16.6821 18.4074C17.3791 19.1044 18.0987 19.7472 18.8213 20.3435C19.5705 20.9616 20.6437 20.8965 21.3089 20.2313L21.6923 19.8479C22.9245 18.6157 24.9549 18.6483 26.2273 19.9207L28.992 22.6852C30.2644 23.9576 30.2968 25.988 29.0647 27.2202L27.2799 29.0051Z" fill="#D8D8D8"/>
                    <path d="M25.2887 13.4438C24.9503 12.6182 24.4459 11.8447 23.7756 11.1744C23.143 10.5419 22.4187 10.0571 21.6455 9.72009" stroke="#D8D8D8" stroke-width="1.5" stroke-linecap="round"/>
                    <path d="M21.6455 5C23.4967 5.67067 25.2337 6.74809 26.7179 8.23228C28.2394 9.75373 29.3334 11.5408 29.9999 13.4443" stroke="#D8D8D8" stroke-width="1.5" stroke-linecap="round"/>
                </svg>
                <span>{{ __('menu.call') }}</span>
            </a>
        </div>
    </div>
</footer>
<!-- <script src="js/jquery-3.6.0.min.js?_v=20250320171057"></script>
<script src="js/slick.min.js?_v=20250320171057"></script> -->
<!--

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.7/jquery.inputmask.min.js?_v=20250320171057"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js?_v=20250320171057"></script> -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js?_v=20250320171057" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js?_v=20250320171057" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.5/swiper-bundle.min.js?_v=20250320171057"></script>
<!-- <script src="//cdn.jsdelivr.net/npm/jquery.marquee@1.6.0/jquery.marquee.min.js?_v=20250320171057" type="text/javascript"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.js?_v=20250320171057"></script> -->
<script src="js/app.js?_v=20250320171057"></script>
<div class="popup form_loader " id="form_loader ">
    <div class="form_loader_block ">
        <div class="form_loader_animate "></div>
        <div class="form_loader_text " style="color: #000; ">Пожалуйста, подождите</div>
    </div>
</div>
<!-- loader form -->
</body>

</html>