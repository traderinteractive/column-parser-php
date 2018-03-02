<?php

namespace TraderInteractive\ColumnParser\LineParser;

/**
 * This splits a single line based on the pre-determined column widths.
 */
class StrictColumnWidthsParser
{
    /**
     * @var array
     */
    private $columnWidths;

    /**
     * Initialize the line parser.
     *
     * @param array $columnWidths The widths of each column in bytes.
     */
    public function __construct(array $columnWidths)
    {
        $this->columnWidths = $columnWidths;
    }

    /**
     * Fetches the data from the line using the column widths to split the data.
     *
     * The last column's width is ignored and the full width of the line is used.  Each column is trimmed of whitespace.
     *
     * @param string $line The line of data.
     * @return array The data by column.
     */
    public function getColumns($line)
    {
        $columns = [];

        $columnStart = 0;
        $lastColumnIndex = count($this->columnWidths) - 1;
        foreach ($this->columnWidths as $i => $columnWidth) {
            $actualWidth = $i === $lastColumnIndex ? strlen($line) : $columnWidth;
            $columns[] = trim(substr($line, $columnStart, $actualWidth));
            $columnStart += $actualWidth;
        }

        return $columns;
    }
}
