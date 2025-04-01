<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('admin/dist/img/avatar4.png') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="/admin/main" class="d-block">Smak</a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('main') }}" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Главная страница
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('categories') }}" class="nav-link">
                        <i class="nav-icon fas fa-user-plus"></i>
                        <p>
                            Категории
                        </p>
                    </a>
                </li>

{{--                <li class="nav-item">--}}
{{--                    <a href="{{ route('maps') }}" class="nav-link">--}}
{{--                        <i class="nav-icon fas fa-map-marker"></i>--}}
{{--                        <p>--}}
{{--                            Карта--}}
{{--                        </p>--}}
{{--                    </a>--}}
{{--                </li>--}}

                <li class="nav-item">
                    <a href="{{ route('dishes') }}" class="nav-link">
                        <i class="fas fa-city nav-icon"></i>
                        <p>
                            Меню
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('orders') }}" class="nav-link">
                        <i class="nav-icon fas fa-tools"></i>
                        <p>
                            История заказов
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('banners') }}" class="nav-link">
                        <i class="nav-icon fas fa-tools"></i>
                        <p>
                            Баннеры
                        </p>
                    </a>
                </li>
            </ul>
        </nav>


        <div class="logout-button">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Выход
                        </p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</aside>


{{--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>--}}

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // При клике на ссылку "Пользователи"
        $('.nav-item .nav-link').click(function () {
            // Проверяем, имеет ли ссылка класс .nav-link и содержит ли она подменю
            if ($(this).hasClass('nav-link') && $(this).next('.nav-treeview').length) {
                // Отменяем действие по умолчанию (переход по ссылке)
                event.preventDefault();

                // Переключаем класс, чтобы показать или скрыть подменю
                $(this).next('.nav-treeview').slideToggle();
            }
        });
    });
</script>
