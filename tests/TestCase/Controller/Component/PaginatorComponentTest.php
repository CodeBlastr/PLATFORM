<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\PaginatorComponent;
use Cake\Controller\Controller;
use Cake\Controller\ComponentRegistry;
use Cake\Network\Request;
use Cake\Network\Response;
use Cake\TestSuite\TestCase;

class PagematronComponentTest extends TestCase
{

    public $component = null;
    public $controller = null;
    public $fixtures = ['app.articles'];

    public function setUp()
    {
        parent::setUp();
        // Setup our component and fake test controller
        $request = new Request();
        $response = new Response();
        $this->controller = $this->getMock(
            'Cake\Controller\Controller',
            null,
            [$request, $response]
        );
        $registry = new ComponentRegistry($this->controller);
        $this->component = new PaginatorComponent($registry);
    }

    /**
     * set get query params that should cause the paginate method to deliver the same as if you had set conditions manually
     *
     * Example
     * http://some-request/articles/index?filter[]=equals&equals[author_id][]=4&equals[published]=N
     */
    public function testPaginateFilterBad()
    {
        // set query params that should cause url get params to deliver the same as if you had set conditions manually
        try {
            $this->controller->request->query = ['filter' => 'equals', 'equals' => ['author_id' => 4, '' => 'N']];
            $this->controller->paginate('Articles');
        } catch (\PDOException $e) {
            $true = true;
        }
        $this->assertTrue($true);
    }

    /**
     * set get query params that should cause the paginate method to deliver the same as if you had set conditions manually
     *
     * Example
     * http://some-request/articles/index?filter[]=equals&equals[author_id]=1
     */
    public function testPaginateFilterEquals()
    {
        $unfiltered = $this->controller->paginate('Articles');
        $this->controller->paginate['conditions'] = ['author_id' => 1];
        $filtered = $this->controller->paginate('Articles');
        $this->controller->paginate = [];

        $count = count($unfiltered) - count($filtered);
        $this->assertTrue($count > 0); // this test is worthless if they're the same

        //
        $this->controller->request->query = ['filter' => 'equals', 'equals' => ['author_id' => 1]];
        $requested = $this->controller->paginate('Articles');
        $this->assertTrue($count == count($unfiltered) - count($requested));
    }

    /**
     * set get query params that should cause the paginate method to deliver the same as if you had set conditions manually
     *
     * Example
     * http://some-request/articles/index?filter[]=equals&equals[author_id][]=1&equals[author_id][]=4
     */
    public function testPaginateFilterEqualsSameFieldDifferentValues()
    {
        $unfiltered = $this->controller->paginate('Articles');
        $this->controller->paginate['conditions'] = ['author_id IN' => [1, 4]];
        $filtered = $this->controller->paginate('Articles');
        $this->controller->paginate = [];
        $count = count($unfiltered) - count($filtered);
        $this->assertTrue($count > 0); // this test is worthless if they're the same

        // set query params that should cause url get params to deliver the same as if you had set conditions manually
        $this->controller->request->query = ['filter' => 'equals', 'equals' => ['author_id' =>[1, 4]]];
        $requested = $this->controller->paginate('Articles');
        $this->assertTrue($count == count($unfiltered) - count($requested));
    }

    /**
     * set get query params that should cause the paginate method to deliver the same as if you had set conditions manually
     *
     * Example
     * http://some-request/articles/index?filter[]=equals&equals[author_id][]=4&equals[published]=N
     */
    public function testPaginateFilterEqualsDifferentFields()
    {
        $unfiltered = $this->controller->paginate('Articles');
        $this->controller->paginate['conditions'] = ['author_id IN' => 4, 'published IN' => 'N'];
        $filtered = $this->controller->paginate('Articles');
        $this->controller->paginate = [];
        $count = count($unfiltered) - count($filtered);
        $this->assertTrue($count > 0); // this test is worthless if they're the same

        // set query params that should cause url get params to deliver the same as if you had set conditions manually
        $this->controller->request->query = ['filter' => 'equals', 'equals' => ['author_id' => 4, 'published' => 'N']];
        $requested = $this->controller->paginate('Articles');
        $this->assertTrue($count == count($unfiltered) - count($requested));
    }

    /**
     * set get query params that should cause the paginate method to deliver the same as if you had set conditions manually
     *
     * Example
     * http://some-request/articles/index?filter=begins&begins[title]=Four
     */
    public function testPaginateFilterBegins()
    {
        $unfiltered = $this->controller->paginate('Articles');
        $this->controller->paginate['conditions'] = ['title LIKE' => 'Four%'];
        $filtered = $this->controller->paginate('Articles');
        $this->controller->paginate = [];
        $count = count($unfiltered) - count($filtered);
        $this->assertTrue($count > 0); // this test is worthless if they're the same

          //set query params that should cause url get params to deliver the same as if you had set conditions manually
        $this->controller->request->query = ['filter' => 'begins', 'begins' => ['title' => 'Four']];
        $requested = $this->controller->paginate('Articles');
        $this->assertTrue($count == count($unfiltered) - count($requested));
    }

