<?php
namespace Trois\Pages\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Trois\Pages\Model\Table\SectionTypesTable;

/**
 * Trois\Pages\Model\Table\SectionTypesTable Test Case
 */
class SectionTypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Trois\Pages\Model\Table\SectionTypesTable
     */
    public $SectionTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.trois/pages.section_types',
        'plugin.trois/pages.sections',
        'plugin.trois/pages.pages',
        'plugin.trois/pages.attachments',
        'plugin.trois/pages.attachments_pages',
        'plugin.trois/pages.articles',
        'plugin.trois/pages.article_types',
        'plugin.trois/pages.section_types_article_types'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('SectionTypes') ? [] : ['className' => SectionTypesTable::class];
        $this->SectionTypes = TableRegistry::get('SectionTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SectionTypes);

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
