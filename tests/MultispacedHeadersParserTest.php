<?php
namespace DominionEnterprises\ColumnParser;

/**
 * @coversDefaultClass \DominionEnterprises\ColumnParser\MultispacedHeadersParser
 * @uses \DominionEnterprises\ColumnParser\LineParser\StrictColumnWidthsParser
 * @uses \DominionEnterprises\ColumnParser\HeaderParser\MultispacedParser
 */
class MultispacedHeadersParserTest extends \PHPUnit_Framework_TestCase
{
    private $_emptyData;
    private $_onlyHeaderData;
    private $_sampleData;

    public function __construct()
    {
        $this->_emptyData = '';
        $this->_onlyHeaderData = 'Name  Age  City of Birth';
        $this->_sampleData = <<<EOS
Name     Age  City of Birth
James    17   San Francisco, CA
Mary     18   Washington, D.C.
William  22   Dallas, TX
EOS;
    }

    /**
     * @test
     * @covers ::__construct
     * @covers ::getRows
     */
    public function getRowsFromSampleData()
    {
        $parser = new MultispacedHeadersParser($this->_sampleData);
        $this->assertSame(
            [
                ['Name' => 'James', 'Age' => '17', 'City of Birth' => 'San Francisco, CA'],
                ['Name' => 'Mary', 'Age' => '18', 'City of Birth' => 'Washington, D.C.'],
                ['Name' => 'William', 'Age' => '22', 'City of Birth' => 'Dallas, TX'],
            ],
            $parser->getRows()
        );
    }

    /**
     * @test
     * @covers ::__construct
     * @covers ::getRows
     */
    public function getRowsFromEmptyData()
    {
        $parser = new MultispacedHeadersParser($this->_emptyData);
        $this->assertSame([], $parser->getRows());
    }

    /**
     * @test
     * @covers ::__construct
     * @covers ::getRows
     */
    public function getRowsFromOnlyHeaderData()
    {
        $parser = new MultispacedHeadersParser($this->_onlyHeaderData);
        $this->assertSame([], $parser->getRows());
    }

    /**
     * @test
     * @covers ::__construct
     * @covers ::getHeaders
     */
    public function getHeadersFromSampleData()
    {
        $parser = new MultispacedHeadersParser($this->_sampleData);
        $this->assertSame(['Name', 'Age', 'City of Birth'], $parser->getHeaders());
    }

    /**
     * @test
     * @covers ::__construct
     * @covers ::getHeaders
     */
    public function getHeadersFromEmptyData()
    {
        $parser = new MultispacedHeadersParser($this->_emptyData);
        $this->assertSame([], $parser->getHeaders());
    }

    /**
     * @test
     * @covers ::__construct
     * @covers ::getHeaders
     */
    public function getHeadersFromOnlyHeaderData()
    {
        $parser = new MultispacedHeadersParser($this->_onlyHeaderData);
        $this->assertSame(['Name', 'Age', 'City of Birth'], $parser->getHeaders());
    }
}
