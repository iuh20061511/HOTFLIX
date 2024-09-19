<?php

class Route
{

    public function handleRoute($url)
    {
        global $routes;


        if (is_array($url)) {
            $path = implode('/', $url);
        } else {
            $path = $url;
        }

        unset($routes['default_controller']);


        $path = trim($path, '/');
        $handleUrl = $path;
        if (!empty($routes)) {
            foreach ($routes as $key => $value) {
                if (preg_match('~' . $key . '~is', $path)) {
                    $handleUrl = preg_replace('~' . $key . '~is', $value, $path);
                }
            }
        }


        return $handleUrl;


    }

}