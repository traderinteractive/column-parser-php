<?php

namespace TraderInteractive\ColumnParser\HeaderParser;

/**
 * This determines the widths of each column in a header row.
 */
class MultispacedParser
{
    /**
     * Splits a line on consecutive spaces (2+) to determine the width of the column and the column header.
     *
     * The trailing spaces are counted as part of the width of the column, but aren't included in the header.
     *
     * @param string $line The line of data.
     * @return array A map of column header => column width.
     */
    public function getMap($line)
    {
        preg_match_all('/(.+?)( {2,}|$)/', $line, $matches);
        $columnHeaders = $matches[1];
        $columnWidths = array_map('strlen', $matches[0]);

        return array_combine($columnHeaders, $columnWidths);
    }
}
