<?php
namespace Trois\Pages\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Trois\Pages\Model\Table\SectionsTable;

/**
 * Trois\Pages\Model\Table\SectionsTable Test Case
 */
class SectionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Trois\Pages\Model\Table\SectionsTable
     */
    public $Sections;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.trois/pages.sections',
        'plugin.trois/pages.section_types',
        'plugin.trois/pages.pages',
        'plugin.trois/pages.attachments',
        'plugin.trois/pages.attachments_pages',
        'plugin.trois/pages.articles'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Sections') ? [] : ['className' => SectionsTable::class];
        $this->Sections = TableRegistry::get('Sections', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Sections);

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
