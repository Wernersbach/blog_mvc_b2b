<?php

namespace modules\Post\models;

use core\Model;

class PostModel extends Model
{
    public function getPosts(): array
    {
        //Aqui deve reetornar algo do banco
        return [
            ['title' => 'Post 1', 'body' => 'Conteúdo do post 1'],
            ['title' => 'Post 2', 'body' => 'Conteúdo do post 2']
        ];
    }
}