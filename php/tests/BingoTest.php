<?php

namespace KataTest;

use Kata\BingoBoard;
use Kata\Coordinate;
use PHPUnit\Framework\TestCase;

class BingoTest extends TestCase
{
    private BingoBoard $board;

    public function testAnNewlyCreatedBoardIsNotInitialized(): void
    {
        $this->board = new BingoBoard(1, 1);
        $this->assertFalse($this->board->isInitialized());
    }

    public function testWhenAllFieldsAreSetTheBoardIsInitialized(): void
    {
        $anyValue = "42";
        $this->board = new BingoBoard(1, 1);
        $bingoBoard = $this->board;
        $bingoBoard->defineCell(new Coordinate(0, 0), $anyValue);
        $this->assertTrue($this->board->isInitialized());
    }

    public function testWhenAllFieldsOnRectangularBoardAreSetItIsInitialized(): void
    {
        $one = "one, two, three";
        $two = "Bingo cells can contain any text";
        $this->board = new BingoBoard(1, 2);
        $bingoBoard1 = $this->board;
        $bingoBoard1->defineCell(new Coordinate(0, 0), $one);
        $bingoBoard = $this->board;
        $bingoBoard->defineCell(new Coordinate(0, 1), $two);
        $this->assertTrue($this->board->isInitialized());
    }

    public function testADefinedCellCantBeRedefinedEvenIfItsTheSameValue(): void
    {
        $anyValue = "42";
        $this->board = new BingoBoard(1, 1);
        $bingoBoard1 = $this->board;
        $bingoBoard1->defineCell(new Coordinate(0, 0), $anyValue);

        $this->expectException(\RuntimeException::class);
//        $this->expectExceptionMessageMatches('/already defined/');
        $bingoBoard = $this->board;
        $bingoBoard->defineCell(new Coordinate(0, 0), $anyValue);
    }

    public function testDuplicateCellsAreNotAllowed(): void
    {
        $anyValue = "42";
        $this->board = new BingoBoard(2, 2);
        $bingoBoard1 = $this->board;
        $bingoBoard1->defineCell(new Coordinate(0, 1), $anyValue);

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessageMatches('/' . preg_quote($anyValue . " already present at 0,1") . '/');
        $bingoBoard = $this->board;
        $bingoBoard->defineCell(new Coordinate(1, 0), $anyValue);
    }

    public function testANonInitializedBoardCannotBeMarked(): void
    {
        $this->board = new BingoBoard(1, 1);

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessageMatches('/not initialized/');
        $bingoBoard = $this->board;
        $bingoBoard->markCell(new Coordinate(0, 0));
    }

    public function testWhenAllCellGetsMarkedItIsMarked(): void
    {
        $anyValue = "42";
        $this->board = new BingoBoard(1, 1);
        $bingoBoard2 = $this->board;
        $bingoBoard2->defineCell(new Coordinate(0, 0), $anyValue);
        $bingoBoard1 = $this->board;
        $bingoBoard1->markCell(new Coordinate(0, 0));
        $bingoBoard = $this->board;
        $this->assertTrue($bingoBoard->isMarked(new Coordinate(0, 0)));
    }
}
