<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * Short description for class.
 *
 */
class ArticlesFixture extends TestFixture
{

    /**
     * fields property
     *
     * @var array
     */
    public $fields = [
        'id' => ['type' => 'integer'],
        'author_id' => ['type' => 'integer', 'null' => true],
        'title' => ['type' => 'string', 'null' => true],
        'body' => 'text',
        'published' => ['type' => 'string', 'length' => 1, 'default' => 'N'],
        'created' => ['type' => 'timestamp', 'null' => true],
        '_constraints' => ['primary' => ['type' => 'primary', 'columns' => ['id']]]
    ];

    /**
     * records property
     *
     * @var array
     */
    public $records = [
        ['author_id' => 1, 'title' => 'First Article', 'body' => 'First Article Body', 'published' => 'Y', 'created' => '2016-03-11 03:54:47'],
        ['author_id' => 3, 'title' => 'Second Article', 'body' => 'Second Article Body', 'published' => 'Y', 'created' => '2016-03-08 04:28:49'],
        ['author_id' => 1, 'title' => 'Third Article', 'body' => 'Third Article Body', 'published' => 'Y', 'created' => '2016-03-08 05:21:40'],
        ['author_id' => 4, 'title' => 'Fourth Article', 'body' => 'Fourth Article Body', 'published' => 'N', 'created' => '2016-03-17 23:20:02'],
        ['author_id' => 4, 'title' => 'Fourth Article', 'body' => 'Error Article Body', 'published' => 'Y', 'created' => '2016-03-18 21:44:18']
    ];
}
