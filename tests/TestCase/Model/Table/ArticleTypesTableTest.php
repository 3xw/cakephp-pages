<?php
namespace Trois\Pages\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Trois\Pages\Model\Table\ArticleTypesTable;

/**
 * Trois\Pages\Model\Table\ArticleTypesTable Test Case
 */
class ArticleTypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Trois\Pages\Model\Table\ArticleTypesTable
     */
    public $ArticleTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.trois/pages.article_types',
        'plugin.trois/pages.articles',
        'plugin.trois/pages.sections',
        'plugin.trois/pages.section_types',
        'plugin.trois/pages.section_types_article_types',
        'plugin.trois/pages.pages',
        'plugin.trois/pages.attachments',
        'plugin.trois/pages.attachments_pages',
        'plugin.trois/pages.attachments_articles'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ArticleTypes') ? [] : ['className' => ArticleTypesTable::class];
        $this->ArticleTypes = TableRegistry::get('ArticleTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ArticleTypes);

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
