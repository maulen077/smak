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
    <link rel="stylesheet" href="css/style.css?_v=2.1">
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
    <section class="hero">
        <div class="container">
            <div class="hero__container content">
                <div class="hero__slider swiper">
                    <div class="swiper-wrapper">
                        @foreach($banners as $banner)
                            <a href="{{ $banner->link ?? '#' }}" class="swiper-slide hero__slider-item">
                                <img src="{{ $banner->photo }}" alt="Banner Image">
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="hero__pagination"></div>
            </div>
        </div>
    </section>
    <section class="category">
        <div class="container">
            <div class="category__container content">
                <h2 class="category__title title">{{ __('menu.category') }}</h2>
                <div class="category__items">
                    @foreach ($categories as $category)
                        <a href="{{ route('menu', ['category_id' => $category->id]) }}"
                           class="category__item js-category-item {{ request('category_id') == $category->id ? 'active' : '' }}"
                           data-id="{{ $category->id }}">
                            <div class="category__item-img">
                                <img src="{{ asset($category->photo ?? 'img/default-category.png') }}"
                                     alt="{{ $category->name }}">
                            </div>
                            <div class="category__item-name">{{ $category->name }}</div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <section class="random">
        <div class="container">
            <div class="random__container content">
                <div class="random__block">
                    <a href="javascript:;" class="random__btn" id="randomDishBtn">
                        {{ __('menu.random_menu') }}
                    </a>
                    <div class="random__items">
                        @if($randomDishes->isNotEmpty())
                            @foreach($randomDishes as $dish)
                                <div class="random__item js-product"
                                     data-id="{{ $dish->id }}"
                                     data-product-id="{{ $dish->id }}"
                                     data-product-name="{{ $dish->name }}"
                                     data-product-desc="{{ $dish->description }}"
                                     data-product-img="{{ $dish->photo }}"
                                     data-product-price="{{ $dish->price }}"
                                     data-product-quantity="1">
                                    <img src="{{ asset($dish->photo) }}" alt="">
                                    <a href="javascript:;" class="js-buy"></a>
                                </div>
                            @endforeach
{{--                            <p>Выбрано блюдо:</p>--}}
{{--                            <div class="random__item">--}}
{{--                                <img src="{{ asset($finalDish->photo) }}" alt="">--}}
{{--                            </div>--}}
                        @else
                            <p>Нет доступных блюд.</p>
                        @endif
                    </div>
                </div>
                <p class="random__text">
                    {{ __('menu.random_text') }}
                    test comm
                </p>
            </div>
        </div>
    </section>
    <section class="recomend">
        <div class="container">
            <div class="recomend__container content">
                <h2 class="recomend__title title">{{ __('menu.recommend') }}</h2>
                <div class="recomend__items">
                    @foreach ($recommend as $dish)
                        <div class="recomend__item js-product"
                             data-product-id="{{ $dish->id }}"
                             data-product-name="{{ $dish->name }}"
                             data-product-desc="{{ $dish->description }}"
                             data-product-img="{{ $dish->photo }}"
                             data-product-price="{{ $dish->price }}"
                             data-product-quantity="1">
                            <div class="recomend__item-img">
                                <img src="{{ $dish->photo }}" alt="{{ $dish->name }}">
                            </div>
                            <div class="recomend__item-els">
                                <div class="recomend__item-name">{{ $dish->name }}</div>
                                <div class="recomend__item-desc">{{ $dish->description }}</div>
                                <div class="recomend__item-btns">
                                    <div class="recomend__item-price">{{ number_format($dish->price, 0, '', ' ') }} Т</div>
                                    <button type="button" class="recomend__item-buy js-buy">
                                        <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0.550388 5.55036C0.246417 5.55036 0 5.30394 0 4.99997C0 4.696 0.246417 4.44958 0.550388 4.44958H9.44961C9.75358 4.44958 10 4.696 10 4.99997C10 5.30394 9.75358 5.55036 9.44961 5.55036H0.550388Z" fill="#303843"/>
                                            <path d="M4.45 0.550388C4.45 0.246417 4.69642 0 5.00039 0C5.30436 0 5.55078 0.246417 5.55078 0.550388L5.55078 9.44961C5.55078 9.75358 5.30436 10 5.00039 10C4.69642 10 4.45 9.75358 4.45 9.44961L4.45 0.550388Z" fill="#303843"/>
                                        </svg>
                                    </button>
                                    <div class="recomend__item-counters js-cart-counters">
                                        <button type="button" class="recomend__item-buy js-card-plus">
                                            <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M0.550388 5.55036C0.246417 5.55036 0 5.30394 0 4.99997C0 4.696 0.246417 4.44958 0.550388 4.44958H9.44961C9.75358 4.44958 10 4.696 10 4.99997C10 5.30394 9.75358 5.55036 9.44961 5.55036H0.550388Z" fill="#303843"/>
                                                <path d="M4.45 0.550388C4.45 0.246417 4.69642 0 5.00039 0C5.30436 0 5.55078 0.246417 5.55078 0.550388L5.55078 9.44961C5.55078 9.75358 5.30436 10 5.00039 10C4.69642 10 4.45 9.75358 4.45 9.44961L4.45 0.550388Z" fill="#303843"/>
                                            </svg>
                                        </button>
                                        <span>1</span>
                                        <button type="button" class="recomend__item-buy js-card-minus">
                                            <svg width="10" height="2" viewBox="0 0 10 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1.18408 1.73114C0.90794 1.73114 0.684082 1.50728 0.684082 1.23114C0.684082 0.954998 0.90794 0.73114 1.18408 0.73114H9.26858C9.54472 0.73114 9.76858 0.954998 9.76858 1.23114C9.76858 1.50728 9.54472 1.73114 9.26858 1.73114H1.18408Z" fill="#303843"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <a href="{{ route('order') }}" class="basket__header">
        <svg width="35" height="35" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M23.2591 5.37247L24.8691 10.2083H27.7085C28.3419 10.2083 28.9677 10.3458 29.5428 10.6113C30.1178 10.8768 30.6283 11.264 31.0391 11.7462C31.4498 12.2284 31.751 12.794 31.9217 13.4039C32.0925 14.0138 32.1288 14.6536 32.028 15.2789L30.2022 25.6783C29.9904 27.0557 29.2925 28.3117 28.2348 29.2191C27.1771 30.1264 25.8295 30.6251 24.436 30.625H10.5643C9.17576 30.6267 7.83229 30.1323 6.7761 29.2309C5.7199 28.3295 5.02046 27.0805 4.80388 25.7089L2.96929 15.2483C2.87344 14.625 2.91346 13.9884 3.08662 13.382C3.25978 12.7756 3.56199 12.2138 3.97252 11.7351C4.38306 11.2565 4.89223 10.8722 5.46515 10.6086C6.03806 10.3451 6.66117 10.2085 7.29179 10.2083H10.1283L11.7397 5.37247C11.8002 5.19072 11.8959 5.02268 12.0214 4.87793C12.1469 4.73318 12.2996 4.61456 12.4709 4.52884C12.8169 4.35572 13.2175 4.32712 13.5845 4.44934C13.7662 4.50986 13.9343 4.60558 14.079 4.73104C14.2238 4.85651 14.3424 5.00925 14.4281 5.18055C14.5139 5.35186 14.565 5.53837 14.5786 5.72944C14.5923 5.92051 14.5681 6.11239 14.5076 6.29413L13.2024 10.2083H21.7964L20.4912 6.29413C20.3689 5.92709 20.3975 5.52652 20.5707 5.18055C20.7438 4.83459 21.0472 4.57156 21.4143 4.44934C21.7813 4.32712 22.1819 4.35572 22.5279 4.52884C22.8738 4.70196 23.1369 5.00542 23.2591 5.37247ZM17.5001 16.0416C16.3842 16.0416 15.3104 16.4679 14.4985 17.2335C13.6866 17.9991 13.1979 19.046 13.1324 20.16L13.1251 20.4166C13.1251 21.2819 13.3817 22.1278 13.8624 22.8473C14.3432 23.5667 15.0265 24.1275 15.8259 24.4586C16.6253 24.7897 17.505 24.8764 18.3536 24.7076C19.2023 24.5388 19.9819 24.1221 20.5937 23.5102C21.2056 22.8984 21.6222 22.1188 21.7911 21.2702C21.9599 20.4215 21.8732 19.5418 21.5421 18.7424C21.211 17.943 20.6502 17.2597 19.9307 16.779C19.2113 16.2982 18.3654 16.0416 17.5001 16.0416Z" fill="white"/>
        </svg>
        {{ __('menu.basket') }}
        <span class="js-total-header-price">0</span>
        Т
    </a>
    <div class="modal-sale active">
        <div class="modal-sale__block">
            <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M45.8334 25C45.8334 36.5058 36.5059 45.8333 25.0001 45.8333C13.4941 45.8333 4.16675 36.5058 4.16675 25C4.16675 13.4941 13.4941 4.16667 25.0001 4.16667C36.5059 4.16667 45.8334 13.4941 45.8334 25ZM25.0001 36.9792C25.863 36.9792 26.5626 36.2796 26.5626 35.4167V22.9167C26.5626 22.0538 25.863 21.3542 25.0001 21.3542C24.1372 21.3542 23.4376 22.0538 23.4376 22.9167V35.4167C23.4376 36.2796 24.1372 36.9792 25.0001 36.9792ZM25.0001 14.5833C26.1507 14.5833 27.0834 15.5161 27.0834 16.6667C27.0834 17.8173 26.1507 18.75 25.0001 18.75C23.8495 18.75 22.9167 17.8173 22.9167 16.6667C22.9167 15.5161 23.8495 14.5833 25.0001 14.5833Z" fill="#88C603"/>
            </svg>
            <p>{{ __('menu.service') }}</p>
            <button type="button" class="modal-sale__button">{{ __('menu.service_agree') }}</button>
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
<script src="js/app.js?_v=2.1"></script>
<div class="popup form_loader " id="form_loader ">
    <div class="form_loader_block ">
        <div class="form_loader_animate "></div>
        <div class="form_loader_text " style="color: #000; ">Пожалуйста, подождите</div>
    </div>
</div>
<!-- loader form -->
</body>

</html>