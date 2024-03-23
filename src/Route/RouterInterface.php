<?php
namespace Ctl\Web\Route;

interface RouterInterface
{
    const CONTROLLER_REWRITE_PREFIX = 'app';
    const CONTROLLER_KEY = 'ctl';
    const CONTROLLER_NAMESPACE = 'Controller';
    const CONTROLLER_ALOWED_REGEX = '/[a-zA-Z0-9_]+/';

}