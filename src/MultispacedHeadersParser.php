<?php

namespace TraderInteractive\ColumnParser;

use TraderInteractive\ColumnParser\LineParser\StrictColumnWidthsParser;
use TraderInteractive\ColumnParser\HeaderParser\MultispacedParser;

/**
 * This parses a string where there are at least two spaces between the columns.  The first line in the string is the
 * headers.  Each header is expected to be separated by at least two spaces.  A single space is treated as interior
 * space of the header (i.e. multiple-word headers).
 */
class MultispacedHeadersParser implements HeaderColumnParser
{
    /**
     * @var array
     */
    private $lines;

    /**
     * @var string
     */
    private $headerLine;

    /**
     * @param string $contents The contents holding the data.
     */
    public function __construct(string $contents)
    {
        $allLines = array_filter(explode("\n", $contents));
        $this->lines = array_slice($allLines, 1);
        $this->headerLine = empty($allLines) ? '' : $allLines[0];
    }

    public function getRows() : array
    {
        $headers = (new MultispacedParser())->getMap($this->headerLine);
        $lineParser = new StrictColumnWidthsParser(array_values($headers));

        $rows = [];
        foreach ($this->lines as $line) {
            $rows[] = array_combine(array_keys($headers), $lineParser->getColumns($line));
        }

        return $rows;
    }

    public function getHeaders() : array
    {
        return array_keys((new MultispacedParser())->getMap($this->headerLine));
    }
}
