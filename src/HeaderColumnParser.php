<?php

namespace TraderInteractive\ColumnParser;

interface HeaderColumnParser extends ColumnParser
{
    /**
     * Gets the column headers from the data.
     *
     * @return array The column headers in the data.
     */
    public function getHeaders() : array;
}
