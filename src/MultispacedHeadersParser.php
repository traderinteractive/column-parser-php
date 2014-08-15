<?php
namespace DominionEnterprises\ColumnParser;

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

        $rows = [];
        foreach (array_slice($this->_lines, 1) as $line) {
            $rows[] = array_combine($columnHeaders, $this->_getColumns($line, $columnWidths));
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

        preg_match_all('/(.+?)(  +|$)/', $this->_lines[0], $matches);
        $columnHeaders = $matches[1];
        $columnWidths = array_map('strlen', $matches[0]);

        return [$columnHeaders, $columnWidths];
    }

    /**
     * Fetches the data from the line using the column widths to split the data.
     *
     * @param string $line The line of data
     * @param array $columnWidths The width of each column
     * @return array The data by column.
     */
    private function _getColumns($line, array $columnWidths)
    {
        $columns = [];

        $columnStart = 0;
        $lastColumnIndex = count($columnWidths) - 1;
        foreach ($columnWidths as $i => $columnWidth) {
            $columns[] = trim(substr($line, $columnStart, $i === $lastColumnIndex ? strlen($line) : $columnWidth));
            $columnStart += $columnWidth;
        }

        return $columns;
    }
}
