<div class="sidebar">
    <div class="sidebar__inner">
        <div class="user">
            <div class="user__content" onclick="location.href='{{ route('profile') }}';" style="cursor: pointer;">
                <img
                    src="{{ $userProfile->avatar ? 'data:image/png;base64,' . base64_encode($userProfile->avatar) : '/static/img/ava-placeholder.svg' }}"
                    width="44"
                    height="44"
                    class="user__ava"
                    alt=""
                />
                <div class="user__caption">
                    <h3 class="user__name">{{ $userProfile->name }}</h3>
                    <p class="user__role">Пользователь</p>
                </div>
            </div>
            <nav class="user__actions">
                <a href="{{ route('user.editProfile') }}" class="user__action"
                >
                    <svg viewBox="0 0 24 24" fill="currentColor" class="user__action-icon">
                        <path
                            d="m19.44 12.99-.01.02c.04-.33.08-.67.08-1.01 0-.34-.03-.66-.07-.99l.01.02 2.44-1.92-2.43-4.22-2.87 1.16.01.01a7.67 7.67 0 0 0-1.71-1h.01L14.44 2H9.57l-.44 3.07h.01c-.62.26-1.19.6-1.71 1l.01-.01-2.88-1.17-2.44 4.22 2.44 1.92.01-.02a6.77 6.77 0 0 0 .01 2l-.01-.02-2.1 1.65-.33.26 2.43 4.2 2.88-1.15-.02-.04c.53.41 1.1.75 1.73 1.01h-.03L9.58 22h4.85l.06-.42.38-2.65h-.01c.62-.26 1.2-.6 1.73-1.01l-.02.04 2.88 1.15 2.43-4.2-.33-.26-2.11-1.66ZM12 15.5a3.5 3.5 0 1 1 0-7 3.5 3.5 0 0 1 0 7Z"
                        ></path>
                    </svg>
                </a
                ><a href="{{ route('logout') }}" class="user__action"
                >
                    <svg viewBox="0 0 24 24" fill="currentColor" class="user__action-icon">
                        <path
                            d="m17 7-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.58L17 17l5-5-5-5ZM4 5h8V3H4a2 2 0 0 0-2 2v14c0 1.1.9 2 2 2h8v-2H4V5Z"
                        ></path>
                    </svg
                    >
                </a>
            </nav>
        </div>
        <a class="button button_primary button_md add-button sidebar__create-button" href="{{ route('orders.create') }}"
           onclick="localStorage.removeItem('currentOrderId');"
        >
            <svg viewBox="0 0 24 24" fill="currentColor" class="add-button__icon">
                <path
                    d="M12 22A10 10 0 0 1 2 12v-.2A10 10 0 1 1 12 22ZM7 11v2h4v4h2v-4h4v-2h-4V7h-2v4H7Z"
                ></path>
            </svg
            >
            Создать заказ</a
        >
        <hr class="sidebar__divider"/>
        <nav class="sidebar__nav">
            <a class="sidebar__nav-link sidebar__nav-link_current" href="{{ route('orders.index') }}"
            >
                <svg viewBox="0 0 24 24" fill="currentColor" class="sidebar__nav-icon">
                    <path
                        d="M12 17.27 18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21 12 17.27Z"
                    ></path>
                </svg
                >
                Мои заказы</a
            ><a class="sidebar__nav-link" href="{{ route('orders.index') }}"
            >
                <svg viewBox="0 0 24 24" fill="currentColor" class="sidebar__nav-icon">
                    <path
                        d="M19 14V6a2 2 0 0 0-2-2H3a2 2 0 0 0-2 2v8c0 1.1.9 2 2 2h14a2 2 0 0 0 2-2Zm-9-1a3 3 0 1 1 0-6 3 3 0 0 1 0 6Zm13-6v11a2 2 0 0 1-2 2H4v-2h17V7h2Z"
                    ></path>
                </svg
                >
                Способы оплаты</a
            ><a class="sidebar__nav-link" href="#"
            >
                <svg viewBox="0 0 24 24" fill="currentColor" class="sidebar__nav-icon">
                    <path
                        d="M4 6H2v14c0 1.1.9 2 2 2h14v-2H4V6Zm16-4H8a2 2 0 0 0-2 2v12c0 1.1.9 2 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2Zm-1 9H9V9h10v2Zm-4 4H9v-2h6v2Zm4-8H9V5h10v2Z"
                    ></path>
                </svg
                >
                Новости</a
            ><a class="sidebar__nav-link" href="#"
            >
                <svg viewBox="0 0 24 24" fill="currentColor" class="sidebar__nav-icon">
                    <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M21 1H3a2 2 0 0 0-2 2v18c0 1.1.9 2 2 2h18a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2ZM7 7h10v3l4-4-4-4v3H5v6h2V7Zm10 10H7v-3l-4 4 4 4v-3h12v-6h-2v4Z"
                    ></path>
                </svg
                >
                Взаиморасчеты</a
            ><a class="sidebar__nav-link" href="#"
            >
                <svg viewBox="0 0 24 24" fill="currentColor" class="sidebar__nav-icon">
                    <path
                        d="M20 2H4a2 2 0 0 0-1.99 2L2 22l4-4h14a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2ZM8 14H6v-2h2v2Zm0-3H6V9h2v2Zm0-3H6V6h2v2Zm7 6h-5v-2h5v2Zm3-3h-8V9h8v2Zm0-3h-8V6h8v2Z"
                    ></path>
                </svg
                >
                Вопрос-ответ</a
            ><a class="sidebar__nav-link" href="#"
            >
                <svg viewBox="0 0 24 24" fill="currentColor" class="sidebar__nav-icon">
                    <path
                        d="M19 3H5a2 2 0 0 0-2 2v14c0 1.1.9 2 2 2h14a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2Zm-5.97 4.06L14.09 6l1.41 1.41L16.91 6l1.06 1.06-1.41 1.41 1.41 1.41-1.06 1.06-1.41-1.4-1.41 1.41-1.06-1.06 1.41-1.41-1.41-1.42Zm-6.78.66h5v1.5h-5v-1.5ZM11.5 16h-2v2H8v-2H6v-1.5h2v-2h1.5v2h2V16Zm6.5 1.25h-5v-1.5h5v1.5Zm0-2.5h-5v-1.5h5v1.5Z"
                    ></path>
                </svg
                >
                Калькулятор доставки</a
            >
        </nav>
    </div>
    <label for="sidebar-toggle" class="sidebar__overlay"></label>
</div>
