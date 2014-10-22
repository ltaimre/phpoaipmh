<?php

namespace Phpoaipmh;
use PHPUnit_Framework_TestCase;

class EndpointTest extends PHPUnit_Framework_TestCase
{

    // -------------------------------------------------------------------------

    /**
     * Simple Instantiation Test
     *
     * Tests that no syntax or runtime errors occur during object insantiation
     */
    public function testInsantiateCreatesNewObject()
    {    
        $obj = new Endpoint($this->getMockClient());
        $this->assertInstanceOf('Phpoaipmh\Endpoint', $obj);
    }    

    // -------------------------------------------------------------------------

    /**
     * Test that identify returns a valid SimpleXMLElement
     */
    public function testIdentifyReturnsSimpleXMLDocument()
    {
        //Build mock object
        $retVal = simplexml_load_file($this->getSampleXML('GoodResponseIdentify.xml'));
        $client = $this->getMockClient($retVal);

        //Do it
        $obj = new Endpoint($client);
        $response = $obj->identify();

        //Check results
        $this->assertInstanceof('SimpleXMLElement', $response);
        $this->assertObjectHasAttribute('Identify', $response);
    }

    // -------------------------------------------------------------------------

    /**
     * Test that list MetaDataFormats resturns valid array
     */
    public function testListMetaDataFormatsReturnsValidArray() 
    {

    }

    // -------------------------------------------------------------------------

    /**
     * Shortcut to load contents of a sample XML file
     */
    protected function getSampleXML($file)
    {
        return __DIR__ . '/../fixtures/SampleXML/' . $file;
    }  

    // -------------------------------------------------------------------------

    protected function getMockClient($retVal = null)
    {
        $mock = $this->getMockBuilder('Phpoaipmh\Client')->disableOriginalConstructor()->getMock();
        $mock->expects($this->any())->method('request')->will($this->returnValue($retVal));
        return $mock;
    }
}

/* EndpointTest.php */