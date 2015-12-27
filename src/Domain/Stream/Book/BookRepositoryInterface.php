<?php

namespace Jacobemerick\Web\Domain\Stream\Book;

interface BookRepositoryInterface
{
    public function getBookById($id);
    public function getBookByFields($title, $author);
    public function getUnmappedBooks();
}
