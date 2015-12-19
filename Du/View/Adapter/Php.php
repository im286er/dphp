<?php
namespace Du\View\Adapter;

use Du\View\Template;

class Php extends Template
{
    public $data;

    public function render($tPath, $tVars)
    {
        $path = join(DS, $tPath);
        $tpldir = VIEW_PATH . DS . $this->theme;
        $file = $tpldir . DS . $path . $this->suffix;
        if (is_file($file)) {
            $this->data = file_get_contents($file);
            $this->fileName = $tPath[2] . $this->suffix;
            $this->cacheFile = CACHE_PATH . DS . $path . $this->suffix;
            $this->buidCacheFile($this->data);
            if (is_file($this->cacheFile)) {
                extract($tVars);
                require $this->cacheFile;
            }
        }
    }

    public function getResult()
    {
        return $this->data;
    }
}