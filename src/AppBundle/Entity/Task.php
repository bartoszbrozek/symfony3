<?php

namespace AppBundle\Entity;

class Task {

    protected $title;
    protected $date;
    protected $content;

    function getTitle() {
        return $this->title;
    }

    function getDate() {
        return $this->date;
    }

    function getContent() {
        return $this->content;
    }

    function setTitle($title) {
        $this->title = $title;
    }

    function setDate(\DateTime $date) {
        $this->date = $date;
    }

    function setContent($content) {
        $this->content = $content;
    }

}
