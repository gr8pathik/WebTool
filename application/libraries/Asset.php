<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//require_once(APPPATH . '/libraries/jsmin.php');

class Asset
{
    private $ci;

    private $styles;
    private $scripts;
    public $asset_js_path = '';
    public $asset_css_path = '';
    public $asset_img_path = '';
    public function __construct()
    {
        $this->ci =& get_instance();
        $this->styles  = array();
        $this->scripts = array();
        if(!function_exists('base_url')) $this->ci->load->helper('url');
    }

    /* set the asset path after base_url(); */
    public function set_asset_js_path($path){
        $this->asset_js_path = base_url($path);
    }

    public function set_asset_css_path($path){
        $this->asset_css_path = base_url($path);
    }

    public function set_asset_img_path($path){
        $this->asset_img_path = base_url($path);
    }

    public function img_url($path='')
    {
        return $this->asset_js_path.'/'.$path;
    }

    public function add_js_string($content)
    {
        $this->scripts[] = array(
            'path' => NULL,
            'content' => $content
        );
    }

    public function add_css_string($content)
    {
        $this->styles[] = array(
            'path' => NULL,
            'content' => $content
        );
    }

    public function add_js($path)
    {
        $this->scripts[] = array(
            'path' => $this->asset_js_path.'/'.$path,
            'content' => ''
        );
    }

    public function add_raw_js($path)
    {
        $this->scripts[] = array(
            'path' => $path,
            'content' => ''
        );
    }

    public function add_css($path)
    {
        $this->styles[] = array(
            'path' => $this->asset_css_path.'/'.$path,
            'content' => ''
        );
    }

    public function add_raw_css($path)
    {
        $this->styles[] = array(
            'path' => $path,
            'content' => ''
        );
    }

    public function add_themes_js($path, $theme, $layout = NULL)
    {
        if (isset($layout)) {
            $this->add_js(base_url('themes/' . $theme . '/assets/' . $layout . '/' . $path));
        } else {
            $this->add_js(base_url('themes/' . $theme . '/assets/' . $path));
        }
    }

    public function add_themes_css($path, $theme, $layout = NULL)
    {
        if (isset($layout)) {
            $this->add_css(base_url('themes/' . $theme . '/assets/' . $layout . '/' . $path));
        } else {
            $this->add_css(base_url('themes/' . $theme . '/assets/' . $path));
        }
    }

    public function add_module_js($path, $module)
    {
        $this->add_js(base_url('modules/' . $module . '/assets/' . $path));
    }

    public function add_module_css($path, $module)
    {
        $this->add_css(base_url('modules/' . $module . '/assets/' . $path));
    }

    private function combine_css($resources, $extension = 'css')
    {
        $long_name = '';
        foreach ($resources as $resource) {
            if (isset($resource['path'])) {
                $long_name .= $resource['path'];
            } else {
                $long_name .= $resource['content'];
            }
        }
        $md5_name  = md5($long_name);
        $file_name = BASEPATH . '../assets/caches/' . $md5_name . '.' . $extension;
        $file_url  = base_url('assets/caches/' . $md5_name . '.' . $extension);
        if (!file_exists($file_name)) {
            if (file_exists($file_name))
                unlink($file_name);
            foreach ($resources as $resource) {
                if (isset($resource['path'])) {
                    $path    = $resource['path'];
                    $content = file_get_contents($path);
                } else {
                    // write content
                    $content = $resource['content'];
                }
                $content = JSMin::minify($content);
                file_put_contents($file_name, $content, FILE_APPEND);
                file_put_contents($file_name, PHP_EOL, FILE_APPEND);
            }

        }
        return $file_url;
    }

    private function combine_js($resources, $extension = 'js')
    {
        $long_name = '';
        foreach ($resources as $resource) {
            if (isset($resource['path'])) {
                $long_name .= $resource['path'];
            } else {
                $long_name .= $resource['content'];
            }
        }
        $md5_name  = md5($long_name);
        $file_name = FCPATH . 'assets/caches/' . $md5_name . '.' . $extension;
        $file_url  = base_url('assets/caches/' . $md5_name . '.' . $extension);
        if (!file_exists($file_name)) {
            if (file_exists($file_name))
                unlink($file_name);
            foreach ($resources as $resource) {
                $content = '';
                if (isset($resource['path'])) {
                    $path = $resource['path'];
                    if (strpos($path, base_url()) == 0) {
                        $path = FCPATH. substr($path, strlen(base_url()));
                    }
                    $content = file_get_contents($path);
                } else {
                    // write content
                    $content = $resource['content'];
                }
                $content = JSMin::minify($content);
                if (strlen($content) > 0 && $content[strlen($content) - 1] != ';') {
                    $content .= ';';
                } else {
                    $content .= '/*is alright*/';
                }
                file_put_contents($file_name, $content . PHP_EOL . PHP_EOL, FILE_APPEND);
            }

        }
        return $file_url;
    }

    public function compile_css($combine = FALSE)
    {
        if ($combine) {
            $file_name    = $this->combine_css($this->styles, 'css');
            $this->styles = array();
            return '<link rel="stylesheet" type="text/css" href="' . $file_name . '" />';
        } else {
            $return = '';
            foreach ($this->styles as $style) {
                if (isset($style['path'])) {
                    $return .= '<link rel="stylesheet" type="text/css" href="' . $style['path'] . '" />';
                } else {
                    $return .= '<style type="text/css">' . $style['content'] . '</style>';
                }
            }
            $this->styles = array();
            return $return;
        }
    }

    public function compile_js($combine = FALSE)
    {
        if ($combine) {
            $file_name     = $this->combine_js($this->scripts, 'js');
            $this->scripts = array();
            return '<script type="text/javascript" src="' . $file_name . '"></script>';
        } else {
            $return = '';
            foreach ($this->scripts as $script) {
                if (isset($script['path'])) {
                    $return .= '<script type="text/javascript" src="' . $script['path'] . '"></script>';
                } else {
                    $return .= '<script type="text/javascript">' . $script['content'] . '</script>';
                }
            }
            $this->scripts = array();
            return $return;
        }
    }
}