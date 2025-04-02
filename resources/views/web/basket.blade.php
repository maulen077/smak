<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
    <title>{{ __('menu.main') }}</title>
    <!--
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css?_v=20250320171057"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.5/swiper-bundle.css?_v=20250320171057">
    <link rel="stylesheet" href="css/style.css?_v=20250320171057">
</head>

<body>
<header class="header way way-header">
    <div class="container">
        <div class="header__container">
            <a href="{{ route('index') }}" class="header__logo">
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
        <section class="basket">
            <div class="container">
                <div class="basket__container content">
                    <h2 class="basket__title title">{{ __('menu.basket') }}</h2>
                    <div class="recomend__items js-cart">
                    </div>
                    <div class="basket__total">
                        <span>{{ __('menu.total') }}</span>
                        <div class="js-total">0</div>
                    </div>

                        <form action="{{ route('order_store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="cart" id="cart-input">
                            <div class="basket__form">
                                <div class="basket__form-title">{{ __('menu.order_title') }}</div>
                                <div class="basket__form-text">
                                    {{ __('menu.order_description') }}
                                </div>
                                <input type="text" name="name" placeholder="{{ __('menu.name_placeholder') }}" required onfocus="this.form.cart.value=localStorage.getItem('SmakCart')">
                                <input type="tel" name="phone" placeholder="{{ __('menu.phone_placeholder') }}" required>

                                <div class="basket__form-deliv">
                                    <label for="deliv">
                                        <input type="radio" hidden name="delivery_type" id="deliv" value="delivery" checked>
                                        <div>
                                            <svg width="11" height="9" viewBox="0 0 11 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10.1336 1.11623C9.89917 0.881888 9.58129 0.750244 9.24983 0.750244C8.91838 0.750244 8.60049 0.881888 8.36608 1.11623L4.24983 5.23123L2.63358 3.61623L2.51608 3.51248C2.26484 3.31821 1.94908 3.22686 1.63293 3.25698C1.31677 3.2871 1.02394 3.43642 0.813893 3.67463C0.603851 3.91284 0.492355 4.22206 0.502048 4.5395C0.511741 4.85693 0.641898 5.15878 0.866083 5.38373L3.36608 7.88373L3.48358 7.98748C3.72409 8.17404 4.0244 8.26644 4.32818 8.24734C4.63197 8.22824 4.91834 8.09895 5.13358 7.88373L10.1336 2.88373L10.2373 2.76623C10.4239 2.52572 10.5163 2.22541 10.4972 1.92163C10.4781 1.61784 10.3488 1.33147 10.1336 1.11623Z" fill="white"/>
                                            </svg>
                                        </div>
                                        <span>{{ __('menu.delivery') }}</span>
                                    </label>
                                    <label for="pickup">
                                        <input type="radio" hidden name="delivery_type" id="pickup" value="pickup">
                                        <div>
                                            <svg width="11" height="9" viewBox="0 0 11 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10.1336 1.11623C9.89917 0.881888 9.58129 0.750244 9.24983 0.750244C8.91838 0.750244 8.60049 0.881888 8.36608 1.11623L4.24983 5.23123L2.63358 3.61623L2.51608 3.51248C2.26484 3.31821 1.94908 3.22686 1.63293 3.25698C1.31677 3.2871 1.02394 3.43642 0.813893 3.67463C0.603851 3.91284 0.492355 4.22206 0.502048 4.5395C0.511741 4.85693 0.641898 5.15878 0.866083 5.38373L3.36608 7.88373L3.48358 7.98748C3.72409 8.17404 4.0244 8.26644 4.32818 8.24734C4.63197 8.22824 4.91834 8.09895 5.13358 7.88373L10.1336 2.88373L10.2373 2.76623C10.4239 2.52572 10.5163 2.22541 10.4972 1.92163C10.4781 1.61784 10.3488 1.33147 10.1336 1.11623Z" fill="white"/>
                                            </svg>
                                        </div>
                                        <span>{{ __('menu.pickup') }}</span>
                                    </label>
                                </div>

                                <input type="text" name="address" class="js-street" placeholder="{{ __('menu.address_placeholder') }}">
                                <textarea name="comment" placeholder="{{ __('menu.comment_placeholder') }}"></textarea>

                                <div class="basket__time">
                                    <div class="basket__time-title">{{ __('menu.delivery_time_title') }}</div>
                                    <div class="basket__time-days">
                                        @foreach($days as $index => $day)
                                            <label for="day-{{ $index }}">
                                                <input type="radio" hidden name="delivery_date" id="day-{{ $index }}" value="{{ now()->addDays($index)->format('Y-m-d') }}" {{ $loop->first ? 'checked' : '' }}>
                                                <div>{{ $day['day'] }} <br> {{ $day['weekday'] }}</div>
                                            </label>
                                        @endforeach
                                    </div>

                                    <!-- Блок выбора времени -->
                                    <div class="basket__time-clock">
                                        @foreach($times as $index => $time)
                                            <label for="time-{{ $index }}">
                                                <input type="radio" hidden name="delivery_time" id="time-{{ $index }}" value="{{ $time }}" {{ $loop->first ? 'checked' : '' }}>
                                                <div>{{ $time }}</div>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                                <textarea hidden class="textarea-table" name="" id=""></textarea>
                                <button type="submit" class="basket__form-send">{{ __('menu.submit') }}</button>
                            </div>
                        </form>
                </div>
            </div>
        </section>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                let form = document.getElementById("order-form");
                if(form) {
                    form.addEventListener("submit", function (event) {
                        let cart = localStorage.getItem("SmakCart");
    
                        if (!cart || cart === "{}") {
                            alert("Ваша корзина пуста!");
                            event.preventDefault();
                            return;
                        }
    
                        console.log("Отправляемый cart:", cart); // Проверка в консоли
                        document.getElementById("cart-input").value = cart; // Записываем данные в скрытое поле
                    });
                }
            });
        </script>
        <div class="basket-modal">
            <div class="basket-modal__block">
                <svg width="83" height="83" viewBox="0 0 83 83" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.2918 24.9C17.2918 22.8822 18.0934 20.9469 19.5202 19.5201C20.9471 18.0933 22.8823 17.2917 24.9001 17.2917H28.3585C30.3674 17.2905 32.2944 16.4949 33.7189 15.0783L36.1397 12.6575C36.8468 11.9465 37.6874 11.3822 38.6133 10.9972C39.5391 10.6122 40.532 10.4139 41.5347 10.4139C42.5375 10.4139 43.5303 10.6122 44.4562 10.9972C45.382 11.3822 46.2227 11.9465 46.9297 12.6575L49.3505 15.0783C50.7754 16.4963 52.7051 17.2917 54.711 17.2917H58.1693C60.1872 17.2917 62.1224 18.0933 63.5492 19.5201C64.976 20.9469 65.7776 22.8822 65.7776 24.9V28.3583C65.7776 30.3642 66.573 32.2939 67.991 33.7188L70.4118 36.1396C71.1228 36.8466 71.6871 37.6873 72.0721 38.6131C72.4571 39.539 72.6554 40.5319 72.6554 41.5346C72.6554 42.5373 72.4571 43.5302 72.0721 44.456C71.6871 45.3819 71.1228 46.2225 70.4118 46.9296L67.991 49.3504C66.5744 50.7749 65.7788 52.7019 65.7776 54.7108V58.1692C65.7776 60.187 64.976 62.1222 63.5492 63.5491C62.1224 64.9759 60.1872 65.7775 58.1693 65.7775H54.711C52.702 65.7787 50.7751 66.5743 49.3505 67.9908L46.9297 70.4117C46.2227 71.1227 45.382 71.687 44.4562 72.072C43.5303 72.457 42.5375 72.6552 41.5347 72.6552C40.532 72.6552 39.5391 72.457 38.6133 72.072C37.6874 71.687 36.8468 71.1227 36.1397 70.4117L33.7189 67.9908C32.2944 66.5743 30.3674 65.7787 28.3585 65.7775H24.9001C22.8823 65.7775 20.9471 64.9759 19.5202 63.5491C18.0934 62.1222 17.2918 60.187 17.2918 58.1692V54.7108C17.2906 52.7019 16.495 50.7749 15.0785 49.3504L12.6576 46.9296C11.9466 46.2225 11.3823 45.3819 10.9973 44.456C10.6123 43.5302 10.4141 42.5373 10.4141 41.5346C10.4141 40.5319 10.6123 39.539 10.9973 38.6131C11.3823 37.6873 11.9466 36.8466 12.6576 36.1396L15.0785 33.7188C16.495 32.2942 17.2906 30.3673 17.2918 28.3583V24.9Z" fill="#88C603"/>
                    <path d="M31.125 41.5L38.0417 48.4167L51.875 34.5833" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <p>{{ __('menu.for_detail') }}</p>
            </div>
        </div>
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