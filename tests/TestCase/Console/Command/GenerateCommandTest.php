<?php

namespace Origin\Test\Console\Command;

use Origin\TestSuite\OriginTestCase;
use Origin\TestSuite\ConsoleIntegrationTestTrait;

class GenerateCommandTest extends OriginTestCase
{
    use ConsoleIntegrationTestTrait;

    protected $fixtures = ['Bookmark', 'BookmarksTag', 'Tag', 'User'];

    public function testGenerateForm()
    {
        $this->exec('generate --force form Dummy');
        $this->assertExitSuccess();
        $filename = APP . DS . 'Form' . DS . 'DummyForm.php';
        $this->assertOutputContains('src/Form/DummyForm.php');
        $this->assertFileExists($filename);

        $this->assertFileHash('141c47b0116bfbcca48e2aa9cd5f23e3', $filename);
        unlink($filename);

        $filename = TESTS . DS . 'TestCase' . DS . 'Form' . DS . 'DummyFormTest.php';
        $this->assertOutputContains('TestCase/Form/DummyFormTest.php');
        $this->assertFileExists($filename);
        $this->assertFileHash('14a65c673e2b39308a293b94569bf80d', $filename);
        unlink($filename);
    }

    public function testGenerateRecord()
    {
        $this->exec('generate --force record Dummy');
        $this->assertExitSuccess();
        $filename = APP . DS . 'Model' . DS . 'Dummy.php';
        $this->assertOutputContains('src/Model/Dummy.php');
        $this->assertFileExists($filename);

        $this->assertFileHash('603600cafcb3281b7bf401505dafdc1d', $filename);
        unlink($filename);

        $filename = TESTS . DS . 'TestCase' . DS . 'Model' . DS . 'DummyTest.php';
        $this->assertOutputContains('TestCase/Model/DummyTest.php');
        $this->assertFileExists($filename);
        $this->assertFileHash('d6b5a6e8405b832a1ab5034b1cef83a1', $filename);
        unlink($filename);
    }

    public function testGenerateException()
    {
        $this->exec('generate --force exception Dummy');
        $this->assertExitSuccess();

        $filename = APP . DS . 'Exception' . DS . 'DummyException.php';
        $this->assertOutputContains('src/Exception/DummyException.php');
        $this->assertFileExists($filename);

        $this->assertFileHash('9900476d5c5d1fa3cebea05f61ae21d2', $filename);
        unlink($filename);
    }

    public function testGenerateQuery()
    {
        $this->exec('generate --force query Dummy');
        $this->assertExitSuccess();

        $filename = APP . DS . 'Model' . DS . 'Query' . DS . 'DummyQuery.php';
        $this->assertOutputContains('src/Model/Query/DummyQuery.php');
        $this->assertFileExists($filename);

        $this->assertFileHash('639d1dab1b4fb258b99150696c7d3793', $filename);
        unlink($filename);

        $filename = TESTS . DS . 'TestCase' . DS . 'Model' . DS . 'Query' . DS . 'DummyQueryTest.php';
        $this->assertOutputContains('TestCase/Model/Query/DummyQueryTest.php');
        $this->assertFileExists($filename);
        $this->assertFileHash('203105a15dfb8a5422d04f08da1499be', $filename);
        unlink($filename);
    }

