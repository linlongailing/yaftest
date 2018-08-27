<?php
// 公共函数

// 校验用户名
function is_username($username)
{
    if (preg_match("/^[0-9a-zA-Z_\x{4e00}-\x{9fa5}]+$/u", $username)) {
        return true;
    }
    return false;
}

// 校验密码
function is_passwd($password)
{
    $total = 0;
    if (preg_match('/[0-9]+/', $password)) {
        $total += 1;
    }
    if (preg_match('/[a-zA-Z]+/', $password)) {
        $total += 1;
    }
    if (preg_match("/[_|\-|+|=|*|!|@|#|$|%|^|&|(|)|.| |,|<|>|?|{|}|[|]|~|`|:|;|'|\"]+/", $password)) {
        $total += 1;
    }
    if ($total >= 2) {
        return true;
    }
    return false;
}