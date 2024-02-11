<?php

namespace App\Services;

class PaginatorService
{
    /**
     * Возвращает готовый url для кнопки с номером страницы с учётом того, на какой странице находится пользователь
     * и применена ли сейчас какая-то сортировка (удаляет дублирование page)
     *
     * @param string $nextOrPrevPageUrl
     * @param string $requestUrl
     * @return string
     */
    public static function getNextOrPrevPageUrl(string $nextOrPrevPageUrl, string $requestUrl): string
    {
        if (count(explode('?', $requestUrl)) > 1) {
            $getParams = explode('?', request()->getRequestUri())[1];
            // Если переходим на другую страницу, удаляем текущую из добавляемых к url параметров сортировки
            // чтобы в url не было указано 2 разные страницы
            if (stripos($nextOrPrevPageUrl, 'page') !== false) {
                $getParams = preg_replace('/page=(\d+)/', '', $getParams);
                if ($getParams[0] === '&') {
                    $getParams = substr($getParams, 1);
                }
            }
            return $nextOrPrevPageUrl . '&' . $getParams;
        } else {
            return $nextOrPrevPageUrl;
        }
    }
}
