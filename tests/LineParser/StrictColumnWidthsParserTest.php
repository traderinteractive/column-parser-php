<?php
namespace DominionEnterprises\ColumnParser\LineParser;

use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \DominionEnterprises\ColumnParser\LineParser\StrictColumnWidthsParser
 */
class StrictColumnWidthsParserTest extends TestCase
{
    /**
     * This tests the basic getColumns behavior.
     *
     * @test
     * @covers ::__construct
     * @covers ::getColumns
     */
    public function getColumnsFromSampleLine()
    {
        $parser = new StrictColumnWidthsParser([9, 5, 13]);
        $this->assertSame(['James', '17', 'San Francisco, CA'], $parser->getColumns('James    17   San Francisco, CA'));
    }

    /**
     * This tests the getColumns behavior for an empty row.
     *
     * @test
     * @covers ::__construct
     * @covers ::getColumns
     */
    public function getColumnsFromEmptyLine()
    {
        $parser = new StrictColumnWidthsParser([9, 5, 13]);
        $this->assertSame(['', '', ''], $parser->getColumns(''));
    }

    /**
     * This tests the getColumns behavior for a row with fewer columns than in the columnWidths spec.
     *
     * @test
     * @covers ::__construct
     * @covers ::getColumns
     */
    public function getColumnsFromShortLine()
    {
        $parser = new StrictColumnWidthsParser([9, 5, 13]);
        $this->assertSame(['Mary', '18', ''], $parser->getColumns('Mary     18'));
    }
}