    public function testScaffoldUnkownModel()
    {
        $this->exec('generate --force --connection=test scaffold Foo');
        $this->assertExitError();
        $this->assertErrorContains('Unkown model Foo');
    }
    public function testGenerateScaffold()
    {
        $this->exec('generate --force --connection=test scaffold Bookmark');

        $this->assertExitSuccess();
        /**
         * Run the generator on the bookmarks app and test its all working as accepted before changing Hashes
         */
        $this->assertFileHash('940945582b2e06f804ce18c64e12dbfa', APP . DS . 'Model' . DS . 'Bookmark.php');
        unlink(APP . DS . 'Model' . DS . 'Bookmark.php');

        $this->assertFileHash('a4ecff363c8f2847c217cc60f7c58248', APP . DS . 'Http' . DS . 'Controller' . DS . 'BookmarksController.php');
        unlink(APP . DS . 'Http' . DS .  'Controller' . DS . 'BookmarksController.php');

        $this->assertFileHash('c380851603180c386f809d2140305f09', APP . DS . 'Http' . DS . 'View' . DS . 'Bookmarks' . DS . 'add.ctp');
        unlink(APP . DS . 'Http' . DS . 'View' . DS . 'Bookmarks' . DS . 'add.ctp');

        $this->assertFileHash('4434b805eab903aab3d98ae596db828f', APP . DS . 'Http' . DS . 'View' . DS . 'Bookmarks' . DS . 'edit.ctp');
        unlink(APP . DS . 'Http' . DS . 'View' . DS . 'Bookmarks' . DS . 'edit.ctp');

        $this->assertFileHash('c8d3d6cd1474cee688f8173d1a640b08', APP . DS . 'Http' . DS . 'View' . DS . 'Bookmarks' . DS . 'index.ctp');
        unlink(APP . DS . 'Http' . DS . 'View' . DS . 'Bookmarks' . DS . 'index.ctp');

        $this->assertFileHash('d302f7dc164a50552a336aed242ba0a6', APP . DS . 'Http' . DS . 'View' . DS . 'Bookmarks' . DS . 'view.ctp');
        unlink(APP . DS . 'Http' . DS . 'View' . DS . 'Bookmarks' . DS . 'view.ctp');
    }

    public function testInvalidGenerator()
    {
        $this->exec('generate foo');
        $this->assertExitError();
        $this->assertErrorContains('Unkown generator foo');
    }

    public function testInvalidName()
    {
        $this->exec('generate command bar-foo');
        $this->assertExitError();
        $this->assertErrorContains('Invalid name format');
    }

    public function testNoName()
    {
        $this->exec('generate command');
        $this->assertExitError();
        $this->assertErrorContains('You must provide a name e.g. Single,DoubleWord');
    }

    public function testInvalidSchema()
    {
        $this->exec('generate model Foo foo bar');
        $this->assertExitError();
        $this->assertErrorContains('Invalid format for foo, should be name:type');
    }

    public function testGenerateMailbox()
    {
        $this->exec('generate --force mailbox Dummy');
        $this->assertExitSuccess();
        $filename = APP . DS . 'Mailbox' . DS . 'DummyMailbox.php';
        $this->assertOutputContains('src/Mailbox/DummyMailbox.php');
        $this->assertFileExists($filename);

        $this->assertFileHash('6cdc21e8146c6911072cb8d2b22758b1', $filename);
        unlink($filename);

        $filename = TESTS . DS . 'TestCase' . DS . 'Mailbox' . DS . 'DummyMailboxTest.php';
        $this->assertOutputContains('TestCase/Mailbox/DummyMailboxTest.php');
        $this->assertFileExists($filename);
        $this->assertFileHash('bef076b9466828abfb8cf25172d403c3', $filename);
        unlink($filename);
    }

    public function testGenerateConcernModel()
    {
        $this->exec('generate --force concern_model Dummy');
        $this->assertExitSuccess();

        $filename = APP . DS . 'Model' . DS . 'Concern' . DS . 'Dummy.php';
        $this->assertOutputContains('src/Model/Concern/Dummy.php');
        $this->assertFileExists($filename);

        $this->assertFileHash('c6a4a2fdb569b3ef936189ae824627f4', $filename);
        unlink($filename);

        $filename = TESTS . DS . 'TestCase' . DS . 'Model' . DS . 'Concern' . DS . 'DummyTest.php';
        $this->assertOutputContains('TestCase/Model/Concern/DummyTest.php');
        $this->assertFileExists($filename);
        $this->assertFileHash('5f367553d6e0bedfeb772e6deff4b9ff', $filename);
        unlink($filename);
    }

