<?php
namespace DominionEnterprises\ColumnParser;

use DominionEnterprises\ColumnParser\LineParser\StrictColumnWidthsParser;

/**
 * This parses a string where there are at least two spaces between the columns.  The first line in the string is the headers.  Each header is
 * expected to be separated by at least two spaces.  A single space is treated as interior space of the header (i.e. multiple-word headers).
 */
class MultispacedHeadersParser implements HeaderColumnParser
{
    /**
     * @var array
     */
    private $_lines;

    /**
     * @param string $contents The contents holding the data.
     */
    public function __construct($contents)
    {
        $this->_lines = array_filter(explode("\n", $contents));
    }

    public function getRows()
    {
        list($columnHeaders, $columnWidths) = $this->_getHeaderSpec();
        $lineParser = new StrictColumnWidthsParser($columnWidths);

        $rows = [];
        foreach (array_slice($this->_lines, 1) as $line) {
            $rows[] = array_combine($columnHeaders, $lineParser->getColumns($line));
        }

        return $rows;
    }

    public function getHeaders()
    {
        list($columnHeaders,) = $this->_getHeaderSpec();

        return $columnHeaders;
    }

    /**
     * Pulls out the column names and column widths of the header row.
     *
     * @return array Two items: the column names and the column widths.
     */
    private function _getHeaderSpec()
    {
        if (empty($this->_lines)) {
            return [[], []];
        }

        preg_match_all('/(.+?)( {2,}|$)/', $this->_lines[0], $matches);
        $columnHeaders = $matches[1];
        $columnWidths = array_map('strlen', $matches[0]);

        return [$columnHeaders, $columnWidths];
    }
}
