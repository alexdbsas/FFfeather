<?php

/**
    @version 1.0
 **/


namespace alexdbsas;

class FFfeather
{
    private \Base $f3;
    private \Template $tpl;
    private string $base;
    private string $sprite = 'feather-icon.svg';
    private string $src = 'https://unpkg.com/feather-icons/dist/feather-sprite.svg';

    public function __construct()
    {
        $this->base = __DIR__;
        $this->f3 = \Base::instance();
        $this->tpl = \Template::instance();
        $this->tpl->extend('feather', [$this, 'renderTag']);
        $this->f3->route("GET /{$this->sprite}", [$this, 'getSprite']);
    }

    public function getSprite()
    {
        $path = implode(DIRECTORY_SEPARATOR, [$this->base, $this->sprite]);
        if (!file_exists($path)) {
            $content = file_get_contents($this->src);
            file_put_contents($path, $content);
        } else {
            $content = file_get_contents($path);
        }
        $this->f3->status(200);
        header('Content-type: application/xml');
        echo ($content);
    }

    public function renderTag($args)
    {
        $attr = $args['@attrib'];
        $type = $attr['type'];
        return "<svg class=\"feather\"><use href=\"/{$this->sprite}#$type\"/></svg>";
    }
}