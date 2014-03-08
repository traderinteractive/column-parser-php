<?php
namespace DominionEnterprises\ColumnParser;

interface ColumnParser
{
    /**
     * Gets the rows from the data.
     *
     * @return array An array of rows, where each row is an array of data points (keyed by the column header for HeaderColumnParser's).
     */
    public function getRows();
}
