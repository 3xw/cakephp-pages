<?php
namespace Trois\Pages\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Trois\Pages\Model\Table\PagesTable;

/**
 * Trois\Pages\Model\Table\PagesTable Test Case
 */
class PagesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Trois\Pages\Model\Table\PagesTable
     */
    public $Pages;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.trois/pages.pages',
        'plugin.trois/pages.sections',
        'plugin.trois/pages.attachments',
        'plugin.trois/pages.attachments_pages'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Pages') ? [] : ['className' => PagesTable::class];
        $this->Pages = TableRegistry::get('Pages', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Pages);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
