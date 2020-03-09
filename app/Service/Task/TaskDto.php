<?php


namespace App\Service\Task;


class TaskDto
{
    public $name;
    public $content;
    public $executorId;
    public $creatorId;
    public $image = null;

    public $limit;
    public $offset;
}