    public function testGenerateEntity()
    {
        $this->exec('generate --force entity Dummy');
        $this->assertExitSuccess();

        $filename = APP . DS . 'Model' . DS . 'Entity' . DS . 'Dummy.php';
        $this->assertOutputContains('src/Model/Entity/Dummy.php');
        $this->assertFileExists($filename);

        $this->assertFileHash('04fad3b577c8f9f19bea579100c6392d', $filename);
        unlink($filename);

        $filename = TESTS . DS . 'TestCase' . DS . 'Model' . DS . 'Entity' . DS . 'DummyTest.php';
        $this->assertOutputContains('TestCase/Model/Entity/DummyTest.php');
        $this->assertFileExists($filename);
        $this->assertFileHash('9e339462f8ed70f80d6f69f1220dc5cb', $filename);
        unlink($filename);
    }

    public function testGenerateFixture()
    {
        $this->exec('generate --force fixture Dummy');
        $this->assertExitSuccess();

        $filename = TESTS . DS . 'Fixture' . DS . 'DummyFixture.php';
        $this->assertOutputContains('Fixture/DummyFixture.php');
        $this->assertFileExists($filename);
        $this->assertFileHash('df0d25881eee0c6cefb48b1b782890dc', $filename);
        unlink($filename);
    }

    public function testGenerateConcernController()
    {
        $this->exec('generate --force concern_controller Dummy');
        $this->assertExitSuccess();

        $filename = APP . DS . 'Http' . DS . 'Controller' . DS . 'Concern' . DS . 'Dummy.php';
        $this->assertOutputContains('src/Http/Controller/Concern/Dummy.php');
        $this->assertFileExists($filename);

        $this->assertFileHash('dd9b722a1b7d7b711faece5697b85040', $filename);
        unlink($filename);

        $filename = TESTS . DS . 'TestCase' . DS . 'Http' . DS . 'Controller' . DS . 'Concern' . DS . 'DummyTest.php';
        $this->assertOutputContains('TestCase/Http/Controller/Concern/DummyTest.php');
        $this->assertFileExists($filename);
        $this->assertFileHash('ce3a0ccf541699e362b0234f7695c428', $filename);
        unlink($filename);
    }

    public function testGenerateRepository()
    {
        $this->exec('generate --force repository Dummy');
        $this->assertExitSuccess();

        $filename = APP . DS . 'Model' . DS . 'Repository' . DS . 'DummyRepository.php';
        $this->assertOutputContains('src/Model/Repository/DummyRepository.php');
        $this->assertFileExists($filename);
        $this->assertFileHash('b41bee29bcc844865a14be2a8f1ed0fd', $filename);
        unlink($filename);

        $filename = TESTS . DS . 'TestCase' . DS . 'Model' . DS . 'Repository' . DS . 'DummyRepositoryTest.php';
        $this->assertOutputContains('TestCase/Model/Repository/DummyRepositoryTest.php');
        $this->assertFileExists($filename);
        $this->assertFileHash('1220eeb65431e5e66b80fd69867492bc', $filename);
        unlink($filename);
    }

    public function testInteractive()
    {
        // this can be annoying when changes are maded
        @unlink(APP . DS . 'Model' . DS . 'Concern' . DS . 'Fooable.php');
        @unlink(TESTS . DS . 'TestCase' . DS . 'Model' . DS . 'Concern' . DS . 'FooableTest.php');

        $this->exec('generate', ['concern_model', 'Fooable']);
        $this->assertExitSuccess();

        $filename = APP . DS . 'Model' . DS . 'Concern' . DS . 'Fooable.php';
        $this->assertOutputContains('src/Model/Concern/Fooable.php');

        $this->assertFileExists($filename);
        $this->assertFileHash('321bbeb920263f5850cbe38c990bdb0e', $filename);
        unlink($filename);

        $filename = TESTS . DS . 'TestCase' . DS . 'Model' . DS . 'Concern' . DS . 'FooableTest.php';
        $this->assertFileExists($filename);
        $this->assertFileHash('04efdb5daa80ab67f9055657915e1aea', $filename);
        unlink($filename);
    }

