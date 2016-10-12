<?php

namespace AppBundle\Entity;

class Task {

    protected $taskName;
    protected $dueDate;

    function getTaskName() {
        return $this->taskName;
    }

    function getDueDate() {
        return $this->dueDate;
    }

    function setTaskName($taskName) {
        $this->taskName = $taskName;
    }

    function setDueDate(\DateTime $dueDate) {
        $this->dueDate = $dueDate;
    }

}