    /**
     * set get query params that should cause the paginate method to deliver the same as if you had set conditions manually
     *
     * Example
     * http://some-request/articles/index?filter=begins&begins[title][]=Four&begins[title][]=Third
     */
    public function testPaginateFilterBeginsTwoValues()
    {
        $unfiltered = $this->controller->paginate('Articles');
        $this->controller->paginate['conditions']['OR'] = [['title LIKE' => 'Four%'], ['title LIKE' => 'Third%']];
        $filtered = $this->controller->paginate('Articles');
        $this->controller->paginate = [];
        $count = count($unfiltered) - count($filtered);
        $this->assertTrue($count > 0); // this test is worthless if they're the same

        //set query params that should cause url get params to deliver the same as if you had set conditions manually
        $this->controller->request->query = ['filter' => 'begins', 'begins' => ['title' => ['Four', 'Third']]];
        $requested = $this->controller->paginate('Articles');
        $this->assertTrue($count == count($unfiltered) - count($requested));
    }

    /**
     * set get query params that should cause the paginate method to deliver the same as if you had set conditions manually
     *
     * Example
     * http://some-request/articles/index?filter=begins&begins[title]=Four&begins[body]=Err
     */
    public function testPaginateFilterBeginsTwoFields()
    {
        $unfiltered = $this->controller->paginate('Articles');
        $this->controller->paginate['conditions'] = [['title LIKE' => 'Four%'], ['body LIKE' => 'Err%']];
        $filtered = $this->controller->paginate('Articles');
        $this->controller->paginate = [];
        $count = count($unfiltered) - count($filtered);
        $this->assertTrue($count > 0); // this test is worthless if they're the same

        //set query params that should cause url get params to deliver the same as if you had set conditions manually
        $this->controller->request->query = ['filter' => 'begins', 'begins' => ['title' => 'Four', 'body' => 'Err']];
        $requested = $this->controller->paginate('Articles');
        $this->assertTrue($count == count($unfiltered) - count($requested));
    }

    /**
     * set get query params that should cause the paginate method to deliver the same as if you had set conditions manually
     *
     * Example
     * http://some-request/articles/index?filter=begins&begins[title]=Four&begins[body][]=Err&begins[body][]=Four
     */
    public function testPaginateFilterBeginsTwoFieldsTwoValues()
    {
        $unfiltered = $this->controller->paginate('Articles');
        $this->controller->paginate['conditions'] = [['title LIKE' => 'Four%'], 'OR' => [['body LIKE' => 'Err%'], ['body LIKE' => 'Four%']]];
        $filtered = $this->controller->paginate('Articles');
        $this->controller->paginate = [];
        $count = count($unfiltered) - count($filtered);
        $this->assertTrue($count > 0); // this test is worthless if they're the same

        //set query params that should cause url get params to deliver the same as if you had set conditions manually
        $this->controller->request->query = ['filter' => 'begins', 'begins' => ['title' => 'Four', 'body' => ['Err', 'Four']]];
        $requested = $this->controller->paginate('Articles');
        $this->assertTrue($count == count($unfiltered) - count($requested));
    }

    /**
     * set get query params that should cause the paginate method to deliver the same as if you had set conditions manually
     *
     * Example
     * http://some-request/articles/index?filter[]=equals&equals[author_id][]=4&equals[published]=N
     */
    public function testPaginateFilterEqualsAndFilterBeginsTogetherComplex()
    {
        $unfiltered = $this->controller->paginate('Articles');
        $this->controller->paginate['conditions'] = ['author_id IN' => 4, 'published IN' => 'N', 'OR' => [['title LIKE' => 'Four%'], 'title LIKE' => 'Err%']];
        $filtered = $this->controller->paginate('Articles');
        $this->controller->paginate = [];
        $count = count($unfiltered) - count($filtered);
        $this->assertTrue($count > 0); // this test is worthless if they're the same

        //set query params that should cause url get params to deliver the same as if you had set conditions manually
        $this->controller->request->query = ['filter' => ['equals', 'begins'], 'begins' => ['title' => ['Four', 'Err']], 'equals' => ['author_id' => 4, 'published' => 'N']];
        $requested = $this->controller->paginate('Articles');
        $this->assertTrue($count == count($unfiltered) - count($requested));
    }

    public function tearDown()
    {
        parent::tearDown();
        // Clean up after we're done
        unset($this->component, $this->controller);
    }
}