    public function testGenerateCommand()
    {
        $this->exec('generate --force command Dummy');
        $this->assertExitSuccess();

        $filename = APP . DS . 'Console' . DS . 'Command' . DS . 'DummyCommand.php';
        $this->assertOutputContains('src/Console/Command/DummyCommand.php');

        $this->assertFileHash('a97bcafcde9885e1658e47aae3c6c2d1', $filename);
        unlink($filename);

        $filename = TESTS . DS . 'TestCase' . DS . 'Console' . DS . 'Command' . DS . 'DummyCommandTest.php';
        $this->assertOutputContains('tests/TestCase/Console/Command/DummyCommandTest.php');
        $this->assertFileExists($filename);
        $this->assertFileHash('e1d620e6a3618bc737016fb7f480a9a5', $filename);
        unlink($filename);
    }

    public function testGenerateCommandPlugin()
    {
        $this->exec('generate --force command ContactManager.Duck');
        $this->assertExitSuccess();

        $filename = PLUGINS . DS . 'contact_manager' . DS . 'src' . DS . 'Console' . DS . 'Command' . DS . 'DuckCommand.php';

        $this->assertOutputContains('contact_manager/src/Console/Command/DuckCommand.php');
        $this->assertFileHash('3645eded9e53b8b4cc2561ee4c65741c', $filename);
        unlink($filename);

        $filename = PLUGINS . DS . 'contact_manager' . DS . 'tests' . DS . 'TestCase' . DS . 'Console' . DS . 'Command' . DS . 'DuckCommandTest.php';

        $this->assertOutputContains('contact_manager/tests/TestCase/Console/Command/DuckCommandTest.php');
        $this->assertFileExists($filename);
        $this->assertFileHash('0ddd51ff7ddc1fd6757a841a920764bd', $filename);
        unlink($filename);

        $this->recursiveDelete(PLUGINS . DS . 'contact_manager');
    }

    public function testGenerateComponent()
    {
        $this->exec('generate --force component Dummy');
        $this->assertExitSuccess();
        $filename = APP . DS . 'Http' . DS . 'Controller' . DS . 'Component' . DS . 'DummyComponent.php';
        $this->assertOutputContains('src/Http/Controller/Component/DummyComponent.php');
        $this->assertFileExists($filename);
        $this->assertFileHash('aa23c61ba00c7a6b6d72f5080905e847', $filename);
        unlink($filename);

        $filename = TESTS . DS . 'TestCase' . DS . 'Http' . DS . 'Controller' . DS . 'Component' . DS . 'DummyComponentTest.php';
        $this->assertOutputContains('TestCase/Http/Controller/Component/DummyComponentTest.php');
        $this->assertFileExists($filename);
        $this->assertFileHash('4ef2ac552cbe842e012c66806b7d0b51', $filename);
        unlink($filename);
    }

    public function testGenerateController()
    {
        $this->exec('generate --force controller Dummies');
        $this->assertExitSuccess();

        $filename = APP . DS . 'Http' . DS . 'Controller' . DS . 'DummiesController.php';
        $this->assertOutputContains('src/Http/Controller/DummiesController.php');
        $this->assertFileExists($filename);

        $this->assertFileHash('e3bd4cdefe22d0ee56e0639bd4d799b9', $filename);
        unlink($filename);

        $filename = TESTS . DS . 'TestCase' . DS . 'Http' . DS . 'Controller' . DS . 'DummiesControllerTest.php';
        $this->assertOutputContains('tests/TestCase/Http/Controller/DummiesControllerTest.php');
        $this->assertFileExists($filename);

        $this->assertFileHash('559c223acadb468fb57f53795a993362', $filename);
        unlink($filename);
    }

