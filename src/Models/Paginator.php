<?php

namespace App\Models;

class Paginator
{
    public int $totalPages;
    public int $recordOffset;

    public function __construct(
        public int $totalRecords,
        public int $recordsPerpage,
        public int $currentPage = 1
    ) {
        $this->totalPages = ceil($totalRecords / $recordsPerpage);

        if ($currentPage < 1)
            $this->currentPage = 1;

        $this->recordOffset = ($this->currentPage - 1) * $this->recordsPerpage;
    }

    public function getPrevPage(): int|bool
    {
        if ($this->currentPage > 1)
            return $this->currentPage - 1;
        else
            return false;
    }

    public function getNextpage(): int|bool
    {
        if ($this->currentPage < $this->totalPages)
            return $this->currentPage + 1;
        else
            return false;
    }

    public function getPages(int $length = 3): array
    {
        $halfLength = floor($length / 2);
        $pageStart = $this->currentPage - $halfLength;
        $pageEnd = $this->currentPage + $halfLength;

        if ($pageStart < 1) {
            $pageStart = 1;
            $pageEnd = $length;
        }

        if ($pageEnd > $this->totalPages) {
            $pageEnd = $this->totalPages;
            $pageStart = $pageEnd - $length + 1;

            if ($this->totalPages === 0) {
                $pageEnd = 1;
            }

            if ($pageStart < 1) {
                $pageStart = 1;
            }
        }
        return range((int)$pageStart, (int)$pageEnd);
    }
}
