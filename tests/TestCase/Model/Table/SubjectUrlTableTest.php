<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SubjectUrlTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SubjectUrlTable Test Case
 */
class SubjectUrlTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SubjectUrlTable
     */
    public $SubjectUrl;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.subject_url'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('SubjectUrl') ? [] : ['className' => 'App\Model\Table\SubjectUrlTable'];
        $this->SubjectUrl = TableRegistry::get('SubjectUrl', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SubjectUrl);

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
