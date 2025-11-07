class Cell {
  public readonly value: string | null;
  public marked: boolean;
  constructor (value: string | null, marked: boolean){
    this.value = value
    this.marked = marked
  }
}

class Coordinate {
  public readonly x: number;
  public readonly y: number;

  constructor(x: number, y: number){
    this.x = x;
    this.y = y;
  }
}

export class BingoBoard {
  private readonly theCells: Cell[][];

  constructor(width: number, height: number) {
    this.theCells = Array.from({ length: width }, () =>
      Array.from({ length: height }, () => new Cell(null, false))
    );
  }

  defineCellAt(position: Coordinate, value: string): void {
    if (this.theCells[position.x][position.y].value !== null) {
      throw new Error("cell already defined");
    }

    for (let c = 0; c < this.theCells.length; c++) {
      for (let r = 0; r < this.theCells[c].length; r++) {
        if (value === this.theCells[c][r].value) {
          throw new Error(`${value} already present at ${c},${r}`);
        }
      }
    }

    this.theCells[position.x][position.y] = new Cell(value, false);
  }

  defineCell(x: number, y: number, value: string): void {
    this.defineCellAt(new Coordinate(x,y), value);
  }

  markCell(x: number, y: number): void {
    if (!this.isInitialized()) {
      throw new Error("board not initialized");
    }
    this.theCells[x][y].marked = true;
  }

  isMarked(x: number, y: number): boolean {
    return this.isCellMarked(new Coordinate(x,y))
  }
  isCellMarked(position: Coordinate): boolean {
    return this.theCells[position.x][position.y].marked;
  }

  isInitialized(): boolean {
    for (const row of this.theCells) {
      for (const col of row) {
        if (col.value === null) {
          return false;
        }
      }
    }
    return true;
  }
}
