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
    private string $base;
    private string $sprite = 'feather-icon.svg';
    private string $src = 'https://unpkg.com/feather-icons/dist/feather-sprite.svg';
    private string $path;

    public function __construct()
    {
        $this->base = __DIR__;
        $this->path = implode(DIRECTORY_SEPARATOR, [$this->base, $this->sprite]);
        if (!file_exists($this->path)) {
            $content = file_get_contents($this->src);
            file_put_contents($this->path, $content);
        }
        $this->f3 = \Base::instance();
        $this->tpl = \Template::instance();
        $this->tpl->extend('feather', [$this, 'renderTag']);
        $this->f3->route("GET /{$this->sprite}", [$this, 'getSprite']);
    }

    public function getSprite()
    {
        $this->f3->status(200);
        header('Content-type: application/xml');
        echo (file_get_contents($this->path));
    }

    public function renderTag($args)
    {
        $attr = $args['@attrib'];
        $type = $attr['type'];
        return "<svg class=\"feather\"><use href=\"/{$this->sprite}#$type\"/></svg>";
    }
}
