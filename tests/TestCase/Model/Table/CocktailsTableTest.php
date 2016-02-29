<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CocktailsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CocktailsTable Test Case
 */
class CocktailsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CocktailsTable
     */
    public $Cocktails;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.cocktails'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Cocktails') ? [] : ['className' => 'App\Model\Table\CocktailsTable'];
        $this->Cocktails = TableRegistry::get('Cocktails', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Cocktails);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
