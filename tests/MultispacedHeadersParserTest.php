<?php

namespace TraderInteractive\ColumnParser;

use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \TraderInteractive\ColumnParser\MultispacedHeadersParser
 */
class MultispacedHeadersParserTest extends TestCase
{
    private $emptyData;
    private $onlyHeaderData;
    private $sampleData;

    public function setUp()
    {
        $this->emptyData = '';
        $this->onlyHeaderData = 'Name  Age  City of Birth';
        $this->sampleData = <<<EOS
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
        $parser = new MultispacedHeadersParser($this->sampleData);
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
        $parser = new MultispacedHeadersParser($this->emptyData);
        $this->assertSame([], $parser->getRows());
    }

    /**
     * @test
     * @covers ::__construct
     * @covers ::getRows
     */
    public function getRowsFromOnlyHeaderData()
    {
        $parser = new MultispacedHeadersParser($this->onlyHeaderData);
        $this->assertSame([], $parser->getRows());
    }

    /**
     * @test
     * @covers ::__construct
     * @covers ::getHeaders
     */
    public function getHeadersFromSampleData()
    {
        $parser = new MultispacedHeadersParser($this->sampleData);
        $this->assertSame(['Name', 'Age', 'City of Birth'], $parser->getHeaders());
    }

    /**
     * @test
     * @covers ::__construct
     * @covers ::getHeaders
     */
    public function getHeadersFromEmptyData()
    {
        $parser = new MultispacedHeadersParser($this->emptyData);
        $this->assertSame([], $parser->getHeaders());
    }

    /**
     * @test
     * @covers ::__construct
     * @covers ::getHeaders
     */
    public function getHeadersFromOnlyHeaderData()
    {
        $parser = new MultispacedHeadersParser($this->onlyHeaderData);
        $this->assertSame(['Name', 'Age', 'City of Birth'], $parser->getHeaders());
    }
}
