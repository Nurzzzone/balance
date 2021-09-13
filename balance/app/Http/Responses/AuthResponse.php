<?php


namespace App\Http\Responses;


class AuthResponse
{
    public const REGISTER_SUCCESS = 'Регистрация прошла успешно!';
    public const LOGIN_SUCCESS = 'Авторизация прошла успешно!';
    public const WRONG_CREDENTIALS = 'Произошла ошибка с комбинацией пароля и адреса электронной почты. Пожалуйста, попробуйте еще раз.';
    public const USER_NOT_FOUND = 'Пользователь не найден!';
    public const UNAUTHORIZED = 'Для доступа к запрашиваемому ресурсу требуется авторизация!';
}
