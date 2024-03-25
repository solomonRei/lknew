<div class="info-bar">
    <div class="info-bar__item">
        <div class="info-bar__item-main">
            Баланс по заказам<span class="info-bar__item-value">{{ $userProfile->balance }} ¥</span>
        </div>
    </div>
    <div class="info-bar__item">
        <div class="info-bar__item-main">
            Курс ¥<span class="info-bar__item-value">13.10 ₽</span>
        </div>
        <div class="info-bar__item-side">
            15.01.2024<button class="info-bar__item-refresh" type="button">
                <svg viewBox="0 0 24 24" fill="currentColor" class="info-bar__item-icon">
                    <path
                        d="m19 8-4 4h3a6 6 0 0 1-8.8 5.3l-1.46 1.46A8 8 0 0 0 20 12h3l-4-4ZM6 12a6 6 0 0 1 8.8-5.3l1.46-1.46A8 8 0 0 0 4 12H1l4 4 4-4H6Z"
                    ></path>
                </svg>
            </button>
        </div>
    </div>
    <div class="info-bar__search">
        <form class="search">
            <input
                class="search__input"
                type="text"
                required
                placeholder="Название заказа, № заказа или позиции"
            />
            <div class="search__addon">
                <svg viewBox="0 0 24 24" fill="none" class="search__icon">
                    <g clip-path="url(#search_svg__a)">
                        <path
                            d="M15.5 14h-.79l-.28-.27a6.5 6.5 0 1 0-.7.7l.27.28v.79l5 4.99L20.49 19l-4.99-5Zm-6 0a4.5 4.5 0 1 1-.01-8.99A4.5 4.5 0 0 1 9.5 14Z"
                            fill="#989898"
                        ></path>
                    </g>
                    <defs>
                        <clipPath id="search_svg__a">
                            <path fill="#fff" d="M0 0h24v24H0z"></path>
                        </clipPath>
                    </defs>
                </svg>
            </div>
        </form>
        <label class="hamburger"
        ><span class="hamburger__bar"></span><span class="hamburger__bar"></span
            ><span class="hamburger__bar"></span
            ><input type="checkbox" id="sidebar-toggle" class="sr-only"
            /></label>
    </div>
</div>
