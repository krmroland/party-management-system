<?php

function nf()
{
    try {
        return number_format(...func_get_args());
    } catch (\Exception $e) {
        return func_get_args()[0] ?: 0;
    }
}