    public function testGenerateControllerWithActions()
    {
        $this->exec('generate --force controller Dummies index get_user');
        $this->assertExitSuccess();

        $filename = APP . DS . 'Http' . DS . 'Controller' . DS . 'DummiesController.php';
        $this->assertOutputContains('src/Http/Controller/DummiesController.php');
        $this->assertFileExists($filename);

        $this->assertFileHash('760ff82986ee54521cb940870a7f8da7', $filename);
        unlink($filename);

        $filename = APP . DS . 'Http' . DS . 'View' . DS . 'Dummies' . DS . 'index.ctp';
        $this->assertOutputContains('src/Http/View/Dummies/index.ctp');
        $this->assertFileExists($filename);
        $this->assertFileHash('af90a7a0bfcd3a6ff30c0aac82c94c16', $filename);
        unlink($filename);

        $filename = APP . DS . 'Http' . DS . 'View' . DS . 'Dummies' . DS . 'get_user.ctp';
        $this->assertOutputContains('src/Http/View/Dummies/get_user.ctp');
        $this->assertFileExists($filename);
        $this->assertFileHash('9263ed82c0e1859690365808dcd719b0', $filename);
        unlink($filename);

        $filename = TESTS . DS . 'TestCase' . DS . 'Http' . DS . 'Controller' . DS . 'DummiesControllerTest.php';
        $this->assertOutputContains('tests/TestCase/Http/Controller/DummiesControllerTest.php');
        $this->assertFileExists($filename);

        $this->assertFileHash('38e759c015ae183c3b9f5e6f5153ac03', $filename);
        unlink($filename);
    }

    public function testGenerateHelper()
    {
        $this->exec('generate --force helper Dummy');
        $this->assertExitSuccess();

        $filename = APP . DS . 'Http' . DS . 'View' . DS . 'Helper' . DS . 'DummyHelper.php';
        $this->assertOutputContains('src/Http/View/Helper/DummyHelper.php');
        $this->assertFileExists($filename);
        $this->assertFileHash('b2a9c09859bc2d68b1022e61430d4422', $filename);
        unlink($filename);

        $filename = TESTS . DS . 'TestCase' . DS . 'Http' . DS . 'View' . DS . 'Helper' . DS . 'DummyHelperTest.php';

        $this->assertOutputContains('TestCase/Http/View/Helper/DummyHelperTest.php');
        $this->assertFileExists($filename);

        $this->assertFileHash('a7bed930b3d630dbceb3a1a40a96c642', $filename);
        unlink($filename);
    }

    public function testGenerateMailer()
    {
        $this->exec('generate --force mailer Dummy');
        $this->assertExitSuccess();

        $filename = APP . DS . 'Mailer' . DS . 'DummyMailer.php';
        $this->assertOutputContains('src/Mailer/DummyMailer.php');
        $this->assertFileExists($filename);

        $this->assertFileHash('f9a3b65f5a1e6fae46b71fbe56e82f63', $filename);
        unlink($filename);

        $filename = TESTS . DS . 'TestCase' . DS . 'Mailer' . DS . 'DummyMailerTest.php';

        $this->assertOutputContains('TestCase/Mailer/DummyMailerTest.php');
        $this->assertFileExists($filename);

        $this->assertFileHash('ccb1ae90ac1a5048e48863de0c5682d4', $filename);
        unlink($filename);

        $filename = APP . DS . 'Mailer' . DS . 'Template' . DS . 'dummy.html.ctp';
        $this->assertOutputContains('src/Mailer/Template/dummy.html.ctp');
        $this->assertFileHash('dcd7e3b40d5e4d840e8e2ba0a9721a81', $filename);
        unlink($filename);

        $filename = APP . DS . 'Mailer' . DS . 'Template' . DS . 'dummy.text.ctp';
        $this->assertOutputContains('src/Mailer/Template/dummy.text.ctp');
        $this->assertFileHash('b336631ad91ce8c22975f1bea7c0da4e', $filename);
        unlink($filename);
    }

