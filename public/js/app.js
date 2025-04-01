document.addEventListener('DOMContentLoaded', () => {
    let headerMenu = document.querySelector('.header__menu');
    const modalBasket = document.querySelector('.basket-modal');
    const modalSale = document.querySelector('.modal-sale');
    document.addEventListener('click', ({ target }) => {
        // burger
        if (target.classList.contains('burger')) {
            target.classList.toggle('_opened');
            headerMenu.classList.toggle('active');
        }
        if(target.closest('.basket-modal')) {
            modalBasket.classList.remove('active');
        }
        if(target.classList.contains('modal-sale__button')) {
            modalSale.classList.remove('active');
        }
    });

    // tabs menu
    const tabsCategory = document.querySelectorAll('.js-category-item');
    if(tabsCategory.length) {
        const tabsMenuItems = document.querySelectorAll('.menu__item');
        tabsCategory.forEach(category => {
            category.addEventListener('click', function(){
                tabsCategory.forEach(cat => cat.classList.remove('active'));
                const id = this.getAttribute('data-id');
                this.classList.add('active');
                tabsMenuItems.forEach(item => {
                    if(item.getAttribute('data-id') == id) {
                        item.classList.add('active');
                    } else {
                        item.classList.remove('active');
                    }
                })
            });
        });
    }

    //Корзина магазина
    function requestCart() {

        const cartDOMElement = document.querySelector('.js-cart')
        const cartItemsCounterDOMElement = document.querySelectorAll('.js-cart-total-count-items')
        const cartTotalPriceDOMElement = document.querySelectorAll('.js-cart-total-summa')
        const cart = getCart();
        //отображаем добавленный товар в корзине
        const renderCartItem = ({ id, articul, name, totalprice, price, src, quantity, href, desc }) => {
            const cartItemDOMElement = document.createElement('div');
            if (articul === null) {
                articul = '';
            }
            // totalprice = totalprice.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
            // price = price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ")
            const cartItemTemplate = `
                <div class="recomend__item-img">
                    <img src="${src}" alt="${name}">
                </div>
                <div class="recomend__item-els">
                    <div class="recomend__item-name">${name}</div>
                    <div class="recomend__item-desc">${desc}</div>
                    <div class="recomend__item-btns">
                        <div class="recomend__item-price">${price} Т</div>
                        <div class="recomend__item-counters">
                            <button type="button" class="recomend__item-buy js-plus">
                                <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0.550388 5.55036C0.246417 5.55036 0 5.30394 0 4.99997C0 4.696 0.246417 4.44958 0.550388 4.44958H9.44961C9.75358 4.44958 10 4.696 10 4.99997C10 5.30394 9.75358 5.55036 9.44961 5.55036H0.550388Z" fill="#303843"/>
                                    <path d="M4.45 0.550388C4.45 0.246417 4.69642 0 5.00039 0C5.30436 0 5.55078 0.246417 5.55078 0.550388L5.55078 9.44961C5.55078 9.75358 5.30436 10 5.00039 10C4.69642 10 4.45 9.75358 4.45 9.44961L4.45 0.550388Z" fill="#303843"/>
                                </svg>                                                                                                 
                            </button>
                            <span class="js-cart-item-quantity">${quantity}</span>
                            <button type="button" class="recomend__item-buy js-minus">
                                <svg width="10" height="2" viewBox="0 0 10 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1.18408 1.73114C0.90794 1.73114 0.684082 1.50728 0.684082 1.23114C0.684082 0.954998 0.90794 0.73114 1.18408 0.73114H9.26858C9.54472 0.73114 9.76858 0.954998 9.76858 1.23114C9.76858 1.50728 9.54472 1.73114 9.26858 1.73114H1.18408Z" fill="#303843"/>
                                </svg>                                                                                                                           
                            </button>
                        </div>
                    </div>
                </div>
            `;

            cartItemDOMElement.innerHTML = cartItemTemplate;
            cartItemDOMElement.setAttribute('data-id', id);
            cartItemDOMElement.classList.add('recomend__item', 'basket__item');
            cartDOMElement.appendChild(cartItemDOMElement);
            totalBusket();
            updateCart();
        }

        //сохраняем товар в LocalStorage
        const saveCart = () => {
            localStorage.setItem('SmakCart', JSON.stringify(cart));
        }

        // подсчитываение колличества и суммы товара
        const totalBusket = () => {
            let totalcount = 0;
            const ids = Object.keys(cart);
            for (let i = 0; i < ids.length; i++) {
                const id = ids[i]
                totalcount += +(cart[id].quantity);
            }

            let totalAll = 0;
            const price = document.querySelectorAll('.js-cart-item-totalprice span');
            for (let i = 0; i < price.length; i++) {
                totalAll = totalAll + parseInt(price[i].innerHTML.replaceAll(' ', ''));
            }

            // cartTotalPriceDOMElement.textContent = totalAll + ' тг';
            // cartTotalSummaDOMElement.textContent = total + ' тг';
            cartItemsCounterDOMElement.forEach(elem => {
                    elem.textContent = totalcount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
                })
                // Итоговая сумма всех товаров
            cartTotalPriceDOMElement.forEach(elem => {
                elem.textContent = totalAll.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ") + ' тг';
                // elem.textContent = totalAll.toString() + ' тг';
                // console.log(totalAll);
            })
            $('.js-cart-total-summa').attr('data-summ', totalAll);
            // console.log(ids.length);
            if (ids.length == 0) {
                cartTotalPriceDOMElement.forEach(elem => {
                        elem.textContent = totalAll + ' тг'
                        console.log(totalAll)
                    })
                    // cartTotalSummaDOMElement.textContent = 0;
                $('.js-cart-total-summa').attr('data-summ', 0);
            }
            updateCart();
            // checkSelectDeliv();
        }

        function totalBusketHeader() {
            let busketHeader = document.querySelector('.basket__header');
            const totalBasket = document.querySelector('.js-total');
            let totalPrice = 0;
        
            const cart = JSON.parse(localStorage.getItem('SmakCart')) || {}; // Загружаем актуальные данные
        
            const ids = Object.keys(cart);
            for (let i = 0; i < ids.length; i++) {
                const id = ids[i];
                totalPrice += Number(cart[id].totalprice);
            }
        
            // Разделение по тысячам и замена неразрывного пробела на обычный
            if(busketHeader) {
                busketHeader.querySelector('.js-total-header-price').innerHTML = totalPrice
                    .toLocaleString('ru-RU')
                    .replace(/\u00A0/g, ' ');
            
                if (ids.length >= 1) {
                    busketHeader.classList.add('active');
                    document.querySelector('body').style.paddingBottom = '150px'
                } else {
                    busketHeader.classList.remove('active');
                    document.querySelector('body').style.paddingBottom = '82px'
                }
            
                console.log("Обновленный totalPrice:", totalPrice);
            }
            if(totalBasket) {
                totalBasket.innerHTML = totalPrice.toLocaleString('ru-RU').replace(/\u00A0/g, ' ') + ' Т';
            }
        }
        totalBusketHeader();

        //Удаление из корзины
        const deleteCartItem = (id) => {
            const cartItemDOMElement = cartDOMElement.querySelector(`[data-id="${id}"]`);
            cartDOMElement.removeChild(cartItemDOMElement);
            delete cart[id];
            updateCart();
            totalBusket();
        }
            //Обновление количества товара и итоговой суммы
        const updateQuantityTotalPrice = (id, quantity) => {
            const cartItemDOMElement = cartDOMElement.querySelector(`[data-id="${id}"`);
            const cartItemQuantityDOMElement = cartItemDOMElement.querySelector('.js-cart-item-quantity');
            // const cartTotalPriceDOMElement = document.querySelector('.js-cart-total-price')
            // const cartItemPriceDOMElement = cartItemDOMElement.querySelector('.js-cart-item-totalprice span');
            const ids = Object.keys(cart);
            cart[id].quantity = quantity;
            cartItemQuantityDOMElement.textContent = quantity;
            cart[id].totalprice = cart[id].quantity * cart[id].price;
            // cartItemPriceDOMElement.textContent = cart[id].totalprice.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
            // console.log(cart[id].totalprice)
            // tableQuantity.textContent = quantity;
            // cart[id].totalprice = cart[id].quantity * cart[id].price;
            // tableTotal.textContent = cart[articul].totalprice;
            updateCart();
        }
        //Увеличение количества товара и итоговой суммы
        const increaseQuantity = (id) => {
            const newQuantity = +(cart[id].quantity) + 1;
            updateQuantityTotalPrice(id, newQuantity);
        }
        //Уменьшение количества товара и итоговой суммы
        const decreaseQuantity = (id) => {
            const newQuantity = +(cart[id].quantity) - 1;
            if (newQuantity >= 1) {
                updateQuantityTotalPrice(id, newQuantity);
            }
            if(newQuantity < 1) {
                deleteCartItem(id);
            }
        }

        const addCartItem = (data) => {
            let cart = getCart(); // Загружаем актуальный `cart` перед добавлением
            console.log("Добавление товара:", data);
        
            const { id } = data;
        
            if (cart[id]) {
                cart[id].quantity = parseInt(cart[id].quantity) + 1;
                cart[id].totalprice = cart[id].quantity * parseInt(cart[id].price);
            } else {
                cart[id] = { ...data, quantity: 1, totalprice: parseInt(data.price) };
            }
        
            saveCartPages(cart); // Сохраняем обновлённую корзину в LS
            if (cartDOMElement) {
                renderCartItem(data);
            }
            disabledButton();
            totalBusketHeader();
        };

        //Обновляем данные в LocalStorage
        const updateCart = () => {
            saveCart();
        }

        //Получаем данные для объекта
        const getProductData = (productDOMElement) => {
            const id = productDOMElement.getAttribute('data-product-id')
            const name = productDOMElement.getAttribute('data-product-name');
            const desc = productDOMElement.getAttribute('data-product-desc');
            const price = productDOMElement.getAttribute('data-product-price');
            const src = productDOMElement.getAttribute('data-product-img');
            const quantity = productDOMElement.getAttribute('data-product-quantity');
            // const quantity = 1;
            const totalprice = quantity * +(price);
            return { id, name, price, totalprice, src, quantity, desc };
        }

        const renderCart = () => {
            const ids = Object.keys(cart);
            // console.log(ids);
            ids.forEach((id) => renderCartItem(cart[id]));
        };


        function disabledButton() {
            const cart = JSON.parse(localStorage.getItem('SmakCart')) || {}; // Парсим LS один раз
            const products = document.querySelectorAll('.js-product');
        
            products.forEach(product => {
                const productId = product.getAttribute('data-product-id');
                const buyButton = product.querySelector('.js-buy');
        
                if (cart.hasOwnProperty(productId)) {
                    product.classList.add('inBasket');
        
                    const quantitySpan = product.querySelector('.js-cart-counters span');
                    console.log(product.querySelector('.js-cart-counters'));
                    console.log(product.querySelector('.js-cart-counters span'));
                    console.log(product, productId);
                    if (quantitySpan) {
                        quantitySpan.innerHTML = cart[productId].quantity;
                        // console.log(cart[productId])
                    } else {
                        console.error(`Не найден span для продукта ${productId}`);
                    }
                    if(product.classList.contains('random__item')) {
                        document.querySelector('body').classList.remove('shadow');
                        document.querySelector('.random__items').classList.remove('active', 'spinning');
                    }
                }
            });
        }
        
        disabledButton();

        function saveCartPages(cart) {
            localStorage.setItem('SmakCart', JSON.stringify(cart));
        }

        function getCart() {
            return JSON.parse(localStorage.getItem('SmakCart')) || {};
        }

        function increaseQuantityCard(productId) {
            let cart = getCart();
            
            if (!productId) {
                console.error("Ошибка: productId не определён");
                return;
            }
        
            if (cart[productId]) {
                cart[productId].quantity = parseInt(cart[productId].quantity) + 1;
                cart[productId].totalprice = cart[productId].quantity * parseInt(cart[productId].price);
            } else {
                console.warn(`Товара с ID ${productId} нет в корзине.`);
                return;
            }
        
            saveCartPages(cart);
            updateDOM(productId, cart[productId].quantity);
        }
        
        function decreaseQuantityCard(productId) {
            let cart = getCart();
            
            if (!productId) {
                console.error("Ошибка: productId не определён");
                return;
            }
        
            if (cart[productId]) {
                cart[productId].quantity = parseInt(cart[productId].quantity) - 1;
                if (cart[productId].quantity < 1) {
                    delete cart[productId];
                } else {
                    cart[productId].totalprice = cart[productId].quantity * parseInt(cart[productId].price);
                }
            } else {
                console.warn(`Товара с ID ${productId} нет в корзине.`);
                return;
            }
        
            saveCartPages(cart);
            updateDOM(productId, cart[productId] ? cart[productId].quantity : 0);
        }
        
        function updateDOM(productId, quantity) {
            const productElement = document.querySelector(`.js-product[data-product-id="${productId}"]`);
        
            if (!productElement) {
                console.warn(`Элемент с data-product-id="${productId}" не найден.`);
                return;
            }
        
            const quantitySpan = productElement.querySelector('.js-cart-counters span');
            if (quantitySpan) {
                quantitySpan.textContent = quantity;
            }
        
            if (quantity < 1) {
                productElement.classList.remove('inBasket');
                if (quantitySpan) quantitySpan.textContent = 1; // Чтоб не было пустым
            }
        }

        //Инициализация
        const cartInit = () => {
            if (cartDOMElement) {
                renderCart();
            }

            document.querySelector('body').addEventListener('click', (e) => {
                const target = e.target;
                //В корзину
                if (target.closest('.js-buy')) {
                    e.preventDefault();
                    const productDOMElement = target.closest('.js-product');
                    const data = getProductData(productDOMElement);
                    addCartItem(data);
                    disabledButton();
                    totalBusketHeader();
                    // showPopup();
                }

                //Удалить из корзины
                if (target.closest('.remove')) {
                    e.preventDefault();
                    const cartItemDOMElement = target.closest('.basket__item');
                    const productId = cartItemDOMElement.getAttribute('data-id');
                    deleteCartItem(productId);
                    // clearBusket();
                    // requestTable();
                    totalBusketHeader();
                }

                //Увеличить
                if (target.closest('.js-plus')) {
                    e.preventDefault();
                    const cartItemDOMElement = target.closest('.basket__item');
                    const productId = cartItemDOMElement.getAttribute('data-id');
                    increaseQuantity(productId);
                    totalBusket();
                    requestTable();
                    totalBusketHeader();
                }
                
                //Уменьшить
                if (target.closest('.js-minus')) {
                    e.preventDefault();
                    const cartItemDOMElement = target.closest('.basket__item');
                    const productId = cartItemDOMElement.getAttribute('data-id');
                    decreaseQuantity(productId);
                    totalBusket();
                    requestTable();
                    totalBusketHeader();
                }

                if(target.closest('.js-card-plus')) {
                    e.preventDefault();
                    const cartItemDOMElement = target.closest('.js-product');
                    const productId = cartItemDOMElement.getAttribute('data-product-id');
                    increaseQuantityCard(productId);
                    totalBusketHeader();
                }

                if(target.closest('.js-card-minus')) {
                    e.preventDefault();
                    const cartItemDOMElement = target.closest('.js-product');
                    const productId = cartItemDOMElement.getAttribute('data-product-id');
                    decreaseQuantityCard(productId);
                    totalBusketHeader();
                }
            });
        }
        cartInit();
    }
    requestCart();
    //Скрытая таблица для отправки формы
    const textarea = document.querySelector('.textarea-table');
    // const textareaID = document.querySelector('.textarea-table_2')

    function requestTable() {
         const cart = JSON.parse(localStorage.getItem('SmakCart')) || {};
         const ids = Object.keys(cart);

         let tableItem = '';
         let tableTemplate = '';
         const renderTable = () => {
             let counter = 0;
             for (let i in ids) {
                 const keys = ids[i];
                 const id = cart[keys].id;
                 const name = cart[keys].name;
                 const quantity = cart[keys].quantity;
                 const price = cart[keys].price;
                 const totalprice = cart[keys].totalprice;
                 tableItem += `
                         <tr class="order-row" style="page-break-after: always;">
                            <td>${id}</td>
                            <td>${name}</td>
                            <td>${quantity}</td>
                            <td>${price}</td>
                            <td>${totalprice}</td>
                         </tr>
                 `;
                 counter++;
                 if (counter % 9 == 0) {
                     tableTemplate += `
                     <table border="1" cellspacing="0" cellpadding="10">
                         <thead>
                             <tr>
                                <th>ID Товара</th>
                                <th>Название</th>
                                <th>Количество</th>
                                <th>Стоимость</th>
                                <th>Общая стоимость</th>
                             </tr>
                         </thead>
                         <tbody>${tableItem}</tbody>
                     </table>
                     `;
                     tableItem = '';
                 }
             }
             tableTemplate += `
                 <table border="1" cellspacing="0" cellpadding="10">
                     <thead>
                         <tr>
                            <th>ID Товара</th>
                            <th>Название</th>
                            <th>Количество</th>
                            <th>Стоимость</th>
                            <th>Общая стоимость</th>
                         </tr>
                     </thead>
                     <tbody>${tableItem}</tbody>
                 </table>
             `;
             textarea.innerHTML = tableTemplate;
         }
         renderTable();
    }

    if (textarea) {
         requestTable();
    }

    // random menu
    const randomMenuBtn = document.querySelector('.random__btn');

    if (randomMenuBtn) {
        const randomItems = document.querySelector('.random__items');
        const body = document.querySelector('body');

        randomMenuBtn.addEventListener('click', () => {
            if (randomItems.classList.contains('active')) {
                // Если блок открыт → скрываем его
                const animateOut = randomItems.animate([
                    { opacity: 1 },
                    { opacity: 0 }
                ], { duration: 300, easing: 'ease-in-out' });
        
                animateOut.addEventListener('finish', () => {
                    randomItems.classList.remove('active', 'spinning');
                    body.classList.remove('shadow');
                    randomItems.style.transform = 'rotate(180deg)'; // Сбрасываем позицию
                });
        
            } else {
                body.classList.add('shadow');
                randomItems.classList.add('active');
        
                const animateIn = randomItems.animate([
                    { opacity: 0 },
                    { opacity: 1 }
                ], { duration: 300, easing: 'ease-in-out' });
                randomItems.classList.add('spinning'); 
            }
        });
        document.addEventListener('click', ({target}) => {
            if(target.classList.contains('shadow')) {
                body.classList.remove('shadow');
                randomItems.classList.remove('active', 'spinning');
                randomMenuBtn.classList.remove('active');
            }
        })
    };

        // basket delivery 
        const typeDeliv = document.querySelector('.basket__form-deliv');
        if (typeDeliv) {
            const inputStreet = document.querySelector('.js-street');
            const radioDelivery = typeDeliv.querySelectorAll('input');
            radioDelivery.forEach(radio => {
                radio.addEventListener('change', () => {
                    if (radio.checked && radio.id === 'deliv') {
                        inputStreet.style.display = 'block';
                    } else {
                        inputStreet.style.display = 'none';
                    }
                });
            });
        }
});

