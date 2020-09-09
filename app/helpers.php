<?php

function respond()
{
    return \RServices\Response\Response::build();
}
/**
 * @return \Illuminate\Contracts\Auth\Authenticatable|null|\RServices\User
 */
function user()
{
    return auth()->user();
}
function sidebarcheck($uri)
{
    return request()->is($uri) ? 'active' : '';
}
