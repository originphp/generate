<?php

namespace Origin\Test\Console\Command;

use Origin\TestSuite\OriginTestCase;
use Origin\TestSuite\ConsoleIntegrationTestTrait;

class GenerateCommandTest extends OriginTestCase
{
    use ConsoleIntegrationTestTrait;

    protected $fixtures = ['Bookmark','BookmarksTag','Tag','User'];

    public function testGenerateException()
    {
        $this->exec('generate --force exception Dummy');
        $this->assertExitSuccess();
       
        $filename = APP.DS.'Exception'.DS.'DummyException.php';
        $this->assertOutputContains('src/Exception/DummyException.php');
        $this->assertFileExists($filename);
     
        $this->assertFileHash('9900476d5c5d1fa3cebea05f61ae21d2', $filename);
        unlink($filename);
    }

    public function testGenerateQuery()
    {
        $this->exec('generate --force query Dummy');
        $this->assertExitSuccess();

        $filename = APP.DS.'Model'.DS.'Query'.DS.'DummyQuery.php';
        $this->assertOutputContains('src/Model/Query/DummyQuery.php');
        $this->assertFileExists($filename);
     
        $this->assertFileHash('639d1dab1b4fb258b99150696c7d3793', $filename);
        unlink($filename);

        $filename = TESTS.DS.'TestCase'.DS.'Model'.DS.'Query'.DS.'DummyQueryTest.php';
        $this->assertOutputContains('TestCase/Model/Query/DummyQueryTest.php');
        $this->assertFileExists($filename);
        $this->assertFileHash('73b53abcf6df2a1720259c5da5294bfd', $filename);
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
       
        $this->assertFileHash('ae4389221897c48b12d35b3755969059', APP . DS .'Http'. DS . 'Controller' . DS . 'BookmarksController.php');
        unlink(APP . DS .'Http'. DS .  'Controller' . DS . 'BookmarksController.php');
     
        $this->assertFileHash('9298725c00be555fb7b8751484f41780', APP . DS . 'Http'. DS .'View' . DS . 'Bookmarks' . DS . 'add.ctp');
        unlink(APP . DS . 'Http'. DS . 'View' . DS . 'Bookmarks' . DS . 'add.ctp');

        $this->assertFileHash('11ed3ae60350bfc07c170aae750e02d1', APP . DS . 'Http'. DS .'View' . DS . 'Bookmarks' . DS . 'edit.ctp');
        unlink(APP . DS . 'Http'. DS . 'View' . DS . 'Bookmarks' . DS . 'edit.ctp');

        $this->assertFileHash('c8d3d6cd1474cee688f8173d1a640b08', APP . DS . 'Http'. DS .'View' . DS . 'Bookmarks' . DS . 'index.ctp');
        unlink(APP . DS . 'Http'. DS . 'View' . DS . 'Bookmarks' . DS . 'index.ctp');

        $this->assertFileHash('193fa37f0d96400e39d025b6a0f92a2d', APP . DS . 'Http'. DS .'View' . DS . 'Bookmarks' . DS . 'view.ctp');
        unlink(APP . DS . 'Http'. DS . 'View' . DS . 'Bookmarks' . DS . 'view.ctp');
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
    public function testGenerateConcernModel()
    {
        $this->exec('generate --force concern_model Dummy');
        $this->assertExitSuccess();

        $filename = APP.DS.'Model'.DS.'Concern'.DS.'Dummy.php';
        $this->assertOutputContains('src/Model/Concern/Dummy.php');
        $this->assertFileExists($filename);
     
        $this->assertFileHash('c6a4a2fdb569b3ef936189ae824627f4', $filename);
        unlink($filename);

        $filename = TESTS.DS.'TestCase'.DS.'Model'.DS.'Concern'.DS.'DummyTest.php';
        $this->assertOutputContains('TestCase/Model/Concern/DummyTest.php');
        $this->assertFileExists($filename);
        $this->assertFileHash('c8322202c4740b13d17267801aa58ae4', $filename);
        unlink($filename);
    }

    public function testGenerateEntity()
    {
        $this->exec('generate --force entity Dummy');
        $this->assertExitSuccess();

        $filename = APP.DS.'Model'.DS.'Entity'.DS.'Dummy.php';
        $this->assertOutputContains('src/Model/Entity/Dummy.php');
        $this->assertFileExists($filename);
     
        $this->assertFileHash('04fad3b577c8f9f19bea579100c6392d', $filename);
        unlink($filename);

        $filename = TESTS.DS.'TestCase'.DS.'Model'.DS.'Entity'.DS.'DummyTest.php';
        $this->assertOutputContains('TestCase/Model/Entity/DummyTest.php');
        $this->assertFileExists($filename);
        $this->assertFileHash('8e207b0ecf03008a057ace54122cfe79', $filename);
        unlink($filename);
    }

    public function testGenerateConcernController()
    {
        $this->exec('generate --force concern_controller Dummy');
        $this->assertExitSuccess();

        $filename = APP.DS.'Http'.DS. 'Controller'.DS.'Concern'.DS.'Dummy.php';
        $this->assertOutputContains('src/Http/Controller/Concern/Dummy.php');
        $this->assertFileExists($filename);
       
        $this->assertFileHash('dd9b722a1b7d7b711faece5697b85040', $filename);
        unlink($filename);

        $filename = TESTS.DS.'TestCase'.DS.'Http'.DS.'Controller'.DS.'Concern'.DS.'DummyTest.php';
        $this->assertOutputContains('TestCase/Http/Controller/Concern/DummyTest.php');
        $this->assertFileExists($filename);
        $this->assertFileHash('5245051fbd109926d5ea27ff2995eb35', $filename);
        unlink($filename);
    }

    public function testGenerateRepository()
    {
        $this->exec('generate --force repository Dummy');
        $this->assertExitSuccess();

        $filename = APP.DS.'Model'.DS.'Repository'.DS.'DummyRepository.php';
        $this->assertOutputContains('src/Model/Repository/DummyRepository.php');
        $this->assertFileExists($filename);
        $this->assertFileHash('b41bee29bcc844865a14be2a8f1ed0fd', $filename);
        unlink($filename);

        $filename = TESTS.DS.'TestCase'.DS.'Model'.DS.'Repository'.DS.'DummyRepositoryTest.php';
        $this->assertOutputContains('TestCase/Model/Repository/DummyRepositoryTest.php');
        $this->assertFileExists($filename);
        $this->assertFileHash('99c36a0c3b320920fc1e64ab1ef64c7d', $filename);
        unlink($filename);
    }

    public function testInteractive()
    {
        // this can be annoying when changes are maded
        @unlink(APP.DS.'Model'.DS.'Concern'.DS.'Fooable.php');
        @unlink(TESTS.DS.'TestCase'.DS.'Model'.DS.'Concern'.DS.'FooableTest.php');

        $this->exec('generate', ['concern_model','Fooable']);
        $this->assertExitSuccess();

        $filename = APP.DS.'Model'.DS.'Concern'.DS.'Fooable.php';
        $this->assertOutputContains('src/Model/Concern/Fooable.php');

        $this->assertFileExists($filename);
        $this->assertFileHash('321bbeb920263f5850cbe38c990bdb0e', $filename);
        unlink($filename);

        $filename = TESTS.DS.'TestCase'.DS.'Model'.DS.'Concern'.DS.'FooableTest.php';
        $this->assertFileExists($filename);
        $this->assertFileHash('85e15621dbd6851241c16cd68d8a80f7', $filename);
        unlink($filename);
    }

    public function testGenerateCommand()
    {
        $this->exec('generate --force command Dummy');
        $this->assertExitSuccess();

        $filename = APP.DS.'Console'.DS.'Command'.DS.'DummyCommand.php';
        $this->assertOutputContains('src/Console/Command/DummyCommand.php');
    
        $this->assertFileHash('a97bcafcde9885e1658e47aae3c6c2d1', $filename);
        unlink($filename);
        
        $filename = TESTS.DS.'TestCase'.DS.'Console'.DS.'Command'.DS.'DummyCommandTest.php';
        $this->assertOutputContains('tests/TestCase/Console/Command/DummyCommandTest.php');
        $this->assertFileExists($filename);
        $this->assertFileHash('d52c5020bacf6814c7e586c857cb685f', $filename);
        unlink($filename);
    }

    public function testGenerateCommandPlugin()
    {
        $this->exec('generate --force command ContactManager.Duck');
        $this->assertExitSuccess();

        $filename = PLUGINS .DS.'contact_manager'.DS.'src'.DS.'Console'.DS.'Command'.DS.'DuckCommand.php';
 
        $this->assertOutputContains('contact_manager/src/Console/Command/DuckCommand.php');
        $this->assertFileHash('3645eded9e53b8b4cc2561ee4c65741c', $filename);
        unlink($filename);

        $filename = PLUGINS .DS.'contact_manager'.DS.'tests'.DS.'TestCase'.DS.'Console'.DS.'Command'.DS.'DuckCommandTest.php';
     
        $this->assertOutputContains('contact_manager/tests/TestCase/Console/Command/DuckCommandTest.php');
        $this->assertFileExists($filename);
        $this->assertFileHash('3df2fbe6dad0388ccc8f61afba77cb2c', $filename);
        unlink($filename);

        $this->recursiveDelete(PLUGINS.DS.'contact_manager');
    }

    public function testGenerateComponent()
    {
        $this->exec('generate --force component Dummy');
        $this->assertExitSuccess();
        $filename = APP.DS.'Http'.DS.'Controller'.DS.'Component'.DS.'DummyComponent.php';
        $this->assertOutputContains('src/Http/Controller/Component/DummyComponent.php');
        $this->assertFileExists($filename);
        $this->assertFileHash('aa23c61ba00c7a6b6d72f5080905e847', $filename);
        unlink($filename);

        $filename = TESTS.DS.'TestCase'.DS.'Http'.DS.'Controller'.DS.'Component'.DS.'DummyComponentTest.php';
        $this->assertOutputContains('TestCase/Http/Controller/Component/DummyComponentTest.php');
        $this->assertFileExists($filename);
        $this->assertFileHash('d7593e303d2ad08f22342b4aed4daf7c', $filename);
        unlink($filename);
    }

    public function testGenerateController()
    {
        $this->exec('generate --force controller Dummies');
        $this->assertExitSuccess();

        $filename = APP.DS.'Http'.DS.'Controller'.DS.'DummiesController.php';
        $this->assertOutputContains('src/Http/Controller/DummiesController.php');
        $this->assertFileExists($filename);
  
        $this->assertFileHash('e3bd4cdefe22d0ee56e0639bd4d799b9', $filename);
        unlink($filename);

        $filename = TESTS.DS.'TestCase'.DS.'Http'.DS.'Controller'.DS.'DummiesControllerTest.php';
        $this->assertOutputContains('tests/TestCase/Http/Controller/DummiesControllerTest.php');
        $this->assertFileExists($filename);
        
        $this->assertFileHash('b9593d31c14bd8ca9d63578a462eeb36', $filename);
        unlink($filename);
    }

    public function testGenerateControllerWithActions()
    {
        $this->exec('generate --force controller Dummies index get_user');
        $this->assertExitSuccess();

        $filename = APP.DS.'Http'.DS.'Controller'.DS.'DummiesController.php';
        $this->assertOutputContains('src/Http/Controller/DummiesController.php');
        $this->assertFileExists($filename);
       
        $this->assertFileHash('760ff82986ee54521cb940870a7f8da7', $filename);
        unlink($filename);

        $filename = APP.DS.'Http'.DS.'View'.DS.'Dummies'.DS .'index.ctp';
        $this->assertOutputContains('src/Http/View/Dummies/index.ctp');
        $this->assertFileExists($filename);
        $this->assertFileHash('af90a7a0bfcd3a6ff30c0aac82c94c16', $filename);
        unlink($filename);

        $filename = APP.DS.'Http'.DS.'View'.DS.'Dummies'.DS .'get_user.ctp';
        $this->assertOutputContains('src/Http/View/Dummies/get_user.ctp');
        $this->assertFileExists($filename);
        $this->assertFileHash('9263ed82c0e1859690365808dcd719b0', $filename);
        unlink($filename);

        $filename = TESTS.DS.'TestCase'.DS.'Http'.DS.'Controller'.DS.'DummiesControllerTest.php';
        $this->assertOutputContains('tests/TestCase/Http/Controller/DummiesControllerTest.php');
        $this->assertFileExists($filename);
      
        $this->assertFileHash('16386b76fd2c6b077957910bfe576893', $filename);
        unlink($filename);
    }

    public function testGenerateHelper()
    {
        $this->exec('generate --force helper Dummy');
        $this->assertExitSuccess();

        $filename = APP.DS.'Http'.DS.'View'.DS.'Helper'.DS.'DummyHelper.php';
        $this->assertOutputContains('src/Http/View/Helper/DummyHelper.php');
        $this->assertFileExists($filename);
        $this->assertFileHash('0e14d3a77be9c244bc02c2c1a823a69c', $filename);
        unlink($filename);

        $filename = TESTS.DS.'TestCase'.DS .'Http'.DS.'View'.DS.'Helper'.DS.'DummyHelperTest.php';
       
        $this->assertOutputContains('TestCase/Http/View/Helper/DummyHelperTest.php');
        $this->assertFileExists($filename);

        $this->assertFileHash('cd38b58b7a13c0f76f52ee1c8b1360d3', $filename);
        unlink($filename);
    }

    public function testGenerateMailer()
    {
        $this->exec('generate --force mailer Dummy');
        $this->assertExitSuccess();

        $filename = APP.DS.'Mailer'.DS.'DummyMailer.php';
        $this->assertOutputContains('src/Mailer/DummyMailer.php');
        $this->assertFileExists($filename);
     
        $this->assertFileHash('f9a3b65f5a1e6fae46b71fbe56e82f63', $filename);
        unlink($filename);
    
        $filename = TESTS.DS.'TestCase'.DS .'Mailer'.DS.'DummyMailerTest.php';
       
        $this->assertOutputContains('TestCase/Mailer/DummyMailerTest.php');
        $this->assertFileExists($filename);
        
        $this->assertFileHash('3c59f7f5ca9b3be50a8d3b38e17f9be4', $filename);
        unlink($filename);

        $filename = APP.DS.'Mailer'.DS.'Template'.DS .'dummy.html.ctp';
        $this->assertOutputContains('src/Mailer/Template/dummy.html.ctp');
        $this->assertFileHash('dcd7e3b40d5e4d840e8e2ba0a9721a81', $filename);
        unlink($filename);

        $filename = APP.DS.'Mailer'.DS.'Template'.DS .'dummy.text.ctp';
        $this->assertOutputContains('src/Mailer/Template/dummy.text.ctp');
        $this->assertFileHash('b336631ad91ce8c22975f1bea7c0da4e', $filename);
        unlink($filename);
    }

    public function testGenerateModel()
    {
        $this->exec('generate --force model Dummy name:string description:text');
        $this->assertExitSuccess();

        $filename = APP.DS.'Model'.DS.'Dummy.php';
        $this->assertOutputContains('src/Model/Dummy.php');
        $this->assertFileExists($filename);
        $this->assertFileHash('b387ebc5275a5c389b3f08f0429e6e66', $filename);
        unlink($filename);

        $filename = TESTS.DS.'TestCase'.DS.'Model'.DS.'DummyTest.php';
        $this->assertOutputContains('tests/TestCase/Model/DummyTest.php');
        $this->assertFileExists($filename);
        $this->assertFileHash('65d447d47d3ece7e2823d07bc7365eb9', $filename);
   
        unlink($filename);

        $filename = TESTS.DS.'Fixture'.DS.'DummyFixture.php';
        $this->assertOutputContains('tests/Fixture/DummyFixture.php');
        $this->assertFileExists($filename);
        
        $this->assertFileHash('2641623321e74f683a10aa8ef170f358', $filename);
        unlink($filename);

        preg_match('/[0-9]{14}/', $this->output(), $match);
        $version = $match[0];
        $filename = DATABASE.DS.'migrations'.DS.$version.'CreateDummyTable.php';
        
        $this->assertOutputContains("database/migrations/{$version}CreateDummyTable.php");
        $this->assertFileExists($filename);
        $this->assertFileHash('c1ac45eb671fb571e313b97e4acf93d1', $filename);
        unlink($filename);
    }

    public function testGenerateMiddleware()
    {
        $this->exec('generate --force middleware Dummy');
        $this->assertExitSuccess();
        $filename = APP.DS.'Http'.DS.'Middleware'.DS.'DummyMiddleware.php';
        $this->assertOutputContains('src/Http/Middleware/DummyMiddleware.php');
        $this->assertFileExists($filename);
        $this->assertFileHash('be60a9605ce0e8a6b1802fdae806e637', $filename);
        unlink($filename);

        $filename = TESTS.DS.'TestCase'.DS .'Http'.DS . 'Middleware'.DS.'DummyMiddlewareTest.php';
        $this->assertOutputContains('TestCase/Http/Middleware/DummyMiddlewareTest.php');
        $this->assertFileExists($filename);
        $this->assertFileHash('7f727124d4b544fd41ba510721bd03c9', $filename);
        unlink($filename);
    }

    public function testGenerateJob()
    {
        $this->exec('generate --force job Dummy');
        $this->assertExitSuccess();
        $filename = APP.DS.'Job'.DS.'DummyJob.php';
        $this->assertOutputContains('src/Job/DummyJob.php');
        $this->assertFileExists($filename);
       
        $this->assertFileHash('0984d9a93e59bff93043b73740c4f5a0', $filename);
        unlink($filename);
        
        $filename = TESTS.DS.'TestCase'.DS .'Job'.DS.'DummyJobTest.php';
        
        $this->assertOutputContains('TestCase/Job/DummyJobTest.php');
        $this->assertFileExists($filename);
        $this->assertFileHash('28d0468f468231a41bc93ce4ba8b8cf0', $filename);
        unlink($filename);
    }

    public function testGenerateService()
    {
        $this->exec('generate --force service Dummy');
        $this->assertExitSuccess();
        $filename = APP.DS.'Service'.DS.'DummyService.php';
        $this->assertOutputContains('src/Service/DummyService.php');
        $this->assertFileExists($filename);
    
        $this->assertFileHash('15d9b54e6aa52f13977520f683b31c63', $filename);
        unlink($filename);
        
        $filename = TESTS.DS.'TestCase'.DS .'Service'.DS.'DummyServiceTest.php';
        $this->assertOutputContains('TestCase/Service/DummyServiceTest.php');
        $this->assertFileExists($filename);
        $this->assertFileHash('bd5f6975a3b595468889d17f957f04ba', $filename);
        unlink($filename);
    }

    public function testGenerateListener()
    {
        $this->exec('generate --force listener Dummy');
        $this->assertExitSuccess();
        $filename = APP.DS.'Listener'.DS.'DummyListener.php';
        $this->assertOutputContains('src/Listener/DummyListener.php');
        $this->assertFileExists($filename);
    
        $this->assertFileHash('3b69bf530ffbf24f31a6936617642e54', $filename);
        unlink($filename);
        
        $filename = TESTS.DS.'TestCase'.DS .'Listener'.DS.'DummyListenerTest.php';
        $this->assertOutputContains('TestCase/Listener/DummyListenerTest.php');
        $this->assertFileExists($filename);
        $this->assertFileHash('909dfdb338c53cb6c56089e735f86531', $filename);
        unlink($filename);
    }

    public function testGenerateMigration()
    {
        $this->exec('generate --force migration Dummy');
        $this->assertExitSuccess();

        preg_match('/[0-9]{14}/', $this->output(), $match);
        $version = $match[0];

        $filename = DATABASE .DS.'migrations'.DS.$version.'Dummy.php';
        
        $this->assertOutputContains("database/migrations/{$version}Dummy.php");
        $this->assertFileExists($filename);
        $this->assertFileHash('7ae46d1b60868d54f09ccce43ca35068', $filename);
        unlink($filename);
    }

    public function testPlugin()
    {
        $this->exec('generate --force plugin Dummy');
        $this->assertExitSuccess();

        $filename = PLUGINS .DS.'dummy'.DS.'src'.DS.'Http'.DS.'Controller'.DS.'DummyApplicationController.php';
        $this->assertFileExists($filename);
        $this->assertFileHash('b056004d9383d8b6cc982dbd17a1cb60', $filename);

        $filename = PLUGINS.DS.'dummy'.DS.'src'.DS.'Model'.DS.'DummyApplicationModel.php';
        $this->assertFileExists($filename);
        $this->assertFileHash('66d57a656bd1290df6358294566a0d3d', $filename);

        $filename = PLUGINS.DS.'dummy'.DS.'config'.DS.'routes.php';
        $this->assertFileExists($filename);
        $this->assertFileHash('6f107423fcdde9f10e7b099f8149b3cf', $filename);

        $filename = PLUGINS.DS.'dummy'.DS.'phpunit.xml';
        $this->assertFileExists($filename);
        $this->assertFileHash('547d46441f0876bac9d21742def30bc4', $filename);

        $filename = PLUGINS.DS.'dummy'.DS.'composer.json';
        $this->assertFileExists($filename);
        $this->assertFileHash('3aac15995b02c9505537ccdb85130f31', $filename);

        $this->recursiveDelete(PLUGINS.DS.'dummy');
    }

    /*

        'plugin' => 'Generates a plugin skeleton',
        */

    protected function assertFileHash(string $hash, String $filename)
    {
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
