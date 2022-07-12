<?php

namespace Views;

class Layout
{
    public function GetHeader(): string
    {
        return <<<HTML
<header class="md-header" data-md-component="header" data-md-state="shadow">
    <nav class="md-header__inner md-grid" aria-label="Header">
        <div class="md-header__title" data-md-component="header-title" data-md-state="active">
            <div class="md-header__ellipsis">
                <div class="md-header__topic"></div>
                <div class="md-header__topic">
                      <span class="md-ellipsis">
                          Общая информация
                      </span>
                </div>
            </div>
        </div>
        <div class="md-search" data-md-component="search" role="dialog">
            <label class="md-search__overlay" for="__search"></label>
            <div class="md-search__inner" role="search">
                <form class="md-search__form" name="search">
                    <input type="text" class="md-search__input" name="query" aria-label="Поиск" placeholder="Поиск">
                    <label class="md-search__icon md-icon" for="__search">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M9.5 3A6.5 6.5 0 0 1 16 9.5c0 1.61-.59 3.09-1.56 4.23l.27.27h.79l5 5-1.5 1.5-5-5v-.79l-.27-.27A6.516 6.516 0 0 1 9.5 16 6.5 6.5 0 0 1 3 9.5 6.5 6.5 0 0 1 9.5 3m0 2C7 5 5 7 5 9.5S7 14 9.5 14 14 12 14 9.5 12 5 9.5 5z"></path>
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        </svg>
                    </label>
                </form>
            </div>
        </div>
    </nav>
</header>

HTML;
    }

    public function GetNavbar(): string
    {
        return <<<HTML
    <div>
        <nav class="nav-cat" aria-label="Администратору">
            <ul class="nav-list">
                <li class="nav-item">
                    <label class="nav-link">
                        Руководство администратора
                        <span class="nav-icon"></span>
                    </label>
                </li>
                <li class="nav-item">
                    <label class="nav-link">
                        Установка
                        <span class="nav-icon"></span>
                    </label>
                </li>
                <li class="nav-item">
                    <label class="nav-link">
                        Установка на Linux
                        <span class="nav-icon"></span>
                    </label>
                </li>
                <li class="nav-item">
                    <label class="nav-link">
                        История изменений
                        <span class="nav-icon"></span>
                    </label>
                </li>
            </ul>
        </nav>
    </div>
HTML;
    }
}
