<?php

/**
    @license MIT
    @version 1.0.2
 **/


namespace alexdbsas;

class FFfeather
{
    private \Base $f3;
    private \Template $tpl;
    private string $sprite = 'feather-icon.svg';
    private string $src = 'https://unpkg.com/feather-icons/dist/feather-sprite.svg';
    private string $path;

    public function __construct()
    {
        $this->f3 = \Base::instance();
        $this->path = $this->f3->get('UI') . $this->sprite;
        if (!file_exists($this->path)) {
            $content = file_get_contents($this->src);
            file_put_contents($this->path, $content);
        }
        $this->f3->route("GET /{$this->sprite}", [$this, 'getSprite'], 31536000);
        $this->tpl = \Template::instance();
        $this->tpl->extend('feather', [$this, 'renderTag']);
    }

    public function getSprite()
    {
        $cache = \Cache::instance();
        echo $this->tpl->render($this->sprite, "image/svg+xml", null, 31536000);
    }

    public function renderTag($args)
    {
        $attr = $args['@attrib'];
        $list = [];
        $classes = [];
        $type = $attr['type'];
        foreach ($attr as $key => &$value) {
            if ($key === 'class') $classes[] = $value;
            elseif ($key !== 'type') $list[] = "$key=\"$value\"";
        }
        $row = ' ' . implode(' ', $list);
        $classes = $classes ? implode(' ', $classes) : 'feather';
        return "<svg$row class=\"$classes\"><use href=\"/{$this->sprite}#$type\"/></svg>";
    }
}
