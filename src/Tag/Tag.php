<?php

namespace daib17\Tag;

use Anax\DatabaseActiveRecord\ActiveRecordModel;

/**
* A database driven model using the Active Record design pattern.
*/
class Tag extends ActiveRecordModel
{
    /**
    * @var string $tableName name of the database table.
    */
    protected $tableName = "Tag";


    /**
    * Columns in the table.
    *
    * @var integer $id primary key auto incremented.
    * @var string $name tag's name.
    * @var integer $questionid question's id.
    */
    public $id;
    public $name;
    public $questionid;


    /**
    * Return array with tags and question titles.
    *
    * @return array array with tag's name as key and question's
    *               title as value.
    */
    public function getAll() : array
    {
        $res = $this->db->connect()
                        ->select("Tag.name, Question.id, Question.title")
                        ->from("Tag")
                        ->join("Question", "Tag.questionid = Question.id")
                        ->execute()
                        ->fetchAll();

        foreach ($res as $key => $value) {
            $tagArr[$value->name][] = [
                "questionid" => $value->id,
                "title" => $value->title
            ];
        }

        return $tagArr;
    }

}
