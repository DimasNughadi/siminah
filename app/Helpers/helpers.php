<?php

function isRouteActive($routeName)
{
    return request()->route()->getName() === $routeName;
}