    public function testGenerateModel()
    {
        $this->exec('generate --force model Dummy name:string description:text');
        $this->assertExitSuccess();

        $filename = APP . DS . 'Model' . DS . 'Dummy.php';
        $this->assertOutputContains('src/Model/Dummy.php');
        $this->assertFileExists($filename);
        $this->assertFileHash('b387ebc5275a5c389b3f08f0429e6e66', $filename);
        unlink($filename);

        $filename = TESTS . DS . 'TestCase' . DS . 'Model' . DS . 'DummyTest.php';
        $this->assertOutputContains('tests/TestCase/Model/DummyTest.php');
        $this->assertFileExists($filename);
        $this->assertFileHash('b65d4a6f35f25f6ca55ad6ac67ea1593', $filename);

        unlink($filename);

        $filename = TESTS . DS . 'Fixture' . DS . 'DummyFixture.php';
        $this->assertOutputContains('tests/Fixture/DummyFixture.php');
        $this->assertFileExists($filename);

        $this->assertFileHash('2641623321e74f683a10aa8ef170f358', $filename);
        unlink($filename);

        preg_match('/[0-9]{14}/', $this->output(), $match);
        $version = $match[0];
        $filename = DATABASE . DS . 'migrations' . DS . $version . 'CreateDummyTable.php';

        $this->assertOutputContains("database/migrations/{$version}CreateDummyTable.php");
        $this->assertFileExists($filename);
        $this->assertFileHash('c1ac45eb671fb571e313b97e4acf93d1', $filename);
        unlink($filename);
    }

    public function testGenerateMiddleware()
    {
        $this->exec('generate --force middleware Dummy');
        $this->assertExitSuccess();
        $filename = APP . DS . 'Http' . DS . 'Middleware' . DS . 'DummyMiddleware.php';
        $this->assertOutputContains('src/Http/Middleware/DummyMiddleware.php');
        $this->assertFileExists($filename);
        $this->assertFileHash('be60a9605ce0e8a6b1802fdae806e637', $filename);
        unlink($filename);

        $filename = TESTS . DS . 'TestCase' . DS . 'Http' . DS . 'Middleware' . DS . 'DummyMiddlewareTest.php';
        $this->assertOutputContains('TestCase/Http/Middleware/DummyMiddlewareTest.php');
        $this->assertFileExists($filename);
        $this->assertFileHash('87eba52a012738800230e9a9238d322d', $filename);
        unlink($filename);
    }

    public function testGenerateJob()
    {
        $this->exec('generate --force job Dummy');
        $this->assertExitSuccess();
        $filename = APP . DS . 'Job' . DS . 'DummyJob.php';
        $this->assertOutputContains('src/Job/DummyJob.php');
        $this->assertFileExists($filename);
     
        $this->assertFileHash('6ecc0febf6fa14e7301b8ebbe5131d34', $filename);
        unlink($filename);

        $filename = TESTS . DS . 'TestCase' . DS . 'Job' . DS . 'DummyJobTest.php';

        $this->assertOutputContains('TestCase/Job/DummyJobTest.php');
        $this->assertFileExists($filename);
        $this->assertFileHash('9f881b3066ffda74240dc0f71ea09d4a', $filename);
        unlink($filename);
    }

