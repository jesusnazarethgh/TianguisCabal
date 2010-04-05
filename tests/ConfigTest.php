<?php
define ('TO_ROOT', '..');
require_once 'PHPUnit/Framework.php';
require_once TO_ROOT . "/application/models/Config.inc.php";

class ConfigTest extends PHPUnit_Framework_TestCase
{
    public function testRead()
    {
      $config_array = parse_ini_file('config_test.ini');
      
      $Config = Config::getInstance('config_test.ini');
      $this->assertNotNull($Config);
            
      $this->assertEquals($config_array['field1'], $Config->field1);
      $this->assertEquals($config_array['field2'], $Config->field2);
      $this->assertEquals($config_array['field3'], $Config->field3);
    }
    
    public function testWriteAndSave()
    {
      $Config = Config::getInstance('config_test.ini');
      $this->assertNotNull($Config);
      
      $Config->field1 = 'writed_value1';
      $Config->field2 = 'writed_value2';
      $Config->field3 = 'writed_value3';
      
      $this->assertEquals($Config->field1, 'writed_value1');
      $this->assertEquals($Config->field2, 'writed_value2');
      $this->assertEquals($Config->field3, 'writed_value3');
      
      $Config->save('alternate_config.ini');
      $config_array = parse_ini_file('alternate_config.ini');
      
      $this->assertEquals('writed_value1', $config_array['field1']);
      $this->assertEquals('writed_value2', $config_array['field2']);
      $this->assertEquals('writed_value3', $config_array['field3']);
      
      //Empties file for further tests
      file_put_contents('alternate_config.ini', '');
    }
    
    public function testDefaultFilename()
    {
      $default_filename = TO_ROOT . "/application/config.ini";
      
      $this->assertFileExists($default_filename,
      'You must have an application config.ini to run this test');
      
      $Config = Config::getInstance();
      $this->assertNotNull($Config);
      
      $this->assertEquals($default_filename, $Config->getFilename());
    }
}