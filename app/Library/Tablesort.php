<?php


namespace App\Library;


trait Tablesort
{
    private $return_param_str = '';
    private $sortby = '';
    private $direction = '';
    private function clear_param()
    {
        $this->return_param_str = '';
        $this->sort_param_str = '';
    }

    private function sortParam($url)
    {
        $this->clear_param();
        $getParam = parse_url($url, PHP_URL_QUERY);
        if ($getParam) {
            $arr_params = explode("&", $getParam);
            if (is_array($arr_params)){
                foreach ($arr_params as $arr_param) {
                    $this->check_param($arr_param);
                }
            }
        }

    }

    private function connecting_symbol() {
        if ($this->return_param_str != '') {
            return '&';
        }
    }

    private function connecting_sort_symbol() {
        if ($this->sort_param_str != '') {
            return '&';
        }
    }

    private function check_param($param) {
        $params = explode("=", $param);
        if ($params[0] != 'sortBy' and $params[0] != 'direction') {
            $this->return_param_str .= $this->connecting_symbol() . $params[0] . '=' . $params[1];
        }
    }

    public function getClearUrl($url) {
        $this->sortParam($url);
        return $this->return_param_str;
    }
}