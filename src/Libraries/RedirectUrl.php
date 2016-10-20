<?php

namespace App\Libraries;

class RedirectUrl {

    protected $url = null;
    protected $data = null;

    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    public function setPostData($data)
    {
        $this->data = $data;

        return $this;
    }

    public function submitByGet()
    {
        $passData = json_encode($this->data);

        header("Location: $this->url?$passData");
    }

    public function submitByPost()
    {
        foreach($this->data as $key=>$item){
            $fields[$key] = urlencode($item);
        }

        return $this->process($this->url, $fields);
    }

    public function process($url, $fields)
    {
        $fields_string=null;

        //url-ify the data for the POST
        foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
        rtrim($fields_string, '&');

        //open connection
        $ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST, count($fields));
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

        //execute post
        $result = curl_exec($ch);

        //close connection
        curl_close($ch);

        // header("Location: $url");
    }
}
