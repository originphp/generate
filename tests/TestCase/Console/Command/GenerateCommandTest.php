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

        $this->assertFileHash('436d97ead15103c5a9c2addf5229f8ef', $filename);
        unlink($filename);

        $filename = TESTS . DS . 'TestCase' . DS . 'Form' . DS . 'DummyFormTest.php';
        $this->assertOutputContains('TestCase/Form/DummyFormTest.php');
        $this->assertFileExists($filename);
        $this->assertFileHash('6a17ca609cace937480e0f4c3a4de1a8', $filename);
        unlink($filename);
    }

    public function testGenerateRecord()
    {
        $this->exec('generate --force record Dummy');
        $this->assertExitSuccess();
        $filename = APP . DS . 'Model' . DS . 'Dummy.php';
        $this->assertOutputContains('src/Model/Dummy.php');
        $this->assertFileExists($filename);

        $this->assertFileHash('007423ae04f0cb6c96a0b03699870b8c', $filename);
        unlink($filename);

        $filename = TESTS . DS . 'TestCase' . DS . 'Model' . DS . 'DummyTest.php';
        $this->assertOutputContains('TestCase/Model/DummyTest.php');
        $this->assertFileExists($filename);
        $this->assertFileHash('af5649ea9ae228c2c9293977c7601939', $filename);
        unlink($filename);
    }

    public function testGenerateException()
    {
        $this->exec('generate --force exception Dummy');
        $this->assertExitSuccess();

        $filename = APP . DS . 'Exception' . DS . 'DummyException.php';
        $this->assertOutputContains('src/Exception/DummyException.php');
        $this->assertFileExists($filename);

        $this->assertFileHash('cbf86eab8e2adb5f235e7998e9d978eb', $filename);
        unlink($filename);
    }

    public function testGenerateQuery()
    {
        $this->exec('generate --force query Dummy');
        $this->assertExitSuccess();

        $filename = APP . DS . 'Model' . DS . 'Query' . DS . 'DummyQuery.php';
        $this->assertOutputContains('src/Model/Query/DummyQuery.php');
        $this->assertFileExists($filename);

        $this->assertFileHash('7552cac2736c71536a87559bc278e15a', $filename);
        unlink($filename);

        $filename = TESTS . DS . 'TestCase' . DS . 'Model' . DS . 'Query' . DS . 'DummyQueryTest.php';
        $this->assertOutputContains('TestCase/Model/Query/DummyQueryTest.php');
        $this->assertFileExists($filename);
        $this->assertFileHash('eaffdd177e49da7de2c106ee155e8dfb', $filename);
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
        $this->assertFileHash('09bcd78360d288010d02eddeb232dd65', APP . DS . 'Model' . DS . 'Bookmark.php');
        unlink(APP . DS . 'Model' . DS . 'Bookmark.php');

        $this->assertFileHash('1e2278a2c43a0d9eb0dc5db550887a0e', APP . DS . 'Http' . DS . 'Controller' . DS . 'BookmarksController.php');
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

        $this->assertFileHash('4e3593cb0d6cf0d02a1f7923acfb7e49', $filename);
        unlink($filename);

        $filename = TESTS . DS . 'TestCase' . DS . 'Mailbox' . DS . 'DummyMailboxTest.php';
        $this->assertOutputContains('TestCase/Mailbox/DummyMailboxTest.php');
        $this->assertFileExists($filename);
        $this->assertFileHash('c38fe8005b490e0ffdd9b01c3971d6f1', $filename);
        unlink($filename);
    }

    public function testGenerateConcernModel()
    {
        $this->exec('generate --force concern_model Dummy');
        $this->assertExitSuccess();

        $filename = APP . DS . 'Model' . DS . 'Concern' . DS . 'Dummy.php';
        $this->assertOutputContains('src/Model/Concern/Dummy.php');
        $this->assertFileExists($filename);

        $this->assertFileHash('e63fc14f861432206e10e1f64f8a1456', $filename);
        unlink($filename);

        $filename = TESTS . DS . 'TestCase' . DS . 'Model' . DS . 'Concern' . DS . 'DummyTest.php';
        $this->assertOutputContains('TestCase/Model/Concern/DummyTest.php');
        $this->assertFileExists($filename);
        $this->assertFileHash('11656e9ad64da41c8b2946b75f268388', $filename);
        unlink($filename);
    }

    public function testGenerateEntity()
    {
        $this->exec('generate --force entity Dummy');
        $this->assertExitSuccess();

        $filename = APP . DS . 'Model' . DS . 'Entity' . DS . 'Dummy.php';
        $this->assertOutputContains('src/Model/Entity/Dummy.php');
        $this->assertFileExists($filename);

        $this->assertFileHash('e337290911498dc7fc9234137252d111', $filename);
        unlink($filename);

        $filename = TESTS . DS . 'TestCase' . DS . 'Model' . DS . 'Entity' . DS . 'DummyTest.php';
        $this->assertOutputContains('TestCase/Model/Entity/DummyTest.php');
        $this->assertFileExists($filename);
        $this->assertFileHash('265ac5b27cd822add217b53beaa8d872', $filename);
        unlink($filename);
    }

    public function testGenerateFixture()
    {
        $this->exec('generate --force fixture Dummy');
        $this->assertExitSuccess();

        $filename = TESTS . DS . 'Fixture' . DS . 'DummyFixture.php';
        $this->assertOutputContains('Fixture/DummyFixture.php');
        $this->assertFileExists($filename);
        $this->assertFileHash('32f2c54ebecba70e02a93fb4a58ffba6', $filename);
        unlink($filename);
    }

    public function testGenerateConcernController()
    {
        $this->exec('generate --force concern_controller Dummy');
        $this->assertExitSuccess();

        $filename = APP . DS . 'Http' . DS . 'Controller' . DS . 'Concern' . DS . 'Dummy.php';
        $this->assertOutputContains('src/Http/Controller/Concern/Dummy.php');
        $this->assertFileExists($filename);

        $this->assertFileHash('0565a2bb1e59c1a32d33ec4cb2e007b4', $filename);
        unlink($filename);

        $filename = TESTS . DS . 'TestCase' . DS . 'Http' . DS . 'Controller' . DS . 'Concern' . DS . 'DummyTest.php';
        $this->assertOutputContains('TestCase/Http/Controller/Concern/DummyTest.php');
        $this->assertFileExists($filename);
        $this->assertFileHash('d8de7f7c0d349d52c9376696a1dd87d7', $filename);
        unlink($filename);
    }

    public function testGenerateRepository()
    {
        $this->exec('generate --force repository Dummy');
        $this->assertExitSuccess();

        $filename = APP . DS . 'Model' . DS . 'Repository' . DS . 'DummyRepository.php';
        $this->assertOutputContains('src/Model/Repository/DummyRepository.php');
        $this->assertFileExists($filename);
        $this->assertFileHash('2b472a9cb98e8f871292742d3c49eb2b', $filename);
        unlink($filename);

        $filename = TESTS . DS . 'TestCase' . DS . 'Model' . DS . 'Repository' . DS . 'DummyRepositoryTest.php';
        $this->assertOutputContains('TestCase/Model/Repository/DummyRepositoryTest.php');
        $this->assertFileExists($filename);
        $this->assertFileHash('7f0871f71bf0fb50f8eddaf2bfabab37', $filename);
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
        $this->assertFileHash('e3fd428ea40551f4a670aadbe792214c', $filename);
        unlink($filename);

        $filename = TESTS . DS . 'TestCase' . DS . 'Model' . DS . 'Concern' . DS . 'FooableTest.php';
        $this->assertFileExists($filename);
        $this->assertFileHash('3e9c11bb53f1735aad0e57426a97f4bd', $filename);
        unlink($filename);
    }

    public function testGenerateCommand()
    {
        $this->exec('generate --force command Dummy');
        $this->assertExitSuccess();

        $filename = APP . DS . 'Console' . DS . 'Command' . DS . 'DummyCommand.php';
        $this->assertOutputContains('src/Console/Command/DummyCommand.php');

        $this->assertFileHash('a92eaea0033f55f82adbb5af1eb23d35', $filename);
        unlink($filename);

        $filename = TESTS . DS . 'TestCase' . DS . 'Console' . DS . 'Command' . DS . 'DummyCommandTest.php';
        $this->assertOutputContains('tests/TestCase/Console/Command/DummyCommandTest.php');
        $this->assertFileExists($filename);
        $this->assertFileHash('cbdb87a705d3989afac56f62cbeea3a2', $filename);
        unlink($filename);
    }

    public function testGenerateCommandPlugin()
    {
        $this->exec('generate --force command ContactManager.Duck');
        $this->assertExitSuccess();

        $filename = PLUGINS . DS . 'contact_manager' . DS . 'src' . DS . 'Console' . DS . 'Command' . DS . 'DuckCommand.php';

        $this->assertOutputContains('contact_manager/src/Console/Command/DuckCommand.php');
        $this->assertFileHash('d473ea0a5adeb413159988e43c6a49c4', $filename);
        unlink($filename);

        $filename = PLUGINS . DS . 'contact_manager' . DS . 'tests' . DS . 'TestCase' . DS . 'Console' . DS . 'Command' . DS . 'DuckCommandTest.php';

        $this->assertOutputContains('contact_manager/tests/TestCase/Console/Command/DuckCommandTest.php');
        $this->assertFileExists($filename);
        $this->assertFileHash('c8536c2b2988088406bbab2e59ebd943', $filename);
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
        $this->assertFileHash('2c3713ffefcf2785c3e01532c2659d49', $filename);
        unlink($filename);

        $filename = TESTS . DS . 'TestCase' . DS . 'Http' . DS . 'Controller' . DS . 'Component' . DS . 'DummyComponentTest.php';
        $this->assertOutputContains('TestCase/Http/Controller/Component/DummyComponentTest.php');
        $this->assertFileExists($filename);
        $this->assertFileHash('86e1c62b3618876cdb0efcf2abb62669', $filename);
        unlink($filename);
    }

    public function testGenerateController()
    {
        $this->exec('generate --force controller Dummies');
        $this->assertExitSuccess();

        $filename = APP . DS . 'Http' . DS . 'Controller' . DS . 'DummiesController.php';
        $this->assertOutputContains('src/Http/Controller/DummiesController.php');
        $this->assertFileExists($filename);

        $this->assertFileHash('dc1f61d0c1119c390b21996ec14a00fa', $filename);
        unlink($filename);

        $filename = TESTS . DS . 'TestCase' . DS . 'Http' . DS . 'Controller' . DS . 'DummiesControllerTest.php';
        $this->assertOutputContains('tests/TestCase/Http/Controller/DummiesControllerTest.php');
        $this->assertFileExists($filename);

        $this->assertFileHash('7ab19b0e8c0139778baf10c0f70ddaaa', $filename);
        unlink($filename);
    }

    public function testGenerateControllerWithActions()
    {
        $this->exec('generate --force controller Dummies index get_user');
        $this->assertExitSuccess();

        $filename = APP . DS . 'Http' . DS . 'Controller' . DS . 'DummiesController.php';
        $this->assertOutputContains('src/Http/Controller/DummiesController.php');
        $this->assertFileExists($filename);

        $this->assertFileHash('9b7954d416cdf2e40b7f0c0226464ce7', $filename);
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

        $this->assertFileHash('e6af1d301eda3113f32c59fad2bc67df', $filename);
        unlink($filename);
    }

    public function testGenerateHelper()
    {
        $this->exec('generate --force helper Dummy');
        $this->assertExitSuccess();

        $filename = APP . DS . 'Http' . DS . 'View' . DS . 'Helper' . DS . 'DummyHelper.php';
        $this->assertOutputContains('src/Http/View/Helper/DummyHelper.php');
        $this->assertFileExists($filename);
        $this->assertFileHash('d0e38dae69dc129dfa278d7ae851b105', $filename);
        unlink($filename);

        $filename = TESTS . DS . 'TestCase' . DS . 'Http' . DS . 'View' . DS . 'Helper' . DS . 'DummyHelperTest.php';

        $this->assertOutputContains('TestCase/Http/View/Helper/DummyHelperTest.php');
        $this->assertFileExists($filename);

        $this->assertFileHash('034bf23b4db1ecb78a3222823c60674f', $filename);
        unlink($filename);
    }

    public function testGenerateMailer()
    {
        $this->exec('generate --force mailer Dummy');
        $this->assertExitSuccess();

        $filename = APP . DS . 'Mailer' . DS . 'DummyMailer.php';
        $this->assertOutputContains('src/Mailer/DummyMailer.php');
        $this->assertFileExists($filename);
       
      
        $this->assertFileHash('fc0a78aecdbdd46621a61b1a852e72fe', $filename);
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
        $this->assertFileHash('7d9c0f45e4e7f85a9f7b3e3bf2c3e189', $filename);
        unlink($filename);

        $filename = TESTS . DS . 'TestCase' . DS . 'Model' . DS . 'DummyTest.php';
        $this->assertOutputContains('tests/TestCase/Model/DummyTest.php');
        $this->assertFileExists($filename);
        $this->assertFileHash('05c6c43dbc4656699a3004a1d4d74aff', $filename);

        unlink($filename);

        $filename = TESTS . DS . 'Fixture' . DS . 'DummyFixture.php';
        $this->assertOutputContains('tests/Fixture/DummyFixture.php');
        $this->assertFileExists($filename);

        $this->assertFileHash('4decf52729ffda0af8e5a1a0d00c4dd0', $filename);
        unlink($filename);

        preg_match('/[0-9]{14}/', $this->output(), $match);
        $version = $match[0];
        $filename = DATABASE . DS . 'migrations' . DS . $version . 'CreateDummyTable.php';

        $this->assertOutputContains("database/migrations/{$version}CreateDummyTable.php");
        $this->assertFileExists($filename);
        $this->assertFileHash('5b5f02960fbf7c76d5e03dc7811b1b8d', $filename);
        unlink($filename);
    }

    public function testGenerateMiddleware()
    {
        $this->exec('generate --force middleware Dummy');
        $this->assertExitSuccess();
        $filename = APP . DS . 'Http' . DS . 'Middleware' . DS . 'DummyMiddleware.php';
        $this->assertOutputContains('src/Http/Middleware/DummyMiddleware.php');
        $this->assertFileExists($filename);
        $this->assertFileHash('3c34d9f22ad39400cbceb4b4970b6793', $filename);
        unlink($filename);

        $filename = TESTS . DS . 'TestCase' . DS . 'Http' . DS . 'Middleware' . DS . 'DummyMiddlewareTest.php';
        $this->assertOutputContains('TestCase/Http/Middleware/DummyMiddlewareTest.php');
        $this->assertFileExists($filename);
        $this->assertFileHash('6d77fa65e48f847764b4af0c5990b0aa', $filename);
        unlink($filename);
    }

    public function testGenerateJob()
    {
        $this->exec('generate --force job Dummy');
        $this->assertExitSuccess();
        $filename = APP . DS . 'Job' . DS . 'DummyJob.php';
        $this->assertOutputContains('src/Job/DummyJob.php');
        $this->assertFileExists($filename);
     
        $this->assertFileHash('8c38669b28943ac5c79f6c129229a219', $filename);
        unlink($filename);

        $filename = TESTS . DS . 'TestCase' . DS . 'Job' . DS . 'DummyJobTest.php';

        $this->assertOutputContains('TestCase/Job/DummyJobTest.php');
        $this->assertFileExists($filename);
        $this->assertFileHash('bbdc620307b1c6c992d999edad1805b7', $filename);
        unlink($filename);
    }

    public function testGenerateService()
    {
        $this->exec('generate --force service Dummy');
        $this->assertExitSuccess();
        $filename = APP . DS . 'Service' . DS . 'Dummy.php';
        $this->assertOutputContains('src/Service/Dummy.php');
        $this->assertFileExists($filename);
      
        $this->assertFileHash('771085fd1efd035c485a7120d8ada6fa', $filename);
        unlink($filename);

        $filename = TESTS . DS . 'TestCase' . DS . 'Service' . DS . 'DummyTest.php';
        $this->assertOutputContains('TestCase/Service/DummyTest.php');
        $this->assertFileExists($filename);
        $this->assertFileHash('63aa50f8a549c552a334cc0fcfc7f45f', $filename);
        unlink($filename);
    }

    public function testGenerateListener()
    {
        $this->exec('generate --force listener Dummy');
        $this->assertExitSuccess();
        $filename = APP . DS . 'Listener' . DS . 'DummyListener.php';
        $this->assertOutputContains('src/Listener/DummyListener.php');
        $this->assertFileExists($filename);

        $this->assertFileHash('0300c8215b2689d56e12202975701297', $filename);
        unlink($filename);

        $filename = TESTS . DS . 'TestCase' . DS . 'Listener' . DS . 'DummyListenerTest.php';
        $this->assertOutputContains('TestCase/Listener/DummyListenerTest.php');
        $this->assertFileExists($filename);
        $this->assertFileHash('e39ce0f812788c0c862498d10588e174', $filename);
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
        $this->assertFileHash('51c2eb1e341de520a1a32eb8df1f2a13', $filename);
        unlink($filename);
    }

    public function testPlugin()
    {
        $this->exec('generate --force plugin Dummy');
        $this->assertExitSuccess();

        $filename = PLUGINS . DS . 'dummy' . DS . 'src' . DS . 'Http' . DS . 'Controller' . DS . 'ApplicationController.php';
        $this->assertFileExists($filename);
        $this->assertFileHash('f8b748ee429f8450c4b25ec2c9f24536', $filename);

        $filename = PLUGINS . DS . 'dummy' . DS . 'src' . DS . 'Model' . DS . 'ApplicationModel.php';
        $this->assertFileExists($filename);
        $this->assertFileHash('fe486b940bfe3801936ab0cbadd31cce', $filename);

        $filename = PLUGINS . DS . 'dummy' . DS . 'config' . DS . 'routes.php';
        $this->assertFileExists($filename);
        $this->assertFileHash('6f107423fcdde9f10e7b099f8149b3cf', $filename);

        $filename = PLUGINS . DS . 'dummy' . DS . 'phpunit.xml';
        $this->assertFileExists($filename);
        $this->assertFileHash('6682a8306b3fb59117088aedf618b808', $filename);

        $filename = PLUGINS . DS . 'dummy' . DS . 'composer.json';
        $this->assertFileExists($filename);
        $this->assertFileHash('5efb8dd1e0de11ce659e00bdf657b462', $filename);

        $filename = PLUGINS . DS . 'dummy' . DS . 'tests/bootstrap.php';
        $this->assertFileExists($filename);
        $this->assertFileHash('a6cdc8b185d91fd6b6ac25058e4c4508', $filename);

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