    public function testGenerateService()
    {
        $this->exec('generate --force service Dummy');
        $this->assertExitSuccess();
        $filename = APP . DS . 'Service' . DS . 'DummyService.php';
        $this->assertOutputContains('src/Service/DummyService.php');
        $this->assertFileExists($filename);

        $this->assertFileHash('6ebfbadff3bd94ddfc1df92c90fbe86e', $filename);
        unlink($filename);

        $filename = TESTS . DS . 'TestCase' . DS . 'Service' . DS . 'DummyServiceTest.php';
        $this->assertOutputContains('TestCase/Service/DummyServiceTest.php');
        $this->assertFileExists($filename);
        $this->assertFileHash('bdcd6f474b1090ccd08844eafa4b83ac', $filename);
        unlink($filename);
    }

    public function testGenerateListener()
    {
        $this->exec('generate --force listener Dummy');
        $this->assertExitSuccess();
        $filename = APP . DS . 'Listener' . DS . 'DummyListener.php';
        $this->assertOutputContains('src/Listener/DummyListener.php');
        $this->assertFileExists($filename);

        $this->assertFileHash('3b69bf530ffbf24f31a6936617642e54', $filename);
        unlink($filename);

        $filename = TESTS . DS . 'TestCase' . DS . 'Listener' . DS . 'DummyListenerTest.php';
        $this->assertOutputContains('TestCase/Listener/DummyListenerTest.php');
        $this->assertFileExists($filename);
        $this->assertFileHash('fc3a4e9567abceb7882b62bb10f64d02', $filename);
        unlink($filename);
    }

    public function testGenerateMigration()
    {
        $this->exec('generate --force migration Dummy');
        $this->assertExitSuccess();

        preg_match('/[0-9]{14}/', $this->output(), $match);
        $version = $match[0];

        $filename = DATABASE . DS . 'migrations' . DS . $version . 'Dummy.php';

        $this->assertOutputContains("database/migrations/{$version}Dummy.php");
        $this->assertFileExists($filename);
        $this->assertFileHash('7ae46d1b60868d54f09ccce43ca35068', $filename);
        unlink($filename);
    }

    public function testPlugin()
    {
        $this->exec('generate --force plugin Dummy');
        $this->assertExitSuccess();

        $filename = PLUGINS . DS . 'dummy' . DS . 'src' . DS . 'Http' . DS . 'Controller' . DS . 'DummyApplicationController.php';
        $this->assertFileExists($filename);
        $this->assertFileHash('b056004d9383d8b6cc982dbd17a1cb60', $filename);

        $filename = PLUGINS . DS . 'dummy' . DS . 'src' . DS . 'Model' . DS . 'DummyApplicationModel.php';
        $this->assertFileExists($filename);
        $this->assertFileHash('66d57a656bd1290df6358294566a0d3d', $filename);

        $filename = PLUGINS . DS . 'dummy' . DS . 'config' . DS . 'routes.php';
        $this->assertFileExists($filename);
        $this->assertFileHash('6f107423fcdde9f10e7b099f8149b3cf', $filename);

        $filename = PLUGINS . DS . 'dummy' . DS . 'phpunit.xml';
        $this->assertFileExists($filename);
        $this->assertFileHash('547d46441f0876bac9d21742def30bc4', $filename);

        $filename = PLUGINS . DS . 'dummy' . DS . 'composer.json';
        $this->assertFileExists($filename);
        $this->assertFileHash('16bab5bd917ae19aa28358a6147c9475', $filename);

        $this->recursiveDelete(PLUGINS . DS . 'dummy');
    }

    /*

        'plugin' => 'Generates a plugin skeleton',
        */

    protected function assertFileHash(string $hash, String $filename)
    {
        #echo PHP_EOL . file_get_contents($filename) . PHP_EOL;
        $this->assertEquals($hash, md5(file_get_contents($filename)));
    }

    private function recursiveDelete(string $directory)
    {
        $files = array_diff(scandir($directory), ['.', '..']);
        foreach ($files as $filename) {
            if (is_dir($directory . DS . $filename)) {
                $this->recursiveDelete($directory . DS . $filename);
                continue;
            }
            unlink($directory . DS . $filename);
        }

        return rmdir($directory);
    }
}