window.onload = () => {
    // $.fn.setCursorPosition = function(pos) {
    //     if ($(this).get(0).setSelectionRange) {
    //         $(this).get(0).setSelectionRange(pos, pos)
    //     } else if ($(this).get(0).createTextRange) {
    //         var range = $(this).get(0).createTextRange()
    //         range.collapse(true)
    //         range.moveEnd('character', pos)
    //         range.moveStart('character', pos)
    //         range.select()
    //     }
    // }
    // $('input[type="tel"]').on('click', function() {
    //     $(this).setCursorPosition(3)
    // }).mask('+7 (999) 999 99 99')

    // $('.way').waypoint({
    //     handler: function() {
    //         $(this.element).addClass("way--active");

    //     },
    //     offset: '88%'
    // });
    const heroSlider = new Swiper('.hero__slider', {
        spaceBetween: 15,
        slidesPerView: 'auto',
        autoplay: {
            enabled: true,
            delay: 2000,
        },
        pagination: {
            el: ".hero__pagination",
        },
    });
};

// loader func
function submitForm() {
    // $('#form_loader').show();
    const busket = document.querySelector('.basket')
    if (busket) {
        clearLocalStorage();
    }
}

function clearLocalStorage() {
    localStorage.removeItem('SmakCart');
}

//Alert form
let alertt = document.querySelector(".alert--fixed");
let alertClose = document.querySelectorAll(".alert--close")
for (let item of alertClose) {
    item.addEventListener('click', function(event) {
        alertt.classList.remove("alert--active")
        alertt.classList.remove("alert--warning")
        alertt.classList.remove("alert--error")
    })
}